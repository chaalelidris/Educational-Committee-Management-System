<?php
  include("includes/head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "promotion";
  }else {
    $_SESSION["current_session"] = "promotion";
  }

  include("includes/navbar.php");
  include("includes/sidebar.php");
 ?>



<div class="main">
  <!-- begin main -->

  <ul class="breadcrumb" >
    <li><a href="dashboard.php">accueil</a></li>
    <li>Gestion des promotions</li>
  </ul>
  <hr class="rounded">


  <div class="container">
    <h2>Table des promotions</h2>
    <p>Cliquez sur les en-têtes pour trier le tableau.</p>

    <input style="margin-bottom:0;" id="myInput_gst_prm" type="text" placeholder="Search..">
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
              <table class="table-all centered hoverable" id="myTable_prom">
                      <tr>
                        <th class="pntr" onclick="sortTable(0)">ID</th>
                        <th class="pntr" onclick="sortTable(1)">nom promotion</th>
                        <th class="pntr" onclick="sortTable(2)">responsable de promotion</th>
                        <th colspan="2">opération</th>
                      </tr>

                      <?php
                        $sqll = "SELECT * FROM tbl_users RIGHT JOIN tbl_promo ON tbl_users.user_id = tbl_promo.prom_resp_id ";
                        $result = mysqli_query($con, $sqll) or die(mysqli_error($con));
                        while ($row = mysqli_fetch_array($result)) {
                          echo'<tr>';
                          echo'<td>'.$row['prom_id'].'</td>';
                          echo'<td>'.$row['prom_name'].'</td>';
                          echo'<td>'.$row['user_name'].'</td>';

                          echo '<td class="mod_bg modif"><a  href="edit_promo.php?edit='.$row['prom_id'].'" >modifier</a></td>';
                          echo '<td class="sup_bg suppr_pr"><a  href="#" >supprimer</a></td>';
                          echo'</tr>';
                        }
                      ?>

              </table>
        </div>
  </div>


  <!-- END MAIN -->
</div>

  <?php include("includes/modals/modal_edit_promo.php"); ?>
  <?php include("includes/modals/modal_delete_promo.php"); ?>

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
  $my_id = "myTable_prom";
  include("sort_table.php") ?>

  <?php
  $idfiltert = "myInput_gst_prm";
  $idtbl = "myTable_prom";
  include("filter_table.php")
  ?>
  </body>
</html>
