<script>
$(document).ready(function(){


  $("#<?php echo $idfiltert; ?>").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#<?php echo $idtbl; ?> tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });


});

</script>
