<!-- ===================================      modal modifier utilisateur       =================================-->
<?php if (isset($_SESSION['show_modal_edit_delegue'])): ?>
  <div id="id12" class="modal-form show">
  <?php else: ?>
    <div id="id12" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content" action="edit_delegue.php" method="post">
      <div class="container-form">
        <span class="close-d close_modal_edit_delegue" title="Fermer le Modal">&times;</span>
        <h1 style="color:#5dd08a;">modifier cet utilisateur</h1>
        <p>Veuillez modifier ce formulaire.</p>

        <input type="hidden" name="id" value="<?php echo $_SESSION['id_edit']; ?>">

        <hr>
        <label for="name"><b>nom complet</b> <span style="opacity:0.8;"> (nom.prénom)</span></label>
        <input type="text" value="<?php echo $_SESSION['name_edit']; ?>" placeholder="Entrer le nom et prénom" id="name" name="name" title="veuillez remplir ce champ" required>

        <label for="username"><b>Nom d'utilisateur</b></label>
        <input type="text" value="<?php echo $_SESSION['username_edit']; ?>" placeholder="Entrer le nom d'utilisateur" name="username" id="username" title="veuillez remplir ce champ" required>

        <label for="email"><b>Email</b></label>
        <input type="email" value="<?php echo $_SESSION['email_edit']; ?>" placeholder="Entrer l'email" name="email" id="email" title="veuillez remplir ce champ" >

        <label for="promid"><b>promotion</b></label> <br>
        <select class="select border " name="promid" style="width:100%;" required>
          <?php
            $id_prm = $_SESSION['promo_edit'];
            $sql = "SELECT * FROM tbl_promo WHERE prom_id='$id_prm'";
            $result = mysqli_query($con, $sql);
            $row1 = mysqli_fetch_array($result);
            echo '<option value="'.$id_prm.'" selected>'.$row1['prom_name'].'</option>';


            $sql = "SELECT * FROM tbl_promo";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
              echo'<option value="'.$row['prom_id'].'">'.$row['prom_name'].'</option>';
            }
          ?>
        </select> <br><br>

        <div class="clearfix-form">
          <button type="button"  class="mdl cancelbtn-form close_modal_edit_delegue">Cancel</button>
          <button type="submit" name="modifier_delegue" class="mdl signupbtn-form">modifier</button>
        </div>
      </div>
    </form>
  </div>
