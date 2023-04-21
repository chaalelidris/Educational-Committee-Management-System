<?php
session_start();
require_once("../control/config/dbcon.php");
if (isset($_GET['edit'])) {
  $_SESSION['show_modal_edit_delegue'] = "show";
  $id = $_GET['edit'];
  $result = mysqli_query($con, "SELECT * FROM tbl_users WHERE user_id=$id") or die (mysqli_error($con));
  $row=mysqli_fetch_array($result);
  $num=mysqli_num_rows($result);
  if($num==1){
    $_SESSION['id_edit'] = $row['user_id'];
    $_SESSION['name_edit'] = $row['user_fullname'];
    $_SESSION['username_edit'] = $row['user_name'];
    $_SESSION['email_edit'] = $row['user_email'];


    $result = mysqli_query($con, "SELECT * FROM tbl_delegation WHERE delegation_del_id=$id") or die (mysqli_error($con));
    $row1=mysqli_fetch_array($result);
    $num=mysqli_num_rows($result);
    $_SESSION['promo_edit'] = $row1['delegation_prom_id'];

    if ($_SESSION["current_session"] == "admin") {
      header('location: ../admin/dashboard.php?class=show');
    }elseif ($_SESSION["current_session"] == "delegue") {
      header('location: ../admin/gst_delegue.php?class=show');
    }elseif ($_SESSION["current_session"] == "enseignant") {
      header('location: ../admin/gst_enseignant.php?class=show');
    }elseif ($_SESSION["current_session"] == "responsable") {
      header('location: ../admin/gst_responsable.php?class=show');
    }
    exit();
  }
}


if (isset($_POST['modifier_delegue'])) {
  // code...
  extract($_POST);
  $id = mysqli_real_escape_string($con,$id);
  $name = mysqli_real_escape_string($con,$name);
  $username = mysqli_real_escape_string($con,$username);
  $promid = mysqli_real_escape_string($con,$promid);
  $email = mysqli_real_escape_string($con,$email);

  $result = mysqli_query($con, "UPDATE tbl_users SET user_fullname='$name',user_name='$username', user_email='$email' WHERE user_id='$id'")or die(mysqli_error($con));
  $result = mysqli_query($con, "UPDATE tbl_delegation SET delegation_prom_id='$promid'WHERE delegation_del_id='$id'")or die(mysqli_error($con));



  $_SESSION["message_suc"]="Le dédégué a été Modifier avec succès";
  $_SESSION["message_type"]="green";

  if (isset($_SESSION["show_modal_edit_delegue"])) {
    unset($_SESSION["show_modal_edit_delegue"]);
  }

  header('location:gst_delegue.php?class=show');
  exit();

}

 ?>
