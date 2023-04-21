<!-- =====================================  Modal  scripts  ==================== -->
<!-- =====================================  Modal  scripts  ==================== -->
<script type="text/javascript">
  // Get the modal desconnect
  var modal = document.getElementById('id01');

  // Get the modal Ajouter_utilisateur
  var modal1 = document.getElementById('id02');

  // modal supprimer utilisateur
  var modal3 = document.getElementById('id03');

  // Get the modal modifier utilisateur
  var modal4 = document.getElementById('id04');

  // Get the modal modifier promotion
  var modal5 = document.getElementById('id05');

  // Get the modal Ajouter promotion
  var modal6 = document.getElementById('id06');   //modal Ajouter promo

  // Get the modal supprimer promotion
  var modal7 = document.getElementById('id07');

  // Get the modal Ajouter module
  var modal8 = document.getElementById('id08');   //modal Ajouter module

  // Get the modal modifier  module
  var modal9 = document.getElementById('id09');   //modal Modifier module

  // Get the modal modifier  module
  var modal10 = document.getElementById('id10');   //modal supprimer module

  // Get the modal modifier  module
  var modal11 = document.getElementById('id11');   //modal Ajouter délégué

  // Get the modal modifier  delegue
  var modal12 = document.getElementById('id12');   //modal Ajouter délégué

  // Get the modal modifier  delegue
  var modal13 = document.getElementById('id13');   //modal Ajouter délégué


  // if (modal1.className.indexOf(" show") == -1 & modal1.className.indexOf(" hide") == -1) {
  //   modal1.className += " hide";
  // }

  // show Ajouter utilisateur modal
  document.querySelector('#adduser').addEventListener('click', function() {
    modal1.className = modal1.className.replace(" hide", " show");
  });

  // show Ajouter promotion modal
  document.querySelector('#addpromo').addEventListener('click', function() {
    modal6.className = modal6.className.replace(" hide", " show");
  });

  // show disconnect modal
  document.querySelector('#disscon').addEventListener('click', function() {
    modal.style.display = "block";
  });

  // show add module modal
  document.querySelector('#addmodule').addEventListener('click', function() {
    modal8.className = modal8.className.replace(" hide", " show");
  });



  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }else if (event.target == modal1) {
        modal1.className = modal1.className.replace(" show", " hide");
    }else if (event.target == modal3) {
          modal3.style.display = "none";
    } else if (event.target == modal7) {
      modal7.style.display = "none";
    } else if (event.target == modal4) {
          modal4.className = modal4.className.replace(" show", " hide");

          $.post("destroy_modal.php",
          {

          },
          function(data,status){
            // alert("Data: " + data + "\nStatus: " + status);
          });
    }else if (event.target == modal6) {
          modal6.className = modal6.className.replace(" show", " hide");

          $.post("destroy_modal.php",
          {

          },
          function(data,status){
            // alert("Data: " + data + "\nStatus: " + status);
          });
    }else if (event.target == modal5) {
      modal5.className = modal5.className.replace(" show", " hide");

      $.post("destroy_modal.php",
      {

      },
      function(data,status){
        // alert("Data: " + data + "\nStatus: " + status);
      });
    }else if (event.target == modal8) {
      modal8.className = modal8.className.replace(" show", " hide");

      $.post("destroy_modal.php",
      {

      },
      function(data,status){
        // alert("Data: " + data + "\nStatus: " + status);
      });
    }else if (event.target == modal9) {
      modal9.className = modal9.className.replace(" show", " hide");

      $.post("destroy_modal.php",
      {

      },
      function(data,status){
        // alert("Data: " + data + "\nStatus: " + status);
      });
    }else if (event.target == modal10) {
      modal10.style.display = "none";
    }else if (event.target == modal11) {
      modal11.className = modal11.className.replace(" show", " hide");

      $.post("destroy_modal.php",
      {

      },
      function(data,status){
        // alert("Data: " + data + "\nStatus: " + status);
      });
    }else if (event.target == modal12) {
      modal12.className = modal12.className.replace(" show", " hide");

      $.post("destroy_modal.php",
      {

      },
      function(data,status){
        // alert("Data: " + data + "\nStatus: " + status);
      });
    }else if (event.target == modal13) {
      modal13.style.display = "none";
    }
  }
