<?php
// If the admin clicks on the "Add" button
session_start();
include("../control/config/dbcon.php");

if (isset($_POST['add_department'])){
  extract($_POST);
  $name = mysqli_real_escape_string($con,$department_name);
  $abbr = mysqli_real_escape_string($con,$department_abbr);
  $description = mysqli_real_escape_string($con,$department_description);
  $admin_id = mysqli_real_escape_string($con,$admin_id);

  // Validation
  $query = "SELECT * FROM tbl_department WHERE department_name='$name' LIMIT 1";
  $result = mysqli_query($con, $query) or die ("La connexion a échoué: 1" . mysqli_error($con));
  $num = mysqli_num_rows($result);

  if ($num > 0) {
    // Store form values in session variables
    $_SESSION['department_name'] = $name;
    $_SESSION['department_abbr'] = $abbr;
    $_SESSION['department_description'] = $description;
    $_SESSION['admin_id'] = $admin_id;

    $_SESSION["message"] = "département avec ce nom existe déjà";
    $_SESSION["message_type"] = "red";
    $_SESSION["show"] = "show";
    $_SESSION["show_modal_add_department"] = "show";

    header('location: manage_departments.php');
    
    exit();
  } else {
    $sql = "INSERT INTO tbl_department (department_name, department_abbr, department_description, admin_id) VALUES ('$name', '$abbr', '$description', '$admin_id')";
    $result = mysqli_query($con,$sql) or die ("La connexion a échoué: 2" . mysqli_error($con));

    $_SESSION['message_suc'] = "Département ajouté avec succès!";
    $_SESSION['message_type'] = "green";
    $_SESSION["show"] = "show";

    if (isset($_SESSION["show_modal_add_department"])) {
      unset($_SESSION["show_modal_add_department"]);
    }

    header('location: manage_departments.php');
    exit();
  }
}
?>
