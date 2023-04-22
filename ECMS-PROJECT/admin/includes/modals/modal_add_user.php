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
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
            <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
            <br>
            <p><?php echo $_SESSION['message'];?></p>
        </div>
        <?php endif; ?>
        <label for="name"><b>nom complet</b> <span style="opacity:0.8;"> (nom.prénom)</span></label>
        <input type="text" placeholder="Entrer le nom et prénom" name="name" title="veuillez remplir ce champ" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" required>

        <label for="username"><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" title="veuillez remplir ce champ" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Entrer l'email" name="email"  title="veuillez remplir ce champ" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">

        <label for="option"><b>sélectionner le type d'utilisateur</b></label>
        <select class="select border" name="option" title="veuillez sélectionner" style="background-color:#f1f1f1; padding:15px 10px;" required>
        <option value="" disabled <?php echo !isset($_SESSION['option']) ? 'selected' : ''; ?>>Choisissez votre option</option>
        <option value="1" <?php echo isset($_SESSION['option']) && $_SESSION['option'] == '1' ? 'selected' : ''; ?>>Résponsable de parcours</option>
        <option value="2" <?php echo isset($_SESSION['option']) && $_SESSION['option'] == '2' ? 'selected' : ''; ?>>Enseignant</option>
        </select> <br>

        <label for="department_id"><b>Département</b></label>
        <select class="select border" name="department_id" title="Veuillez sélectionner" style="background-color:#f1f1f1; padding:15px 10px;" required>
        <?php
        $admin_department_id = $_SESSION['admin_department_id'];
        $sql = "SELECT * FROM tbl_department WHERE department_id = '$admin_department_id'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $selected = isset($_SESSION['department_id']) && $_SESSION['department_id'] == $row['department_id'] ? 'selected' : '';
                echo '<option value="' . $row['department_id'] . '" ' . $selected . '>' . $row['department_name'] . '</option>';
            }
        }
        ?>
        </select> <br>


        <?php unset($_SESSION['name']); unset($_SESSION['username']); unset($_SESSION['email']); unset($_SESSION['option']); unset($_SESSION['department_id']); unset($_SESSION['message']); unset($_SESSION['message_type']); ?> 

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


