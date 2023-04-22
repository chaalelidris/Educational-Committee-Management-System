<?php
session_start();
require_once("../control/config/dbcon.php");

if (isset($_GET['edit'])) {
  $_SESSION['show_modal_edit'] = "show";
  $id = $_GET['edit'];
  $result = mysqli_query($con, "SELECT * FROM tbl_users WHERE user_id=$id") or die (mysqli_error($con));
  $row=mysqli_fetch_array($result);
  $num=mysqli_num_rows($result);
  if($num==1){
    $_SESSION['id_edit'] = $row['user_id'];
    $_SESSION['name_edit'] = $row['user_fullname'];
    $_SESSION['username_edit'] = $row['user_name'];
    $_SESSION['email_edit'] = $row['user_email'];
    $_SESSION['option_edit'] = $row['user_type'];

    
    header('location: manage_admins.php?');
    
    exit();
  }
}


if (isset($_POST['modifier_utilisateur'])) {
  // code...
  extract($_POST);
  $id = mysqli_real_escape_string($con,$id);
  $name = mysqli_real_escape_string($con,$name);
  $username = mysqli_real_escape_string($con,$username);
  $email = mysqli_real_escape_string($con,$email);

  $username_query = "SELECT * FROM tbl_users WHERE user_name='$username' and user_id!='$id' LIMIT 1";
  $result=mysqli_query($con,$username_query)or die ("La connexion a échoué: 1" . mysqli_error($con));
  $num_usrs=mysqli_num_rows($result);

  if ($num_usrs > 0) {
    $_SESSION["message"]="Ce nom d'utilisateur existe déjà";
    $_SESSION["message_type"]="red";
    $_SESSION["show"]="show";
    $_SESSION["show_modal"]="show";

    
    header('location: dashboard.php?');
    
    exit();

  }else {
    $result = mysqli_query($con, "UPDATE tbl_users SET user_fullname='$name',user_name='$username', user_email='$email',user_type='$option' WHERE user_id='$id'")or die(mysqli_error($con));

    $_SESSION["message_success"]="L'utilisateur a été Modifier avec succès";
    $_SESSION["message_type"]="green";

    if (isset($_SESSION['show_modal_edit'])) {
      unset($_SESSION["show_modal_edit"]);
    }

    
    header('location:manage_admins.php?');
    exit();
  }


}

 ?>
