<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-3 col-xl-2 d-md-block background-color-green sidebar collapse">
            <div class="mh-100">
                <ul class="nav flex-column">
                    <li class="nav-item"  >
                        <a href="../dashboard/dashboard.php" class="nav-link pt-3" title="Dashboard">
                            <i class='bx bx-grid-alt' ></i>
                            <span class="links-name">Dashboard</span>
                        </a>
                    </li>
                    <?php
                    if((isset($_SESSION['admin_announcement_restriction_details']) && $_SESSION['admin_announcement_restriction_details'] == 'Modify') || (isset($_SESSION['admin_announcement_restriction_details']) && $_SESSION['admin_announcement_restriction_details'] == 'Read-Only')){
                        echo'
                    <li class="nav-item" >
                        <a  href="../announcement/announcement.php" class="nav-link"  title="Announcement">
                            <i class="bx bxs-megaphone"></i>
                            <span class="links-name ">Announcement</span>
                        </a>
                    </li>';
                    }
                    if((isset($_SESSION['admin_attendance_restriction_details']) && $_SESSION['admin_attendance_restriction_details'] == 'Modify') || (isset($_SESSION['admin_attendance_restriction_details']) && $_SESSION['admin_attendance_restriction_details'] == 'Read-Only')){
                        echo'
                    <li class="nav-item" ">
                        <a href="../attendance/attendance.php" class="nav-link " title="Attendance">
                            <i class="bx bx-calendar-check"></i>
                            <span class="links-name">Attendance</span>
                        </a>
                    </li>';
                    }
                    if((isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Modify') || (isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Read-Only')){
                        echo'
                    <li class="nav-item">
                        <a href="../locker/locker.php" class="nav-link " title="Locker">
                            <i class="bx bx-cabinet" ></i>
                            <span class="links-name">Locker</span>
                        </a>
                    </li>';
                    }
                    if((isset($_SESSION['admin_notification_restriction_details']) && $_SESSION['admin_notification_restriction_details'] == 'Modify') || (isset($_SESSION['admin_notification_restriction_details']) && $_SESSION['admin_notification_restriction_details'] == 'Read-Only')){
                        echo'
                    <li class="nav-item d-block d-lg-none">
                        <a href="../notification/notification.php" class="nav-link " title="Notification">
                            <i class="bx bx-bell"></i>
                            <span class="links-name">Notifications</span>
                        </a>
                    </li>';
                    }
                    if((isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Modify') || (isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Read-Only')){
                        echo'
                        <li class="nav-item">
                        <a href="../offers/offer.php" class="nav-link " title="Offers">
                            <i class="bx bxs-offer"></i>
                            <span class="links-name">Offers</span>
                        </a>
                    </li>';
                    }
                    if((isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Modify') || (isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Read-Only')){
                        echo'
                    <li class="nav-item">
                        <a href="../avail/avail.php?active=subs" class="nav-link " title="Avail">
                            <i class="bx bx-calendar-plus"></i>
                            <span class="links-name">Avail</span>
                        </a>
                    </li>
                    ';
                    }
                    if((isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify') || (isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Read-Only')){
                        echo'
                    <li class="nav-item">
                        <a href="../account/account.php" class="nav-link " title="Accounts">
                            <i class="bx bx-user" ></i>
                            <span class="links-name">Accounts</span>
                        </a>
                    </li>
                    ';
                    }
                    if((isset($_SESSION['admin_payment_restriction_details']) && $_SESSION['admin_payment_restriction_details'] == 'Modify') || (isset($_SESSION['admin_payment_restriction_details']) && $_SESSION['admin_payment_restriction_details'] == 'Read-Only')){
                        echo'
                   <li class="nav-item">
                        <a href="../payment/payment.php" class="nav-link " title="Payment">
                            <i class="bx bx-money"></i>
                            <span class="links-name">Payment</span>
                        </a>
                    </li>';
                    }
                    if((isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Modify') || (isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Read-Only')){
                        echo'
                    <li class="nav-item">
                        <a href="../maintenance/maintenance.php" class="nav-link " title="Maintenance">
                            <i class="bx bx-wrench"></i>
                            <span class="links-name">Maintenance</span>
                        </a>
                    </li>
                    ';
                    }
                    if((isset($_SESSION['admin_report_restriction_details']) && $_SESSION['admin_report_restriction_details'] == 'Modify') || (isset($_SESSION['admin_report_restriction_details']) && $_SESSION['admin_report_restriction_details'] == 'Read-Only')){
                        echo'
                    <li class="nav-item">
                        <a href="../reports/reports.php" class="nav-link " title="Reports">
                            <i class="bx bx-line-chart"></i>
                            <span class="links-name">Reports</span>
                        </a>
                    </li>
                    ';
                    }
                    if((isset($_SESSION['admin_user_type_details']) && $_SESSION['admin_user_type_details'] == 'admin') ){
                        echo'
                  <li class="nav-item">
                        <a href="../settings/settings.php" class="nav-link " title="Settings">
                            <i class="bx bx-cog"></i>
                            <span class="links-name">Settings</span>
                        </a>
                    </li>
                    ';
                    }?>
                    <hr class="line">
                    <li id="logout-link" class="nav-item">
                        <a class="logout-link nav-link" href="../log-out.php" title="Logout">
                            <i class='bx bx-log-out'></i>
                            <span class="links-name">Sign out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<script>

</script>
