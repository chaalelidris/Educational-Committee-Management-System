<script type="text/javascript">
  // Get the modal desconnect
  var modal = document.getElementById('id01');

  // Get the modal changer mot de passe
  var modalChangePass = document.getElementById('idChPass');

  // Get the modal cp desactiver
  var modalCpInfo = document.getElementById('idinfo');

  // show disconnect modal
  $('#disscon').on('click', function() {
    modal.style.display = "block";
  });

  $('#ChangePass').on('click', function() {
    modalChangePass.style.display = "block";
  });

  $('.btn_cp_info').on('click', function() {
    modalCpInfo.style.display = "block";
  });



  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }if (event.target == modalChangePass) {
      modalChangePass.style.display = "none";
    }
  }
</script>
