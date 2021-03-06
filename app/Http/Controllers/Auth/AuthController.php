<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mailers\AppMailer;
use App\Repositories\AccountRepository;
use App\Services\ActivationService;
use App\Social;
use App\User;
use Auth;
use Faker\Factory as Faker;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Socialite;
use Validator;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    protected $activationService;

    public function __construct(ActivationService $activationService, AccountRepository $accountRepo)
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->activationService = $activationService;
        $this->accountRepo = $accountRepo;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:intact_users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        // echo '<pre>' . print_r($request->all(), 1) . '</pre>';

        

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());

        $this->accountRepo->createAccount($user);
        
        $this->activationService->sendActivationMail($user);

        return redirect('/login')->with('status', 'We sent you an activation code. Check your email.');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return  User::create([
            // 'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'password_text' => $data['password'],
            'affiliate_id' => isset($data['eoffice_id']) ? $data['eoffice_id'] : '',
        ]);
        
    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->activated) {
            $this->activationService->sendActivationMail($user);
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
            // return back()->flash('status', 'We sent you an activation code. Check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }

    public function activateUser($token)
    {
        if ($user = $this->activationService->activateUser($token)) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }
        abort(404);
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver( $provider )->redirect();
    }
 
    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {

        $user = Socialite::driver( $provider )->user();
        // dd($user);
        $user->email = $provider=='twitter' ? $user->nickname : $user->email;
        $socialUser = null;

        //Check is this email present
        $userCheck = User::where('email', '=', $user->email)->first();

        if(!empty($userCheck))
        {
            $socialUser = $userCheck;
        }
        else
        {
            $sameSocialId = Social::where('social_id', '=', $user->id)->where('provider', '=', $provider )->first();

            if(empty($sameSocialId))
            {
                $password = Faker::create()-> password();
                //There is no combination of this social id and provider, so create new one
                $newSocialUser = new User;
                $newSocialUser->email        = $user->email;
                $newSocialUser->name         = $user->name;
                $newSocialUser->password     =  bcrypt($password);
                $newSocialUser->activated     =  true;
                $newSocialUser->save();

                $this->accountRepo->createAccount($newSocialUser);

                // $this->sendPasswordforSocial($newSocialUser, $password);

                $socialData = new Social;
                $socialData->social_id = $user->id;
                $socialData->provider= $provider;
                $socialData->avatar= $user->avatar;
                $newSocialUser->social()->save($socialData);

                $socialUser = $newSocialUser;
            }
            else
            {
                //Load this existing social user
                $socialUser = $sameSocialId->user;
            }
        }
        // $this->auth->login($socialUser, true);
        Auth::login($socialUser, true);

        return redirect('home');
       
    }

    protected function sendPasswordforSocial($user, $password)
    {
        Mail::queue('emails.password', compact('user', 'password'), function($message) use ($user){
            $message->to($user->email)->subject('Temporary Password');
        });
    }

    public function showLoginFormAffiliate(Request $request)
    {
        
        // Session::flush();
        Session::put('affiliate_id', $request->eoffice_id);
        
        $eoffice_id = $request->eoffice_id;

        $view = property_exists($this, 'loginView')
                    ? $this->loginView : 'auth.authenticate';

        if (view()->exists($view)) {
            return view($view);
        }

        return view('auth.login',compact('eoffice_id'));

    }
 
}
