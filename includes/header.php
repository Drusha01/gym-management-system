
<section class="header">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #A73535">
        <div class="container-fluid">
            <div class="d-flex flex-row">
                <a class="navbar-brand navbar" href="user-page.php">
                  <img src="../images/logo.png" alt="" width="55">
                  <div class="d-flex flex-column p-2 pt-0 pb-0">
                    <h3 class="mb-1 fs-5 text-white"><strong>KE-NO</strong></h3>
                    <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
                  </div>
                </a>
              </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="user-page.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="offers.php">Offers</a>
                </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="user-avail.php">Avail</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="user-about.php">About</a>
                </li>
            </ul>
              <ul class="nav navbar-nav navbar-right d-none d-lg-block">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class='bx bx-bell fs-2'></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary" id="notification_number"> <span class="visually-hidden">unread messages</span></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="width:350px;">
                      <table class="table table-bordered table-hover">
                          <tbody id="notification_content">
                             
                          </tbody>
                      </table>
                      <div class="dropdown-divider"></div>
                      <li><a class="dropdown-item text-center" href="../user/user-profile.php?active=notification-tab" style="text-indent: 1%;">Show More</a></li>
                  </ul>
                  </li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-user-circle fs-1'></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item" href="../user/user-profile.php?active=account-tab">My Account</a></li>
                      <li><a class="dropdown-item" href="../user/user-profile.php?active=notification-tab">Notifications</a></li>
                      <li><a class="dropdown-item" href="../user/user-profile.php?active=Subscription-tab">My Subscriptions</a></li>
                      <li><a class="dropdown-item" href="../user/user-profile.php?active=lockers-tab">My Lockers</a></li>
                      <li><a class="dropdown-item" href="../user/user-profile.php?active=trainer-tab">My Trainer</a></li>
                      <li><a class="dropdown-item" href="../user/user-profile.php?active=payment-tab">Payment</a></li>
                      <div class="dropdown-divider"></div>
                      <li><a class="dropdown-item" href="../login/log-out.php">Log-Out</a></li>
                    </ul>
                  </li>
              </ul>
          </div>
        </div>
      </nav>

<audio id="myAudio">

<source src="../audio/notification.mp3" type="audio/mpeg">
</audio>



<button id="play_button" onclick="playAudio()"type="button" style="visibility:hidden;">Play Audio</button>
<button onclick="pauseAudio()" type="button" style="visibility:hidden;">Pause Audio</button> 

<script>
var x = document.getElementById("myAudio"); 

function playAudio() { 
  console.log('moce')
  x.play(); 
} 

function pauseAudio() { 
x.pause(); 
} 

var prev =0;
var current =0;
var notification = new FormData(); 
$.ajax({
    type: "GET",
    enctype: 'multipart/form-data',
    url: "../user/notification/number_of_notification.php",
    data: notification,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function ( result ) {
        // parse result
        current = parseInt(result);
        $('#notification_number').html(result);
        prev = current;
        // get three latest notification
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            url: "../user/notification/get_three_latest_notifications.php",
            data: notification,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                // parse result
                $('#notification_content').html(result);
                
                
            }
        });
    }
});
setInterval(function(){
    var notification = new FormData(); 
    var audio = $("#myAudio")[0];
    audio.muted = false; 
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            url: "../user/notification/number_of_notification.php",
            data: notification,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                // parse result
                current = parseInt(result);
                $('#notification_number').html(current);
                if(current>prev){
                    
                    // play audio
                    audio.play();
                    // update notification number

                    // update three latest notification
                    $.ajax({
                        type: "GET",
                        enctype: 'multipart/form-data',
                        url: "../user/notification/get_three_latest_notifications.php",
                        data: notification,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function ( result ) {
                            // parse result
                            $('#notification_content').html(result);
                            
                            
                        }
                    });
                    // update prev
                    prev =current;
                }
                console.log(result)
                
            }
        });
    
    // 


}, 1500);
      </script>
</section>

