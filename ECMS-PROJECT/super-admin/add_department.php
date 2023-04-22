<?php
session_start();
include("../control/config/dbcon.php");

if (isset($_POST['add_department'])){

  // get all user IDs from the users table
  $user_ids = array_column(mysqli_fetch_all(mysqli_query($con, "SELECT user_id FROM tbl_users")), 0);


  // loop through all user IDs
  foreach ($user_ids as $user_id) {
    // loop through all department IDs
    mysqli_query($con, "INSERT INTO tbl_user_department (user_id, department_id) VALUES ($user_id, 1)");
  } 
  

  extract($_POST);

  // Clean input data
  $name = mysqli_real_escape_string($con, $department_name);
  $abbr = mysqli_real_escape_string($con, $department_abbr);
  $description = mysqli_real_escape_string($con, $department_description);
  $admin_id = mysqli_real_escape_string($con, $admin_id);

  // Check for empty admin ID
  if (empty($admin_id)) {
    $_SESSION['department_name'] = $name;
    $_SESSION['department_abbr'] = $abbr;
    $_SESSION['department_description'] = $description;
    $_SESSION['admin_id'] = $admin_id;

    $_SESSION["message"] = "Le champ admin est obligatoire";
    $_SESSION["message_type"] = "red";
    $_SESSION["show_modal_add_department"] = true;

    header('location: manage_departments.php');
    exit();
  }

  // Check if department with same name exists
  $query = "SELECT * FROM tbl_department WHERE department_name='$name' LIMIT 1";
  $result = mysqli_query($con, $query) or die ("La connexion a échoué: " . mysqli_error($con));
  $num = mysqli_num_rows($result);

  if ($num > 0) {
    $_SESSION['department_name'] = $name;
    $_SESSION['department_abbr'] = $abbr;
    $_SESSION['department_description'] = $description;
    $_SESSION['admin_id'] = $admin_id;

    $_SESSION["message"] = "Département avec ce nom existe déjà";
    $_SESSION["message_type"] = "red";
    $_SESSION["show_modal_add_department"] = true;

    header('location: manage_departments.php');
    exit();
  } 

  // Check if admin is already assigned to a department
  $query = "SELECT department_id FROM tbl_department WHERE admin_id='$admin_id' LIMIT 1";
  $result = mysqli_query($con, $query) or die ("La connexion a échoué: " . mysqli_error($con));
  $num = mysqli_num_rows($result);

  if ($num > 0) {
    $_SESSION["message"] = "Cet administrateur est déjà assigné à un département";
    $_SESSION["message_type"] = "red";
    $_SESSION["show_modal_add_department"] = true;

    header('location: manage_departments.php');
    exit();
  }

  // Add department to database
  $sql = "INSERT INTO tbl_department (department_name, department_abbr, department_description, admin_id) VALUES ('$name', '$abbr', '$description', '$admin_id')";
  $result = mysqli_query($con, $sql) or die ("La connexion a échoué: " . mysqli_error($con));

  // Unset session variables
  unset($_SESSION['department_name']);
  unset($_SESSION['department_abbr']);
  unset($_SESSION['department_description']);
  unset($_SESSION['admin_id']);

  $_SESSION['message'] = "Département ajouté avec succès!";
  $_SESSION['message_type'] = "green";
  $_SESSION["show_modal_add_department"] = true;

  header('location: manage_departments.php');
  exit();
}
?>
