<?php
session_start();
require_once("../control/config/dbcon.php");
if (isset($_POST['btn_delete_module'])) {
  // code...
  extract($_POST);
  $delete_module_id = mysqli_real_escape_string($con,$delete_module_id);

  $query=mysqli_query($con, "SELECT * from tbl_module WHERE modl_id='$delete_module_id'")or die (mysqli_error($con));
  $row=mysqli_fetch_assoc($query); //tableau
  $num=mysqli_num_rows($query);


  $sql = "DELETE FROM tbl_module WHERE modl_id=".$delete_module_id;
  mysqli_query($con, $sql) or die (mysqli_error($con));

  $_SESSION["message_suc"]="Le module a été supprimé avec succès";
  $_SESSION["message_type"]="green";


    header('location:gst_modules.php?class_md=show');
    exit();

}
 ?>
