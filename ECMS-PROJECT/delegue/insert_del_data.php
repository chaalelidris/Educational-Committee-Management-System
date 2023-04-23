<?php
    session_start();
    include("../control/config/dbcon.php");


    if (isset($_POST['avancement'])){
      extract($_POST);
      $avancement = mysqli_real_escape_string($con,$avancement);
      $nbr_chap = mysqli_real_escape_string($con,$nbr_chap);
      $nbr_seances = mysqli_real_escape_string($con,$nbr_seances);
      $nbr_seances_tdtp = mysqli_real_escape_string($con,$nbr_seances_tdtp);
      $nbr_ceances_ctdtp_no = mysqli_real_escape_string($con,$nbr_ceances_ctdtp_no);
      $exps_micro = mysqli_real_escape_string($con,$exps_micro);
      $valid_tp = mysqli_real_escape_string($con,$valid_tp);
      $Polycopie_cours = mysqli_real_escape_string($con,$Polycopie_cours);
      $delid = $_SESSION['delegue_user_id'];
      $mdlid = mysqli_real_escape_string($con,$mdlid);
      $cp_id = mysqli_real_escape_string($con,$cp_id);


      // insert avec id delegue
      $sql =  "INSERT INTO tbl_data (data_avncm_glob, data_nbr_chap, data_nbr_cours, data_nbr_tdtp,data_nbr_crtdtp,data_exps_micro,data_valid_tp,data_polycp_cour,data_usr_id,data_modl_id,data_cp_id) VALUES ('$avancement','$nbr_chap','$nbr_seances','$nbr_seances_tdtp','$nbr_ceances_ctdtp_no','$exps_micro','$valid_tp','$Polycopie_cours','$delid','$mdlid','$cp_id')";
      $result = mysqli_query($con,$sql) or die ("La connexion a échoué: 2" . mysqli_error($con));



      $user_id = $con->insert_id;

      $_SESSION['message_success'] = "Données soumises avec succès !";
      $_SESSION['message_type'] = "green";


      header('location: modules.php');
      exit();

    }

 ?>
