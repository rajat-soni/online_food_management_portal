<?php 


define('DB_HOST','localhost');
define('USER_NAME','root');
define('PASSWORD','');
define('DB_NAME','odr_order_mng_portal');

$conn = new mysqli(DB_HOST,USER_NAME,PASSWORD,DB_NAME);
if(!$conn){
    echo 'error in connection';
}

?>


?>