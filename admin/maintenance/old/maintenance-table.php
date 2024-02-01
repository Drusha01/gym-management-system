<?php 
session_start();
if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Modify'){


}elseif(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Read-Only'){
    //
}else{
    //do not load the page
    header('location:../dashboard/dashboard.php');
}
?>

<table id="table-1" class="table table-striped table-borderless table-custom" style="width:100%;border: 3px solid black;">
    <thead class="bg-dark text-light">
            <tr>
            <th class="d-lg-none"></th>
            <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
            <th>EQUIPMENT NAME</th>
            <th class="text-center ">CONDITION</th>
            <th scope="col" class="text-center">QUANTITY</th>
            <?php 
            if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Modify'){
                echo '<th scope="col" class="text-center">ACTION</th>';
            }
            ?>
            
            </tr>
        </thead>
        <tbody>
        <?php
        require_once '../../classes/equipments.class.php';
        require_once '../../tools/functions.php';


        $equipmentsObj = new equipments();
        $equipments_data = $equipmentsObj->fetchAll();
        $counter=1;
        foreach ($equipments_data as $key => $value) {
            echo '<tr>';
            echo'<th class="d-lg-none"></th>';
            echo'<th scope="row" class="text-center d-none d-sm-table-cell">'.htmlentities($counter).'</th>';
            echo'<td>'.htmlentities($value['equipment_name']).'</td>';
            echo'<td class="text-center ">'.htmlentities($value['equipment_condition_details']).'</td>';
            echo'<td class="text-center">'.htmlentities($value['equipment_quantity']).'</td>';
            if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Modify'){
                echo'<td class="text-center"><a href="edit-maintenance.php?equipment_id='.htmlentities($value['equipment_id']).'" class="btn btn-primary btn-sm" role="button">Edit</a>  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="modalCreate('.htmlentities($counter).','.htmlentities($value['equipment_id']).')">Delete</button></td>';
            }
            echo'</tr>';
            $counter++;
        }

        ?>
        </tbody>
</table>
