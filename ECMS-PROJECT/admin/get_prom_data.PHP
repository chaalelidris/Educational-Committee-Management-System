<?php
session_start();
include("../control/config/dbcon.php");
if (isset($_GET['idpromo'])) {

  extract($_GET);

  $_SESSION['consult_promotion_id'] = $_GET['idpromo'];

  ?>
    <script type="text/javascript">
    window.location.assign("consulter_cps.php");
    </script>
  <?php
}
 ?>
