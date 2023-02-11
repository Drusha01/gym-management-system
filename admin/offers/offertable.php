<table id="example"  class="table table-striped table-borderless table-custom">
    <thead class="bg-dark text-light">
        <tr>
        <th class="d-lg-none"></th>
        <th class="text-center d-none d-sm-table-cell">#</th>
        <th scope="col">NAME OF OFFER</th>
        <th scope="col" class="text-center ">TYPE OF SUBSCRIPTION</th>
        <th scope="col" class="text-center ">AGE QUALIFICATION</th>
        <th scope="col" class="text-center ">DAYS</th>
        <th scope="col" class="text-center ">SLOTS</th>
        <th scope="col" class="text-center ">PRICE</th>
        <th scope="col" class="text-center ">ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            require_once '../../classes/offers.class.php';
            require_once '../../tools/functions.php';

            $offersObj = new offers();

            if($offers_data = $offersObj->fetch()){
                $counter = 1;
                foreach ($offers_data as $key => $value) {
                    echo '<tr>';
                    echo '<td class="d-lg-none"></td>';
                    echo '<td scope="row" class="text-center d-none d-sm-table-cell">'; echo_safe($counter); echo'</td>';
                    echo ' <td>'; echo_safe($value['offer_name']); echo '</td>';
                    echo '<td class="text-center ">';echo_safe($value['type_of_subscription_details']); echo '</td>';
                    echo '<td class="text-center ">';echo_safe($value['age_qualification_details']); echo '</td>';
                    echo '<td class="text-center ">';echo_safe($value['offer_duration']); echo '</td>';
                    echo '<td class="text-center ">';echo_safe($value['offer_slots']); echo '</td>';
                    echo '<td class="text-center ">';echo_safe($value['offer_price']); echo '</td>';
                    echo '<td class="text-center "><a href="editoffer.php?id='; echo_safe($value['offer_id']); echo'" class="btn btn-primary btn-sm" role="button">Edit</a> <a href="deleteoffer.php?id='; echo_safe($value['offer_id']); echo'" class="btn btn-danger btn-sm">Delete</a></td>';
                    echo '</tr>';
                    $counter++;
                }
            }

        
        ?>
        <!-- <tr> -->
        
        <!-- <td scope="row" class="text-center d-none d-sm-table-cell">1</td>
        <td>1-Month Gym-Use(21 and Above)</td>
        <td class="text-center ">Gym-Use Subscription</td>
        <td class="text-center ">21 above</td>
        <td class="text-center ">30</td>
        <td class="text-center ">None</td>
        <td class="text-center ">₱800.00</td>
        <td class="text-center "><a href="editoffer.php" class="btn btn-primary btn-sm" role="button">Edit</a> <button class="btn btn-danger btn-sm">Delete</button></td>
        </tr>
        <tr>
        <td class="d-lg-none"></td>
        <td scope="row" class="text-center d-none d-sm-table-cell">2</td>
        <td>1-Month Trainer</td>
        <td class="text-center ">Trainer Subscription</td>
        <td class="text-center ">None</td>
        <td class="text-center ">30</td>
        <td class="text-center ">None</td>
        <td class="text-center ">₱1500.00</td>
        <td class="text-center "><a href="editoffer.php" class="btn btn-primary btn-sm" role="button">Edit</a> <button class="btn btn-danger btn-sm">Delete</button></td>
        </tr>
        <tr>
        <td class="d-lg-none"></td>
        <td scope="row" class="text-center d-none d-sm-table-cell">3</td>
        <td>1-Month Locker</td>
        <td class="text-center ">Locker Subscription</td>
        <td class="text-center ">None</td>
        <td class="text-center ">30</td>
        <td class="text-center ">None</td>
        <td class="text-center ">₱100.00</td>
        <td class="text-center "><a href="editoffer.php" class="btn btn-primary btn-sm" role="button">Edit</a> <button class="btn btn-danger btn-sm">Delete</button></td>
        </tr>
        <tr>
        <td class="d-lg-none"></td>
        <td scope="row" class="text-center d-none d-sm-table-cell">4</td>
        <td>Zumba</td>
        <td class="text-center ">Program Subscription</td>
        <td class="text-center ">21 above</td>
        <td class="text-center ">30</td>
        <td class="text-center ">45</td>
        <td class="text-center ">₱500.00</td>
        <td class="text-center "><a href="editoffer.php" class="btn btn-primary btn-sm" role="button">Edit</a> <button class="btn btn-danger btn-sm">Delete</button></td>
        </tr> -->
    </tbody>
</table>