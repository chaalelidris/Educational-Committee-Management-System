<!-- ===================================      modal Ajouter promotion      =================================-->

<?php if (isset($_SESSION['show_modal_module'])): ?>
  <div id="id08" class="modal-form show">
  <?php else: ?>
    <div id="id08" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content" action="add_module.php" method="post">
      <div class="container-form">
        <span  class="close-d btn_cancel_add_module" title="Fermer le Modal">&times;</span>
        <h1 style="color:#191923;">Ajouter un module</h1>
        <p>Veuillez remplir ce formulaire pour créer un module.</p>

        <!--                                             alert                                                     -->

        <?php if (isset($_SESSION['message'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message']; ?></p>
        </div>
        <?php endif; ?>

        <hr>
        <label for="name"><b>Nom de module</b></label>
        <input type="text" placeholder="Entrer le nom de module" name="name" title="veuillez remplir ce champ" required>

        <label for="abbr"><b>Abbreviation  de module</b></label>
        <input type="text" placeholder="Abbreviation   EX: BDD" name="abbr" title="veuillez remplir ce champ" required>

        <label for="promid"><b>Séléctionner la promotion de la module</b></label> <br>
        <select class="select border list_resp" name="promid" style="width:100%;" required>
          <?php
            $sql = "SELECT * FROM tbl_promo ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
              echo'<option value="'.$row['prom_id'].'">'.$row['prom_name'].'</option>';
            }
          ?>
        </select> <br> <br>

        <label for="semestre"><b>sélectionner le semestre</b></label>
        <select class="select border" name="semestre" title="veuillez sélectionner" style="background-color:#f1f1f1; padding:15px 10px;" required>
          <option value="" disabled selected>Choisissez votre option</option>
          <option value="1">semestre N°1</option>
          <option value="2">semestre N°2</option>
        </select>

        <label for="ensid"><b>Séléctionner l'enseignant de la module</b></label> <br>
        <select class="select border list_resp" name="ensid" style="width:100%;">
          <?php
            $sql = "SELECT * FROM tbl_users WHERE user_type='2' ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
              echo'<option value="'.$row['user_id'].'">'.$row['user_name'].'</option>';
            }
          ?>
        </select> <br><br>

        <div class="clearfix-form">
          <button  type="button"  class="mdl cancelbtn-form btn_cancel_add_module">Cancel</button>
          <button type="submit" name="Ajouter_module" class="mdl signupbtn-form">Ajouter</button>
        </div>
      </div>
    </form>
  </div>
