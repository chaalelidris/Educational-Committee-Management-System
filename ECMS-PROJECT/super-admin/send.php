<?php
session_start();
require_once("../control/config/dbcon.php");

if (isset($_POST['send_message'])) {
  extract($_POST);
  date_default_timezone_set ( "Africa/Algiers" );
  // $date = date("d-m-y h-ia");
  // echo date("Y-m-d h-ia");

  $subject = mysqli_real_escape_string($con,$subject);
  $message = mysqli_real_escape_string($con,$message);

  $sql =  "INSERT INTO tbl_messagerie (msg_from_id, msg_to_id,msg_subject,msg_content,msg_status) VALUES ('$meid','$toid','$subject','$message',1)";
  $result = mysqli_query($con,$sql) or die ("La connexion a échoué: 2" . mysqli_error($con));

  ?>
    <script type="text/javascript">
    window.location.assign("send_message.php");
    </script>
  <?php
}
 ?>
