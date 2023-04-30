
  <div id="change_admin_pass" class="modal-d ">
    <form class="modal-content-d round-large animate-zoom" action="change_pass.php" method="post">
      <div class="container-d">
        <span onclick="document.getElementById('change_admin_pass').style.display='none'" class="close-d" title="Close Modal">&times;</span>
        <h1 style="color:#191923;"><?=$translations['change_pass']?></h1>
        <p><?=$translations['change_pass_txt']?></p>

        <hr>
        <input type="hidden" name="change_password" value="<?php echo $_SESSION['admin_user_id']; ?>">

        <label for="password"><b><?=$translations['password']?></b></label>
        <input type="password" placeholder="<?=$translations['password']?>" name="password" title="veuillez remplir ce champ" required>

        <label for="password-repeat"><b><?=$translations['confirm_password']?></b></label>
        <input type="password" placeholder="<?=$translations['confirm_password']?>" name="password_repeat" title="veuillez remplir ce champ" required>

        <div class="clearfix-form">
          <button onclick="document.getElementById('id13').style.display='none'" type="button"  class="mdl cancelbtn-form"><?=$translations['cancel']?></button>
          <button type="submit" name="edit_pass" class="mdl signupbtn-form"><?=$translations['edit']?></button>
        </div>
      </div>
    </form>
  </div>

