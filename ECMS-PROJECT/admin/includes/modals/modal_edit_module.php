<!-- ===================================      modal Ajouter promotion      =================================-->

<?php if (isset($_SESSION['show_modal_edit_module'])): ?>
  <div id="id09" class="modal-form show">
  <?php else: ?>
    <div id="id09" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content" action="edit_module.php" method="post">
      <div class="container-form">
        <span  class="close-d btn_cancel_modif_module" title="Fermer le Modal">&times;</span>
        <h1 style="color:#191923;">modifier ce module</h1>
        <p>Veuillez modifier ce formulaire .</p>

        <!--                                             alert                                                     -->

        <?php if (isset($_SESSION['message'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message'];?></p>
        </div>
        <?php endif; ?>

        <input type="hidden" name="id" value="<?php echo $_SESSION['id_edit']; ?>">

        <hr>
        <label for="name"><b>nom de module</b></label>
        <input type="text" placeholder="Entrer le nom de module" name="name" value="<?php echo $_SESSION['name_edit']; ?>" title="veuillez remplir ce champ" required>

        <label for="abbr"><b>Abbreviation module</b></label>
        <input type="text" placeholder="Abbreviation EX: BDD" name="abbr" value="<?php echo $_SESSION['abbr_edit']; ?>" title="veuillez remplir ce champ" required>

        <label for="promid"><b>promotion de la module</b></label> <br>
        <select class="select border list_resp" name="promid" style="width:100%;" required>
          <?php
            $id_prm = $_SESSION['promid_edit'];
            $sql = "SELECT * FROM tbl_promo WHERE prom_id='$id_prm'";
            $result = mysqli_query($con, $sql);
            $row1 = mysqli_fetch_array($result);
            echo '<option value="'.$id_prm.'" selected>'.$row1['prom_name'].'</option>';


            $sql = "SELECT * FROM tbl_module INNER JOIN tbl_promo ON tbl_module.modl_promo_id = tbl_promo.prom_id ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
              echo'<option value="'.$row['modl_promo_id'].'">'.$row['prom_name'].'</option>';
            }
          ?>
        </select> <br><br>

        <label for="semestre"><b>sélectionner le Semestre</b></label>
        <select  class="select border" name="semestre" title="veuillez sélectionner" style="background-color:#f1f1f1; padding:15px 10px;" required>
          <option value="<?php echo $_SESSION['Semestre_edit']; ?>" selected>Semestre N°  <?php echo $_SESSION['Semestre_edit']; ?> </option>
          <option value="1">Semestre N°1</option>
          <option value="2">Semestre N°2</option>
        </select> <br>


        <label for="ensid"><b>enseignant de la module</b></label> <br>
        <select class="select border list_resp" name="ensid" style="width:100%;">
          <?php
            $id = $_SESSION['ensid_edit'];
            $sql = "SELECT * FROM tbl_users WHERE user_id='$id'";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);

            if ($num > 0) {
              $row1 = mysqli_fetch_array($result);
              echo ' <option value="">aucun</option>';
              echo '<option value="'.$row1['user_id'].'" selected>'.$row1['user_name'].'</option>';
            }else {
              echo ' <option value="">choisissez l enseignant</option>';
            }

            $sql = "SELECT * FROM tbl_users WHERE user_type='2'";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
              echo'<option value="'.$row['user_id'].'">'.$row['user_name'].'</option>';
            }
          ?>
        </select>

        <div class="clearfix-form">
          <button  type="button"  class="mdl cancelbtn-form btn_cancel_modif_module">Cancel</button>
          <button type="submit" name="Modifier_module" class="mdl signupbtn-form">Modifier</button>
        </div>
      </div>
    </form>
  </div>
