<?php
  include("../head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "responsable";
  }else {
    $_SESSION["current_session"] = "responsable";
  }

  include("../navbar.php");
  include("../sidebar.php");
 ?>





  <!-- =====================================                  contenus               ======================================= -->



  <!--                                  Main content: shift it to the right by 310 pixels                                    -->
  <div class="main">
    <ul class="breadcrumb" >
      <li><a href="admin.php">accueil</a></li>
      <li>Gestion des Responsables de parcours</li>
    </ul>
    <hr class="rounded">



    <!--                                                        Tableau -->
    <div class="container">
      <h2>Table des utilisateurs résponsables de parcours</h2>
      <p>Cliquez sur les en-têtes pour trier le tableau.</p>

      <input style="margin-bottom:0;" id="myInput_gst_res" type="text" placeholder="Search..">
      <br><br>

      <?php
        require_once("../control/config/dbcon.php");
        if (isset($_SESSION['message_suc'])): ?>
       <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container ">
         <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
         <br>
         <p><?php echo $_SESSION['message_suc']; unset($_SESSION['message_suc']); ?></p>
       </div>
       <?php endif; ?>


      <div class="responsive">
        <table class="table-all centered hoverable" id="myTable_resp">
          <tr>
            <th class="pntr" onclick="sortTable(0)">ID</th>
            <th class="pntr" onclick="sortTable(1)">nom complet</th>
            <th class="pntr" onclick="sortTable(2)">Nom d'utilisateur</th>
            <th class="pntr" onclick="sortTable(3)">Email</th>
            <th colspan="2">opération</th>
          </tr>

          <?php
        $sql = "SELECT * FROM tbl_users WHERE user_type= '1'";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
          echo'<tr>';
            echo'<td>'.$row['user_id'].'</td>';
            echo'<td>'.$row['user_fullname'].'</td>';
            echo'<td>'.$row['user_name'].'</td>';
            echo'<td>'.$row['user_email'].'</td>';

            echo '<td class="mod_bg modif"><a  href="edit_user.php?edit='.$row['user_id'].'" >modifier</a></td>';
            echo '<td class="sup_bg suppr"><a href="#" >supprimer</a></td>';
          echo'</tr>';
        }
        ?>

        </table>
      </div>
    </div>

    <!-- END MAIN -->
  </div>
  <?php include("../modal_edituser.php"); ?>
  <?php include("../modal_delete_user.php") ?>

  <?php include("../modal_ajouter_promo.php"); ?>
  <?php include("../modal_ajouter_module.php"); ?>
  <?php include("../modal_ajouterutilisateur.php"); ?>
  <?php include("../modal_deconnexion.php"); ?>
  <?php include("scripts.php"); ?>

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
