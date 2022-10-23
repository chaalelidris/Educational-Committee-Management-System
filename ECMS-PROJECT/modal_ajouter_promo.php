<!-- ===================================      modal Ajouter promotion      =================================-->

<?php if (isset($_SESSION['show_modal_promo'])): ?>
  <div id="id06" class="modal-form show">
  <?php else: ?>
    <div id="id06" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content" action="add_promo.php" method="post">
      <div class="container-form">
        <span id="bttn4" class="close-d" title="Fermer le Modal">&times;</span>
        <h1 style="color:#191923;">Ajouter une promotion</h1>
        <p>Veuillez remplir ce formulaire pour créer une promotion.</p>

        <!--                                             alert                                                     -->

        <?php if (isset($_SESSION['message'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message'];?></p>
        </div>
        <?php endif; ?>

        <hr>
        <label for="name"><b>nom de promotion</b></label>
        <input type="text" placeholder="Entrer le nom de promotion" name="name" title="veuillez remplir ce champ" required>

        <label for="respid"><b>Séléctionner le responsable de la promotion</b></label> <br>
        <select class="select border list_resp" name="respid" style="width:100%;">
          <?php
            $sql = "SELECT * FROM tbl_users WHERE user_type= '1'";
            $result = mysqli_query($con, $sql);
            // echo '<option value="" selected>aucun</option>';
            while ($row = mysqli_fetch_array($result)) {
              echo'<option value="'.$row['user_id'].'">'.$row['user_name'].'</option>';
            }
          ?>
        </select> <br><br>

        <div class="clearfix-form">
          <button id="bttn5" type="button"  class="mdl cancelbtn-form">Cancel</button>
          <button type="submit" name="Ajouter_promotion" class="mdl signupbtn-form">Ajouter</button>
        </div>
      </div>
    </form>
  </div>
