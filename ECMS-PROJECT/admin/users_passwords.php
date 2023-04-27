
<?php
  include("includes/head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "admin";
  }else {
    $_SESSION["current_session"] = "admin";
  }

  include("includes/navbar.php");
  include("includes/sidebar.php");
 ?>





  <!-- =====================================                  contenus               ======================================= -->


  <div class="main " >
    <!--                                                    breadcrumb                                                       -->
    <ul class="breadcrumb round-large" >
      <li><a href="dashboard.php"><?=$translations['home']?></a></li>
      <li>Mot de passes des utilisateurs</li>
    </ul>
    <hr class="rounded">

    <?php
    require_once("../control/config/dbcon.php");
    ?>

    <!--                                                        Tableau -->
    <div class="container">
      <h2><?=$translations['all_users_pass']?></h2>
      <p style="color:rgba(0, 0, 0, 0.78)"><?=$translations['sort_table']?></p>

      <input style="margin-bottom:0;" id="myInput_ch_pass" type="text" placeholder="<?=$translations['search']?>">
      <br><br>

      <?php
      if (isset($_SESSION['message_edit_pass_succ'])):
          $message_type = $_SESSION['message_type'];
          $success_message = $_SESSION['message_edit_pass_succ'];
          unset($_SESSION['message_edit_pass_succ']);
      ?>
          <div class="panel <?php echo $message_type; ?> display-container round-large">
              <span class="button large display-topright" onclick="this.parentElement.style.display='none'">&times;</span>
              <br>
              <p><?php echo $success_message; ?></p>
          </div>
      <?php endif; ?>

      <?php
      if (isset($_SESSION['message_edit_pass_err'])):
          $message_type = $_SESSION['message_type'];
          $error_message = $_SESSION['message_edit_pass_err'];
          unset($_SESSION['message_edit_pass_err']);
      ?>
          <div class="panel <?php echo $message_type; ?> display-container round-large">
              <span class="button large display-topright" onclick="this.parentElement.style.display='none'">&times;</span>
              <br>
              <p><?php echo $error_message; ?></p>
          </div>
      <?php endif; ?>



      <div class="responsive">
        <table class="table-all centered hoverable" id="myTable_ch_pass">
          <tr>
            <th class="pntr" onclick="sortTable(0)">ID</th>
            <th class="pntr" onclick="sortTable(2)"><?=$translations['username']?></th>
            <th class="pntr" onclick="sortTable(2)">type d'utilisateur</th>
            <!-- <th class="pntr" onclick="sortTable(3)">Mot de pass</th> -->
            <th colspan="1"><?=$translations['action']?></th>
          </tr>

          <?php
        $sql = "SELECT DISTINCT u.user_id,u.user_name,u.user_type
                FROM tbl_users u
                JOIN tbl_user_department ud ON u.user_id = ud.user_id
                JOIN tbl_department d ON ud.department_id = d.department_id
                WHERE d.department_id = '{$_SESSION['admin_department_id']}' 
                AND user_type 
                NOT IN ('admin', 'super_admin') 
                ORDER BY user_type 
                DESC";
        
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) :?>
          <tr>
            <td><?= $row['user_id']?></td>
            <td><?= $row['user_name']?></td>

            <?php if ($row['user_type'] == 1) :?>
              <td><?=$translations['managers']?></td>
            <?php elseif ($row['user_type'] == 2): ?>
              <td><?=$translations['teachers']?></td>
            <?php elseif ($row['user_type'] == 3): ?>
              <td><?=$translations['delegates']?></td>
            <?php elseif ($row['user_type'] == 'admin'): ?>
              <td><?=$translations['admin']?></td>
            <?php elseif ($row['user_type'] == 'super_admin'): ?>
              <td><?=$translations['superadmin']?></td>
            <?php endif; ?>

            <td class="mod_bg changepass"><a  href="#" >Changer</a></td>

          </tr>
        <?php endwhile; ?>

        </table>
      </div>
    </div>


  </div>

  <?php include("includes/modals/modal_change_pass.php"); ?>
  <?php include("includes/modals/modal_add_promotion.php"); ?>
  <?php include("includes/modals/modal_add_module.php"); ?>
  <?php include("includes/modals/modal_add_user.php"); ?>
  <?php include("includes/modals/modal_delete_user.php") ?>
  <?php include("../modal_deconnexion.php"); ?>

  <?php include("includes/scripts.php"); ?>


  <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>

  <?php
  $my_id = "myTable_ch_pass";
  include("sort_table.php") ?>
  <?php

  $idfiltert = "myInput_ch_pass";
  $idtbl = "myTable_ch_pass";
  include("filter_table.php") ?>

  </body>
</html>
