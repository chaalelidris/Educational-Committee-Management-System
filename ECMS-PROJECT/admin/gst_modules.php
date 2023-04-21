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

  <ul class="breadcrumb" >
    <li><a href="dashboard.php">accueil</a></li>
    <li>Gestion des modules</li>
  </ul>
  <hr class="rounded">


  <div class="container">
    <h2>Table des modules</h2>
    <p>Cliquez sur les en-têtes pour trier le tableau.</p>

    <input style="margin-bottom:0;" id="myInput_gst_mdl" type="text" placeholder="Rechercher..">
      <br><br>

    <?php
      require_once("../control/config/dbcon.php");
     ?>

    <?php if (isset($_SESSION['message_suc'])): ?>
    <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container ">
      <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
      <br>
      <p><?php echo $_SESSION['message_suc']; unset($_SESSION['message_suc']); ?></p>
    </div>
    <?php endif; ?>

    <div class="responsive">
      <table class="table-all centered hoverable " id="myTable">
        <tr>
          <th class="pntr" onclick="sortTable(0)">ID</th>
          <th class="pntr" onclick="sortTable(1)">Nom module</th>
          <th class="pntr" onclick="sortTable(2)">Abbreviation </th>
          <th class="pntr" onclick="sortTable(3)">Promotion</th>
          <th class="pntr" onclick="sortTable(4)">Semestre</th>
          <th class="pntr" onclick="sortTable(5)">Enseignant</th>
          <th class="pntr" colspan="2">opération</th>
        </tr>

      <?php
        $sqll = "SELECT modl_id,modl_name,modl_abbr,prom_name,modl_semestre,user_name FROM tbl_promo RIGHT JOIN tbl_module ON tbl_module.modl_promo_id = tbl_promo.prom_id LEFT JOIN tbl_users ON tbl_module.modl_ens_id = tbl_users.user_id order by prom_name,modl_semestre";
        $result = mysqli_query($con, $sqll) or die(mysqli_error($con));
        while ($row = mysqli_fetch_array($result)) {
          echo'<tr>';
            echo'<td>'.$row['modl_id'].'</td>';
            echo'<td>'.$row['modl_name'].'</td>';
            echo'<td>'.$row['modl_abbr'].'</td>';
            echo'<td>'.$row['prom_name'].'</td>';
            echo'<td>'.$row['modl_semestre'].'</td>';
            echo'<td>'.$row['user_name'].'</td>';



            echo '<td class="mod_bg modif"><a  href="edit_module.php?edit='.$row['modl_id'].'" >modifier</a></td>';
            echo '<td class="sup_bg suppr_md"><a  href="#" >supprimer</a></td>';
          echo'</tr>';
        }
        ?>


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
