<!-- ===================================      modal Ajouter utilisateur       =================================-->

<?php if (isset($_SESSION['show_modal_add_del'])): ?>
  <div id="id11" class="modal-form show">
  <?php else: ?>
    <div id="id11" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content" action="../control/saveusers.php" method="post">
      <div class="container-form">
        <span class="close-d btn_cancel_add_delegue" title="Fermer le Modal">&times;</span>
        <h1 style="color:#191923;">Ajouter un délégué</h1>
        <p>Veuillez remplir ce formulaire pour créer un compte.</p>

        <!--                                             alert                                                     -->

        <?php if (isset($_SESSION['message'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message'];?></p>
        </div>
        <?php endif; ?>


        <hr>
        <label for="name"><b>nom complet</b> <span style="opacity:0.8;"> (nom.prénom)</span></label>
        <input type="text" placeholder="Entrer le nom et prénom" name="name" title="veuillez remplir ce champ" required>

        <label for="username"><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" title="veuillez remplir ce champ" required>

        <label for="email"><b>Email</b><span style="opacity:0.8;color:rgb(244, 121, 132);">  ( pas obligatoire )</span></label>
        <input type="email" placeholder="Entrer l'email" name="email"  title="veuillez remplir ce champ" >

        <label for="promid"><b>Séléctionner la promotion</b></label> <br>
        <select class="select border list_resp" name="promid" style="width:100%;" required>
          <?php
            $sql = "SELECT * FROM tbl_promo ";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
              echo'<option value="'.$row['prom_id'].'">'.$row['prom_name'].'</option>';
            }
          ?>
        </select> <br> <br>

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

        <label for="password"><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" title="veuillez remplir ce champ" required>

        <label for="password-repeat"><b>Répéter le mot de passe</b></label>
        <input type="password" placeholder="Répéter le mot de passe" name="password_repeat" title="veuillez remplir ce champ" required>

        <div class="clearfix-form">
          <button  type="button"  class="mdl cancelbtn-form btn_cancel_add_delegue">Cancel</button>
          <button type="submit" name="Ajouter_utilisateur_del" class="mdl signupbtn-form">Ajouter</button>
        </div>
      </div>
    </form>
  </div>





  <!-- =====================================  Modal Ajouter utilisateur scripts  ==================== -->
