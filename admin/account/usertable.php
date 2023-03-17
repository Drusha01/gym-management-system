<?php 
session_start();
if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){

}elseif(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Read-Only'){
    //d
}else{
    //do not load the page
    header('HTTP/1.1 404 Not Found');
    exit();
}

?>

<table id="table-1" class="table table-striped table-borderless table-custom table-hover" style="width:100%;border: 3px solid black;">
    <thead class="bg-dark text-light">
        <tr>
        <th class="d-lg-none"></th>
        <th class="text-center d-none d-sm-table-cell">#</th>
        <th>USERNAME</th>
        <th>NAME</th>
        <th class="text-center ">AGE</th>
        <th class="text-center">SUBSCRIPTION STATUS</th>
        <th class="text-center">EMAIL VERIFIED</th>
        <th class="text-center">USER STATUS</th>
        <?php
        if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){?>
            <th class="text-center">ACTION</th>
        <?php }?>
        </tr>
    </thead>
    <tbody>


<!-- <select class="form-select-sm" aria-label="Default select example">
        <option value="1">Paid</option>
        <option value="2">Pending</option>
        <option value="3">Partial</option>
        <option value="4">Unpaid</option>
        <option value="5">Overdue</option>
    </select> -->
    <?php 
        // include
        require_once '../../classes/users.class.php';
        require_once '../../classes/user_status.class.php';
        require_once '../../tools/functions.php';
        if(isset($_GET['page']) && intval($_GET['page'])>=0 ){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }
        $limit=10;


        $userObj =new users();
        $user_status = new user_status();
        $num_of_users = $userObj->count_users();
        $output=false;
        if($user_status_data =$user_status->get_user_status()){
            if($users_data = $userObj->fetch_all_users($page-1,10000)){
                //print_r($users_data)  ;
                $counter=1;
                $output=true;
                foreach ($users_data as $key => $value) {
                    echo '<tr>';
                    echo '<th class="d-lg-none"></th>';
                    echo '<th class="text-center d-none d-sm-table-cell">';echo $counter;echo'</th>';
                    echo '<td class="">'; echo_safe($value['user_name']);'</td>';
                    echo '<td><a href="account-profile.php?user_id=';echo_safe($value['user_id']);echo'" class="text-decoration-none text-dark">';echo_safe($value['user_lastname'].', '.$value['user_firstname'].' '.$value['user_middlename']);echo'</a></td>';
                    echo '<td class="text-center ">'; echo_safe(getAge($value['user_birthdate']));'</td>';
                    echo '<td class="text-center">TO BE IMPLEMENTED</td>';
                    echo '<td class="text-center">'; if($value['user_email_verified'] ==1){echo('<i class="bx bxs-check-square fs-3 align-bottom" style="color:green;" >');}else{echo '';}'</td>';
                    echo '<td class="text-center">';
                    if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){
                        echo '<select class="form-select-sm" aria-label="Default select example" id="user_status';echo_safe($value['user_id']);echo'" onchange="changeUserStatus(';echo_safe($value['user_id']);echo')">';
                            foreach ($user_status_data as $key => $user_status_value) {
                                if($value['user_status_details'] == $user_status_value['user_status_details']){
                                    echo '<option value="';echo_safe($user_status_value['user_status_details']);echo'" selected>';echo_safe($user_status_value['user_status_details']);echo'</option>';
                                }else{
                                    echo '<option value="';echo_safe($user_status_value['user_status_details']);echo'">';echo_safe($user_status_value['user_status_details']);echo'</option>';
                                }
                            }
                    }else{
                        echo_safe($value['user_status_details']);
                    }
                    echo'</td>';
                    if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){
                        echo '<td class="text-center"><a class="btn btn-primary btn-sm px-3" href="account-profile-edit.php?user_id=';echo_safe($value['user_id']);echo'&prev=account.php">Edit</a> <button class="btn btn-danger btn-sm" onclick="confirmfunction(';echo $value['user_id']; echo','.$counter.',\''.htmlentities($value['user_lastname'].', '.$value['user_firstname'].' '.$value['user_middlename']).'\')">Delete</button></td>';
                     }
                       echo '</tr>';
                    $counter++;
                    
                }
            }else{
                $users_data = $userObj->fetch_all_users(0,10);
                //print_r($users_data)  ;
                $counter=1;
                $output=true;
                foreach ($users_data as $key => $value) {
                    echo '<tr>';
                    echo '<th class="d-lg-none"></th>';
                    echo '<th class="text-center d-none d-sm-table-cell">';echo $counter;echo'</th>';
                    echo '<td class="">'; echo_safe($value['user_lastname']);'</td>';
                    echo '<td><a href="account-profile.php?user_id=';echo_safe($value['user_id']);echo'" class="text-decoration-none text-dark">';echo_safe($value['user_lastname'].', '.$value['user_firstname'].' '.$value['user_middlename']);echo'</a></td>';
                    echo '<td class="text-center ">'; echo_safe(getAge($value['user_birthdate']));'</td>';
                    echo '<td class="text-center">TO BE IMPLEMENTED</td>';
                    echo '<td class="text-center">'; if($value['user_email_verified'] ==1){echo('VERIFIED');}else{echo 'NOT VERIFIED';}'</td>';
                    echo '<td class="text-center">';
                    if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){
                        echo '<select class="form-select-sm" aria-label="Default select example" id="user_status';echo_safe($value['user_id']);echo'" onchange="changeUserStatus(';echo_safe($value['user_id']);echo')">';
                            foreach ($user_status_data as $key => $user_status_value) {
                                if($value['user_status_details'] == $user_status_value['user_status_details']){
                                    echo '<option value="';echo_safe($user_status_value['user_status_details']);echo'" selected>';echo_safe($user_status_value['user_status_details']);echo'</option>';
                                }else{
                                    echo '<option value="';echo_safe($user_status_value['user_status_details']);echo'">';echo_safe($user_status_value['user_status_details']);echo'</option>';
                                }
                            }
                    }else{
                        echo_safe($value['user_status_details']);
                    }
                    echo'</td>';
                    if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){
                        echo '<td class="text-center"><a class="btn btn-primary btn-sm px-3" href="account-profile-edit.php?user_id=';echo_safe($value['user_id']);echo'&prev=account.php">Edit</a> <button class="btn btn-danger btn-sm" onclick="confirmfunction(';echo $value['user_id']; echo ',\'sdfsd\')">Delete</button></td>';
                        }
                        echo '</tr>';
                    $counter++;
                    
                }
                
            }
        }
    ?>
    </tbody>
