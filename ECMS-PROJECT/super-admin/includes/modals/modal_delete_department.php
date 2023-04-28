
<!-- modal delete department -->

<div id="id07" class="modal-d ">
  <form class="modal-content-d round-large animate-zoom" action="delete_department.php" method="post">
    <div class="container-d">
      <span onclick="document.getElementById('id07').style.display='none'" class="close-d" title="Close Modal">&times;</span>
      <h1>Supprimer la departement</h1>
      <p>Voulez-vous vraiment vous supprimer cette departement ?</p>
        <input type="hidden" name="delete_promo_id" id="delete_promo_id">
        <div class="clearfix-d">
          <button onclick="document.getElementById('id07').style.display='none'" type="button" class="mdl cancelbtn-d"><?=$translations['cancel']?></button>
          <button type="submit" name="btn_delete_promo" class="mdl deletebtn-d">Oui</button>
        </div>
    </div>
  </form>
</div>

