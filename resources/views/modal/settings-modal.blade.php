<!-- Settings Modal -->
<div class="modal fade" id="SettingsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#profilesettings" aria-controls="profilesettings" role="tab" data-toggle="tab">Profile Setting</a></li>
                    <li role="presentation"><a href="#otp" aria-controls="otp" role="tab" data-toggle="tab">OTP Setting</a></li>
                    <li role="presentation"><a href="#whatsapp" aria-controls="whatsapp" role="tab" data-toggle="tab">Whatsapp Setting</a></li>
                    <li role="presentation"><a href="#marketing" aria-controls="marketing" role="tab" data-toggle="tab">Marketing Tools</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="profilesettings">
                        <div class="col-md-6 left">
                            <div class="account-profile">
                                <div class="account-thumb">
                                    <img v-if="intactdata.userProfile.profile_picture_url!=''" src="{{ url('upload')}}/@{{intactdata.userProfile.profile_picture_url}}" alt="profile photo" title="profile photo" />
                                    <img v-else src="{{ $social->avatar or '../img/member_img/profile-thumb.jpg'}}" alt="profile photo" title="profile photo" />
                                </div>
                                <div class="account-status">
                                    <h3 class="text-center">Account Status 
                                        <input v-show="intactdata.userProfile.account_stat=='not_verified'" type="button" value="OPS! NOT VERIFIED" class="red-btn-profile">
                                        <input v-show="intactdata.userProfile.account_stat=='verified'"     type="button" value="VERIFIED!" class="blue-btn-profile">
                                        <input v-show="intactdata.userProfile.account_stat=='ib_account'"   type="button" value="IB ACCOUNT" class="green-btn-profile">
                                    </h3>
                                    <p  class="text-center">
                                        <small v-show="intactdata.userProfile.account_stat==0">Please go to Main Wallet to upload your <br />documents for verification</small>
                                        <small v-else> <br /></small>
                                    </p>
                                    <p class="text-center">
                                        <input v-show="profileForm.edit==0" @click="profileEdit()" type="button" name="edit profile" value="Edit Profile" class="blue-btn"> 
                                        <input v-show="profileForm.edit==1" @click="profileUpdate()" type="button" name="save" value="SAVE" class="blue-btn">
                                    </p>
                                </div>

                                <div class="clear"></div>

                                <p>Change profile picture</p>
                                <p>
                                    <!-- <input type="file" id="profilepicture"> -->
                                    {!! Form::open(array('route' => 'uploadprofilepicture', 'method' => 'POST', 'id' => 'my-dropzone3', 'class' => 'my-dropzone3', 'files' => true, 'style' => 'padding:0;')) !!}
                                        {!! csrf_field() !!}
                                        {!! Form::hidden('action', 'uploadprofilepicture') !!}
                                    {!! Form::close() !!} 
                                    <input id="uploadProfilePic" type="button" name="Upload" value="Upload" class="blue-btn">
                                </p>

                                <div class="financial-information">
                                    <h3 class="bold text-center">Financial Information</h3>
                                    <h3 class="text-center normal">Banking</h3>
                                    <p>
                                        <span>Account Holder Name</span>
                                        <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.bank_fullname" type="text" v-bind:class="{ 'account-input-edit': profileForm.status }" class="account-input" name="fullname" />
                                    </p>
                                    <p>
                                        <span>Account Number</span> 
                                        <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.bank_account" type="text" value="Bank account number or IBAN" class="account-input" v-bind:class="{ 'account-input-edit': profileForm.status }" name="bankaccount" />
                                    </p>
                                    <p>
                                        <span class="short">Bank Name</span>
                                        <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.bank_name" type="text"  class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="bankname" />
                                        <span class="short text-right">SWIFTCODE</span> 
                                        <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.bank_swiftcode" type="text" value="" class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="swiftcode" />
                                    </p>
                                    <p>
                                        <span class="short">Country</span>
                                        <select :disabled="profileForm.edit==0" class="select-form" v-bind:class="{ 'account-input-edit': profileForm.status }">
                                            <option>Country 1</option>
                                            <option>Country 2</option>
                                            <option>Country 3</option>
                                            <option>Country 4</option>
                                            <option>Country 5</option>
                                        </select>
                                        
                                        <span class="short text-right">State</span> 
                                        <select :disabled="profileForm.edit==0" class="select-form" v-bind:class="{ 'account-input-edit': profileForm.status }">
                                            <option>State 1</option>
                                            <option>State 2</option>
                                            <option>State 3</option>
                                            <option>State 4</option>
                                            <option>State 5</option>
                                        </select>  
                                    </p>
                                    <h3 class="text-center normal">Other payment systems</h3>
                                    <p>Select
                                        <label class="radio-inline">
                                            <input :disabled="profileForm.edit==0" v-model="profileForm.picked" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="neteller"> Neteller
                                        </label>
                                        <label class="radio-inline">
                                            <input :disabled="profileForm.edit==0" v-model="profileForm.picked" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="skrill"> Skrill
                                        </label>
                                        <label class="radio-inline">
                                            <input :disabled="profileForm.edit==0" v-model="profileForm.picked" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="pm"> Perfect Money
                                        </label>
                                    </p>
                                    <p>
                                        <span>Account ID/Email</span>
                                            <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.netteller" v-show="profileForm.picked=='neteller'" type="text" value="" class="account-input" v-bind:class="{ 'account-input-edit': profileForm.status }" name="accountid" />
                                            <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.skrill" v-show="profileForm.picked=='skrill'" type="text" value="" class="account-input" v-bind:class="{ 'account-input-edit': profileForm.status }" name="accountid" />
                                            <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.perfect_money" v-show="profileForm.picked=='pm'" type="text" value="" class="account-input" v-bind:class="{ 'account-input-edit': profileForm.status }" name="accountid" />
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 right">
                            <div class="general-information">
                                <h3 class="bold text-center">General Information</h3>
                                <p>
                                    <span>First Name</span>
                                    <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.first_name" type="text" placeholder="First Name" class="account-input" v-bind:class="{ 'account-input-edit': profileForm.status }" name="FirstName" />
                                </p>
                                <p>
                                    <span>Last Name</span>
                                    <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.last_name" type="text" placeholder="Last Name" class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="LastName" />
                                    <span class="short text-right">Gender</span>
                                    <select :disabled="profileForm.edit==0" class="select-form" v-bind:class="{ 'account-input-edit': profileForm.status }">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </p>
                                <p>
                                    <span>Date of birth</span>
                                    <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.birthdate" type="text" placeholder="dd/mm/yyyy" class="account-date" v-bind:class="{ 'account-input-edit': profileForm.status }" name="date" /> 
                                    <img src="{{url('img/mainpage/account-date-icon.png')}}" alt="date" title="date" class="date-icon" />
                                    <span class="short text-right" style="width: 67px !important;">Phone</span> 
                                    <input :disabled="profileForm.edit==0" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" v-model="intactdata.userProfile.phone_number" type="text" class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="phone" />
                                </p>
                                <p>
                                    <span>Email</span>
                                    <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.email" type="text" placeholder="Email" class="account-input" v-bind:class="{ 'account-input-edit': profileForm.status }" name="Email" />
                                </p>
                                <p>
                                    <span>Address</span>
                                    <input  :disabled="profileForm.edit==0" v-model="intactdata.userProfile.address" type="text"  class="account-input" v-bind:class="{ 'account-input-edit': profileForm.status }" name="Address1" />
                                </p>
                                <p>
                                    <span>&nbsp;</span>
                                    <input  :disabled="profileForm.edit==0" v-model="intactdata.userProfile.address2" type="text" class="account-input" v-bind:class="{ 'account-input-edit': profileForm.status }" name="Address2" />
                                </p>
                                <p>
                                    <span>City</span>
                                        <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.city" type="text" class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="City" />
                                    <span class="short text-right">State</span>
                                        <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.state" type="text" class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="State" /> 
                                </p>
                                <p>
                                    <span>Zipcode</span>
                                    <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.zipcode" type="text" value="" class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="Zipcode" />
                                    <span class="short text-right">Country</span>
                                    <select :disabled="profileForm.edit==0" class="select-form" v-bind:class="{ 'account-input-edit': profileForm.status }">
                                        <option>Country 1</option>
                                        <option>Country 2</option>
                                        <option>Country 3</option>
                                        <option>Country 4</option>
                                        <option>Country 5</option>
                                    </select>  
                                </p>

                                <div class="gap"></div>

                                <h3 class="text-center bold">Additional Information</h3>

                                <p>
                                    <span class="social-icon">
                                    <img src="{{url('img/mainpage/gi-skype-icon.png')}}" alt="skype" title="skype" /></span>
                                    <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.skype_id" type="text" placeholder="skype id" class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="skype" />
                                    <span class="social-icon">
                                    <img src="{{url('img/mainpage/gi-icq-icon.png')}}" alt="icq" title="icq" /></span>
                                    <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.icq_number" type="text" placeholder="icq number" class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="icq" />
                                </p>

                                <p>
                                    <span class="social-icon">
                                    <img src="{{url('img/mainpage/gi-twitter-icon.png')}}" alt="twitter" title="twitter" /></span>
                                    <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.twitter_username" type="text" placeholder="twitter username" class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="twitter" />
                                    <span class="social-icon">
                                    <img src="{{url('img/mainpage/gi-google-icon.png')}}" alt="google" title="google" /></span>
                                    <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.google_email" type="text" placeholder="google+ email" class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="google+ email" />
                                </p>

                                <p>
                                    <span class="social-icon">
                                        <img src="{{url('img/mainpage/gi-facebook-icon.png')}}" alt="facebook" title="facebook" />
                                    </span>
                                    <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.facebook_url" type="text" placeholder="facebook name" class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="facebook" />
                                    <span class="social-icon">
                                        <img src="{{url('img/mainpage/gi-pinterest-icon.png')}}" alt="pinterest" title="pinterest" />
                                    </span>
                                    <input :disabled="profileForm.edit==0" v-model="intactdata.userProfile.instagram_url" type="text" placeholder="instagram" class="account-input short" v-bind:class="{ 'account-input-edit': profileForm.status }" name="pinterest" />
                                </p>

                            </div>
                        </div>
                    </div>  

                    <div role="tabpanel" class="tab-pane" id="otp">
                        <div v-show="intactdata.userProfile.confirm_phone_status==1" class="settings-content">
                            <p>
                                <span class="short text-right" style="width: 67px !important;">Phone Number +<strong>@{{ intactdata.userProfile.confirm_phone_number }} </strong> has been validated.</span>
                            </p>
                        </div>

                        <div v-show="intactdata.userProfile.confirm_phone_status==0" class="settings-content">
                            
                            <div v-show="intactdata.userProfile.confirm_phone_number != intactdata.userProfile.phone_number && intactdata.userProfile.confirm_phone_number!='' " class="alert alert-danger text-center">
                                <i class="fa fa-exclamation-triangle"></i> You need to confirm the new phone number.
                            </div>

                            <p>
                                <span class="short text-right" style="width: 67px !important;">Phone Number</span>
                            </p>
                            <p>
                                <input v-model="intactdata.userProfile.phone_number" type="input" class="account-input" v-bind:class="{ 'account-input-edit': profileForm.status }" name="phone" disabled="disabled" />
                                <input @click.prevent="sendConfirmationSms" type="button" value="Send Confirmation Code" class="blue-btn"> 
                            </p>                        
                             <p>
                                <span class="short text-right" style="width: 67px !important;">Enter Confirmation Code</span>
                            </p>
                            <p>
                                <input v-model="intactdata.wallet.validation_code" type="input" class="account-input" v-bind:class="{ 'account-input-edit': profileForm.status }" name="phone" />
                                <input @click.prevent="confirmPhoneNumber" type="button" value="Confirm Phone Number" class="blue-btn"> 
                            </p>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="whatsapp">
                        <div class="settings-content">

                        </div>

                    </div>

                    <div role="tabpanel" class="tab-pane" id="marketing">
                        <div class="settings-content">

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>