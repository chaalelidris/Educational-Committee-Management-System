<?php if (isset($_SESSION['show_modal'])): ?>
<div id="id02" class="modal-form show">
  <?php else: ?>
  <div id="id02" class="modal-form hide">
    <?php endif; ?>
    <form class="modal-content animate-zoom" action="../control/saveusers.php" method="post">
      <div class="container-form">
        <span id="bttn" class="close-d" title="Fermer le Modal">&times;</span>
        <h1 style="color:#191923;">
          <?=$translations['add_user']?>
        </h1>
        <p>
          <?=$translations['add_user_text']?>
        </p>

        <!--                                             alert                                                     -->
        <?php if (isset($_SESSION['message'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p>
            <?php echo $_SESSION['message'];?>
          </p>
        </div>
        <?php endif; ?>
        <label for="name"><b>
            <?=$translations['full_name']?>
          </b> <span style="opacity:0.8;"> </span></label>
        <input type="text" placeholder="<?=$translations['full_name']?>" name="name"
          title="<?=$translations['fill_the_field']?>"
          value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" required>

        <label for="username"><b>
            <?=$translations['username']?>
          </b></label>
        <input type="text" placeholder="<?=$translations['username']?>" name="username"
          title="<?=$translations['fill_the_field']?>"
          value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>

        <label for="email"><b>
            <?=$translations['email']?>
          </b></label>
        <input type="email" placeholder="<?=$translations['email']?>" name="email"
          title="<?=$translations['fill_the_field']?>"
          value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">

        <label for="option"><b>
            <?=$translations['select_user_type']?>
          </b></label>
        <select class="select border" name="option" title="<?=$translations['please_select']?>" required>
          <option value="" disabled <?php echo !isset($_SESSION['option']) ? 'selected' : '' ; ?>>
            <?=$translations['please_select']?>
          </option>
          <option value="1" <?php echo isset($_SESSION['option']) && $_SESSION['option']=='1' ? 'selected' : '' ; ?>>
            <?=$translations['managers']?>
          </option>
          <option value="2" <?php echo isset($_SESSION['option']) && $_SESSION['option']=='2' ? 'selected' : '' ; ?>>
            <?=$translations['teachers']?>
          </option>
        </select> <br>

        <label for="department_id"><b>
            <?=$translations['department']?>
          </b></label>
        <select class="select border" name="department_id" title="<?=$translations['please_select']?>"
          style="background-color:#f1f1f1; padding:15px 10px;" required>
          <?php
        $admin_department_id = $_SESSION['admin_department_id'];
        $sql = "SELECT * FROM tbl_department WHERE department_id = '$admin_department_id'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $selected = isset($_SESSION['department_id']) && $_SESSION['department_id'] == $row['department_id'] ? 'selected' : '';
                echo '<option value="' . $row['department_id'] . '" ' . $selected . '>' . $row['department_name'] . '</option>';
            }
        }
        ?>
        </select> <br>


        <?php unset($_SESSION['name']); unset($_SESSION['username']); unset($_SESSION['email']); unset($_SESSION['option']); unset($_SESSION['department_id']); unset($_SESSION['message']); unset($_SESSION['message_type']); ?>

        <label for="password"><b>
            <?=$translations['password']?>
          </b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password"
          title="<?=$translations['fill_the_field']?>" required>

        <label for="password-repeat"><b>
            <?=$translations['confirm_password']?>
          </b></label>
        <input type="password" placeholder="<?=$translations['confirm_password']?>" name="password_repeat"
          title="<?=$translations['fill_the_field']?>" required>



        <div class="clearfix-form">
          <button id="bttn1" type="button" class="mdl cancelbtn-form">
            <?=$translations['cancel']?>
          </button>
          <button type="submit" name="Ajouter_utilisateur" class="mdl signupbtn-form">
            <?=$translations['add_user']?>
          </button>
        </div>
      </div>
    </form>
  </div>