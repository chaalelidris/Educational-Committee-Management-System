<?php
session_start();
require_once("../control/config/dbcon.php");

  if (isset($_POST['edit_pass'])) {
    extract($_POST);
    $id = $change_password;

    $password = mysqli_real_escape_string($con, $password);
    $password_repeat = mysqli_real_escape_string($con, $password_repeat);

    if ($password != $password_repeat) {
      $_SESSION["message_edit_pass_err"]="Les mots de passe ne correspondent pas";
      $_SESSION["message_type"]="red";

      if(isset($_SESSION["current_session"]) && $_SESSION["current_session"] == "admin"){
        header('location: dashboard.php');
      }else{
        header('location: users_passwords.php');
      }
      exit();
    } 

    $password = md5($password);
    $query = mysqli_query($con, "UPDATE tbl_users SET user_pass='$password' WHERE user_id='$id'")or die(mysqli_error($con));

    $_SESSION["message_edit_pass_succ"]="le mot pass a été changer avec succes";
    $_SESSION["message_type"]="green";

    if(isset($_SESSION["current_session"]) && $_SESSION["current_session"] == "admin"){
      header('location: dashboard.php');
    }else{
      header('location: users_passwords.php');
    }

    exit();
  }

 ?>