</script>





<!-- jquery -->
<script>
$(document).ready(function(){

  $("#bttn").click(function(){
    document.getElementById('id02').className = document.getElementById('id02').className.replace(" show", " hide");
    $.post("destroy_modal.php",
    {

    },
    function(data,status){
      // alert("Data: " + data + "\nStatus: " + status);
    });

  });



  $("#bttn1").click(function(){
    document.getElementById('id02').className = document.getElementById('id02').className.replace(" show", " hide");

    $.post("destroy_modal.php",
    {

    },
    function(data,status){
      // alert("Data: " + data + "\nStatus: " + status);
    });
  });

  // id04 modifier utilisateur
  $("#bttn2").click(function(){
    document.getElementById('id04').className = document.getElementById('id04').className.replace(" show", " hide");
    $.post("destroy_modal.php",
    {

    },
    function(data,status){
      // alert("Data: " + data + "\nStatus: " + status);
    });

  });



  $("#bttn3").click(function(){
    document.getElementById('id04').className = document.getElementById('id04').className.replace(" show", " hide");

    $.post("destroy_modal.php",
    {

    },
    function(data,status){
      // alert("Data: " + data + "\nStatus: " + status);
    });
  });


  // modal Ajouter promotion
  $("#bttn4").click(function(){
    document.getElementById('id06').className = document.getElementById('id06').className.replace(" show", " hide");
    $.post("destroy_modal.php",
    {

    },
    function(data,status){
    });

  });


  $("#bttn5").click(function(){
    document.getElementById('id06').className = document.getElementById('id06').className.replace(" show", " hide");

    $.post("destroy_modal.php",
    {

    },
    function(data,status){
      // alert("Data: " + data + "\nStatus: " + status);
    });
  });


  $(".btn_cancel_modif_promo").click(function(){
    document.getElementById('id05').className = document.getElementById('id05').className.replace(" show", " hide");
    $.post("destroy_modal.php",
    {

    },
    function(data,status){
      // alert("Data: " + data + "\nStatus: " + status);
    });
  });

  $(".btn_cancel_add_module").click(function(){
    document.getElementById('id08').className = document.getElementById('id08').className.replace(" show", " hide");
    $.post("destroy_modal.php",
    {

    },
    function(data,status){
      // alert("Data: " + data + "\nStatus: " + status);
    });
  });

  $(".btn_cancel_modif_module").click(function(){
    document.getElementById('id09').className = document.getElementById('id09').className.replace(" show", " hide");
    $.post("destroy_modal.php",
    {

    },
    function(data,status){
      // alert("Data: " + data + "\nStatus: " + status);
    });
  });

  $(".close_modal_edit_delegue").click(function(){
    document.getElementById('id12').className = document.getElementById('id12').className.replace(" show", " hide");
    $.post("destroy_modal.php",
    {

    },
    function(data,status){
      // alert("Data: " + data + "\nStatus: " + status);
    });
  });

  $(".btn_cancel_add_delegue").click(function(){
    document.getElementById('id11').className = document.getElementById('id11').className.replace(" show", " hide");
    $.post("destroy_modal.php",
    {

    },
    function(data,status){
      // alert("Data: " + data + "\nStatus: " + status);
    });
  });


  // supprimer utilisateur
  $(".suppr").click(function(){
    document.getElementById('id03').style.display = "block";
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);

    $('#delete_user_id').val(data[0]);

  });

  // supprimer utilisateur
  $(".changepass").click(function(){
    document.getElementById('id13').style.display = "block";
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);

    $('#change_password').val(data[0]);

  });

  // clicker sur supprimer promotion

  $(".suppr_pr").click(function(){
    document.getElementById('id07').style.display = "block";
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);

    $('#delete_promo_id').val(data[0]);
    // alert('hellllo');

  });

  $(".suppr_md").click(function(){
    document.getElementById('id10').style.display = "block";
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    console.log(data);

    $('#delete_module_id').val(data[0]);
    // alert('hellllo');

  });


  $(".list_resp").select2();





});
</script>
