<?php
// si l'admine clicker Ajouter
session_start();
include("../control/config/dbcon.php");


if (isset($_POST['Ajouter_module'])){
  extract($_POST);
  $name = mysqli_real_escape_string($con,$name);
  $abbr = mysqli_real_escape_string($con,$abbr);
  $promid = mysqli_real_escape_string($con,$promid);
  $semestre = mysqli_real_escape_string($con,$semestre);
  $ensid = mysqli_real_escape_string($con,$ensid);


  //validation
  $query = "SELECT * FROM tbl_module WHERE modl_name='$name' AND modl_promo_id='$promid'";
  $result=mysqli_query($con,$query)or die ("La connexion a échoué: 1" . mysqli_error($con));
  $num=mysqli_num_rows($result);

  if ($num > 0) {
    $_SESSION["message"]="Ce module existe déjà dans cette promotion";
    $_SESSION["message_type"]="red";
    $_SESSION["show"]="show";
    $_SESSION["show_modal_module"]="show";

    if ($_SESSION["current_session"] == "admin") {
      header('location: ../admin/admin.php?class=show');
    }elseif ($_SESSION["current_session"] == "delegue") {
      header('location: ../admin/gst_delegue.php?class=show');
    }elseif ($_SESSION["current_session"] == "enseignant") {
      header('location: ../admin/gst_enseignant.php?class=show');
    }elseif ($_SESSION["current_session"] == "responsable") {
      header('location: ../admin/gst_responsable.php?class=show');
    }elseif ($_SESSION["current_session"] == "promotion") {
      header('location: ../admin/gst_promos.php?class_pr=show');
    }elseif ($_SESSION["current_session"] == "module") {
      header('location: ../admin/gst_modules.php?class_md=show');
    }
    exit();
  }else{
    //validation
    $query = "SELECT * FROM tbl_module WHERE modl_promo_id='$promid' AND modl_semestre='$semestre' AND modl_ens_id='$ensid'";
    $result=mysqli_query($con,$query)or die ("La connexion a échoué: 1" . mysqli_error($con));
    $num=mysqli_num_rows($result);
    if ($num > 0) {
      $_SESSION["message"]="Cet enseignant enseigne déja dans ce Semestre de cette promotion";
      $_SESSION["message_type"]="red";
      $_SESSION["show"]="show";
      $_SESSION["show_modal_module"]="show";

      if ($_SESSION["current_session"] == "admin") {
        header('location: ../admin/admin.php?class=show');
      }elseif ($_SESSION["current_session"] == "delegue") {
        header('location: ../admin/gst_delegue.php?class=show');
      }elseif ($_SESSION["current_session"] == "enseignant") {
        header('location: ../admin/gst_enseignant.php?class=show');
      }elseif ($_SESSION["current_session"] == "responsable") {
        header('location: ../admin/gst_responsable.php?class=show');
      }elseif ($_SESSION["current_session"] == "promotion") {
        header('location: ../admin/gst_promos.php?class_pr=show');
      }elseif ($_SESSION["current_session"] == "module") {
        header('location: ../admin/gst_modules.php?class_md=show');
      }
      exit();

    }else {
      $sql =  "INSERT INTO tbl_module (modl_name,modl_abbr, modl_promo_id, modl_semestre, modl_ens_id) VALUES ('$name','$abbr','$promid','$semestre','$ensid')";
      $result = mysqli_query($con,$sql) or die ("La connexion a échoué: 2" . mysqli_error($con));

      $user_id = $con->insert_id;

      $_SESSION['message_suc'] = "Module ajouté avec succès !";
      $_SESSION['message_type'] = "green";
      $_SESSION["show"]="show";

      if (isset($_SESSION["show_modal_module"])) {
        unset($_SESSION["show_modal_module"]);
      }


      header('location: ../admin/gst_modules.php?class_md=show');
      exit();
    }

  }

}

 ?>
