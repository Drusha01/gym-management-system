<table id="table-1" class="table table-striped table-borderless table-custom table-hover" style="width: 100%">
    <thead class="bg-dark text-light">
        <tr>
        <th class="d-lg-none"></th>
        <th class="text-center d-none d-sm-table-cell">#</th>
        <th>USERNAME</th>
        <th>NAME</th>
        <th class="text-center ">AGE</th>
        <th class="text-center">SUBSCRIPTION STATUS</th>
        <th class="text-center">USER STATUS</th>
        <th class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody>


<select class="form-select-sm" aria-label="Default select example">
        <option value="1">Paid</option>
        <option value="2">Pending</option>
        <option value="3">Partial</option>
        <option value="4">Unpaid</option>
        <option value="5">Overdue</option>
    </select>
    <?php 
        // include
        require_once '../../classes/users.class.php';
        require_once '../../classes/user_status.class.php';
        require_once '../../tools/functions.php';

        $userObj =new users();
        $user_status = new user_status();
        if($user_status_data =$user_status->get_user_status()){
            if($users_data = $userObj->fetch_all_users()){
                //print_r($users_data)  ;
                $counter=1;
                foreach ($users_data as $key => $value) {
                    echo '<tr>';
                    echo '<th class="d-lg-none"></th>';
                    echo '<th class="text-center d-none d-sm-table-cell">';echo $counter;echo'</th>';
                    echo '<td class="">'; echo_safe($value['user_name']);'</td>';
                    echo '<td><a href="account-profile.php?user_id=';echo_safe($value['user_id']);echo'" class="text-decoration-none text-dark">';echo_safe($value['user_lastname'].', '.$value['user_firstname'].' '.$value['user_middlename']);echo'</a></td>';
                    echo '<td class="text-center ">'; echo_safe(getAge($value['user_birthdate']));'</td>';
                    echo '<td class="text-center">TO BE IMPLEMENTED</td>';
                    echo '<td class="text-center">';
                        echo '<select class="form-select-sm" aria-label="Default select example" id="user_status';echo_safe($value['user_id']);echo'" onchange="changeUserStatus(';echo_safe($value['user_id']);echo')">';
                            foreach ($user_status_data as $key => $user_status_value) {
                                if($value['user_status_details'] == $user_status_value['user_status_details']){
                                    echo '<option value="';echo_safe($user_status_value['user_status_details']);echo'" selected>';echo_safe($user_status_value['user_status_details']);echo'</option>';
                                }else{
                                    echo '<option value="';echo_safe($user_status_value['user_status_details']);echo'">';echo_safe($user_status_value['user_status_details']);echo'</option>';
                                }
                                
                            }
                    echo'</td>';
                    echo '<td class="text-center"><a class="btn btn-primary btn-sm px-3" href="account-profile-edit.php?user_id=';echo_safe($value['user_id']);echo'">Edit</a> <button class="btn btn-danger btn-sm" onclick="confirmfunction(';echo $value['user_id']; echo')">Delete</button></td>';
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
        }});
    } else {
        return;
        text = "You canceled!";
    }
    
}


function changeUserStatus(id){
    console.log(id);
    console.log($("#user_status option:selected" ).text());
    $.ajax({url: "account-change-status.php?user_id="+id+'&user_status_details='+$("#user_status option:selected" ).text(), success: function(result){
            console.log(result);
            if(result == 1){
                // update datatables
                //$( "#offer_id_"+id ).remove();
                alert('changed successfully');
                console.log(result)
            }else{
                alert('changed failed');
            }
    }});
}
</script>



   
