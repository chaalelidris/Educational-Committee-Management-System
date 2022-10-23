<?php
// si l'admine clicker Ajouter
session_start();
include("../control/config/dbcon.php");


if (isset($_POST['Ajouter_promotion'])){
  extract($_POST);
  $name = mysqli_real_escape_string($con,$name);
  $respid = mysqli_real_escape_string($con,$respid);


  //validation
  $query = "SELECT * FROM tbl_promo WHERE prom_name='$name' LIMIT 1";
  $result=mysqli_query($con,$query)or die ("La connexion a échoué: 1" . mysqli_error($con));
  $num=mysqli_num_rows($result);

  if ($num > 0) {
    $_SESSION["message"]="Cette promotion existe déjà";
    $_SESSION["message_type"]="red";
    $_SESSION["show"]="show";
    $_SESSION["show_modal_promo"]="show";

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
    $query = "SELECT * FROM tbl_promo WHERE prom_resp_id='$respid' LIMIT 1";
    $result=mysqli_query($con,$query)or die ("La connexion a échoué: 1" . mysqli_error($con));
    $num=mysqli_num_rows($result);

    if ($num > 0) {
      $_SESSION["message"]="Ce responsable gère une autre promotion";
      $_SESSION["message_type"]="red";
      $_SESSION["show_modal_promo"]="show";

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
    } else {
      $sql =  "INSERT INTO tbl_promo (prom_name, prom_resp_id) VALUES ('$name','$respid')";
      $result = mysqli_query($con,$sql) or die ("La connexion a échoué: 2" . mysqli_error($con));

        $user_id = $con->insert_id;

        $_SESSION['message_suc'] = "promotion ajouté avec succès!";
        $_SESSION['message_type'] = "green";
        $_SESSION["show"]="show";

        if (isset($_SESSION["show_modal_promo"])) {
          unset($_SESSION["show_modal_promo"]);
        }


          header('location: ../admin/gst_promos.php?class_pr=show');
        exit();
    }




  }

}

 ?>
