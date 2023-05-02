<div class="card_prf center theme-light padding round-xxlarge">

    <!-- SUCCESS MESSAGE -->
    <?php if (isset($_SESSION['message_edit_pass_succ'])):
            $message_type = $_SESSION['message_type'];
            $success_message = $_SESSION['message_edit_pass_succ'];
            unset($_SESSION['message_edit_pass_succ']);
        ?>
    <div class="panel <?php echo $message_type; ?> display-container round-large">
      <span class="button large display-topright" onclick="this.parentElement.style.display='none'">&times;</span>
      <br>
      <p>
        <?php echo $success_message; ?>
      </p>
    </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['message_edit_pass_err'])):
            $message_type = $_SESSION['message_type'];
            $success_message = $_SESSION['message_edit_pass_err'];
            unset($_SESSION['message_edit_pass_err']);
        ?>
    <div class="panel <?php echo $message_type; ?> display-container round-large">
      <span class="button large display-topright" onclick="this.parentElement.style.display='none'">&times;</span>
      <br>
      <p>
        <?php echo $success_message; ?>
      </p>
    </div>
    <?php endif; ?>


    <h3>
      <?=$translations['username']?>: <span class="text-gray">
        <?php echo htmlspecialchars($_SESSION['admin_user_name'], ENT_QUOTES); ?>
      </span>
    </h3>
    <h1>
      <?php echo htmlspecialchars($_SESSION['admin_user_fullname'], ENT_QUOTES); ?>
    </h1>

    <?php if (isset($_SESSION['admin_department_id'])) {
              $admin_department_id = $_SESSION['admin_department_id'];
              $query = mysqli_query($con, "SELECT * 
                                          FROM tbl_department
                                          WHERE department_id = '$admin_department_id' 
                                          LIMIT 1");
              $row_dep = mysqli_fetch_assoc($query);
            } else{
              $row_dep = ["department_name" => "No department"];
            }
        ?>

    <p class="title"><strong>
        <?=$translations['department']?>:
      </strong>
      <span>
        <?php echo htmlspecialchars($row_dep['department_name'], ENT_QUOTES); ?>
      </span>
    </p>
    <p><button id="changeadminpass" class="button primary round-xlarge">
        <?=$translations['change_pass']?>
      </button></p>
  </div>