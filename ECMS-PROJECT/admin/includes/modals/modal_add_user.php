<!-- ===================================      modal Ajouter utilisateur       =================================-->

<?php if (isset($_SESSION['show_modal'])): ?>
  <div id="id02" class="modal-form show">
  <?php else: ?>
    <div id="id02" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content" action="../control/saveusers.php" method="post">
      <div class="container-form">
        <span id="bttn" class="close-d" title="Fermer le Modal">&times;</span>
        <h1 style="color:#191923;">Ajouter un utilisateur</h1>
        <p>Veuillez remplir ce formulaire pour créer un compte.</p>

        <!--                                             alert                                                     -->

        <?php if (isset($_SESSION['message'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message'];?></p>
        </div>
        <?php endif; ?>


        <hr>
        <label for="name"><b>nom complet</b> <span style="opacity:0.8;"> (nom.prénom)</span></label>
        <input type="text" placeholder="Entrer le nom et prénom" name="name" title="veuillez remplir ce champ" required>

        <label for="username"><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" title="veuillez remplir ce champ" required>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Entrer l'email" name="email"  title="veuillez remplir ce champ" >

        <label for="option"><b>sélectionner le type d'utilisateur</b></label>
        <select class="select border" name="option" title="veuillez sélectionner" style="background-color:#f1f1f1; padding:15px 10px;" required>
          <option value="" disabled selected>Choisissez votre option</option>
          <option value="1">Résponsable de parcours</option>
          <option value="2">Enseignant</option>
        </select> <br>

        <label for="password"><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" title="veuillez remplir ce champ" required>

        <label for="password-repeat"><b>Répéter le mot de passe</b></label>
        <input type="password" placeholder="Répéter le mot de passe" name="password_repeat" title="veuillez remplir ce champ" required>



        <div class="clearfix-form">
          <button id="bttn1" type="button"  class="mdl cancelbtn-form">Annuler</button>
          <button type="submit" name="Ajouter_utilisateur" class="mdl signupbtn-form">Ajouter</button>
        </div>
      </div>
    </form>
  </div>





  <!-- =====================================  Modal Ajouter utilisateur scripts  ==================== -->
