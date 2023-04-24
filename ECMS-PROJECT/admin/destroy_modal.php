<?php
session_start();
if (isset($_SESSION['show_modal'])) {
  unset($_SESSION['show_modal']);
}elseif (isset($_SESSION['show_modal_edit'])) {
  unset($_SESSION['show_modal_edit']);
}elseif (isset($_SESSION['show_modal_promo'])) {
  unset($_SESSION['show_modal_promo']);
}elseif (isset($_SESSION['show_modal_edit_promo'])) {
  unset($_SESSION['show_modal_edit_promo']);
}elseif (isset($_SESSION['show_modal_module'])) {
  unset($_SESSION['show_modal_module']);
}elseif (isset($_SESSION['show_modal_edit_module'])) {
  unset($_SESSION['show_modal_edit_module']);
}elseif (isset($_SESSION['show_modal_add_del'])) {
  unset($_SESSION['show_modal_add_del']);
}elseif (isset($_SESSION['show_modal_edit_delegue'])) {
  unset($_SESSION['show_modal_edit_delegue']);
}


 ?>
