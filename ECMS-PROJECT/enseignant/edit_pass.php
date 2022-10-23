<?php
session_start();
require_once("../control/config/dbcon.php");

  if (isset($_POST['edit_pass'])) {
    extract($_POST);
    $id = $change_password;
    // echo $change_password;

    $password_act = mysqli_real_escape_string($con, $password_act);
    $password_act = md5($password_act);

    $query = mysqli_query($con, "SELECT user_pass FROM tbl_users WHERE user_pass='$password_act' AND user_id='$id'");
    $count = mysqli_num_rows($query);

    if ($count > 0) {
      $password = mysqli_real_escape_string($con, $password);
      $password_repeat = mysqli_real_escape_string($con, $password_repeat);

      if ($password != $password_repeat) {
        $_SESSION["message_edit_pass_err"]="Les mots de passe ne correspondent pas";
        $_SESSION["message_type"]="red";

        header('location: enseignant.php');
      } else {
        $password = md5($password);
        $query = mysqli_query($con, "UPDATE tbl_users SET user_pass='$password' WHERE user_id='$id'")or die(mysqli_error($con));

        $_SESSION["message_edit_pass_succ"]="le mot pass a été changer avec succes";
        $_SESSION["message_type"]="green";

        header('location: enseignant.php');
        exit();
      }
    }else {
      $_SESSION["message_edit_pass_err"]="Mot pass actuel incorrect !";
      $_SESSION["message_type"]="red";

      header('location: enseignant.php');
    }


  }

 ?>
