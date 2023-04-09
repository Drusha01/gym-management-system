<?php 
session_start();
if(isset($_SESSION['admin_announcement_restriction_details']) && $_SESSION['admin_announcement_restriction_details'] == 'Modify'){

}elseif(isset($_SESSION['admin_announcement_restriction_details']) && $_SESSION['admin_announcement_restriction_details'] == 'Read-Only'){
    //
}else{
    //do not load the page
    header('location:../dashboard/dashboard.php');
}
?>
<table id="maintenance" class="table table-borderless table-striped" style="width:100%; border: 3px solid black;">
    <thead class="table-dark" >
        <tr>
        <th class="d-lg-none"></th>
        <th class="text-center d-none d-sm-table-cell">#</th>
        <th class="text-center w-25">EQUIPMENT</th>
        <th class="text-center">TYPE</th>
        <th class="text-center">CONDITION</th>
        <th class="text-center">DATE AND TIME</th>
        <th class="text-center">LAST CHECKED BY</th>
        <th class="text-center">VIEW REMARKS</th>
        <th class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php
            require_once '../../../classes/equipments.class.php';
            require_once '../../../classes/remarks.class.php';
            $remarksObj = new remarks();
            $equipmentsObj = new equipments();
            if($equipments_data = $equipmentsObj->fetch_all()){
                $counter =1;
                foreach ($equipments_data as $key => $equipments_item) {
                    // fetch recent remarks
                    if($equipments_item['status_details'] =='active'){

                        if($remark_data = $remarksObj->fetch_one($equipments_item['equipment_id'])){
                            echo '
        <tr>
            <th class="d-lg-none"></th>
            <td class="text-center d-none d-sm-table-cell">'.$counter.'</td>
            <td class="text-center">'.htmlentities($equipments_item['equipment_name']).'</td>
            <td class="text-center">'.htmlentities($equipments_item['equipment_type_details']).'</td>
            <td class="text-center">'.htmlentities($remark_data['equipment_condition_details']).'</td>
            <td class="text-center">'.htmlentities($remark_data['remark_time']).'</td>
            <td class="text-center">'.htmlentities($remark_data['user_fullname']).'</td>
            <td class="text-center"><a href="view_rem.php?equipment_id='.$equipments_item['equipment_id'].'" class="btn btn-outline-dark btn-sm">View All <i class="bx bx-show-alt" style="font-size:20px; vertical-align: middle;"></i></a></td>
            <td class="text-center"><button class="btn btn-outline-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bx bx-plus-circle"></i></button><a href="edit-maintenance.php?equipment_id='.$equipments_item['equipment_id'].'" class="btn btn-outline-primary btn-circle btn-sm"><i class="bx bx-edit-alt"></i></a><button class="btn btn-outline-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#delete"><i class="bx bx-trash" onclick="delete_equipment('.$counter.','.$equipments_item['equipment_id'].',\''.htmlentities($equipments_item['equipment_name']).'\')"></i></button></td>
        </tr>';
                        }else{
                            echo '
        <tr>
            <th class="d-lg-none"></th>
            <td class="text-center d-none d-sm-table-cell">'.$counter.'</td>
            <td class="text-center">'.htmlentities($equipments_item['equipment_name']).'</td>
            <td class="text-center">'.htmlentities($equipments_item['equipment_type_details']).'</td>
            <td class="text-center">No data</td>
            <td class="text-center">No data</td>
            <td class="text-center">No data</td>
            <td class="text-center"><a href="view_rem.php?equipment_id='.$equipments_item['equipment_id'].'" class="btn btn-outline-dark btn-sm">View All <i class="bx bx-show-alt" style="font-size:20px; vertical-align: middle;"></i></a></td>
            <td class="text-center"><button class="btn btn-outline-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bx bx-plus-circle"></i></button><a href="edit-maintenance.php?equipment_id='.$equipments_item['equipment_id'].'" class="btn btn-outline-primary btn-circle btn-sm"><i class="bx bx-edit-alt"></i></a><button class="btn btn-outline-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#delete"><i class="bx bx-trash"  onclick="delete_equipment('.$counter.','.$equipments_item['equipment_id'].',\''.htmlentities($equipments_item['equipment_name']).'\')"></i></button></td>
        </tr>';
                        }
                        $counter++;
                    }
                }
                
            }
        ?>
        
        <!-- <tr>
        <th class="d-lg-none"></th>
        <td class="text-center d-none d-sm-table-cell">2</td>
        <td class="text-center">TreadMill Machine B</td>
        <td class="text-center">Machine</td>
        <td class="text-center">Good</td>
        <td class="text-center">March 26, 2023 (3:30 PM)</td>
        <td class="text-center">Trinidad, James Lorenz</td>
        <td class="text-center"><a href="view_rem.php" class="btn btn-outline-dark btn-sm">View All <i class='bx bx-show-alt' style="font-size:20px; vertical-align: middle;"></i></a></td>
        <td class="text-center"><button class="btn btn-outline-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-plus-circle'></i></button><a href="edit-maintenance.php" class="btn btn-outline-primary btn-circle btn-sm"><i class='bx bx-edit-alt'></i></a><button class="btn btn-outline-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#delete"><i class='bx bx-trash' ></i></button></td>
        </tr>
        <tr>
        <th class="d-lg-none"></th>
        <td class="text-center d-none d-sm-table-cell">3</td>
        <td class="text-center">20 lb Dumbell A</td>
        <td class="text-center">Weights</td>
        <td class="text-center">In-Maintenance</td>
        <td class="text-center">March 24, 2023 (3:30 PM)</td>
        <td class="text-center">Lim, Robbie John</td>
        <td class="text-center"><a href="view_rem.php" class="btn btn-outline-dark btn-sm">View All <i class='bx bx-show-alt' style="font-size:20px; vertical-align: middle;"></i></a></td>
        <td class="text-center"><button class="btn btn-outline-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-plus-circle'></i></button><a href="edit-maintenance.php" class="btn btn-outline-primary btn-circle btn-sm"><i class='bx bx-edit-alt'></i></a><button class="btn btn-outline-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#delete"><i class='bx bx-trash' ></i></button></td>
        </tr>
        <tr>
        <th class="d-lg-none"></th>
        <td class="text-center d-none d-sm-table-cell">4</td>
        <td class="text-center">Ab-Roller A</td>
        <td class="text-center">Tool</td>
        <td class="text-center">In-Maintenance</td>
        <td class="text-center">March 24, 2023 (3:30 PM)</td>
        <td class="text-center">Lim, Robbie John</td>
        <td class="text-center"><a href="view_rem.php" class="btn btn-outline-dark btn-sm">View All <i class='bx bx-show-alt' style="font-size:20px; vertical-align: middle;"></i></a></td>
        <td class="text-center"><button class="btn btn-outline-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-plus-circle'></i></button><a href="edit-maintenance.php" class="btn btn-outline-primary btn-circle btn-sm"><i class='bx bx-edit-alt'></i></a><button class="btn btn-outline-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#delete"><i class='bx bx-trash' ></i></button></td>
        </tr> -->
    </tbody>
</table>