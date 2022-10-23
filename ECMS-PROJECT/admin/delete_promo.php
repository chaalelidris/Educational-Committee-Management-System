<?php
session_start();
require_once("../control/config/dbcon.php");
if (isset($_POST['btn_delete_promo'])) {
  // code...
  extract($_POST);
  $delete_promo_id = mysqli_real_escape_string($con,$delete_promo_id);

  $query=mysqli_query($con, "SELECT * from tbl_delegation WHERE delegation_prom_id='$delete_promo_id'")or die (mysqli_error($con));
  $row=mysqli_fetch_assoc($query); //tableau
  $num=mysqli_num_rows($query);
  if ($num > 0) {
    $_SESSION["message_suc"]="La promotion ne peut pas étre supprimé";
    $_SESSION["message_type"]="red";

    header('location:gst_promos.php?class=show_pr');
    exit();
  }else {
    $sql = "DELETE FROM tbl_promo WHERE prom_id=".$delete_promo_id;
    mysqli_query($con, $sql) or die (mysqli_error($con));

    $_SESSION["message_suc"]="La promotion a été supprimé avec succès";
    $_SESSION["message_type"]="green";


      header('location:gst_promos.php?class=show_pr');
      exit();
  }





}
 ?>
