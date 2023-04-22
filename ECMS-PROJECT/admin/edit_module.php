<?php
    session_start();
    require_once("../control/config/dbcon.php");
    if (isset($_GET['edit'])) {
      $_SESSION['show_modal_edit_module'] = " show";
      $id = $_GET['edit'];
      $result = mysqli_query($con, "SELECT * FROM tbl_module WHERE modl_id=$id") or die (mysqli_error($con));
      $row=mysqli_fetch_array($result);
      $num=mysqli_num_rows($result);
      if($num>0){

        $_SESSION['id_edit'] = $row['modl_id'];
        $_SESSION['name_edit'] = $row['modl_name'];
        $_SESSION['abbr_edit'] = $row['modl_abbr'];
        $_SESSION['promid_edit'] = $row['modl_promo_id'];
        $_SESSION['Semestre_edit'] = $row['modl_semestre'];
        $_SESSION['ensid_edit'] = $row['modl_ens_id'];



        if ($_SESSION["current_session"] == "admin") {
          header('location: ../admin/dashboard.php?class=show');
        }elseif ($_SESSION["current_session"] == "delegue") {
          header('location: ../admin/gst_delegue.php?class=show');
        }elseif ($_SESSION["current_session"] == "enseignant") {
          header('location: ../admin/gst_enseignant.php?class=show');
        }elseif ($_SESSION["current_session"] == "responsable") {
          header('location: ../admin/gst_responsable.php?class=show');
        }elseif ($_SESSION["current_session"] == "promotion") {
          header('location: ../admin/gst_promos.php?class_pr=show');
        }elseif ($_SESSION["current_session"] == "module") {
          header('location: ../admin/gst_modules.php');
        }
        exit();
      }
    }


    if (isset($_POST['Modifier_module'])) {
      // code...
      extract($_POST);
      $id = mysqli_real_escape_string($con,$id);
      $name = mysqli_real_escape_string($con,$name);
      $abbr = mysqli_real_escape_string($con,$abbr);
      $promid = mysqli_real_escape_string($con,$promid);
      $semestre = mysqli_real_escape_string($con,$semestre);
      $ensid = mysqli_real_escape_string($con,$ensid);

      $bool = false;

      //validation
      $query = "SELECT * FROM tbl_module WHERE modl_id!='$id'";
      $result=mysqli_query($con,$query)or die ("La connexion a échoué: 1" . mysqli_error($con));
      $num=mysqli_num_rows($result);

      while ($row = mysqli_fetch_array($result)) {
        if ($row['modl_promo_id'] == $promid & $row['modl_semestre'] == $semestre & $row['modl_ens_id'] == $ensid ) {
          $bool = true;
        }
      }

      if ($bool) {
        $_SESSION["message"]="Cet enseignant enseigne déja dans ce Semestre de cette promotion";
        $_SESSION["message_type"]="red";
        $_SESSION["show"]="show";
        $_SESSION["show_modal_edit_module"]="show";

        if ($_SESSION["current_session"] == "admin") {
          header('location: ../admin/dashboard.php?class=show');
        }elseif ($_SESSION["current_session"] == "delegue") {
          header('location: ../admin/gst_delegue.php?class=show');
        }elseif ($_SESSION["current_session"] == "enseignant") {
          header('location: ../admin/gst_enseignant.php?class=show');
        }elseif ($_SESSION["current_session"] == "responsable") {
          header('location: ../admin/gst_responsable.php?class=show');
        }elseif ($_SESSION["current_session"] == "promotion") {
          header('location: ../admin/gst_promos.php?class_pr=show');
        }elseif ($_SESSION["current_session"] == "module") {
          header('location: ../admin/gst_modules.php');
        }
        exit();
      }else {

        if ($ensid == "") {
          $result = mysqli_query($con, "UPDATE tbl_module SET modl_name='$name',modl_abbr='$abbr',modl_promo_id='$promid',modl_semestre='$semestre',modl_ens_id=NULL WHERE modl_id='$id'")or die(mysqli_error($con));
        }else {
          $result = mysqli_query($con, "UPDATE tbl_module SET modl_name='$name',modl_abbr='$abbr',modl_promo_id='$promid',modl_semestre='$semestre',modl_ens_id='$ensid' WHERE modl_id='$id'")or die(mysqli_error($con));
        }

        $_SESSION['show_modal_edit_module'] = " show";
        $result = mysqli_query($con, "SELECT * FROM tbl_module WHERE modl_id=$id") or die (mysqli_error($con));
        $row=mysqli_fetch_array($result);
        $num=mysqli_num_rows($result);

        $_SESSION['id_edit'] = $row['modl_id'];
        $_SESSION['name_edit'] = $row['modl_name'];
        $_SESSION['abbr_edit'] = $row['modl_abbr'];
        $_SESSION['promid_edit'] = $row['modl_promo_id'];
        $_SESSION['Semestre_edit'] = $row['modl_semestre'];
        $_SESSION['ensid_edit'] = $row['modl_ens_id'];

        $_SESSION["message_success_edid"]="Le module a été Modifier avec succès";
        $_SESSION["message_type"]="green";

        

        header('location:gst_modules.php');
        exit();
      }
    }

 ?>
