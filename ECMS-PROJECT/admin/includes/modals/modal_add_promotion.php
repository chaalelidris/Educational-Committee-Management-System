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
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message'];?></p>
        </div>
        <?php endif; ?>

        <hr>
        <label for="name"><b>nom de promotion</b></label>
        <input type="text" placeholder="Entrer le nom de promotion" name="name" title="veuillez remplir ce champ" required>

        <label for="respid"><b>Sélectionner le responsable de la promotion :</b></label><br>
        <select class="select border list_resp" name="respid" style="width:100%;" required>

          <option value="" disabled selected>Choisir un responsable</option>
          <?php
          $stmt = $con->prepare("SELECT DISTINCT u.user_id, u.user_name 
                                  FROM tbl_users u
                                  JOIN tbl_user_department ud ON u.user_id = ud.user_id
                                  JOIN tbl_department d ON ud.department_id = ?
                                  WHERE u.user_type = 1
                                ");
          $department_id = $_SESSION['admin_department_id'];
          $stmt->bind_param("i", $department_id);
          $stmt->execute();
          $result = $stmt->get_result();
          while ($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['user_id'].'">'.$row['user_name'].'</option>';
          }
          $stmt->close();
          ?>
        </select><br><br>


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
          <button id="bttn5" type="button"  class="mdl cancelbtn-form">Cancel</button>
          <button type="submit" name="add_promotion" class="mdl signupbtn-form">Ajouter</button>
        </div>
      </div>
    </form>
  </div>
