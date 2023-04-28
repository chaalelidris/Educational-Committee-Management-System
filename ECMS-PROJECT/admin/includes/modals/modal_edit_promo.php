<!-- ===================================      modal <?=$translations['edit']?> utilisateur       =================================-->
<?php if (isset($_SESSION['show_modal_edit_promo'])): ?>
<div id="id05" class="modal-form show">
  <?php else: ?>
  <div id="id05" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content animate-zoom" action="edit_promo.php" method="post">
      <div class="container-form">
        <span class="close-d btn_cancel_modif_promo" title="Fermer le Modal">&times;</span>
        <h1 style="color:#5dd08a;">modifier cette promotion</h1>
        <p><?=$translations['edit_form_pls']?></p>

        <input type="hidden" name="id" value="<?php echo $_SESSION['id_edit']; ?>">

        <hr>
        <label for="name"><b>nom de la promotion</b> </label>
        <input type="text" value="<?php echo $_SESSION['name_edit']; ?>" placeholder="Entrer le nom de la promotion"
          name="name" title="veuillez remplir ce champ" required>

        <label for="username"><b>Nom de responsable</b></label>
        <select class="select border list_resp" name="respid" required>
          <?php
            $id = $_SESSION['respid_edit'];
            
            $sql = "SELECT * FROM tbl_users WHERE user_id='$id'";
            $result = mysqli_query($con, $sql);
            
            if (mysqli_num_rows($result) > 0) {
              $row1 = mysqli_fetch_array($result);
              echo '<option value="'.$row1['user_id'].'" selected>'.$row1['user_name'].'</option>';
            }
            
            $sql = "SELECT DISTINCT u.user_id,u.user_name
                    FROM tbl_users u
                    JOIN tbl_user_department ud ON u.user_id = ud.user_id
                    JOIN tbl_department d ON ud.department_id = d.department_id
                    WHERE d.department_id = '{$_SESSION['admin_department_id']}'
                    AND u.user_type = 1
                    AND u.user_id != '$id'";

            $result = mysqli_query($con, $sql);
            
            while ($row = mysqli_fetch_array($result)):?>
              <option value="<?php echo $row['user_id'] ?>"><?php echo $row['user_name'] ?></option>';
            <?php endwhile; ?>
        </select>


        <label for="department_id"><b><?=$translations['department']?></b></label>
        <select class="select border" name="department_id" title="<?=$translations['please_select']?>"
          style="background-color:#f1f1f1; padding:15px 10px;" required>
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
          <button type="button" class="mdl cancelbtn-form btn_cancel_modif_promo"><?=$translations['cancel']?></button>
          <button type="submit" name="modifier_promotion" class="mdl signupbtn-form"><?=$translations['edit']?></button>
        </div>
      </div>
    </form>
  </div>