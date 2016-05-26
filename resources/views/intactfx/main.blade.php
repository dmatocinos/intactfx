<div class="container" id="testingapp">
      <div class="row">
        <div class="content">
          <div class="col-md-6">
            <!-- <img @click="openModal()" src="/img/member_img/12k-blue.png" alt="12,000 main wallet" title="12,000 main wallet" class="blue-btn-img"/> -->
            {{ $user }}
            <div class="col-md-12" @click="mainwallet()">
            @if($user->account_stat==0)
                <div class="mainwallet-red wallet">
            @else
                <div class="mainwallet wallet">    
            @endif
                    <div class="position">
                        <h2>12,000</h2>
                        <p>Main Wallet</p>
                    </div>
                </div>
            </div>
            <!-- <img src="/img/member_img/12k-red.png" alt="12,000 commision wallet" title="12,000 commision wallet" class="red-btn-img"/> -->
            
            <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="commisionwallet_red wallet" @click="commisionwallet_red()">
              <div class="position">
                <h2>12,000</h2>
                <p>Commision Wallet</p>
              </div>
            </div>
            </div>

            <!-- <img src="/img/member_img/12k-green.png" alt="12,000 commision wallet" title="12,000 commision wallet" class="green-btn-img"/> -->
            <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="commisionwallet_green wallet" @click="commisionwallet_green()">
              <div class="position">
                <h2>12,000</h2>
                <p>Commision Wallet</p>
              </div>
            </div>
            </div>

          </div>
          <div class="col-md-6">

            <div id="recentnews">
              <h3 class="recentnews-block-title">Recent News</h3>
              <div class="recentnews-block">
                <div class="recentnews-thumb col-md-2">
                  <img src="/img/member_img/recentnews-thumb.jpg" alt="recent news" title="recent news" class="img-responsive" />
                </div>
                <div class="recentnews-content col-md-9">
                  <h4>Proin gravida nibh vel velit auctor aliqut velit auctor aliquet enim</h4>
                  <span class="glyphicon glyphicon-chevron-right blue-icon" aria-hidden="true"></span>
                  <div class="recentnews-excerpt">
                    <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis be bendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.</p>
                  </div>
                  <a href="#" class="next-btn">Next</a>
                </div>
              </div>
            </div><!--/ recent news -->

            <div id="twitter">

              <div class="twitter-headline">
                <h3 class="twiiter-ribbon">Recent Tweet</h3>
              </div>
              
              <div v-for="tweets in tweet_feeds">
                
              </div>
              <!-- <div class="tweets">
                <h4>#intactfx</h4>
                <p>Proin gravida nibh vel velit auctor aliqut velit auctor aliquet enim </p>
                <span class="glyphicon glyphicon-chevron-right gray-icon" aria-hidden="true"></span>
              </div>
              <div class="separator"></div>
              <div class="tweets last">
                <h4>#intactfx</h4>
                <p>Proin gravida nibh vel velit auctor aliqut velit auctor aliquet enim </p>
                <span class="glyphicon glyphicon-chevron-right gray-icon" aria-hidden="true"></span>
              </div> -->

            </div><!--/ twitter -->
          </div>

          <!-- <div class="col-md-12">
            <div id="content-links">
                <ul>
                  <li><a href="#">Accounts</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Promotions and bonuses</a></li>
                  <li><a href="#">Contests</a></li>
                </ul>
              </div>
          </div> -->

         </div><!--/ content -->
       </div><!--/ row -->
    </div><!--/ container -->




<!-- Modal -->
<div class="modal fade" id="mainWallet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="commisionwallet_red" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="commisionwallet_green" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>