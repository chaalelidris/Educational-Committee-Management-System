<?php
  include("../head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "delegue";
  }else {
    $_SESSION["current_session"] = "delegue";
  }


  include("../navbar.php");
  include("../sidebar.php");
 ?>


  <!-- =====================================                  contenus               ======================================= -->



  <!--                                  Main content: shift it to the right by 310 pixels                                    -->
  <div class="main">
    <!--                                                    breadcrumb                                                       -->
    <ul class="breadcrumb" >
      <li><a href="admin.php">accueil</a></li>
      <li>Gestion des délégué</li>
    </ul>
    <hr class="rounded">


    <!--                                                        Tableau -->
    <div class="container">
      <h2>Table des utilisateurs délégués</h2>
      <p>Cliquez sur les en-têtes pour trier le tableau.</p>

      <!-- <input style="margin-bottom:0;" id="myInput_gst_del" type="text" placeholder="Search.."> -->
      <!-- <br><br> -->

      <!-- <button id="add_del" class="btn_btn success_btn">Ajouter un délégué</button> -->

      <div class="row-padding">
        <div class="half">
          <button id="add_del" class="btn_btn success_btn">Ajouter un délégué</button>
        </div>
        <div class="half">
          <input id="myInput_gst_del" class="input" type="text" placeholder="Rechercher..">
        </div>
      </div>

      <?php
      require_once("../control/config/dbcon.php");
       ?>

       <?php if (isset($_SESSION['message_suc'])): ?>
       <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container ">
         <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
         <br>
         <p><?php echo $_SESSION['message_suc']; unset($_SESSION['message_suc']);unset($_SESSION['message_type']); ?></p>
       </div>
       <?php endif; ?>


      <div class="responsive">
        <table class="table-all centered hoverable" id="myTable_del">
          <tr>
            <th class="pntr" onclick="sortTable(0)">ID</th>
            <th class="pntr" onclick="sortTable(1)">nom complet</th>
            <th class="pntr" onclick="sortTable(2)">Nom d'utilisateur</th>
            <th class="pntr" onclick="sortTable(3)">Promotion</th>
            <th class="pntr" onclick="sortTable(4)">Email</th>
            <th colspan="2">opération</th>
          </tr>

          <?php
            $sql = "SELECT * FROM tbl_users INNER JOIN tbl_delegation on tbl_users.user_id = tbl_delegation.delegation_del_id INNER JOIN tbl_promo ON tbl_delegation.delegation_prom_id=tbl_promo.prom_id";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
              echo'<tr>';
                echo'<td>'.$row['user_id'].'</td>';
                echo'<td>'.$row['user_fullname'].'</td>';
                echo'<td>'.$row['user_name'].'</td>';
                echo'<td>'.$row['prom_name'].'</td>';
                echo'<td>'.$row['user_email'].'</td>';

                echo '<td class="mod_bg modif"><a  href="edit_delegue.php?edit='.$row['user_id'].'" >modifier</a></td>';
                echo '<td class="sup_bg suppr"><a  href="#" >supprimer</a></td>';
              echo'</tr>';
            }
            ?>

        </table>
      </div>
    </div>



    <!-- END MAIN -->
  </div>
  <?php include("../modal_edit_delegue.php"); ?>
  <?php include("../modal_ajouter_delegue.php"); ?>
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
  $my_id = "myTable_del";
  include("sort_table.php") ?>

  <?php
  $idfiltert = "myInput_gst_del";
  $idtbl = "myTable_del";
  include("filter_table.php")
  ?>


  <script type="text/javascript">
    // show Ajouter délégué modal
    document.querySelector('#add_del').addEventListener('click', function() {
      modal11.className = modal11.className.replace(" hide", " show");
    });
  </script>


  </body>
</html>
