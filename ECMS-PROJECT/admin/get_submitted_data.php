<?php
session_start();
require_once("../control/config/dbcon.php");

if (isset($_POST['btn_to_formulaire'])) {
  extract($_POST);
  $_SESSION['cp_id']= $cpid;
  ?>
    <script type="text/javascript">
    window.location.assign("consulter_modules.php");
    </script>
  <?php

}



if (isset($_POST['consulter'])) {
  extract($_POST);
  $_SESSION['cp_id']= $cpid;
  $_SESSION['del_id']= $delid;
  ?>
    <script type="text/javascript">
    window.location.assign("consulter_del.php");
    </script>
  <?php

}

 ?>
