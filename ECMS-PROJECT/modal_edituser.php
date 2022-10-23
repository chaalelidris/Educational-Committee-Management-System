<!-- ===================================      modal modifier utilisateur       =================================-->
<?php if (isset($_SESSION['show_modal_edit'])): ?>
  <div id="id04" class="modal-form show">
  <?php else: ?>
    <div id="id04" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content" action="edit_user.php" method="post">
      <div class="container-form">
        <span id="bttn2" class="close-d" title="Fermer le Modal">&times;</span>
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

        <label for="option"><b>sélectionner le type d'utilisateur</b></label>
        <select  class="select border" name="option" title="veuillez sélectionner" style="background-color:#f1f1f1; padding:15px 10px;" required>
          <option value="<?php echo $_SESSION['option_edit']; ?>" selected>utilisateur actuel par défaut ( <?php echo $_SESSION['option_edit']; ?> )</option>
          <option value="1">1- Résponsable de parcours</option>
          <option value="2">2- Enseignant</option>
          <option value="3">3- Délégué</option>
        </select> <br> <br>


        <div class="clearfix-form">
          <button id="bttn3" type="button"  class="mdl cancelbtn-form">Annuler</button>
          <button type="submit" name="modifier_utilisateur" class="mdl signupbtn-form">modifier</button>
        </div>
      </div>
    </form>
  </div>
