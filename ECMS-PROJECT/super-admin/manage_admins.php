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





  <!-- ===================================== CONTENT ======================================= -->

  <!--                                  Main content: shift it to the right by 310 pixels                                    -->
  <div class="main">
    <ul class="breadcrumb round-large" >
      <li><a href="admin.php">accueil</a></li>
      <li>Gestion des Administrateurs</li>
    </ul>
    <hr class="rounded">



    <!--  TABLE -->
    <div class="container">
      <h2>Table des utilisateurs administrateurs</h2>
      <p>Cliquez sur les en-têtes pour trier le tableau.</p>

      <input style="margin-bottom:0;" id="myInput_gst_res" type="text" placeholder="Search..">
      <br><br>

      <?php
        require_once("../control/config/dbcon.php");
        if (isset($_SESSION['message_success'])): ?>
       <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
         <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
         <br>
         <p><?php echo $_SESSION['message_success']; unset($_SESSION['message_success']); ?></p>
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
        $sql = "SELECT * FROM tbl_users WHERE user_type= 'admin'";
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
  <?php include("includes/modals/modal_add_user.php"); ?>
  <?php include("includes/modals/modal_edit_user.php"); ?>
  <?php include("includes/modals/modal_delete_user.php") ?>

  <?php include("includes/modals/modal_add_department.php"); ?>
  

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
