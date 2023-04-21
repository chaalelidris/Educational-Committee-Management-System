<script type="text/javascript">
  // Get the modal desconnect
  var modal = document.getElementById('id01');

  // Get the modal desconnect
  var modalChangePass = document.getElementById('idChPass');

  // show disconnect modal
  document.querySelector('#disscon').addEventListener('click', function() {
    modal.style.display = "block";
  });
  document.querySelector('#ChangePass').addEventListener('click', function() {
    modalChangePass.style.display = "block";
  });


  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }else if (event.target == modalChangePass) {
      modalChangePass.style.display = "none";
    }
  }
</script>
