
  <div id="idChPass" class="modal-d">
    <form class="modal-content-d round-large animate-zoom" action="edit_pass.php" method="post">
      <div class="container-d">
        <span onclick="document.getElementById('idChPass').style.display='none'" class="close-d" title="Close Modal">&times;</span>
        <h1 style="color:#191923;"><?=$translations['change_pass']?></h1>
        <p><?=$translations['change_pass_txt']?></p>

        <hr>
        <input value="<?php echo $_SESSION['delegue_user_id']; ?>" type="hidden" name="change_password">

        <label for="password_act"><b><?=$translations['current_pass']?></b></label>
        <input type="password" placeholder="<?=$translations['password']?>" name="password_act" title="veuillez remplir ce champ" required>

        <label for="password"><b><?=$translations['password']?></b></label>
        <input type="password" placeholder="<?=$translations['password']?>" name="password" title="veuillez remplir ce champ" required>

        <label for="password-repeat"><b><?=$translations['confirm_password']?></b></label>
        <input type="password" placeholder="<?=$translations['confirm_password']?>" name="password_repeat" title="veuillez remplir ce champ" required>

        <div class="clearfix-form">
          <button onclick="document.getElementById('idChPass').style.display='none'" type="button"  class="mdl cancelbtn-form"><?=$translations['cancel']?></button>
          <button type="submit" name="edit_pass" class="mdl signupbtn-form"><?=$translations['edit']?></button>
        </div>
      </div>
    </form>
  </div>


