
    <?php 
        session_start();
        require_once('../../../classes/walk_ins.class.php');

        $walk_insObj = new walk_ins();

        if($walk_ins_data = $walk_insObj->get_all_walkins()){
            echo '
            <table id="table-1" class="table table-striped table-borderless table-custom" style="width:100%;border: 3px solid black;">
            <thead class="bg-dark text-light">
                <tr>
                <th class="d-lg-none"></th>
                <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                <th>NAME</th>
                <th class="text-center ">TRAINER NAME</th>
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
                </tbody>
            </table>';
        }else{
            echo 'No Data';
        }
    ?>
    
       
       
  