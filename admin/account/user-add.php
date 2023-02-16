<?php 
require_once '../../tools/functions.php';
require_once '../../classes/users.class.php';
require_once '../../classes/genders.class.php';

// print_r($_POST);
?>


<?php require_once '../includes/header.php';?>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
<body>
<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
    <div class="w-100">
        <div class="row">
            <h5 class="col-8 col-lg-4 fw-bold mb-3 ms-2">Add Account</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="account.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>
    </div>
    <div class="container-fluid">
        <form action="" method="POST">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="row form-group pb-2">
                    <label for="exampleFormControlFile1">Profile Picture</label>
                    <input type="file" class="form-control-file" id="profilepic" name="profilepic" accept="image/*" >
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Username</label>
                            <input type="text" class="form-control" value="" id="username" name="username"placeholder="Enter Username" required>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">First Name</label>
                            <input type="text" class="form-control" value="" id="fname" name="fname"placeholder="Enter First Name" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">Middle Name</label>
                            <input type="text" class="form-control" value="" id="mname" name="mname"placeholder="Enter Middle Name" >
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Last Name</label>
                            <input type="text" class="form-control" value="" id="lname" name="lname"placeholder="Enter Last Name" required>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Phone Number</label>
                            <input type="text" class="form-control" value="" id="phone" max="11" name="phone"placeholder="Enter Phone Number" required>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Email</label>
                            <input type="email" class="form-control" value="" id="email" name="email"placeholder="Enter Email" required>
                        </div>
                    </div>
                    
                    <div class="row form-group pb-2">
                        <div class="col-12 col-lg-6">
                            <label for="Gender">Gender</label>
                            <select class="form-select" id="gender" name="gender" onchange="genders()">
                                <option value="None" >Select Gender </option>
                                <?php 
                                
                                $genderObj = new genders();
                                $data = $genderObj->get_gender_list();
                                foreach ($data as $key => $value) {
                                    echo '<option value="';
                                    echo_safe($value['user_gender_details']);
                                    echo '"';
                                    echo 'id="';echo_safe($value['user_gender_details']);
                                    echo '">';
                                    echo_safe($value['user_gender_details']);
                                    echo '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">Not in the list?</label>
                            <input type="text" class="form-control" value="" id="gender_other" name="gender_other"placeholder="Enter gender" onchange="other_genders()">
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Birth Date</label>
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d', time()-(60*60*24*365*18)); ?>" id="birthdate" name="birthdate"placeholder="Enter Birth Date" max="<?php echo date('Y-m-d', time()-60*60*24*5); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="row form-group pb-2">
                        <label for="exampleFormControlFile1">ID or Birth Certificate</label>
                        <input type="file" class="form-control-file" id="valid_id" accept="image/*" >
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Address</label>
                            <input type="text" class="form-control" value="" id="address" name="address"placeholder="Enter Address" tabindex="-1" required>
                        </div>
                    </div>
                    
                    <div class="row form-group pb-2">
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">Password</label>
                            <input type="password" class="form-control" value="" id="password" name="password"placeholder="Enter Password" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">Confirm Password</label>
                            <input type="password" class="form-control" value="" id="confirm_password" name="confirm_password"placeholder="Confirm Password" required>
                        </div>
                    </div>
                    
                </div>
            </div>
                <div class="row d-flex">
                    <div class="col-12 col-lg-1 d-grid d-lg-flex pt-3 pt-lg-1">
                        <button type="submit" class="btn btn-success btn-lg border-0 rounded" name="add_account" value="add_account" id="submit">Submit</button>
                    </div>
                </div>
        </form>
    </div>
</main>
</body>


<script>
function genders(){
  $('#gender_other').val(''); 
  console.log('gender selected  changed');
}
function other_genders(){
  $('#gender').val('Other'); 
  $('#gender option[value=Other]').attr('selected','selected'); 
  console.log('gender others changed');
}
</script>