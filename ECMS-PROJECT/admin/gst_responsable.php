<?php
  include("includes/head.php");
  include("includes/navbar.php");
  include("includes/sidebar.php");

  $_SESSION["current_session"] = "responsable";
  require_once("../control/config/dbcon.php");
  

 ?>

  <!-- ===================================== CONTENT ======================================= -->

  <!--                                  Main content: shift it to the right by 310 pixels                                    -->
  <div class="main">
    <ul class="breadcrumb round-large" >
      <li><a href="dashboard.php"><?=$translations['home']?></a></li>
      <li><?=$translations['managers']?></li>
    </ul>
    <hr class="rounded">



    <!--  TABLE -->
    <div class="container">
      <h2><?=$translations['managers_table']?></h2>
      <p><?=$translations['sort_table']?></p>

      <div class="row-padding">
        <div class="half">
          <button class="btn_btn success_btn btn_add_user"><?=$translations['add_manager']?></button>
        </div>
        <div class="half">
          <input style="margin-bottom:12px;" id="myInput_gst_res" type="text" placeholder="<?=$translations['search']?>">
        </div>
      </div>


      <?php if (isset($_SESSION['message_success'])): ?>
        <div class="panel green display-container round-large ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message_success']; unset($_SESSION['message_success']); ?></p>
        </div>
      <?php endif; ?>


      <div class="responsive">
        <table class="table-all centered hoverable" id="myTable_resp">
          <tr>
            <th class="pntr" onclick="sortTable(0)">ID</th>
            <th class="pntr" onclick="sortTable(1)"><?=$translations['full_name']?></th>
            <th class="pntr" onclick="sortTable(2)"><?=$translations['username']?></th>
            <th class="pntr" onclick="sortTable(3)">Email</th>
            <th colspan="2"><?=$translations['action']?></th>
          </tr>

          <?php
        $sql = "SELECT DISTINCT u.*
                FROM tbl_users u
                JOIN tbl_user_department ud ON u.user_id = ud.user_id
                JOIN tbl_department d ON ud.department_id = d.department_id
                WHERE d.department_id = '{$_SESSION['admin_department_id']}'
                AND u.user_type = 1";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)): ?>
          <tr>
            <td><?= $row['user_id']?></td>
            <td><?= $row['user_fullname']?></td>
            <td><?= $row['user_name']?></td>
            <td><?= $row['user_email']?></td>

            <td class="mod_bg "><a  href="edit_user.php?edit=<?=$row['user_id']?>" ><?=$translations['edit']?></a></td>
            <td class="sup_bg suppr"><a href="#" ><?=$translations['delete']?></a></td>
          </tr>
        <?php endwhile;?>

        </table>
      </div>
    </div>

    <!-- END MAIN -->
  </div>
  <?php include("includes/modals/modal_add_user.php"); ?>
  <?php include("includes/modals/modal_edit_user.php"); ?>
  <?php include("includes/modals/modal_delete_user.php") ?>

  <?php include("includes/modals/modal_add_promotion.php"); ?>
  <?php include("includes/modals/modal_add_module.php"); ?>
  <?php include("../modal_deconnexion.php"); ?>
  <?php include("includes/scripts.php"); ?>

  <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>

  <?php
  $my_id = "myTable_resp";
  include("sort_table.php") ?>

  <?php
  $idfiltert = "myInput_gst_res";
  $idtbl = "myTable_resp";
  include("filter_table.php")
  ?>
  </body>
</html>
