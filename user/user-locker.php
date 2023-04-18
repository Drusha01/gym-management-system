<div class="container-fluid p-3 " style="min-height: 450px;">
    <div class="ms-lg-5">
        <div class="table-responsive table-container col-12 col-lg-6">
            <?php 
            session_start();
            require_once '../tools/functions.php';
            require_once('../classes/lockers.class.php');
            $lockerObj = new lockers();
            if($locker_data = $lockerObj->fetch_user_locker($_SESSION['user_id'])){
                echo ' 
                <table id="announce" class="table table-borderless table-striped" style="width:100%; border: 3px solid black;">
                    <thead class="table-dark" >
                        <tr>
                        <th class="d-lg-none"></th>
                        <th class="text-center d-none d-sm-table-cell">#</th>
                        <th>LOCKER_ID</th>
                        <th class="text-center">END DATE</th>
                        </tr>
                    </thead>
                    <tbody>';
                $counter=1;
                foreach ($locker_data as $key => $value) {
                    echo ' 
                    <tr>
                        <th class="d-lg-none"></th>
                        <td class="text-center d-none d-sm-table-cell">'.$counter.'</td>
                        <td>Locker_'.htmlentities($value['locker_UID']).'</td>
                        <td class="text-center">'.htmlentities(date_format(date_create($value['subscription_end_date']), "F d, Y")).'</td>
                    </tr>';
                    $counter++;
                }
                echo 
                    '</tbody>
                </table>';
            }else{
                echo '
                <div class="pt-2">
                    <h5>Avail Locker Go Here.</h5>
                    <div class="form-group col-12 pt-3 ">
                        <a class="btn btn-success" role="button" href="user-avail.php">Avail Now</a>
                    </div>
                </div>
            ';
            }
            ?>  
        </div>
    </div>
</div>
