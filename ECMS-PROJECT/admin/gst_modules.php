<?php
  include("includes/head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "module";
  }else {
    $_SESSION["current_session"] = "module";
  }

  include("includes/navbar.php");
  include("includes/sidebar.php");
 ?>



<div class="main">
  <!-- begin main -->

  <ul class="breadcrumb round-large" >
    <li><a href="dashboard.php"><?=$translations['home']?></a></li>
    <li>Gestion des modules</li>
  </ul>
  <hr class="rounded">


  <div class="container">
    <h2>Table des modules</h2>
    <p><?=$translations['sort_table']?></p>

    <input style="margin-bottom:0;" id="myInput_gst_mdl" type="text" placeholder="<?=$translations['search']?>">
      <br><br>

    <?php
      require_once("../control/config/dbcon.php");
     ?>

    <?php if (isset($_SESSION['message_success'])): ?>
      <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message_success']; ?></p>
      </div>
      <?php unset($_SESSION['message_success']); ?>
    <?php endif; ?>

    <div class="responsive">
      <table class="table-all centered hoverable " id="myTable">
        <tr>
          <th class="pntr" onclick="sortTable(0)">ID</th>
          <th class="pntr" onclick="sortTable(1)"><?=$translations['module_name']?></th>
          <th class="pntr" onclick="sortTable(2)"><?=$translations['abbr']?> </th>
          <th class="pntr" onclick="sortTable(3)"><?=$translations['promotion']?></th>
          <th class="pntr" onclick="sortTable(4)"><?=$translations['semester']?></th>
          <th class="pntr" onclick="sortTable(5)"><?=$translations['teachers']?></th>
          <th class="pntr" colspan="2"><?=$translations['action']?></th>
        </tr>

      <?php
        $sqll = "SELECT modl_id,modl_name,modl_abbr,prom_name,modl_semestre,user_name FROM tbl_promo INNER JOIN tbl_module ON tbl_module.modl_promo_id = tbl_promo.prom_id AND tbl_promo.department_id = '{$_SESSION['admin_department_id']}' INNER JOIN tbl_users ON tbl_module.modl_ens_id = tbl_users.user_id order by prom_name,modl_semestre";
        $result = mysqli_query($con, $sqll) or die(mysqli_error($con));
        while ($row = mysqli_fetch_array($result)) :?>
          <tr>
            <td><?=$row['modl_id']?></td>
            <td><?=$row['modl_name']?></td>
            <td><?=$row['modl_abbr']?></td>
            <td><?=$row['prom_name']?></td>
            <td><?=$row['modl_semestre']?></td>
            <td><?=$row['user_name']?></td>


            <td class="mod_bg "><a  href="edit_module.php?edit=<?=$row['modl_id']?>" ><?=$translations['edit']?></a></td>
            <td class="sup_bg suppr_md"><a  href="#" ><?=$translations['delete']?></a></td>
          </tr>
        <?php endwhile; ?>


      </table>
    </div>
  </div>
  <!-- END MAIN -->
</div>

  <?php include("includes/modals/modal_edit_module.php"); ?>
  <?php include("includes/modals/modal_delete_module.php"); ?>

  <?php include("includes/modals/modal_add_user.php"); ?>
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
  $my_id = "myTable";
  include("sort_table.php") ?>

  <?php
  $idfiltert = "myInput_gst_mdl";
  $idtbl = "myTable";
  include("filter_table.php")
  ?>
  </body>
</html>
