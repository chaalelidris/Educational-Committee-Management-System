
<?php
session_start();
include("config/dbcon.php");
// date_default_timezone_set('');
$date=date('Y-m-d h:i:s');
extract($_SESSION);
echo $admin_user_id;
$squery=mysqli_query($con, "SELECT * from tbl_users where user_id='$admin_user_id'");
$srow=mysqli_fetch_array($squery);
$user_id=$srow['user_id'];

$details=$srow['user_name']." est déconnecté.";

session_destroy();
header('location:../index.php');
?>
