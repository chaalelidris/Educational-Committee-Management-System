
<!--                               modal supprimer promotion                              -->



<div id="id10" class="modal-d ">
  <form class="modal-content-d round-large animate-zoom" action="delete_module.php" method="post">
    <div class="container-d">
      <span onclick="document.getElementById('id10').style.display='none'" class="close-d" title="Close Modal">&times;</span>
      <h1>Supprimer le module</h1>
      <p>Voulez-vous vraiment vous supprimer ce module ?</p>
        <input type="hidden" name="delete_module_id" id="delete_module_id">
        <div class="clearfix-d">
          <button onclick="document.getElementById('id10').style.display='none'" type="button" class="mdl cancelbtn-d">Annuler</button>
          <button type="submit" name="btn_delete_module" class="mdl deletebtn-d">Oui</button>
        </div>
    </div>
  </form>
</div>


<!-- ############################################################################################################################# -->
