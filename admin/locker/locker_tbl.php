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
                echo ' <td class="text-center "><button name="edit_locker" id="'.$value['subscription_id'].'" class="btn btn-primary btn-sm" role="button">Edit</button></td>';
            }
            echo'
        </tr>';
                $counter++;
            }
         }

        ?>
    </tbody>
</table>
<script>
    $('button[name="edit_locker"]').click(function (){
        console.log($(this).attr('id'));

        var path_name= $(this).attr('id');
        const location_length = (window.location.pathname.split("/").length);
        var offset = 5;
        const location = (window.location.pathname.split("/"));
        var offset = 5;
        location[offset] = 'locker'
        location[offset+1] = 'edit_locker.php?subscription_id='+$(this).attr('id');
        var url_path = '';
        for (let index = 1; index < location.length; index++) {
            url_path+=('/'+location[index]);
            
        }
        if(window.location.href != window.location.origin+url_path){
            history.pushState({}, "", window.location.origin+url_path+'.php');
        }
        $.ajax({
            type: "GET",
            url: '../locker/edit_locker.php?subscription_id='+$(this).attr('id'),
            success: function(result)
            {
                $('main#main-content').html(result);
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            } 
        });

    });
</script>