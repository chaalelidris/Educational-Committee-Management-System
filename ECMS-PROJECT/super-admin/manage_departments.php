<?php
  include("includes/head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "department";
  }else {
    $_SESSION["current_session"] = "department";
  }

  include("includes/navbar.php");
  include("includes/sidebar.php");
 ?>



<div class="main">
  <!-- begin main -->

  <ul class="breadcrumb round-large" >
    <li><a href="dashboard.php"><?=$translations['home']?></a></li>
    <li><?=$translations['manage_dep']?></li>
  </ul>
  <hr class="rounded">


  <div class="container">
    <h2><?=$translations['manage_dep']?></h2>
    <p><?=$translations['sort_table']?></p>

    <input style="margin-bottom:0;" id="myInput_gst_prm" type="text" placeholder="<?=$translations['search']?>">
      <br><br>

    <?php
      require_once("../control/config/dbcon.php");
     ?>

    <?php if (isset($_SESSION['message_success'])): ?>
    <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
      <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
      <br>
      <p><?php echo $_SESSION['message_success']; unset($_SESSION['message_success']); ?></p>
    </div>
    <?php endif; ?>

        <div class="responsive">
              <table class="table-all centered hoverable" id="myTable_prom">
                      <tr>
                        <th class="pntr" onclick="sortTable(0)">ID</th>
                        <th class="pntr" onclick="sortTable(1)"><?=$translations['dep_name']?></th>
                        <th class="pntr" onclick="sortTable(1)"><?=$translations['abbr']?></th>
                        <th class="pntr" onclick="sortTable(1)"><?=$translations['dep_desc']?></th>
                        <th class="pntr" onclick="sortTable(2)"><?=$translations['dep_admin']?></th>
                        <th colspan="2"><?=$translations['action']?></th>
                      </tr>

                      <?php
                        $sqll = " SELECT tbl_department.*, tbl_users.user_name as admin_name 
                                  FROM tbl_department 
                                  LEFT JOIN tbl_users 
                                  ON tbl_department.admin_id = tbl_users.user_id 
                                  WHERE tbl_users.user_type = 'admin'";

                        $result = mysqli_query($con, $sqll) or die(mysqli_error($con));

                        while ($row = mysqli_fetch_array($result)):?>
                          <tr>
                          <td><?=$row['department_id']?></td>
                          <td><?=$row['department_name']?></td>
                          <td><?=$row['department_abbr']?></td>
                          <td><?=$row['department_description']?></td>
                          <td><?=$row['admin_name']?></td>

                          <td class="mod_bg "><a href="edit_department.php?edit=<?=$row['department_id']?>"><?=$translations['edit']?></a></td>
                          <td class="sup_bg suppr_dp"><a href="#"><?=$translations['delete']?></a></td>
                          </tr>
                        <?php endwhile; ?>
                      

              </table>
        </div>
  </div>


  <!-- END MAIN -->
</div>

  <?php include("includes/modals/modal_add_department.php"); ?>
  <?php include("includes/modals/modal_edit_department.php"); ?>
  <?php include("includes/modals/modal_delete_department.php"); ?>

  <?php include("includes/modals/modal_add_user.php"); ?>
  <?php include("../modal_deconnexion.php"); ?>

  <?php include("includes/scripts.php"); ?>

  <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>

  <?php
  $my_id = "myTable_prom";
  include("sort_table.php") ?>

  <?php
  $idfiltert = "myInput_gst_prm";
  $idtbl = "myTable_prom";
  include("filter_table.php")
  ?>
  </body>
</html>
