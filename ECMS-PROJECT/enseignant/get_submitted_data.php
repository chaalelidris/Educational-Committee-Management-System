<?php
session_start();
require_once("../control/config/dbcon.php");

if (isset($_POST['btn_to_formulaire'])) {
  extract($_POST);
  $_SESSION['cp_id']= $cpid;
  $_SESSION['mdl_id']= $mdlid;
  $_SESSION['mdl_mdlname']= $mdlname;


  ?>
    <script type="text/javascript">
    window.location.assign("remplir_avancement.php");
    </script>
  <?php

}

if (isset($_POST['btn_to_modifier_formulaire'])) {
  extract($_POST);

  $querydata=mysqli_query($con, "SELECT * from tbl_data WHERE data_id='$dataid'") or die (mysqli_error($con));
  $dataResult = mysqli_fetch_array($querydata);
  $count = mysqli_num_rows($querydata);


  $_SESSION['data_id']= $dataid;
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

  $_SESSION['mdl_mdlname']= $mdlname;

  ?>
    <script type="text/javascript">
    window.location.assign("modifier_avancement.php");
    </script>
  <?php

}





if (isset($_POST['btn_to_mydata_formulaire'])) {
  extract($_POST);

  $querydata=mysqli_query($con, "SELECT * from tbl_data WHERE data_id='$dataid'") or die (mysqli_error($con));
  $dataResult = mysqli_fetch_array($querydata);
  $count = mysqli_num_rows($querydata);


  $_SESSION['prom_name']= $promname;

  $_SESSION['data_id']= $dataid;
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

  $_SESSION['mdl_mdlname']= $mdlname;

  ?>
    <script type="text/javascript">
    window.location.assign("module_data.php");
    </script>
  <?php

}

 ?>
