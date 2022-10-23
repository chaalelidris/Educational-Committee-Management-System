<?php
session_start();
if (isset($_SESSION['show_modal'])) {
  unset($_SESSION['show_modal']);
}elseif (isset($_SESSION['show_modal_edit'])) {
  // code...
  unset($_SESSION['show_modal_edit']);
}elseif (isset($_SESSION['show_modal_promo'])) {
  // code...
  unset($_SESSION['show_modal_promo']);
}elseif (isset($_SESSION['show_modal_edit_promo'])) {
  // code...
  unset($_SESSION['show_modal_edit_promo']);
}elseif (isset($_SESSION['show_modal_module'])) {
  // code...
  unset($_SESSION['show_modal_module']);
}elseif (isset($_SESSION['show_modal_edit_module'])) {
  // code...
  unset($_SESSION['show_modal_edit_module']);
}elseif (isset($_SESSION['show_modal_add_del'])) {
  // code...
  unset($_SESSION['show_modal_add_del']);
}elseif (isset($_SESSION['show_modal_edit_delegue'])) {
  // code...
  unset($_SESSION['show_modal_edit_delegue']);
}


 ?>
