<!-- ===================================      modal modifier utilisateur       =================================-->
<?php if (isset($_SESSION['show_modal_edit_department'])): ?>
  <div id="id05" class="modal-form show">
  <?php else: ?>
    <div id="id05" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content animate-zoom" action="edit_department.php" method="post">
      <div class="container-form">
        <span class="close-d btn_cancel_modif_departement" title="Fermer le Modal">&times;</span>
        <h1 style="color:#5dd08a;">Modifier ce département</h1>
        <p>Veuillez modifier les informations de ce formulaire.</p>

        <?php if (isset($_SESSION['message_err'])): ?>
          <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
            <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
            <br>
            <p><?php echo $_SESSION['message_err']; unset($_SESSION['message_err']);unset($_SESSION['message_type']); ?></p>
          </div>
        <?php endif; ?>

        <input type="hidden" name="department_id" value="<?php echo $_SESSION['department_id_edit']; ?>">

        <hr>

        <label for="name"><b>Nom du département</b></label>
        <input type="text" value="<?php echo $_SESSION['department_name_edit']; ?>" placeholder="Entrer le nom du département" name="department_name" title="Veuillez remplir ce champ" required>

        <label for="department_abbr"><b>Abbréviation du département</b></label>
        <input type="text"  placeholder="Entrer l'abbréviation du département" name="department_abbr" title="Veuillez remplir ce champ" value="<?php echo $_SESSION['department_abbr_edit']; ?>" required>

        <label for="department_description"><b>Description du département</b></label>
        <textarea class="input margin-bottom round-large" style="background-color: #f1f1f1;" rows="3" placeholder="Entrer une description du département" name="department_description" title="Veuillez remplir ce champ" required><?php echo $_SESSION['department_description_edit']; ?></textarea>

        <label ><b>administrateur du département</b></label>
        <select class="select border list_resp" name="admin_id">
          <?php
            $id = $_SESSION['department_adminid_edit'];
            $sql = "SELECT * FROM tbl_users WHERE user_id='$id'";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);

            if ($num > 0) {
              $row1 = mysqli_fetch_array($result);
              echo '<option value="'.$row1['user_id'].'" selected>'.$row1['user_name'].'</option>';
            }

            $sql = "SELECT * FROM tbl_users WHERE user_type= 'admin' AND user_id!='$id'";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
              echo'<option value="'.$row['user_id'].'">'.$row['user_name'].'</option>';
            }
          ?>
        </select>

        <div class="clearfix-form">
          <button type="button" class="mdl cancelbtn-form btn_cancel_modif_departement">Annuler</button>
          <button type="submit" name="edit_department" class="mdl signupbtn-form">Modifier</button>
        </div>
      </div>
    </form>
  </div>
