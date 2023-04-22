<?php
// si l'admine clicker Ajouter
session_start();
include("../control/config/dbcon.php");


if (isset($_POST['activer_cp'])){
  extract($_POST);

  $titre = mysqli_real_escape_string($con,$titre);
  $datetime = mysqli_real_escape_string($con,$datetime);
  $lieu = mysqli_real_escape_string($con,$lieu);
  $ordre = mysqli_real_escape_string($con,$ordre);
  $detail = mysqli_real_escape_string($con,$detail);
  $intervension = mysqli_real_escape_string($con,$intervension);
  $semestre = mysqli_real_escape_string($con,$semestre);


  $query=mysqli_query($con, "SELECT * from tbl_promo where prom_resp_id='$idresp' LIMIT 1 ");
  $rowprmid=mysqli_fetch_assoc($query); //tableau

  $promid = $rowprmid['prom_id'];
  $sql =  "INSERT INTO tbl_cp (cp_title, cp_datetime,cp_location,cp_ordre,cp_detail,cp_intervension,cp_semestre,cp_prom_id,cp_status) VALUES ('$titre','$datetime','$lieu','$ordre','$detail','$intervension','$semestre','$promid','1')";
  $result = mysqli_query($con,$sql) or die ("La connexion a échoué:" . mysqli_error($con));

  $id = $con->insert_id;

  $_SESSION['message_success'] = "CP activé avec succès!";
  $_SESSION['message_type'] = "green";
  $_SESSION["show"]="show";

  if (isset($_SESSION['switch_facp'])) {
    $_SESSION['switch_pcp'] = 'ok';
    unset($_SESSION['switch_facp']);
  }


  header('location: gst_cp.php');
  exit();

}

if (isset($_GET['desactiv_cp'])) {
  $did = $_GET['desactiv_cp'];

  $sql =  "UPDATE tbl_cp SET cp_status = '0' WHERE cp_id='$did'";
  $result = mysqli_query($con,$sql) or die ("La connexion a échoué:" . mysqli_error($con));

  header('location: gst_cp.php');
  exit();

}

if (isset($_GET['activer_cp'])) {
  $aid = $_GET['activer_cp'];

  $sql =  "UPDATE tbl_cp SET cp_status = '1' WHERE cp_id='$aid'";
  $result = mysqli_query($con,$sql) or die ("La connexion a échoué:" . mysqli_error($con));

  header('location: gst_cp.php');
  exit();
}

 ?>
