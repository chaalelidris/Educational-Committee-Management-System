<?php if (isset($_SESSION['show_modal_edit_module'])): ?>
<div id="id09" class="modal-form show">
  <?php else: ?>
  <div id="id09" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content animate-zoom" action="edit_module.php" method="post">
      <div class="container-form">
        <span class="close-d btn_cancel_modif_module" title="Fermer le Modal">&times;</span>
        <h1 style="color:#191923;">modifier ce module</h1>
        <p>Veuillez modifier ce formulaire .</p>

        <!--                                             alert                                                     -->

        <?php if (isset($_SESSION['message'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p>
            <?php echo $_SESSION['message'];?>
          </p>
        </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['message_success_edid'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p>
            <?php echo $_SESSION['message_success_edid']; ?>
          </p>
        </div>
        <?php unset($_SESSION['message_success_edid']); ?>
        <?php endif; ?>


        <input type="hidden" name="id" value="<?php echo $_SESSION['id_edit']; ?>">

        <hr>
        <label for="name"><b><?=$translations['module_name']?></b></label>
        <input type="text" placeholder="Entrer le <?=$translations['module_name']?>" name="name"
          value="<?php echo $_SESSION['name_edit']; ?>" title="veuillez remplir ce champ" required>

        <label for="abbr"><b>
            <?=$translations['abbr']?> module
          </b></label>
        <input type="text" placeholder="Abbreviation EX: BDD" name="abbr" value="<?= $_SESSION['abbr_edit']; ?>"
          title="veuillez remplir ce champ" required>

        <label for="promid"><b><?=$translations['select_mod_prom']?></b></label> <br>
        <select class="select border list_resp" name="promid" style="width:100%;" required>

          <?php
          $id_prm = $_SESSION['promid_edit'];
          $sql = "SELECT * FROM tbl_promo WHERE prom_id='$id_prm'";
          $result = mysqli_query($con, $sql);
          $row1 = mysqli_fetch_array($result);
          echo '<option value="'.$id_prm.'" selected>'.$row1['prom_name'].'</option>';

          $sql = "SELECT * FROM tbl_promo";
          $result = mysqli_query($con, $sql);
          while ($row = mysqli_fetch_array($result)) {
            if ($row['prom_id'] != $id_prm) {
              echo '<option value="'.$row['prom_id'].'">'.$row['prom_name'].'</option>';
            }
          }
          ?>
        </select> <br><br>

        <label for="department_id"><b><?=$translations['department']?></b></label>
        <select class="select border" name="department_id" title="<?=$translations['please_select']?>"
          style="background-color:#f1f1f1; padding:15px 10px;" required>
          <?php
            $admin_department_id = $_SESSION['admin_department_id'];
            $sql = "SELECT * FROM tbl_department WHERE department_id = ?";
            $stmt = mysqli_prepare($con, $sql) or die(mysqli_error($con));
            mysqli_stmt_bind_param($stmt, "i", $admin_department_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['department_id'] . '">' . $row['department_name'] . '</option>';
                }
            } else {
                echo '<option value="">Aucun département disponible</option>';
            }
            ?>
        </select>

        <label for="<?=$translations['semester']?>"><b><?=$translations['semester']?></b></label>
        <select class="select border" name="semestre" title="veuillez sélectionner"
          style="background-color:#f1f1f1; padding:15px 10px;" required>
          <option value="<?php echo $_SESSION['Semestre_edit']; ?>" selected>
            <?=$translations['semester_nb']?>
            <?php echo $_SESSION['Semestre_edit']; ?>
          </option>
          <option value="1">
            <?=$translations['semester_nb']?>1
          </option>
          <option value="2">
            <?=$translations['semester_nb']?>2
          </option>
        </select> <br>


        <!-- Select the teacher for the module -->
        <label for="ensid"><b>Enseignant de la module</b></label> <br>
        <select class="select border list_resp" name="ensid" style="width:100%;">
          <?php
            // Get the ID of the currently selected teacher
            $selected_teacher_id = $_SESSION['ensid_edit'];

            // Query the database to get the selected teacher's information
            $selected_teacher_query = "SELECT * FROM tbl_users WHERE user_id='$selected_teacher_id'";
            $selected_teacher_result = mysqli_query($con, $selected_teacher_query);
            $selected_teacher_num = mysqli_num_rows($selected_teacher_result);

            // If the selected teacher exists, display their name in the dropdown menu
            if ($selected_teacher_num > 0) {
                $selected_teacher_row = mysqli_fetch_array($selected_teacher_result);
                echo '<option value="'.$selected_teacher_row['user_id'].'" selected>'.$selected_teacher_row['user_name'].'</option>';
            } 
            // Otherwise, display a default option in the dropdown menu
            else {
                echo '<option value="" selected disabled>Choisissez l\'enseignant</option>';
            }

            // Query the database to get a list of available teachers for the module
            $available_teachers_query = "SELECT DISTINCT u.user_id,u.user_name
                                          FROM tbl_users u
                                          JOIN tbl_user_department ud ON u.user_id = ud.user_id
                                          JOIN tbl_department d ON ud.department_id = d.department_id
                                          WHERE d.department_id = '{$_SESSION['admin_department_id']}' 
                                          AND u.user_type = 2";
            $available_teachers_result = mysqli_query($con, $available_teachers_query);

            // Display the list of available teachers in the dropdown menu
            while ($available_teacher_row = mysqli_fetch_array($available_teachers_result)) {
                // Skip the selected teacher to avoid duplicates in the dropdown menu
                if ($available_teacher_row['user_id'] != $selected_teacher_id) {
                    echo '<option value="'.$available_teacher_row['user_id'].'">'.$available_teacher_row['user_name'].'</option>';
                }
            }
            ?>
        </select>

        <div class="clearfix-form">
          <button type="button" class="mdl cancelbtn-form btn_cancel_modif_module"><?=$translations['cancel']?></button>
          <button type="submit" name="Modifier_module" class="mdl signupbtn-form">Modifier</button>
        </div>
      </div>
    </form>
  </div>