<?php

echo date('m-d-Y', time()-(60*60*24*365*18));
echo '<br>';
echo strtotime('2000-02-14')-time();
echo '<br>';
echo time();
?>