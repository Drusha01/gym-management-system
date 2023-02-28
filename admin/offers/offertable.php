<?php
// start session
session_start();

// includes


// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}


if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing
        if(isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Modify'){

        }else if(isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Read-Only'){
            
        }else{
            header('location:../dashboard/dashboard.php');
        }
    }else if($_SESSION['admin_user_status_details'] == 'inactive'){
        // do this
    }else if($_SESSION['admin_user_status_details'] == 'deleted'){
        // go to deleted user page
    }

}else{
    // go to admin login
    header('location:../admin_control_log_in2.php');
}

?>

<table id="example"  class="table table-striped table-borderless table-custom table-hover" style="width:100%;border: 3px solid black;">
    <thead class="bg-dark text-light">
        <tr>
        <th class="d-lg-none"></th>
        <th class="text-center d-none d-sm-table-cell">#</th>
        <th scope="col">NAME OF OFFER</th>
        <th scope="col" class="text-center ">TYPE OF SUBSCRIPTION</th>
        <th scope="col" class="text-center ">AGE QUALIFICATION</th>
        <th scope="col" class="text-center ">DAYS</th>
        <th scope="col" class="text-center ">SLOTS</th>
        <th scope="col" class="text-center ">PRICE</th>
        
        <?php 
            
        if(isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Modify'){?>
            <th scope="col" class="text-center ">ACTION</th>
        <?php }?>
        </tr>
    </thead>
    <tbody>
        <?php 
            require_once '../../classes/offers.class.php';
            require_once '../../tools/functions.php';

            $offersObj = new offers();

            if($offers_data = $offersObj->fetch()){
                $counter = 1;
                foreach ($offers_data as $key => $value) {
                    if($value['status_details'] =='active'){
                        echo '<tr id="offer_id_';echo_safe($value['offer_id']); echo'">';
                        echo '<td class="d-lg-none"></td>';
                        echo '<td scope="row" class="text-center d-none d-sm-table-cell">'; echo_safe($counter); echo'</td>';
                        echo ' <td>'; echo_safe($value['offer_name']); echo '</td>';
                        echo '<td class="text-center ">';echo_safe($value['type_of_subscription_details']); echo '</td>';
                        echo '<td class="text-center ">';echo_safe($value['age_qualification_details']); echo '</td>';
                        echo '<td class="text-center ">';echo_safe($value['offer_duration']); echo '</td>';
                        echo '<td class="text-center ">';echo_safe($value['offer_slots']); echo '</td>';
                        echo '<td class="text-center ">₱';echo_safe($value['offer_price']); echo '</td>';
                        if(isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Modify'){
                            echo '<td class="text-center "><a href="editoffer.php?id='; echo_safe($value['offer_id']); echo'" class="btn btn-primary btn-sm" role="button">Edit</a> <button href="deleteoffer.php?id='; echo_safe($value['offer_id']); echo'" class="btn btn-danger btn-sm" onclick="confirmfunction(';echo $value['offer_id']; echo')">Delete</button></td>';
                        }
                        echo '</tr>';
                        $counter++;
                    }
                }
            }

        
        ?>
       
    </tbody>
</table>
<script> 
    function confirmfunction(id){
        let text = "Are you sure you want to delete #"+id+"?";
        if (confirm(text) == true) {
            $.ajax({url: "deleteoffer.php?id="+id, success: function(result){
                if(result ==1){
                    // update datatables
                    $( "#offer_id_"+id ).remove();
                    alert('deleted successfully');
                    console.log(result)
                }else{
                    alert('deletion failed');
                }
                
            }});
        } else {
            return;
            text = "You canceled!";
        }
        
    }
</script>