<!-- ===================================      modal Ajouter utilisateur       =================================-->
  <div id="idChPass" class="modal-d">
    <form class="modal-content-d round-large animate-zoom" action="edit_pass.php" method="post">
      <div class="container-d">
        <span onclick="document.getElementById('idChPass').style.display='none'" class="close-d" title="Close Modal">&times;</span>
        <h1 style="color:#191923;">Changer mot de passe</h1>
        <p>Veuillez entrer le neveaux mot de passe.</p>

        <hr>
        <input value="<?php echo $_SESSION['enseignant_user_id']; ?>" type="hidden" name="change_password">

        <label for="password_act"><b>Mot de passe actuel</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password_act" title="veuillez remplir ce champ" required>

        <label for="password"><b>Nouveau mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" title="veuillez remplir ce champ" required>

        <label for="password-repeat"><b>Répéter le mot de passe</b></label>
        <input type="password" placeholder="Répéter le mot de passe" name="password_repeat" title="veuillez remplir ce champ" required>

        <div class="clearfix-form">
          <button onclick="document.getElementById('idChPass').style.display='none'" type="button"  class="mdl cancelbtn-form">Annuler</button>
          <button type="submit" name="edit_pass" class="mdl signupbtn-form">Changer</button>
        </div>
      </div>
    </form>
  </div>





  <!-- =====================================  Modal Ajouter utilisateur scripts  ==================== -->
