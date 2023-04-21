<!-- ===================================      modal Ajouter departement      =================================-->
<?php if (isset($_SESSION['show_modal_department'])): ?>
<div id="id06" class="modal-form show">
  <?php else: ?>
  <div id="id06" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content" action="add_department.php" method="post">
      <div class="container-form">
        <span id="bttn4" class="close-d" title="Fermer le Modal">&times;</span>
        <h1 style="color:#191923;">Ajouter un département</h1>
        <p>Veuillez remplir ce formulaire pour créer un département.</p>
        <!--                                             alert                                                     -->

        <?php if (isset($_SESSION['message'])): ?>
        <div class="panel <?php echo $_SESSION[" message_type"]; ?> display-container ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p>
            <?php echo $_SESSION['message'];?>
          </p>
        </div>
        <?php endif; ?>

        <hr>
        <label for="department_name"><b>Nom du département</b></label>
        <input class="round-large" type="text" placeholder="Entrer le nom du département" name="department_name"
          title="veuillez remplir ce champ" required>

        <label for="department_abbr"><b>Abbréviation du département</b></label>
        <input class="round-large" type="text" placeholder="Entrer l'abbréviation du département" name="department_abbr"
          title="veuillez remplir ce champ" required>

        <label for="department_description"><b>Description de département</b></label>
        <textarea class="input margin-bottom round-large" style="background-color: #f1f1f1;"
          placeholder="Entrer la description de département" name="department_description"
          title="veuillez remplir ce champ" required></textarea>

        <label for="admin_id"><b>Sélectionner l'administrateur du département</b></label> <br>
        <select class="select border list_resp" name="admin_id" style="width:100%;">
          <?php
          $sql = "SELECT * FROM tbl_users WHERE user_type= 'admin'";
          $result = mysqli_query($con, $sql);
          // echo '<option value="" selected>aucun</option>';
          while ($row = mysqli_fetch_array($result)) {
            echo'<option value="'.$row['user_id'].'">'.$row['user_name'].'</option>';
          }
        ?>
        </select> <br><br>

        <div class="clearfix-form">
          <button id="bttn5" type="button" class="mdl cancelbtn-form">Cancel</button>
          <button type="submit" name="add_department" class="mdl signupbtn-form">Ajouter</button>
        </div>
      </div>
    </form>
  </div>
</div>