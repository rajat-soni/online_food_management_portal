<?php 
session_start();
include '../customFunction/function.php';

unset($_SESSION['is_ADMIN_LOGIN']);
redirect('login.php');

?>