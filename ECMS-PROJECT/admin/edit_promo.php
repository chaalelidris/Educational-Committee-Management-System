<?php
session_start();
require_once("../control/config/dbcon.php");
if (isset($_GET['edit'])) {
  $_SESSION['show_modal_edit_promo'] = " show";
  $id = $_GET['edit'];
  $result = mysqli_query($con, "SELECT * FROM tbl_promo WHERE prom_id=$id") or die (mysqli_error($con));
  $row=mysqli_fetch_array($result);
  $num=mysqli_num_rows($result);
  if($num==1){

    $_SESSION['id_edit'] = $row['prom_id'];
    $_SESSION['name_edit'] = $row['prom_name'];
    $_SESSION['respid_edit'] = $row['prom_resp_id'];
  


    if ($_SESSION["current_session"] == "admin") {
      header('location: ../admin/dashboard.php?class=show');
    }elseif ($_SESSION["current_session"] == "delegue") {
      header('location: ../admin/gst_delegue.php?class=show');
    }elseif ($_SESSION["current_session"] == "enseignant") {
      header('location: ../admin/gst_enseignant.php?class=show');
    }elseif ($_SESSION["current_session"] == "responsable") {
      header('location: ../admin/gst_responsable.php?class=show');
    }elseif ($_SESSION["current_session"] == "promotion") {
      header('location: ../admin/gst_promos.php?class_pr=show');
    }
    exit();
  }
}


if (isset($_POST['modifier_promotion'])) {
  // code...
  extract($_POST);
  $id = mysqli_real_escape_string($con,$id);
  $name = mysqli_real_escape_string($con,$name);
  $respid = mysqli_real_escape_string($con,$respid);

  $result = mysqli_query($con, "UPDATE tbl_promo SET prom_name='$name',prom_resp_id='$respid' WHERE prom_id='$id'")or die(mysqli_error($con));

  $_SESSION["message_suc"]="La promotion a été Modifier avec succès";
  $_SESSION["message_type"]="green";

  if (isset($_SESSION["show_modal_edit_promo"])) {
    unset($_SESSION["show_modal_edit_promo"]);
  }


    header('location:gst_promos.php?class_pr=show');
    exit();

}

 ?>
