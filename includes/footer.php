<footer>
      <div class="footer-top">
         <div class="container">
            <div class="row gy-5">
               <div class="col-md-4">
                <div class="d-flex flex-row">
                  <a class="navbar-brand navbar" href="user-page.php">
                    <img src="../images/logo.png" alt="" width="55">
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
                  </div>
               </div>
               <div class="col-md-2">
                  <h5 class="title-sm">Navigation</h5>
                  <div class="footer-links">
                     <a href="#">Services</a>
                     <a href="#">Our Gym</a>
                     <a href="#">Team</a>
                     <a href="#">Location</a>
                  </div>
               </div>
               <div class="col-md-2">
                  <h5 class="title-sm">More</h5>
                  <div class="footer-links">
                     <a href="#">Gym Images</a>
                     <a href="#">Rules</a>
                  </div>
               </div>
               <div class="col-md-2">
                  <h5 class="title-sm">Contact</h5>
                  <div class="footer-links">
                  <?php 
                        require_once('../classes/admin_settings.class.php');
                        $settingObj = new admin_settings();
                        $setting_data = $settingObj->fetch_one();
                  ?>
                  <p class="mb text-white"><?php if($setting_data){echo htmlentities($setting_data['setting_gym_address']);}?></p>
                  <p class="mb text-white"><?php if($setting_data){echo htmlentities($setting_data['setting_gym_contact_number']);}?></p>
                  <p class="mb text-white"><?php if($setting_data){echo htmlentities($setting_data['setting_gym_email_address']);}?></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>