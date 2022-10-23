<?php
session_start();
require_once("../control/config/dbcon.php");

if (isset($_POST['iduser'])) {
  extract($_POST);
  // echo $_POST['iduser'];
  // echo date('M d Y');
  $_SESSION['messagerie_user_id'] = $_POST['iduser'];

  ?>
    <script type="text/javascript">
    window.location.assign("send_message.php");
    </script>
  <?php
}
 ?>
