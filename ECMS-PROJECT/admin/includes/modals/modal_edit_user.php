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
        
        
        <?php if (isset($_SESSION['message_edit_success'])): ?>
          <div class="panel green display-container round-large">
            <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
            <br>
            <p><?php echo $_SESSION['message_edit_success']; unset($_SESSION['message_edit_success']); ?></p>
          </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['message_edit_error'])): ?>
          <div class="panel red display-container round-large ">
            <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
            <br>
            <p><?php echo $_SESSION['message_edit_error']; unset($_SESSION['message_edit_error']); ?></p>
          </div>
        <?php endif; ?>

        <label for="name"><b>nom complet</b> <span style="opacity:0.8;"> (nom.prénom)</span></label>
        <input type="text" value="<?php echo $_SESSION['name_edit']; ?>" placeholder="Entrer le nom et prénom" id="name" name="name" title="veuillez remplir ce champ" required>

        <label for="username"><b>Nom d'utilisateur</b></label>
        <input type="text" value="<?php echo $_SESSION['username_edit']; ?>" placeholder="Entrer le nom d'utilisateur" name="username" id="username" title="veuillez remplir ce champ" required>

        <label for="email"><b>Email</b></label>
        <input type="email" value="<?php echo isset($_SESSION['email_edit']) ? $_SESSION['email_edit'] : ''; ?>"  placeholder="Entrer l'email" name="email" id="email" title="veuillez remplir ce champ" >

        <label for="type"><b>Choisir le type d'utilisateur</b></label>
        <select class="select border" name="type" title="Veuillez sélectionner" style="background-color:#f1f1f1; padding:15px 10px;" required>
          <?php if ($_SESSION['option_edit'] == 1): ?>
            <option value="<?php echo $_SESSION['option_edit']; ?>" selected>Résponsable de parcours (<?php echo $_SESSION['option_edit']; ?>)</option>
          <?php elseif ($_SESSION['option_edit'] == 2): ?>
            <option value="<?php echo $_SESSION['option_edit']; ?>" selected>Enseignant (<?php echo $_SESSION['option_edit']; ?>)</option>
          <?php elseif ($_SESSION['option_edit'] == 3): ?>
            <option value="<?php echo $_SESSION['option_edit']; ?>" selected>Délégué (<?php echo $_SESSION['option_edit']; ?>)</option>
          <?php else: ?>
            <option value="<?php echo $_SESSION['option_edit']; ?>" selected>Utilisateur actuel par défaut (<?php echo $_SESSION['option_edit']; ?>)</option>
          <?php endif; ?>
          <option value="1">1- Résponsable de parcours</option>
          <option value="2">2- Enseignant</option>
          <option value="3">3- Délégué</option>
        </select>

        <label for="department_id"><b>Département</b></label>
        <select class="select border" name="department_id" title="Veuillez sélectionner" style="background-color:#f1f1f1; padding:15px 10px;" required>
            <?php
            $admin_department_id = $_SESSION['admin_department_id'];
            $sql = "SELECT * FROM tbl_department WHERE department_id = '$admin_department_id'";
            $result = mysqli_query($con, $sql) or die(mysqli_error($con));
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['department_id'] . '">' . $row['department_name'] . '</option>';
                }
            }
            ?>
        </select> <br>



        <div class="clearfix-form">
          <button id="bttn3" type="button"  class="mdl cancelbtn-form">Annuler</button>
          <button type="submit" name="modifier_utilisateur" class="mdl signupbtn-form">modifier</button>
        </div>
      </div>
    </form>
  </div>
