<?php
session_start();
require_once("../control/config/dbcon.php");

// Check if 'edit' parameter is set in URL
if (isset($_GET['edit'])) {
  // Set session variable to show modal for editing delegate
  $_SESSION['show_modal_edit_delegue'] = "show";
  
  // Get ID of delegate to be edited
  $id = $_GET['edit'];
  
  // Get information of delegate from database
  $result = mysqli_query($con, "SELECT * FROM tbl_users WHERE user_id=$id") or die (mysqli_error($con));
  $row = mysqli_fetch_array($result);
  $num = mysqli_num_rows($result);
  
  // If delegate exists, store their information in session variables
  if ($num == 1) {
    $_SESSION['id_edit'] = $row['user_id'];
    $_SESSION['name_edit'] = $row['user_fullname'];
    $_SESSION['username_edit'] = $row['user_name'];
    $_SESSION['email_edit'] = $row['user_email'];

    // Get promotion ID of delegate from database
    $result = mysqli_query($con, "SELECT * FROM tbl_delegation WHERE delegation_del_id=$id") or die (mysqli_error($con));
    $row1 = mysqli_fetch_array($result);
    $num = mysqli_num_rows($result);
    
    // If promotion ID exists, store it in session variable
    if ($num == 1) {
      $_SESSION['promo_edit'] = $row1['delegation_prom_id'];
    }

    // Redirect to appropriate page depending on user type
    if ($_SESSION["current_session"] == "admin") {
      header('location: ../admin/dashboard.php?class=show');
    } elseif ($_SESSION["current_session"] == "delegue") {
      header('location: ../admin/gst_delegue.php?class=show');
    } elseif ($_SESSION["current_session"] == "enseignant") {
      header('location: ../admin/gst_enseignant.php?class=show');
    } elseif ($_SESSION["current_session"] == "responsable") {
      header('location: ../admin/gst_responsable.php?class=show');
    }
    exit();
  }
}

// Check if 'modifier_delegue' form has been submitted
if (isset($_POST['modifier_delegue'])) {
  // Extract form data
  extract($_POST);
  
  // Sanitize form data
  $id = mysqli_real_escape_string($con, $id);
  $name = mysqli_real_escape_string($con, $name);
  $username = mysqli_real_escape_string($con, $username);
  $promid = mysqli_real_escape_string($con, $promid);
  $department_id = mysqli_real_escape_string($con, $department_id);
  $email = mysqli_real_escape_string($con, $email);

  // Update delegate's information in database
  $result = mysqli_query($con, "UPDATE tbl_users SET user_fullname='$name',user_name='$username', user_email='$email' WHERE user_id='$id'") or die(mysqli_error($con));
  $result = mysqli_query($con, "UPDATE tbl_delegation SET delegation_prom_id='$promid'WHERE delegation_del_id='$id'") or die(mysqli_error($con));
  $result = mysqli_query($con, "UPDATE tbl_user_department SET department_id='$department_id'WHERE user_id='$id'") or die(mysqli_error($con));

  // Set success message in session variable and redirect to

  $_SESSION["message_success"]="Le dédégué a été Modifier avec succès";
  $_SESSION["message_type"]="green";

  if (isset($_SESSION["show_modal_edit_delegue"])) {
    unset($_SESSION["show_modal_edit_delegue"]);
  }

  header('location:gst_delegue.php?class=show');
  exit();

}

 ?>
