<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keno Gym</title>
    <link rel="icon" type="images/x-icon" href="/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/boxicons.min.css">

</head>
<body>
    <section class="header">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #A73535">
                <div class="container-fluid">
                    <div class="d-flex flex-row">
                        <a class="navbar-brand navbar">
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
                        <a class="nav-link active" aria-current="page" href="userpage.html">Home</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Subscriptions
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Gym-Use</a></li>
                          <li><a class="dropdown-item" href="#">Trainer</a></li>
                          <li><a class="dropdown-item" href="#">Locker</a></li>
                          <li><a class="dropdown-item" href="#">Programs</a></li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Avail</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          About
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Gym</a></li>
                          <li><a class="dropdown-item" href="#">Policies</a></li>
                          <li><a class="dropdown-item" href="#">Owner</a></li>
                          <li><a class="dropdown-item" href="#">Employee</a></li>
                          <li><a class="dropdown-item" href="#">Items</a></li>
                        </ul>
                      </li>
                    </ul>
                      <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-user-circle fs-1'></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                              <li><a class="dropdown-item" href="#">My Account</a></li>
                              <li><a class="dropdown-item" href="#">My Subscriptions</a></li>
                              <li><a class="dropdown-item" href="#">My Trainer</a></li>
                              <div class="dropdown-divider"></div>
                              <li><a class="dropdown-item" href="../login/log-out.php">Log-Out</a></li>
                            </ul>
                          </li>
                      </ul>
                  </div>
                </div>
              </nav>
    </section>
    <div class="my_acc_edit">
        <div class="container">
            <div class="pb-1">
                <a class="text-decoration-none text-black" aria-current="page" href="my_acc.html"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
            </div>
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="../images/acc_img.png" alt="Admin" class="rounded-circle p-1 bg-danger" width="110">
                                    <div class="mt-3">
                                        <h4>James_No_Legday</h4>
                                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 5 MB</div>
                                        <!-- Profile picture upload button-->
                                        <button class="btn btn-primary" type="button">Upload new image</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-2 align-self-center pb-1">
                                        <h6 class="mb-0">Username</h6>
                                    </div>
                                    <div class="col-sm-10 text-secondary">
                                        <input type="text" class="form-control" value="James_No_Legday">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">First Name</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" value="James Lorenz">
                                    </div>
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Last Name</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" value="Trinidad">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="email" class="form-control" value="James@gmail.com">
                                    </div>
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Phone Number</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="number" class="form-control" value="0912345678">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" value="San Jose, Zamboanga City">
                                    </div>
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Birth Date</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" onfocus="(this.type='date')" value="11/04/2000"
                                        onblur="(this.type='text')">
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-3 text-secondary">
                                        <input type="button" class="btn btn-success px-4" value="Save Changes">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
    

    <br>

    <footer>
      <div class="footer-top">
         <div class="container">
            <div class="row gy-5">
               <div class="col-md-4">
                <div class="d-flex flex-row">
                  <a class="navbar-brand navbar">
                    <img src="images/logo.png" alt="" width="55">
                    <div class="d-flex flex-column p-2 pt-0 pb-0">
                      <h3 class="mb-1 fs-5 text-white"><strong>KE-NO</strong></h3>
                      <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
                    </div>
                  </a>
                </div>

                  <div class="social-icons">
                     <a href="#"><i class="bx bxl-facebook"></i></a>
                     <a href="#"><i class="bx bxl-twitter"></i></a>
                     <a href="#"><i class="bx bxl-instagram"></i></a>
                     <a href="#"><i class="bx bxl-github"></i></a>
                  </div>
               </div>
               <div class="col-md-2">
                  <h5 class="title-sm">Navigation</h5>
                  <div class="footer-links">
                     <a href="#">Services</a>
                     <a href="#">Our Work</a>
                     <a href="#">Team</a>
                     <a href="#">Blog</a>
                  </div>
               </div>
               <div class="col-md-2">
                  <h5 class="title-sm">More</h5>
                  <div class="footer-links">
                     <a href="#">FAQ's</a>
                     <a href="#">Privacy & Policy</a>
                     <a href="#">Liscences</a>
                  </div>
               </div>
               <div class="col-md-2">
                  <h5 class="title-sm">Contact</h5>
                  <div class="footer-links">
                     <p class="mb text-white">San Jose, Zamboanga City</p>
                     <p class="mb text-white">8(800)316-06-42</p>
                     <p class="mb text-white">hello@yourdomain.com</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>
</body>
</html>