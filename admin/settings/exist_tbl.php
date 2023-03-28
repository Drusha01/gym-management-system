<table id="table-exist" class="table table-striped table-borderless table-custom" style="width:100%;border: 3px solid black;">
    <thead class="bg-dark text-light">
        <tr>
        <th class="d-lg-none"></th>
        <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
        <th>USER NAME</th>
        <th>NAME</th>
        <th scope="col" class="text-center">AGE</th>
        <th scope="col" class="text-center">GENDER</th>
        <th scope="col" class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php
            require_once '../../classes/users.class.php';
            $userObj = new users();

            $users_data = $userObj->fetch_all_users(0,1000000);

            $counter=1;
            foreach ($users_data as $key => $value) {
                if($value['user_status_details'] == 'active'){
                echo '<tr>';
                echo '<th class="d-lg-none"></th>';
                echo '<th scope="row" class="text-center d-none d-sm-table-cell">'.htmlentities($counter).'</th>';
                echo '<td>'.htmlentities($value['user_name']).'</td>';
                echo '<td>'.htmlentities($value['user_fullname']).'</td>';
                echo '<td class="text-center">'.htmlentities(intval(date('Y', time() - strtotime($value['user_birthdate']))) - 1970).'</td>';
                echo '<td class="text-center">'.htmlentities($value['user_gender_details']).'</td>';
                echo '<td class="text-center"><a  class="btn btn-primary btn-sm" role="button" href="add-new-admin.php?user_id='.htmlentities($value['user_id']).'">Add</a></td>';
                echo '</tr>';
                }
            }
        ?>
    </tbody>
</table>