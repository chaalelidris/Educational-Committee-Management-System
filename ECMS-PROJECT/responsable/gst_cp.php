
<?php
  include("includes/head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "responsable";
  }else {
    $_SESSION["current_session"] = "responsable";
  }

  include("includes/navbar.php");
  include("includes/sidebar.php");
 ?>





  <!-- =====================================                  contenus               ======================================= -->




  <?php if (isset($_SESSION['switch_facp'])): ?>
    <div id="idpcp" class="main hide" >
    <?php elseif (isset($_SESSION['switch_fmdcp'])): ?>
      <div id="idpcp" class="main hide" >
      <?php else: ?>
          <div id="idpcp" class="main show" >
            <?php endif; ?>
    <!--                                                    breadcrumb                                                       -->
    <ul class="breadcrumb" >
      <li><a href="responsable.php">accueil</a></li>
      <li>Programmation CP <?php echo $_SESSION['responsable_prom_name']; ?></li>
    </ul>
    <hr class="rounded">

    <?php
    require_once("../control/config/dbcon.php");
    ?>




    <div class="container">
      <h2>Table des Réunions programmé</h2>
      <!-- <p>Cliquez sur les en-têtes pour trier le tableau.</p> -->


      <div class="cell-row">

        <div class="container cell">
          <p><button id="activer_cp" class="button green hover-green">Ajouter un CP  <i class="fa fa-calendar"></i> </button></p>
        </div>

        <div class="container  cell">

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
            <th class="pntr" onclick="sortTable(1)">Titre CP</th>
            <th class="pntr" onclick="sortTable(2)">Date et Heure</th>
            <th class="pntr" onclick="sortTable(3)">Lieu</th>
            <th class="pntr" onclick="sortTable(4)">Semestre</th>
            <th class="pntr" onclick="sortTable(5)">Ordre du jour</th>
            <th class="pntr" onclick="sortTable(5)">Détailes</th>
            <th class="pntr" onclick="sortTable(5)">Interventions diverses.</th>
            <th colspan="3">opération</th>
          </tr>

          <?php
            $id = $_SESSION['responsable_user_id'];
            $sql = "SELECT * FROM tbl_cp INNER JOIN tbl_promo on tbl_cp.cp_prom_id = tbl_promo.prom_id AND tbl_promo.prom_resp_id=$id order by cp_datetime desc";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
              echo'<tr>';
                echo'<td>'.$row['cp_id'].'</td>';
                echo'<td>'.$row['cp_title'].'</td>';
                echo'<td>'.$row['cp_datetime'].'</td>';
                echo'<td>'.$row['cp_location'].'</td>';
                echo'<td>'.$row['cp_semestre'].'</td>';
                echo'<td>'.$row['cp_ordre'].'</td>';
                echo'<td>'.$row['cp_detail'].'</td>';
                echo'<td>'.$row['cp_intervension'].'</td>';

                // echo '<td class="mod_bg modif"><a  href="edit_cp.php?edit='.$row['cp_id'].'" >modifier</a></td>';
                if ($row['cp_status'] == 1) {
                  echo '<td style="padding:0;"><button class="btn_da_cp" type="button" ><a href="activer_cp.php?desactiv_cp='.$row['cp_id'].'" >Désactiver</a></button></td>';
                }elseif ($row['cp_status'] == 0) {
                  echo '<td style="padding:0;"><button class="btn_a_cp" type="button" ><a href="activer_cp.php?activer_cp='.$row['cp_id'].'" >Activer</a></button></td>';
                }
                echo '<td style="padding:0;"><button class="btn_m_cp" type="button" ><a href="edit_cp.php?edit='.$row['cp_id'].'" >modifier</a></button></td>';
                echo '<td style="padding:0;"><button class="btn_d_cp btn_delet_cp" type="button" >supprimer</button></td>';
              echo'</tr>';
            }
            ?>
        </table>
      </div>
    </div>

  </div>


  <?php include("Form_activer_cp.php"); ?>
  <?php include("form_modifier_cp.php"); ?>
  <?php include("modal_delete_cp.php"); ?>
  <?php include("../modal_deconnexion.php"); ?>
  <?php include("includes/scripts.php"); ?>






  <script type="text/javascript">
    var page1 = document.getElementById('idpcp');
    var page2 = document.getElementById('idfacp');
    var page3 = document.getElementById('idfmdcp');
    var modal_del_cp = document.getElementById('iddcp');

    window.onclick = function(event) {
      if (event.target == modal_del_cp) {
        modal_del_cp.style.display = "none";
      }
    }


    $('#activer_cp').click(function(){
      page1.className = page1.className.replace(" show", " hide");
      page2.className = page2.className.replace(" hide", " show");

      $.post("set_switch_page.php",
      {
        setfacp: 'ok',
      },
      function(data,status){
        // alert("Data: " + data + "\nStatus: " + status);
      });
    });

    $('#programmer_cp').click(function(){
      page1.className = page1.className.replace(" hide", " show");
      page2.className = page2.className.replace(" show", " hide");

      $.post("set_switch_page.php",
      {
        setpcpprg: 'ok',
      },
      function(data,status){
        // alert("Data: " + data + "\nStatus: " + status);
      });
    });
    $('#modifier_cp').click(function(){
      page1.className = page1.className.replace(" hide", " show");
      page3.className = page3.className.replace(" show", " hide");

      $.post("set_switch_page.php",
      {
        setpcpmdf: 'ok',
      },
      function(data,status){
        // alert("Data: " + data + "\nStatus: " + status);
      });
    });

    $(".btn_delet_cp").click(function(){
      document.getElementById('iddcp').style.display = "block";
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function(){
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_cp_id').val(data[0]);

    });


  </script>






  <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>
  </body>
</html>
