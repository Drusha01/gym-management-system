<?php 
session_start();
if(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Modify'){

}elseif(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Read-Only'){
    //d
}else{
    //do not load the page
    header('location:../dashboard/dashboard.php');
}
?>
<table id="locker-content" class="table table-borderless table-striped" style="width:100%; border: 3px solid black;">
    <thead class="table-dark" >
        <tr>
        <th class="d-lg-none"></th>
        <th class="text-center d-none d-sm-table-cell">#</th>
        <th>USERNAME</th>
        <th>FULL NAME</th>
        <th class="text-center">QUANTITY</th>
        <th class="text-center">START TO END DATE</th>
        <th class="text-center">LOCKER ID</th>
        <?php 
        if(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Modify'){
            echo '<th class="text-center">ACTION</th>';
        }
        ?>
        
        </tr>
    </thead>
    <tbody>
        <?php 
         require_once '../../classes/subscriptions.class.php';

         $subscriptionsObj = new subscriptions();
         if($locker_subscription_data = $subscriptionsObj->fetchAllUserLockerActiveSubscription()){
            $counter=1;
            foreach ($locker_subscription_data as $key => $value) {
            echo '
        <tr>
            <th class="d-lg-none"></th>
            <td class="text-center d-none d-sm-table-cell">'.$counter.'</td>
            <td>'.htmlentities($value['user_name']).'</td>
            <td>'.htmlentities($value['user_fullname']).'</td>
            <td class="text-center">'.htmlentities($value['subscription_quantity']).'</td>
            <td class="text-center">March 25, 2023 - March 28, 2023</td>
            <td class="text-center"><button class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="showLockers('.$value['subscription_id'].')">Show All <i class="bx bx-show-alt" style="font-size:20px; vertical-align: middle;"></i></button></td>';
            if(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Modify'){
                echo ' <td class="text-center "><a href="edit_locker.php?subscription_id='.$value['subscription_id'].'" class="btn btn-primary btn-sm" role="button">Edit</a></td>';
            }
            echo'
        </tr>';
                $counter++;
            }
         }

        ?>
    </tbody>
</table>