
<!-- ==================================      modal supprimer     ========================================-->

<div id="id03" class="modal-d ">
  <form class="modal-content-d round-large animate-zoom" action="delete_user.php" method="post">
    <div class="container-d">
      <span onclick="document.getElementById('id03').style.display='none'" class="close-d" title="Close Modal">&times;</span>
      <h1>Supprimer l'utilisateur</h1>
      <p>Voulez-vous vraiment vous supprimer cet utilisateur ?</p>

      <div class="panel yellow round-large">
        <h3>Attention !</h3>
        <p>Si vous supprimez cet administrateur, tous les départements associés à cet administrateur seront également supprimés en raison d'une contrainte de clé étrangère. Pour éviter de perdre ce département, vous pouvez créer un nouvel administrateur et réattribuer le département de cet administrateur au nouvel administrateur.</p>
      </div>

        <input type="hidden" name="delete_user_id" id="delete_user_id">
        <div class="clearfix-d">
          <button onclick="document.getElementById('id03').style.display='none'" type="button" class="mdl cancelbtn-d"><?=$translations['cancel']?></button>
          <button type="submit" name="btn_delete" class="mdl deletebtn-d">Oui</button>
        </div>
    </div>
  </form>
</div>
