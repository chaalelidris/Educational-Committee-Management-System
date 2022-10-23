<?php
session_start();
require_once("../control/config/dbcon.php");
if (isset($_POST['btn_delete_cp'])) {
  // code...
  extract($_POST);
  $delete_cp_id = mysqli_real_escape_string($con,$delete_cp_id);

  $sql = "DELETE FROM tbl_cp WHERE cp_id=".$delete_cp_id;
  mysqli_query($con, $sql) or die (mysqli_error($con));

  $_SESSION["message_suc"]="CP supprimé avec succès";
  $_SESSION["message_type"]="green";


    header('location:gst_cp.php');
    exit();

}
 ?>
