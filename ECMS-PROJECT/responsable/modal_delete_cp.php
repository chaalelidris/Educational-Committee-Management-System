
<!--                               modal supprimer promotion                              -->



<div id="iddcp" class="modal-d ">
  <form class="modal-content-d round-large animate-zoom" action="delete_cp.php" method="post">
    <div class="container-d">
      <span onclick="document.getElementById('iddcp').style.display='none'" class="close-d" title="Close Modal">&times;</span>
      <h1><?=$translations['delete']?></h1>
      <p><?=$translations['cp_delete']?></p>
        <input type="hidden" name="delete_cp_id" id="delete_cp_id">
        <div class="clearfix-d">
          <button onclick="document.getElementById('iddcp').style.display='none'" type="button" class="mdl cancelbtn-d"><?=$translations['cancel']?></button>
          <button type="submit" name="btn_delete_cp" class="mdl deletebtn-d">Oui</button>
        </div>
    </div>
  </form>
</div>


<!-- ############################################################################################################################# -->
