<?php
// si l'admine clicker Ajouter
session_start();
include("config/dbcon.php");


if (isset($_POST['Ajouter_utilisateur'])){
  extract($_POST);
  $name = mysqli_real_escape_string($con,$name);
  $username = mysqli_real_escape_string($con,$username);
  $email = mysqli_real_escape_string($con,$email);
  $password = mysqli_real_escape_string($con,$password);
  $password_repeat = mysqli_real_escape_string($con,$password_repeat);
  //validation

  if ($password !== $password_repeat) {
    $_SESSION["message"]="Les deux mots de passe ne correspondent pas";
    $_SESSION["message_type"]="red";
    $_SESSION["show"]="show";
    $_SESSION["show_modal"]="show";

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

  $username_query = "SELECT * FROM tbl_users WHERE user_name='$username' LIMIT 1";
  $result=mysqli_query($con,$username_query)or die ("La connexion a échoué: 1" . mysqli_error($con));
  $num=mysqli_num_rows($result);

  if ($num > 0) {
    $_SESSION["message"]="Ce nom d'utilisateur existe déjà";
    $_SESSION["message_type"]="red";
    $_SESSION["show"]="show";
    $_SESSION["show_modal"]="show";

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
  }else{
    $password_encrypted=md5($password);
    $sql =  "INSERT INTO tbl_users (user_fullname, user_name, user_email, user_pass, user_type) VALUES ('$name','$username', '$email', '$password_encrypted','$option')";
    $result = mysqli_query($con,$sql) or die ("La connexion a échoué: 2" . mysqli_error($con));

      $user_id = $con->insert_id;
      // $_SESSION['id'] = $user_id;
      // $_SESSION['name'] = $name;
      // $_SESSION['username'] = $username;
      // $_SESSION['user_type'] = $option;
      //flash Message
      $_SESSION['message_suc'] = "utilisateur ajouté avec succès!";
      $_SESSION['message_type'] = "green";
      $_SESSION["show"]="show";

      if (isset($_SESSION["show_modal"])) {
        unset($_SESSION["show_modal"]);
      }

      if ($option == 3) {
        header('location: ../admin/gst_delegue.php?class=show');
      }elseif ($option == 2) {
        header('location: ../admin/gst_enseignant.php?class=show');
      }elseif ($option == 1) {
        header('location: ../admin/gst_responsable.php?class=show');
      }
      exit();
  }

}



// Ajouter délégué

if (isset($_POST['Ajouter_utilisateur_del'])){
  extract($_POST);
  $name = mysqli_real_escape_string($con,$name);
  $username = mysqli_real_escape_string($con,$username);
  $email = mysqli_real_escape_string($con,$email);
  $promid = mysqli_real_escape_string($con,$promid);
  $password = mysqli_real_escape_string($con,$password);
  $password_repeat = mysqli_real_escape_string($con,$password_repeat);
  //validation

  if ($password !== $password_repeat) {
    $_SESSION["message"]="Les deux mots de passe ne correspondent pas";
    $_SESSION["message_type"]="red";
    $_SESSION["show"]="show";
    $_SESSION["show_modal"]="show";

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
  }else {


    $username_query = "SELECT * FROM tbl_users WHERE user_name='$username' LIMIT 1";
    $result=mysqli_query($con,$username_query)or die ("La connexion a échoué: 1" . mysqli_error($con));
    $num=mysqli_num_rows($result);



    if ($num > 0) {
      $_SESSION["message"]="Cet utilisateur existe déjà";
      $_SESSION["message_type"]="red";
      $_SESSION["show"]="show";
      $_SESSION["show_modal"]="show";

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
    }else{
      $password_encrypted=md5($password);
      $sql =  "INSERT INTO tbl_users (user_fullname, user_name, user_email, user_pass, user_type) VALUES ('$name','$username', '$email', '$password_encrypted','3')";
      $result = mysqli_query($con,$sql) or die ("La connexion a échoué: 2" . mysqli_error($con));

      $user_id = $con->insert_id;
      $sql =  "INSERT INTO tbl_delegation (delegation_del_id, delegation_prom_id) VALUES ('$user_id','$promid')";
      $result = mysqli_query($con,$sql) or die ("La connexion a échoué: 2" . mysqli_error($con));


      // $_SESSION['id'] = $user_id;
      // $_SESSION['name'] = $name;
      // $_SESSION['username'] = $username;
      // $_SESSION['user_type'] = $option;
      //flash Message
      $_SESSION['message_suc'] = "Délégué ajouté avec succès!";
      $_SESSION['message_type'] = "green";
      $_SESSION["show"]="show";

      if (isset($_SESSION["show_modal_add_del"])) {
        unset($_SESSION["show_modal_add_del"]);
      }

      header('location: ../admin/gst_delegue.php?class=show');

      exit();
    }

  }


}



 ?>
