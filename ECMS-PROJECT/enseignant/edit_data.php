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
      $ensid = $_SESSION['enseignant_user_id'];
      $mdlid = mysqli_real_escape_string($con,$mdlid);
      $cpid = mysqli_real_escape_string($con,$cpid);
      $dataid1 = mysqli_real_escape_string($con,$dataid);

      // edit whith responsable id
      $query=mysqli_query($con, "SELECT cp_prom_id,prom_resp_id from tbl_cp INNER JOIN tbl_promo ON tbl_cp.cp_prom_id=tbl_promo.prom_id AND cp_id=$cpid");
      $row=mysqli_fetch_assoc($query); //tableau
      $respid = $row['prom_resp_id'];

      $query=mysqli_query($con, "SELECT data_id from tbl_data WHERE  data_usr_id='$respid' AND data_modl_id='$mdlid' AND data_cp_id='$cpid'");
      $rowData = mysqli_fetch_assoc($query);
      $dataid2 = $rowData['data_id'];

      // edit avec id enseignant
      $sql =  "UPDATE tbl_data SET data_avncm_glob = '$avancement', data_nbr_chap = '$nbr_chap', data_nbr_cours = '$nbr_seances', data_nbr_tdtp = '$nbr_seances_tdtp' ,data_nbr_crtdtp = '$nbr_ceances_ctdtp_no' ,data_exps_micro = '$exps_micro',data_valid_tp = '$valid_tp',data_polycp_cour = '$Polycopie_cours' WHERE data_id='$dataid1'";
      $result = mysqli_query($con,$sql) or die ("La connexion a échoué: 2" . mysqli_error($con));


      // edit avec id responsable
      $sql =  "UPDATE tbl_data SET data_avncm_glob = '$avancement', data_nbr_chap = '$nbr_chap', data_nbr_cours = '$nbr_seances', data_nbr_tdtp = '$nbr_seances_tdtp' ,data_nbr_crtdtp = '$nbr_ceances_ctdtp_no' ,data_exps_micro = '$exps_micro',data_valid_tp = '$valid_tp',data_polycp_cour = '$Polycopie_cours' WHERE data_id='$dataid2'";
      $result = mysqli_query($con,$sql) or die ("La connexion a échoué: 2" . mysqli_error($con));



      $querydata=mysqli_query($con, "SELECT * from tbl_data WHERE data_id='$dataid1'") or die (mysqli_error($con));
      $dataResult = mysqli_fetch_array($querydata);
      $count = mysqli_num_rows($querydata);


      $_SESSION['data_id'] = $dataid1;
      $_SESSION['cp_id']= $dataResult['data_cp_id'];
      $_SESSION['mdl_id']= $dataResult['data_modl_id'];
      $_SESSION['user_id']= $dataResult['data_usr_id'];
      $_SESSION['sess_data1']= $dataResult['data_polycp_cour'];
      $_SESSION['sess_data2']= $dataResult['data_valid_tp'];
      $_SESSION['sess_data3']= $dataResult['data_exps_micro'];
      $_SESSION['sess_data4']= $dataResult['data_nbr_crtdtp'];
      $_SESSION['sess_data5']= $dataResult['data_nbr_tdtp'];
      $_SESSION['sess_data6']= $dataResult['data_nbr_cours'];
      $_SESSION['sess_data7']= $dataResult['data_nbr_chap'];
      $_SESSION['sess_data8']= $dataResult['data_avncm_glob'];


      $user_id = $con->insert_id;

      $_SESSION['message_success'] = "Données modifié avec succès !";
      $_SESSION['message_type'] = "green";


      header('location: modifier_avancement.php');
      exit();

    }

 ?>
