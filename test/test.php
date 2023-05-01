<?php

echo date('m-d-Y', time()-(60*60*24*365*18));
echo '<br>';
echo strtotime('2000-02-14')-time();
echo '<br>';
echo time();
echo '<br>';
if(isset($_POST['date'])){
    echo $_POST['date'];
    echo '<br>';
    echo date('Y-m-d', time());
    $min_date = 10 * 366;
    $diff= date_diff(date_create($_POST['date']),date_create(date('Y-m-d', time())));
    $date_diff =  intval($diff->format("%R%a"));
    if($date_diff>$min_date){
        echo $date_diff;
    }
}
?>
<html>
    <form action="" method="POSt" >
        <input type="date" name="date" id="" min="">
        <input type="submit">
    </form>
</html>