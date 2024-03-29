<!-- Modal - Add User -->
<?php if (isset($_SESSION['show_modal'])): ?>
  
  <div id="id02" class="modal-form show">
<?php else: ?>
  <div id="id02" class="modal-form hide">
<?php endif; ?>

  <form class="modal-content animate-zoom" action="add_admin.php" method="post">
    <div class="container-form">
      <span id="bttn" class="close-d" title="Fermer le Modal">&times;</span>
      <h1>Ajouter un utilisateur</h1>
      <p>Veuillez remplir ce formulaire pour créer un compte.</p>

      <?php if (isset($_SESSION['message'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message'];?></p>
        </div>
      <?php endif; ?>

      <hr>

      <label for="name"><b><?=$translations['full_name']?></b> </label>
      <input type="text" placeholder="<?=$translations['full_name']?>" name="name" title="Veuillez remplir ce champ" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" required>

      <label for="username"><b><?=$translations['username']?></b></label>
      <input type="text" placeholder="<?=$translations['username']?>" name="username" title="Veuillez remplir ce champ" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>

      <label for="email"><b><?=$translations['email']?></b></label>
      <input type="email" placeholder="<?=$translations['email']?>" name="email"  title="Veuillez remplir ce champ" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">

      <label for="option"><b><?=$translations['select_user_type']?></b></label>
      <select class="select border" name="option" title="<?=$translations['please_select']?>" style="background-color:#f1f1f1; padding:15px 10px;" required>
        <option value="" disabled selected>Choisissez votre option</option>
        <option value="admin" selected>Admin</option>
      </select> <br>

      <label for="password"><b><?=$translations['password']?></b></label>
      <input type="password" placeholder="<?=$translations['password']?>" name="password" title="Veuillez remplir ce champ" required>

      <label for="password-repeat"><b><?=$translations['confirm_password']?></b></label>
      <input type="password" placeholder="<?=$translations['confirm_password']?>" name="password_repeat" title="Veuillez remplir ce champ" required>

      <div class="clearfix-form">
        <button id="bttn1" type="button"  class="mdl cancelbtn-form"><?=$translations['cancel']?></button>
        <button type="submit" name="add_admin" class="mdl signupbtn-form"><?=$translations['add']?></button>
      </div>
    </div>
  </form>
</div>