</table>
<?php 
// if(isset($num_of_users)){
//     $val = $num_of_users['number_of_users'];
//     echo 'showing results of '.(($page*$limit)+1).'-'.($page*$limit)+$limit.' of '.$val;
//     $prev ='';

    
// }
// if($output){
//     if($page<=3){
        
//     echo '<div class="container d-flex justify-content-center justify-content-lg-end ">
//                 <nav aria-label="...">
//                         <ul class="pagination">';
//     $counter=0;
//     $current = $counter*$limit;
//     while($current <=$val){
//         if($counter == $page-1){
//             echo ' <li class="page-item active ">
//                         <a class="page-link" href="#"  onclick="get_page('.($counter+1).')">'.($counter+1).'</a>
//                     </li>';
//         }else{
//             echo ' <li class="page-item  ">
//                     <a class="page-link" href="#"  onclick="get_page('.($counter+1).')">'.($counter+1).'</a>
//                 </li>';
//         }
        
//         $counter++;
//         $current = $counter*$limit;
//     }
  
//     if($page-1 != intval($val/$limit) ){
//         echo '<li class="page-item">
//             <a class="page-link " href="#" onclick="get_page('.($page+1).')">Next</a>
//             </li>';
//     }
    
                            

                           

//             //                 <li class="page-item '.$page_2.'" >
//             //                     <a class="page-link " href="#" onclick="get_page(2)">2</a>
//             //                 </li>

//             //                 <li class="page-item '.$page_3.'">
//             //                     <a class="page-link " href="#" onclick="get_page(3)">3</a>
//             //                 </li>
//             //                 <li class="page-item">
//             //                     <a class="page-link " href="#" onclick="get_page(4)">4</a>
//             //                 </li>
//             //                 <li class="page-item">
//             //                     <a class="page-link " href="#" onclick="get_page(5)">5</a>
//             //                 </li>

//             //                 
//             //             </ul>
//             //         </nav>
//             //     </div>
//             // </div>';

//     }else{
//         $prev ='<li class="page-item disabled">
//         <a class="page-link" href="#" tabindex="-1" aria-disabled="true" onclick="get_page('.($page-1).')">Previous</a>
//         </li>';
//     }
// }
?>
            
        </div>
<script> 
function confirmfunction(id,index,name){
    console.log(name)
    let text = "Are you sure you want to delete #"+index+'.'+name+"?";
    if (confirm(text) == true) {
        $.ajax({url: "account-change-status.php?user_id="+id+'&user_status_details=deleted', success: function(result){
            console.log(result);
            if(result ==1){
                // update datatables
                // $( "#offer_id_"+id ).remove();
                // update selected
                $('#user_status'+id+' option[value=deleted]').attr('selected','selected'); 
                alert('deleted successfully');
                console.log(result)
            }else{
                alert('deletion failed');
            }
            location.reload();
        }});
    } else {
        return;
        text = "You canceled!";
    }
    
}


function changeUserStatus(id){
    console.log(id);
    console.log($("#user_status"+id+" option:selected" ).text());
    
   // $('#user_status'+id+' option[value='+$("#user_status"+id+" option:selected" ).text()+']').attr('selected',''); 
    $.ajax({url: "account-change-status.php?user_id="+id+'&user_status_details='+$("#user_status"+id+" option:selected" ).text(), success: function(result){
            console.log(result);
            if(result == 1){
                // update datatables
                //$( "#offer_id_"+id ).remove();
                alert('changed successfully');
                console.log(result)
                location.reload();
            }else{
                alert('changed failed');
                location.reload();
            }
    }});
}

function get_page(page_id){
    console.log(page_id);
    $('#next_page').attr('onclick','get_page('+(page_id+1)+')');
    // if($('foo').is(':focus');)
    $.ajax({
            type: "GET",
            url: 'user-table-header.php?',
            success: function(result)
            {
                $('#add-button').html('Add Customer');
                $('#add-button').attr('href','user-add.php');
                $('div#tab').html(result);
                $.ajax({
                    type: "GET",
                    url: 'usertable.php?page='+page_id,
                    success: function(result)
                    {
                        $('div.table-responsive').html(result);
                        // dataTable = $("div.table-responsive").DataTable({
                        //     "dom": '<"top"f>rt<"bottom"lp><"clear">',
                        //     responsive: true,
                        // });
                        // $('input#keyword').on('input', function(e){
                        //     var status = $(this).val();
                        //     dataTable.columns([2]).search(status).draw();
                        // })
                        // $('select#categoryFilter').on('change', function(e){
                        //     var status = $(this).val();
                        //     dataTable.columns([4]).search(status).draw();
                        // })
                        // $('select#program').on('change', function(e){
                        //     var status = $(this).val();
                        //     dataTable.columns([4]).search(status).draw();
                        // })
                        // new $.fn.dataTable.FixedHeader(dataTable);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    }
                });
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
}
</script>



   
