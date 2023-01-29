<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keno Gym | Sign-Up</title>
    <link rel="icon" type="images/x-icon" href="../images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/log-in.css">
    <link rel="stylesheet" href="../css/boxicons.min.css">
</head>
<body>
  <section class="container">
    <div class="row content d-flex justify-content-center align-items-center">
      <div class="col-md-5">
        <div class="box shadow bg-white rounded">
          <div class="container-fluid bg-danger p-2 rounded-top d-inline-flex justify-content-center">
            <img src="../images/logo.png" alt="" width="55">
            <div class="d-flex flex-column p-2 pt-0 pb-0 ">
              <h3 class="mb-1 fs-5 text-white "><strong>KE-NO</strong></h3>
              <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
            </div>
          </div>
          <form class="form-signup p-2">
            <h2 class="text-center">Create Account</h2>
            <div class="form-group py-1">
              <label for="exampleFormControlFile1">Profile Picture</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" >
            </div>
            <div class="form-group py-1">
              <input type="text" class="form-control" name="username" placeholder="Username" >
            </div>
            <div class="form-group py-1">
                <div class="row">
                    <div class="col-md-6 py-1">
                        <input type="text" class="form-control" name="first" placeholder="First Name" >
                    </div>
                    <div class="col-md-6 py-1">
                        <input type="text" class="form-control" name="last" placeholder="Last Name"  >
                    </div>
                </div>
            </div>
            <div class="form-group py-1">
                <input type="email" class="form-control" name="email" placeholder="Email" >
            </div>
            <div class="form-group py-1">
              <input type="number" class="form-control" name="number" placeholder="Phone Number" >
            </div>
            <label>Gender</label>
            <div class="form-group py-1">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"  >
                    <label class="form-check-label" for="inlineRadio1">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" >
                    <label class="form-check-label" for="inlineRadio2">Female</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" >
                    <label class="form-check-label" for="inlineRadio3">Other</label>
                  </div>
            </div>
            <div class="form-group py-1">
              <label>Birth Date</label>
              <input type="date" class="form-control" name="bday" id="bday">
            </div>
            <div class="form-group py-1">
              <label for="exampleFormControlFile1">Valid ID</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="form-group py-1">
            <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group py-1">
                <input type="repassword" class="form-control" name="conpassword" placeholder="Confirm Password">
            </div>
            <div class="d-grid">
              <button type="button" class="btn btn-success btn-lg border-0 rounded"> <a class="text-decoration-none text-white" onclick="signup()">Sign-Up</a></button>
            </div>
            <p class="text-center">Already Have an Account? <a class="text-decoration-none" href="../login/log-in.php">Log-in</a></p>
          </form>
          

        </div>
      </div>
    </div>
  </section>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>
</body>
</html>

<script>
function login() {
  // get the
  var username = $('#email').val();
  var password = $('#password').val()
  console.log(username)
  console.log(password)
  // javascript validation here 
  // ajax here

}

</script>