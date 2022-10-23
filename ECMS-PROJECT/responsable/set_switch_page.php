<?php
session_start();

if (isset($_POST['setfacp'])) {
  $_SESSION['switch_facp'] = 'ok';
  unset($_SESSION['switch_pcp']);
}

if (isset($_POST['setpcpprg'])) {
  $_SESSION['switch_pcp'] = 'ok';
  unset($_SESSION['switch_facp']);
}

if (isset($_POST['setpcpmdf'])) {
  $_SESSION['switch_pcp'] = 'ok';
  unset($_SESSION['switch_fmdcp']);
}


 ?>
