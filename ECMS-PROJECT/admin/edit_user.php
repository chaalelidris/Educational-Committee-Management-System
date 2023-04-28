<?php
session_start();
require_once("../control/config/dbcon.php");

if (isset($_GET['edit'])) {
  $id = mysqli_real_escape_string($con, $_GET['edit']);

  $result = mysqli_query($con, "SELECT * FROM tbl_users WHERE user_id='$id' LIMIT 1") or die(mysqli_error($con));
  $row = mysqli_fetch_assoc($result);
  
  if (!$row) {
    // handle error if user with given ID doesn't exist
    $_SESSION['message_edit_error'] = "L'utilisateur avec l'ID $id n'existe pas";
    $_SESSION['message_type'] = " red ";
  } else {
    $_SESSION['show_modal_edit'] = "show";
    $_SESSION['id_edit'] = $row['user_id'];
    $_SESSION['name_edit'] = $row['user_fullname'];
    $_SESSION['username_edit'] = $row['user_name'];
    $_SESSION['email_edit'] = $row['user_email'];
    $_SESSION['type_edit'] = $row['user_type'];

    // redirect user based on their current session
    $redirect_url = '';
    switch ($_SESSION['current_session']) {
      case 'admin':
        $redirect_url = '../admin/dashboard.php?class=show';
        break;
      case 'delegue':
        $redirect_url = '../admin/gst_delegue.php?class=show';
        break;
      case 'enseignant':
        $redirect_url = '../admin/gst_enseignant.php?class=show';
        break;
      case 'responsable':
        $redirect_url = '../admin/gst_responsable.php?class=show';
        break;
      default:
        // handle error if current session is not recognized
        $_SESSION['message_edit_error'] = "Session invalide: {$_SESSION['current_session']}";
        $_SESSION['message_type'] = " red ";
    }

    if ($redirect_url) {
      header("Location: $redirect_url");
      exit();
    }
  }
}



if (isset($_POST['modifier_utilisateur'])) {

  // Sanitize and escape user input
  $id = mysqli_real_escape_string($con, $_POST['id']);
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $type = mysqli_real_escape_string($con, $_POST['type']);
  $department_id = mysqli_real_escape_string($con, $_POST['department_id']);

  // Check if the username already exists in the database
  $username_query = "SELECT * FROM tbl_users WHERE user_name='$username' AND user_id!='$id' LIMIT 1";
  $result = mysqli_query($con, $username_query);
  if (!$result) {
    die("La requête a échoué: " . mysqli_error($con));
  }
  $num_usrs = mysqli_num_rows($result);
  mysqli_free_result($result);

  if ($num_usrs > 0) {
    // Set session variables for displaying error message and preserving form input
    $_SESSION['id_edit'] = $id;
    $_SESSION['name_edit'] = $name;
    $_SESSION['username_edit'] = $username;
    $_SESSION['email_edit'] = $email;
    $_SESSION['type_edit'] = $type;
    $_SESSION['department_id_edit'] = $department_id;

    $_SESSION['message_edit_error'] = "Ce nom d'utilisateur existe déjà";
    $_SESSION['message_type'] = "red";
    $_SESSION['show_modal_edit'] = true;

    // Redirect back to the appropriate page based on the user type
    $redirect_url = "gst_{$_SESSION['current_session']}.php?class=show";
    header("location: ../admin/$redirect_url");
    exit();
  } else {
    // Update the user and department information in the database
    $user_query = "UPDATE tbl_users SET user_fullname='$name', user_name='$username', user_email='$email', user_type='$type' WHERE user_id='$id'";
    $department_query = "UPDATE tbl_user_department SET department_id='$department_id' WHERE user_id='$id'";

    $result1 = mysqli_query($con, $user_query);
    $result2 = mysqli_query($con, $department_query);
    if (!$result1 || !$result2) {
      die("La requête a échoué: " . mysqli_error($con));
    }

    $_SESSION['id_edit'] = $id;
    $_SESSION['name_edit'] = $name;
    $_SESSION['username_edit'] = $username;
    $_SESSION['email_edit'] = $email;
    $_SESSION['type_edit'] = $type;
    $_SESSION['department_id_edit'] = $department_id;
    // Set session variables for displaying success message
    $_SESSION['message_edit_success'] = "L'utilisateur a été modifié avec succès";
    $_SESSION['message_type'] = "green";

    // Redirect back to the appropriate page based on the user type
    $redirect_url = "gst_{$_SESSION['current_session']}.php?class=show";
    header("location: ../admin/$redirect_url");
    exit();
  }
}

 ?>
