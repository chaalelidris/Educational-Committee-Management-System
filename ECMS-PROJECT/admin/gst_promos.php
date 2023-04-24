<?php
  require_once("../control/config/dbcon.php");
     
  include("includes/head.php");
  include("includes/navbar.php");
  include("includes/sidebar.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
  }
  
  $_SESSION["current_session"] = "promotion";

?>



<div class="main">
  <!-- begin main -->

  <ul class="breadcrumb round-large">
    <li><a href="dashboard.php">accueil</a></li>
    <li>Gestion des promotions</li>
  </ul>
  <hr class="rounded">


  <div class="container">
    <h2>Table des promotions</h2>
    <p>Cliquez sur les en-têtes pour trier le tableau.</p>

    <input style="margin-bottom:0;" id="myInput_gst_prm" type="text" placeholder="Search..">
    <br><br>

    

    <?php if (isset($_SESSION['message_success'])): ?>
    <div class="panel green display-container round-large ">
      <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
      <br>
      <p>
        <?php echo $_SESSION['message_success']; unset($_SESSION['message_success']); ?>
      </p>
    </div>
    <?php endif; ?>

    <div class="responsive">
      <table class="table-all centered hoverable" id="myTable_prom">
        <tr>
          <th class="pntr" onclick="sortTable(0)">ID</th>
          <th class="pntr" onclick="sortTable(1)">nom promotion</th>
          <th class="pntr" onclick="sortTable(2)">responsable de promotion</th>
          <th colspan="2">Action</th>
        </tr>

        <?php
          $sqll = "SELECT * FROM tbl_users INNER JOIN tbl_promo ON tbl_users.user_id = tbl_promo.prom_resp_id and tbl_promo.department_id='{$_SESSION['admin_department_id']}'";
          $result = mysqli_query($con, $sqll) or die(mysqli_error($con));
        ?>

        <?php while ($row = mysqli_fetch_array($result)): ?>
        <tr>
          <td>
            <?php echo $row['prom_id'] ?>
          </td>
          <td>
            <?php echo $row['prom_name'] ?>
          </td>
          <td>
            <?php echo $row['user_name'] ?>
          </td>

          <td><a class="button green hover-green" href="edit_promo.php?edit=<?php echo $row['prom_id'] ?>">modifier</a></td>
          <td><a class="button red hover-red suppr_pr">supprimer</a></td>
        </tr>
        <?php endwhile; ?>

      </table>
    </div>
  </div>


  <!-- END MAIN -->
</div>

<?php include("includes/modals/modal_add_promotion.php"); ?>
<?php include("includes/modals/modal_edit_promo.php"); ?>
<?php include("includes/modals/modal_delete_promo.php"); ?>

<?php include("includes/modals/modal_add_user.php"); ?>
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
  include("sort_table.php") 
?>

<?php $idfiltert = "myInput_gst_prm";
      $idtbl = "myTable_prom";
      include("filter_table.php")?>
</body>

</html>