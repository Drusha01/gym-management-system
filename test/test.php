<?php 

$dir = dirname(__DIR__, 1).'/img/profile';
mkdir($dir);
echo $dir;
if ( !$dir) {
    mkdir($dir);
    echo 'created';
}
echo '<br>';
echo 'nice';
?>