<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="google-signin-client_id" content="53523092857-46kpu1ffikh67k7kckngcbm6k7naf8ic.apps.googleusercontent.com">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keno Gym | Log-In</title>
  <link rel="icon" type="images/x-icon" href="../images/favicon.png">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/log-in.css">
  <link rel="stylesheet" href="../css/boxicons.min.css">
  <script defer src="../js/bootstrap.bundle.min.js"></script>
  <html itemscope itemtype="http://schema.org/Article">

<script src="https://apis.google.com/js/platform.js" async defer></script>


</head>
<body>
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
            <img src="../images/logo.png" class="rounded me-2" alt="logo" style="width: 25px;">
            <strong class="me-auto">KE-NO Fitness Center</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
            Succesfully sent to E-mail.✅
            </div>
        </div>
    </div>
  <section class="container">
    <div class="row content d-flex justify-content-center align-items-center">
      <div class="col-md-5">
        <div class="box shadow bg-white rounded">
          <div class="container-fluid bg-danger p-2 rounded-top d-inline-flex justify-content-center">
            <img src="../images/logo.png" alt="" width="60">
            <div class="d-flex flex-column p-2 pt-0 pb-0 ">
              <h3 class="mb-1 fs-5 text-white "><strong>KE-NO</strong></h3>
              <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
            </div>
          </div>
          <a class="text-decoration-none text-black m-0" aria-current="page" href="log-in.php"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
          <div class="container px-4">
            <div class="text-center">
              <p class="fw-bold fs-4">Email Has Been Sent To</p>
              <p class="fw-light fs-5">youremail@gmail.com</p>
            </div>
            <section class="wrapper">
                <div class="otp_input text-start mb-2">
                    <label for="digit">Type your 6 Digit Security Code</label>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <input type="text" class="form-control" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}">
                        <input type="text" class="form-control" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}">
                        <input type="text" class="form-control" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}">
                        <input type="text" class="form-control" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}">
                        <input type="text" class="form-control" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}">
                        <input type="text" class="form-control" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}">
                    </div>
                </div>
            </section>
            
            <div class="row mt-4">
                <div class="col-lg-6 text-center text-lg-start">
                    Didn't Get the Code?<a href="#" class="ms-2">Resend?</a>
                </div>
                <div class="col-lg-6 text-center text-lg-end mt-2 mt-lg-0">
                    <a href="#">Change Email</a>
                </div>
            </div>
            <br> <br>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>