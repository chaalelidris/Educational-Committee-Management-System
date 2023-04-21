<script type="text/javascript">
  // Get the modal desconnect
  var modal = document.getElementById('id01');

  // Get the modal changer mot de passe
  var modalChangePass = document.getElementById('idChPass');

  // Get the modal cp desactiver
  var modalCpInfo = document.getElementById('idinfo');

  // show disconnect modal
  document.querySelector('#disscon').addEventListener('click', function() {
    modal.style.display = "block";
  });

  document.querySelector('#ChangePass').addEventListener('click', function() {
    modalChangePass.style.display = "block";
  });

  document.querySelector('#btn_cp_info').addEventListener('click', function() {
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
