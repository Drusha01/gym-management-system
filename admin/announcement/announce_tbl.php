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

<table id="announce" class="table table-borderless table-striped" style="width:100%; border: 3px solid black;">
    <thead class="table-dark" >
        <tr>
        <th class="d-lg-none"></th>
        <th class="text-center d-none d-sm-table-cell">#</th>
        <th>ANNOUNCEMENT TITLE</th>
        <th class="text-center">TYPE</th>
        <th class="text-center">START TO END DATE</th>
        <th class="text-center">ORDER</th>
        <th class="text-center">STATUS</th>
        <th class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php   
            require_once('../../classes/annoucements.class.php');
            $annoucementObj = new annoucements();
            $number_of_announcement = $annoucementObj->get_number_of_annoucements()['number_of_announcements'];

            // fetch all announcements ordering by announcement order
            if($annoucement_data = $annoucementObj->fetch_all()){
                $counter=1;
                $index =0;
                foreach ($annoucement_data as $key => $annoucement_item) {
                    echo '
        <tr id="announcement_'.$annoucement_item['announcement_id'].'">
            <th class="d-lg-none align-middle"></th>
            <td class="text-center d-none d-sm-table-cell align-middle">'.$counter.'</td>
            <td class="align-middle">'.htmlentities($annoucement_item['announcement_title']).'</td>
            <td class="text-center align-middle">'.htmlentities($annoucement_item['announcement_type_details']).'</td>
            <td class="text-center align-middle">'.date_format(date_create($annoucement_item['announcement_start_date']), "F d, Y").' - '.date_format(date_create($annoucement_item['announcement_end_date']), "F d, Y").'</td>
            <td class="text-center align-middle">
                <div class="row" >
                    <div class="col-auto ms-3 ">
                        <div class="btn-group-vertical btn-group-sm " role="group" aria-label="Basic example">';
                        if($number_of_announcement>1){
                             if($index !=0){
                                echo'
                                <button type="button" class="btn btn-outline-dark"><i class="bx bx-up-arrow-alt" style="font-size:20px; vertical-align: middle;" onclick="move_order_up('.$annoucement_item['announcement_id'].')"></i></button>';
                            }
                            if($index+1 < $number_of_announcement){
                            echo'
                                <button type="button" class="btn btn-outline-dark"><i class="bx bx-down-arrow-alt" style="font-size:20px; vertical-align: middle;" onclick="move_order_down('.$annoucement_item['announcement_id'].')"></i></button>';
                            }
                        }
                        echo'
                        </div>
                    </div>
                </div>
            </td>
            <td class="text-center align-middle">'.htmlentities($annoucement_item['announcement_status_details']).'</td>
            <td class="text-center align-middle "><button name="announcement" id="'.$annoucement_item['announcement_id'].'"  class="btn btn-primary btn-sm" role="button">Edit</button> <button href="" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete" onclick="delete_announcement('.$annoucement_item['announcement_id'].')">Delete</button></td>
        </tr>';
        $index++;
        $counter++;
                }
            }
            
            ?>
    </tbody>
</table>

