
<?php
  include("includes/head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "super_admin";
  }else {
    $_SESSION["current_session"] = "super_admin";
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
        if (isset($_SESSION['message_edit_pass_succ'])): ?>
       <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
         <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
         <br>
         <p><?php echo $_SESSION['message_edit_pass_succ']; unset($_SESSION['message_edit_pass_succ']); ?></p>
       </div>
       <?php endif; ?>

      <?php
        if (isset($_SESSION['message_edit_pass_err'])): ?>
       <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
         <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
         <br>
         <p><?php echo $_SESSION['message_edit_pass_err']; unset($_SESSION['message_edit_pass_err']); ?></p>
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
        $sql = "SELECT * FROM tbl_users WHERE user_type='admin' order by user_type desc";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
          echo'<tr>';
            echo'<td>'.$row['user_id'].'</td>';
            echo'<td>'.$row['user_name'].'</td>';

            if ($row['user_type'] == 1) {
              echo'<td>responsable</td>';
            }elseif ($row['user_type'] == 2) {
              echo'<td>enseignant</td>';
            }elseif ($row['user_type'] == 3) {
              echo'<td>delege</td>';
            }elseif ($row['user_type'] == 'admin') {
              echo'<td>Administrateur</td>';
            }

            // $pass = mysqli_real_escape_string($con, $row['user_pass']);
            // echo'<td>'.$pass.'</td>';

            echo '<td class="mod_bg changepass"><a  href="#" >Changer</a></td>';

          echo'</tr>';
        }
        ?>

        </table>
      </div>
    </div>


  </div>

  <?php include("includes/modals/modal_change_pass.php"); ?>
  <?php include("includes/modals/modal_add_department.php"); ?>
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
