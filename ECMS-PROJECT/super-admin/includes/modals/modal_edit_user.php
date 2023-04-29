<!-- ===================================      modal <?=$translations['edit']?> utilisateur       =================================-->
<?php if (isset($_SESSION['show_modal_edit'])): ?>
  <div id="id04" class="modal-form show">
  <?php else: ?>
    <div id="id04" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content" action="edit_user.php" method="post">
      <div class="container-form">
        <span id="bttn2" class="close-d" title="Fermer le Modal">&times;</span>
        <h1 style="color:#5dd08a;"><?=$translations['edit_user']?></h1>
        <p><?=$translations['edit_form_pls']?></p>

        <input type="hidden" name="id" value="<?php echo $_SESSION['id_edit']; ?>">

        <?php if (isset($_SESSION['message'])): ?>
          <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large">
            <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
            <br>
            <p><?php echo $_SESSION['message'];?></p>
          </div>
        <?php endif; ?>

        <hr>
        <label for="name"><b><?=$translations['full_name']?></b> </label>
        <input type="text" value="<?php echo $_SESSION['name_edit']; ?>" placeholder="<?=$translations['full_name']?>" id="name" name="name" title="veuillez remplir ce champ" required>

        <label for="username"><b><?=$translations['username']?></b></label>
        <input type="text" value="<?php echo $_SESSION['username_edit']; ?>" placeholder="<?=$translations['username']?>" name="username" id="username" title="veuillez remplir ce champ" required>

        <label for="email"><b><?=$translations['email']?></b></label>
        <input type="email" value="<?php echo $_SESSION['email_edit']; ?>" placeholder="<?=$translations['email']?>" name="email" id="email" title="veuillez remplir ce champ" >

        
        <label for="option"><b><?=$translations['user_type']?></b></label>
        <select class="select border" name="option" title="<?=$translations['please_select']?>" style="background-color:#f1f1f1; padding:15px 10px;" required>
          <?php if ($_SESSION['option_edit'] == "admin"): ?>
            <option value="admin" selected>Admin </option>
          <?php else: ?>
            <option value="admin" selected>Admin</option>
          <?php endif; ?>
        </select>
        
        <br><br>



        <div class="clearfix-form">
          <button id="bttn3" type="button"  class="mdl cancelbtn-form"><?=$translations['cancel']?></button>
          <button type="submit" name="modifier_utilisateur" class="mdl signupbtn-form"><?=$translations['edit']?></button>
        </div>
      </div>
    </form>
  </div>
