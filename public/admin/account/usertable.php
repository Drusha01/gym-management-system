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

<table id="example" class="table table-striped table-borderless table-custom table-hover" style="width:100%;border: 3px solid black;">
    <thead class="bg-dark text-light">
        <tr>
        <th class="d-lg-none"></th>
        <th class="text-center d-none d-lg-table-cell">#</th>
        <th scope="col">USERNAME</th>
        <th scope="col">NAME</th>
        <th scope="col" class="text-center ">AGE</th>
        <th scope="col" class="text-center">EMAIL VERIFIED</th>
        <th scope="col" class="text-center">USER STATUS</th>
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
                    echo '<td class="d-lg-none"></td>';
                    echo '<td scope="row" class="text-center d-none d-lg-table-cell">'.$counter.'</td>';
                    echo '<td>'; echo_safe($value['user_name']);'</td>';
                    echo '<td><a href="account-profile.php?user_id=';echo_safe($value['user_id']);echo'" class="text-decoration-none text-dark">';echo_safe($value['user_lastname'].', '.$value['user_firstname'].' '.$value['user_middlename']);echo'</a></td>';
                    echo '<td class="text-center">'; echo_safe(getAge($value['user_birthdate']));'</td>';
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
            }
        }
    ?>
    </tbody>
</table>



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
                $.ajax({
                    type: "GET",
                    url: 'usertable.php?page=1',
                    success: function(result)
                    {
                        $('div.table-responsive-1').html(result);
                        dataTable = $("#example").DataTable({
                            "dom": '<"top"f>rt<"bottom"lp><"clear">',
                            responsive: true,
                        });
                        $('input#keyword').on('input', function(e){
                            var status = $(this).val();
                            dataTable.columns([3]).search(status).draw();
                        })
                        $('select#categoryFilter').on('change', function(e){
                            var status = $(this).val();
                            dataTable.columns([7]).search(status).draw();
                        })
                        new $.fn.dataTable.FixedHeader(dataTable);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    }
                });
            }else{
                alert('deletion failed');
            }
        }});
    } else {
        return;
        text = "You canceled!";
    }
    
}


function changeUserStatus(id){
    console.log(id);
    console.log($("#user_status"+id+" option:selected" ).text());
    let text = "Are you sure you want to change status ?";
    if (confirm(text) == true) {
    // $('#user_status'+id+' option[value='+$("#user_status"+id+" option:selected" ).text()+']').attr('selected',''); 
        $.ajax({url: "account-change-status.php?user_id="+id+'&user_status_details='+$("#user_status"+id+" option:selected" ).text(), success: function(result){
                console.log(result);
                if(result == 1){
                    // update datatables
                    //$( "#offer_id_"+id ).remove();
                    alert('changed successfully');
                    $.ajax({
                        type: "GET",
                        url: 'usertable.php?page=1',
                        success: function(result)
                        {
                            $('div.table-responsive-1').html(result);
                            dataTable = $("#example").DataTable({
                                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                                responsive: true,
                            });
                            $('input#keyword').on('input', function(e){
                                var status = $(this).val();
                                dataTable.columns([3]).search(status).draw();
                            })
                            $('select#categoryFilter').on('change', function(e){
                                var status = $(this).val();
                                dataTable.columns([7]).search(status).draw();
                            })
                            new $.fn.dataTable.FixedHeader(dataTable);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                        }
                    });
                }else{
                    alert('changed failed');
                }
        }});
    }else{
        $.ajax({
            type: "GET",
            url: 'usertable.php?page=1',
            success: function(result)
            {
                $('div.table-responsive-1').html(result);
                dataTable = $("#example").DataTable({
                    "dom": '<"top"f>rt<"bottom"lp><"clear">',
                    responsive: true,
                });
                $('input#keyword').on('input', function(e){
                    var status = $(this).val();
                    dataTable.columns([3]).search(status).draw();
                })
                $('select#categoryFilter').on('change', function(e){
                    var status = $(this).val();
                    dataTable.columns([7]).search(status).draw();
                })
                new $.fn.dataTable.FixedHeader(dataTable);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
    }
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



   
