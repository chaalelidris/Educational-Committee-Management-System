<?php
session_start();
require_once("../control/config/dbcon.php");

if (isset($_GET['edit'])) {
  $_SESSION['show_modal_edit_department'] = " show";
  $id = $_GET['edit'];
  $result = mysqli_query($con, "SELECT * FROM tbl_department WHERE department_id=$id") or die(mysqli_error($con));
  $row = mysqli_fetch_array($result);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    $_SESSION['department_id_edit'] = $row['department_id'];
    $_SESSION['department_name_edit'] = $row['department_name'];
    $_SESSION['department_abbr_edit'] = $row['department_abbr'];
    $_SESSION['department_description_edit'] = $row['department_description'];
    $_SESSION['department_adminid_edit'] = $row['admin_id'];
    
    header('location: manage_departments.php');
    exit();
  }
}

if (isset($_POST['edit_department'])) {
  extract($_POST);
  $id = mysqli_real_escape_string($con, $department_id);
  $name = mysqli_real_escape_string($con, $department_name);
  $abbr = mysqli_real_escape_string($con, $department_abbr);
  $description = mysqli_real_escape_string($con, $department_description);
  $adminid = mysqli_real_escape_string($con, $admin_id);

  // Check if the new admin ID already exists in the table
  $result = mysqli_query($con, "SELECT * FROM tbl_department WHERE admin_id = '$adminid' AND department_id != '$id'");
  if (mysqli_num_rows($result) > 0) {
    $_SESSION["message_err"] = "L'administrateur est déjà utilisé par un autre département.";
    $_SESSION["message_type"] = "red";
    header('location: manage_departments.php');
    exit();
  }

  // Update the department
  $result = mysqli_query($con, "UPDATE tbl_department SET department_name='$name', department_abbr='$abbr', department_description='$description', admin_id='$adminid' WHERE department_id='$id'") or die(mysqli_error($con));

  $_SESSION["message_success"] = "Le département a été modifié avec succès";
  $_SESSION["message_type"] = "green";

  if (isset($_SESSION["show_modal_edit_department"])) {
    unset($_SESSION["show_modal_edit_department"]);
  }

  header('location: manage_departments.php');
  exit();
}

?>
