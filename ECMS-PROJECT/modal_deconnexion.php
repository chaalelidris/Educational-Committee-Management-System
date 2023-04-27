


<!-- ==================================      modal disconnect      ========================================-->

<div id="id01" class="modal-d ">
  <form class="modal-content-d round-large animate-zoom" action="../control/logout.php">
    <div class="container-d">
      <span onclick="document.getElementById('id01').style.display='none'" class="close-d" title="Close Modal">&times;</span>
      <h1><?=$translations['logout']?></h1>
      <p><?=$translations['logout_message']?></p>

      <div class="clearfix-d">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="mdl cancelbtn-d"><?=$translations['cancel']?></button>
        <button type="submit" class="mdl deletebtn-d"><?=$translations['yes']?></button>
      </div>
    </div>
  </form>
</div>
