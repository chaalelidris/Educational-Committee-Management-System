<?php
  include("includes/head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "enseignant";
  }else {
    $_SESSION["current_session"] = "enseignant";
  }

  include("includes/navbar.php");
  include("includes/sidebar.php");
 ?>


<div class="main">
  <!-- begin main -->
  <ul class="breadcrumb round-large" >
    <li><a href="dashboard.php">accueil</a></li>
    <li>Gestion des enseignants</li>
  </ul>
  <hr class="rounded">

  <!--                                                        Tableau -->
  <div class="container">
    <h2>Table des utilisateurs enseignants</h2>
    <p>Cliquez sur les en-têtes pour trier le tableau.</p>

    <input style="margin-bottom:0;" id="myInput_gst_ens" type="text" placeholder="Search..">
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
      <table class="table-all centered hoverable" id="myTable_ens">
        <tr>
          <th class="pntr" onclick="sortTable(0)">ID</th>
          <th class="pntr" onclick="sortTable(1)">nom complet</th>
          <th class="pntr" onclick="sortTable(2)">Nom d'utilisateur</th>
          <th class="pntr" onclick="sortTable(3)">Email</th>
          <th colspan="2">opération</th>
        </tr>

      <?php
        $sql = "SELECT DISTINCT u.*
                FROM tbl_users u
                JOIN tbl_user_department ud ON u.user_id = ud.user_id
                JOIN tbl_department d ON ud.department_id = d.department_id
                WHERE d.department_id = '{$_SESSION['admin_department_id']}'
                AND u.user_type = 2";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
          echo'<tr>';
            echo'<td>'.$row['user_id'].'</td>';
            echo'<td>'.$row['user_fullname'].'</td>';
            echo'<td>'.$row['user_name'].'</td>';
            echo'<td>'.$row['user_email'].'</td>';

            echo '<td class="mod_bg "><a  href="edit_user.php?edit='.$row['user_id'].'" >modifier</a></td>';
            echo '<td class="sup_bg suppr"><a  href="#" >supprimer</a></td>';
          echo'</tr>';
        }
        ?>


      </table>
    </div>
  </div>


  <!-- END MAIN -->
</div>

  <?php include("includes/modals/modal_edit_user.php"); ?>
  <?php include("includes/modals/modal_delete_user.php") ?>

  <?php include("includes/modals/modal_add_promotion.php"); ?>
  <?php include("includes/modals/modal_add_module.php"); ?>
  <?php include("includes/modals/modal_add_user.php"); ?>
  <?php include("../modal_deconnexion.php"); ?>
  <?php include("includes/scripts.php"); ?>

  <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>

  <?php
  $my_id = "myTable_ens";
  include("sort_table.php") ?>

  <?php
  $idfiltert = "myInput_gst_ens";
  $idtbl = "myTable_ens";
  include("filter_table.php")
  ?>
  </body>
</html>
