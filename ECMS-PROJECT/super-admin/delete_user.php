<?php
session_start();
require_once("../control/config/dbcon.php");
if (isset($_POST['btn_delete'])) {
  // code...
  extract($_POST);
  $delete_user_id = mysqli_real_escape_string($con,$delete_user_id);

  $query=mysqli_query($con, "SELECT * from tbl_users where user_id='$delete_user_id'")or die (mysqli_error($con));
  $row=mysqli_fetch_assoc($query); //tableau
  $num=mysqli_num_rows($query);


  $sql = "DELETE FROM tbl_users WHERE user_id=".$delete_user_id;
  mysqli_query($con, $sql) or die (mysqli_error($con));


  $_SESSION["message_suc"]="L'utilisateur a été supprimé avec succès";
  $_SESSION["message_type"]="green";

  
  header('location:manage_admins.php');
 
  exit();
}
 ?>
