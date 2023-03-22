<?php 

if(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Modify'){


}elseif(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Read-Only'){
    //
}else{
    //do not load the page
    header('location:../dashboard/dashboard.php');
}
?>

<?php  if(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Modify'){
 require_once 'walk-in-add.php';
}?>

<div class="container-fluid">
    <div class="row g-2 mb-2 mt-1">
        <div class="col-12 col-lg-2 align-bottom ">
            <p class="fw-bold fs-5">Recent Walk-In </p>
        </div>
        <div class="col-12 col-lg-10 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50">
            <a href="walk-in_more.php" class="btn btn-success" role="button">More Details</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-borderless table-custom" style="width:100%;border: 3px solid black;">
        <?php 
        require_once('../../classes/walk_ins.class.php');


        $walk_insObj = new walk_ins();

        if($walk_ins_data = $walk_insObj->get_all_walkins_limit()){
            echo '
            <thead class="bg-dark text-light">
                <tr>
                <th class="d-lg-none"></th>
                <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                <th>NAME</th>
                <th class="">TRAINER NAME</th>
                <th class="text-center ">AVAILED SERVICE</th>
                <th scope="col" class="text-center">DATE AVAILED</th>
                ';
                if(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Modify'){
                    echo '<th scope="col" class="text-center">ACTION</th>';
                }
                echo'
                </tr>
            </thead>
            <tbody>';
            $counter =1;
            foreach ($walk_ins_data as $key => $value) {
                echo ' 
                <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">'.$counter.'</th>
                    <td>'.htmlentities($value['user_fullname']).'</td>
                    <td>'.htmlentities($value['trainer_fullname']).'</td>
                    <td class="text-center ">'.htmlentities($value['walk_in_service_details']).'</td>
                    <td class="text-center">'.htmlentities(date_format(date_create($value['walk_in_date']), "F d, Y")).'</td>';
                    if(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Modify'){
                        echo '<td class="text-center"><button  onclick="delete_func('.$value['walk_in_id'].')"class="btn btn-danger" role="button">Delete</button></td>';
                    }
                    echo'
                </tr>';
                $counter++;
            }
            echo '  
                </tbody>';
        }else{
            echo 'No Data';
        }
    ?>
        </table>
    </div>
</div>

<script>

    function delete_func(walk_in_id){
        $.post("delete_walk_in.php",{
            walk_in_id: walk_in_id

        },
        function(data, status){
            console.log(data);
            if(data ==1){
                alert('deleted successfully')
                location.href = 'avail.php?active=walk';
            }else{
                alert('Error avail');
            }
        });
    }
    var user_id;
    var trainer_id;
    function trainer_selected_change(){
        if($('#trainers').val() != 'None'){
            // check
            $('#Trainer').prop('checked', true);
            trainer_id = $('#trainers').val();
        }else{
            $('#Trainer').prop('checked', false);
        }
    }
    function users_selected_change(){
        if($('#users').val() != 'None'){
            // check
            $('#Gym-Use').prop('checked', true);
            user_id =$('#users').val();
            $('#trainers').val('None');
            $('#Trainer').prop('checked',false );
           
        }else{
            $('#Gym-Use').prop('checked', false);
            $('#trainers').val('None');
            $('#Trainer').prop('checked',false );
        }
    }
    function gym_use_changed(){
        if($('#Gym-Use').prop('checked')){
            alert('please select customer');
            $('#Gym-Use').prop('checked',!$('#Gym-Use').prop('checked') );
        }else{
            user_id = null;
            $('#users').val('None')
        }
        
        console.log(check)
    }
    function trainer_check_change(){
        if($('Trainer').prop('checked')){
            alert('please select customer');
            $('#Trainer').prop('checked',!$('#Gym-Use').prop('checked') );
        }else{
            trainer_id = null;
            $('#trainers').val('None')
        }
    }
    function walk_in_avail(){
        if(user_id== null){
            alert('Please Select customer');
        }
        console.log(user_id);
        console.log(trainer_id);
        $.post("walk-in-ajax.php",{
            user_id: user_id,
            trainer_id:trainer_id

        },
        function(data, status){
            console.log(data);
            if(data ==1){
                $('#liveToast').toast('show')
                $('#trainers').val('None')
                $('#Trainer').prop('checked',false );
                $('#Gym-Use').prop('checked', false);
                $('#select2-users-container').prop('title','');
                $('#select2-users-container').html('Select Customer Name');
                location.href = 'walk-in_more.php';
            }else{
                alert('Error avail');
            }
        });

        // ajax here 

        // if result is successful show the  toast

        // else if the ajax failed or it didnt proceed as usual, it
    }
</script>
<script>
    $('.select2').select2();
</script>


