
<?php if (isset($_SESSION['show_modal_edit_delegue'])): ?>
  <div id="id12" class="modal-form show">
  <?php else: ?>
    <div id="id12" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content animate-zoom" action="edit_delegue.php" method="post">
      <div class="container-form">
        <span class="close-d close_modal_edit_delegue" title="Fermer le Modal">&times;</span>
        <h1 style="color:#5dd08a;"><?=$translations['edit_user']?></h1>
        <p><?=$translations['edit_form_pls']?></p>

        <input type="hidden" name="id" value="<?php echo $_SESSION['id_edit']; ?>">

        <hr>
        <label for="name"><b><?=$translations['full_name']?></b> </label>
        <input type="text" value="<?php echo $_SESSION['name_edit']; ?>" placeholder="<?=$translations['full_name']?>" id="name" name="name" title="veuillez remplir ce champ" required>

        <label for="username"><b><?=$translations['username']?></b></label>
        <input type="text" value="<?php echo $_SESSION['username_edit']; ?>" placeholder="<?=$translations['username']?>" name="username" id="username" title="veuillez remplir ce champ" required>

        <label for="email"><b><?=$translations['email']?></b></label>
        <input type="email" value="<?php echo $_SESSION['email_edit']; ?>" placeholder="<?=$translations['email']?>" name="email" id="email" title="veuillez remplir ce champ" >

        <label for="promid"><b>promotion</b></label> <br>
        <select class="select border " name="promid" style="width:100%;" required>
          <?php
            $id_prm = $_SESSION['promo_edit'];
            $sql = "SELECT * FROM tbl_promo WHERE prom_id='$id_prm'";
            $result = mysqli_query($con, $sql);
            $row1 = mysqli_fetch_array($result);
            echo '<option value="'.$id_prm.'" selected>'.$row1['prom_name'].'</option>';


            $sql = "SELECT * FROM tbl_promo";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
              echo'<option value="'.$row['prom_id'].'">'.$row['prom_name'].'</option>';
            }
          ?>
        </select> <br><br>

        <label for="department_id"><b><?=$translations['department']?></b></label>
        <select class="select border" name="department_id" title="<?=$translations['please_select']?>" style="background-color:#f1f1f1; padding:15px 10px;" required>
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
          <button type="button"  class="mdl cancelbtn-form close_modal_edit_delegue"><?=$translations['cancel']?></button>
          <button type="submit" name="modifier_delegue" class="mdl signupbtn-form"><?=$translations['edit']?></button>
        </div>
      </div>
    </form>
  </div>
