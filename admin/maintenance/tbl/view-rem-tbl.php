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

<table id="view-rem" class="table table-borderless table-striped" style="width:100%; border: 3px solid black;">
    <thead class="table-dark" >
        <tr>
        <th class="d-lg-none"></th>
        <th class="text-center d-none d-sm-table-cell">#</th>
        <th class="text-center">REMARKS</th>
        <th class="text-center">CONDITION</th>
        <th class="text-center">DATE AND TIME</th>
        <th class="text-center">CHECKED BY</th>
        <th class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        require_once '../../../classes/remarks.class.php';
        $remarksObj = new remarks();
        if(isset($_GET['equipment_id'])){
            if($remark_data = $remarksObj->fetch_all($_GET['equipment_id'])){
                $counter=1;
                foreach ($remark_data as $key => $value) {
                    echo '
        <tr>
            <th class="d-lg-none"></th>
            <td class="text-center d-none d-sm-table-cell">'.$counter.'</td>
            <td class="text-center">'.htmlentities($value['remark_remark']).'</td>
            <td class="text-center">'.htmlentities($value['equipment_condition_details']).'</td>
            <td class="text-center">'.htmlentities($value['remark_time']).'</td>
            <td class="text-center">'.htmlentities($value['user_fullname']).'</td>
            <td class="text-center">
                <button class="btn btn-outline-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#view" onclick="show_remark('.htmlentities($value['remark_id']).')"><i class="bx bx-show-alt"></i></button>
                <button class="btn btn-outline-primary btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit_remark('.htmlentities($value['remark_id']).')"><i class="bx bx-edit-alt"></i></button>
                <button class="btn btn-outline-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#delete" onclick="add_delete_remark('.htmlentities($value['remark_id']).')"><i class="bx bx-trash" ></i></button></td>
        </tr>';
                    $counter++;
                }
            }
        }
        
        ?>
        
        <!-- <tr>
        <th class="d-lg-none"></th>
        <td class="text-center d-none d-sm-table-cell">2</td>
        <td class="text-center">Somewhat Good</td>
        <td class="text-center">In-Maintenance</td>
        <td class="text-center">March 22, 2023 (3:30 PM)</td>
        <td class="text-center">Trinidad, James Lorenz</td>
        <td class="text-center"><button class="btn btn-outline-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#view"><i class='bx bx-show-alt'></i></button></td>
        </tr> -->
    </tbody>
</table>