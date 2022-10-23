<?php
session_start();
require_once("../control/config/dbcon.php");
if (isset($_GET['edit'])) {
  $_SESSION['switch_fmdcp'] = " show";
  $id = $_GET['edit'];
  $result = mysqli_query($con, "SELECT * FROM tbl_cp WHERE cp_id=$id") or die (mysqli_error($con));
  $row=mysqli_fetch_array($result);
  $num=mysqli_num_rows($result);
  if($num==1){

    $_SESSION['edit_id'] = $row['cp_id'];
    $_SESSION['edit_titre'] = $row['cp_title'];
    $_SESSION['edit_datetime'] = $row['cp_datetime'];
    $_SESSION['edit_location'] = $row['cp_location'];
    $_SESSION['edit_ordre'] = $row['cp_ordre'];
    $_SESSION['edit_detail'] = $row['cp_detail'];
    $_SESSION['edit_intervension'] = $row['cp_intervension'];
    $_SESSION['edit_semestre'] = $row['cp_semestre'];


    $_SESSION['edit_semestre_name'] = $row['cp_semestre'];


      header('location: gst_cp.php');

    exit();
  }
}


if (isset($_POST['modifier_cp'])) {
  // code...
  extract($_POST);
  $idcp = mysqli_real_escape_string($con,$idcp);
  $titre = mysqli_real_escape_string($con,$titre);
  $datetime = mysqli_real_escape_string($con,$datetime);
  $lieu = mysqli_real_escape_string($con,$lieu);
  $ordre = mysqli_real_escape_string($con,$ordre);
  $detail = mysqli_real_escape_string($con,$detail);
  $intervension = mysqli_real_escape_string($con,$intervension);
  $semestre = mysqli_real_escape_string($con,$semestre);

  $result = mysqli_query($con, "UPDATE tbl_cp SET cp_title='$titre',cp_datetime='$datetime',cp_location='$lieu',cp_ordre='$ordre',cp_detail='$detail',cp_intervension='$intervension',cp_semestre='$semestre' WHERE cp_id='$idcp'")or die(mysqli_error($con));

  $_SESSION["message_suc"]="CP Modifier avec succès";
  $_SESSION["message_type"]="green";

  if (isset($_SESSION['switch_fmdcp'])) {
    unset($_SESSION['switch_fmdcp']);
  }


    header('location:gst_cp.php');
    exit();

}

 ?>
