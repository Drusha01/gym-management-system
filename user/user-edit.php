<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';


// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
      header('location:../admin/admin-profile.php');
    }else if($_SESSION['user_type_details'] == 'normal'){
      // do nothing
    } 
  }else if($_SESSION['user_status_details'] =='inactive'){
    // handle inactive user details
  }else if($_SESSION['user_status_details'] =='deleted'){
    // handle deleted user details
  }
} else {
  // go to login page
  header('location:../login/log-in.php');
}

?>

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

    <?php require_once '../includes/header.php';?>


    <div class="my_acc_edit">
        <div class="container">
            <div class="pb-1">
                <a class="text-decoration-none text-black" aria-current="page" href="user-profile.php"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
            </div>
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="../img/profile-resize/<?php echo_safe($_SESSION['user_profile_picture'])?>" alt="Admin" class="rounded-circle p-1 bg-danger" width="110">
                                    <div class="mt-3">
                                        <h4><?php echo_safe($_SESSION['user_name'])?></h4>
                                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 5 MB</div>
                                        <!-- Profile picture upload button-->
                                        <button class="btn btn-primary" type="file">Upload new image</button>
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
                                        <input type="text" class="form-control" value="<?php echo_safe($_SESSION['user_name'])?>" placeholder="<?php echo_safe($_SESSION['user_name'])?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">First Name</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" value="<?php echo_safe($_SESSION['user_firstname'])?>" placeholder="<?php echo_safe($_SESSION['user_firstname'])?>">
                                    </div>
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Last Name</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" value="<?php echo_safe($_SESSION['user_lastname'])?>" placeholder="<?php echo_safe($_SESSION['user_lastname'])?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="email" class="form-control" value="<?php echo_safe($_SESSION['user_email'])?>" placeholder="<?php echo_safe($_SESSION['user_email'])?>">
                                    </div>
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Phone Number</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="number" class="form-control" value="<?php echo_safe($_SESSION['user_phone_number'])?>" placeholder="<?php echo_safe($_SESSION['user_phone_number'])?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" value="<?php echo_safe($_SESSION['user_address'])?>" placeholder="<?php echo_safe($_SESSION['user_address'])?>">
                                    </div>
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Birth Date</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" onfocus="(this.type='date')" value="<?php echo_safe(date_format(date_create($_SESSION['user_birthdate']), "F d,Y"));?>" placeholder="<?php echo_safe(date_format(date_create($_SESSION['user_birthdate']), "F d,Y"));?>"
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
    <?php require_once '../includes/footer.php';?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>
</body>
</html>