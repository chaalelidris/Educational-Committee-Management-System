
<?php
  include("includes/head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "delegue";
  }else {
    $_SESSION["current_session"] = "delegue";
  }

  include("includes/navbar.php");
  include("includes/sidebar.php");
 ?>





  <!-- =====================================                  contenus               ======================================= -->





  <div class="main " >
    <!--                                                    breadcrumb                                                       -->
    <ul class="breadcrumb round-large" >
      <li><a href="delegue.php">accueil</a></li>
      <li>Liste des modules</li>
    </ul>
    <hr class="rounded">

    <?php
    require_once("../control/config/dbcon.php");
    ?>


    <div class="cell-row">
      <div class="container cell">
        <p><button id="accueil_return" class="button green hover-green round-large"> <i class="	fa fa-chevron-left"></i> Arrière</button></p>
      </div>
      <div class="container  cell">
      </div>
    </div>



    <div class="container">

      <h1><strong style="color:#191923">Liste des Modules </strong></h1>


      <?php if (isset($_SESSION['message_success'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message_success']; unset($_SESSION['message_success']); ?></p>
        </div>
      <?php endif; ?>


      <?php
      $id = $_SESSION['delegue_user_id'];
      $cpid = $_SESSION['cp_id'];
      $sqlCpRows = "SELECT * FROM tbl_cp INNER JOIN tbl_module on tbl_cp.cp_prom_id = tbl_module.modl_promo_id AND tbl_cp.cp_semestre = tbl_module.modl_semestre AND cp_id='$cpid'";
      $result = mysqli_query($con, $sqlCpRows);
      $countresult = mysqli_num_rows($result);

      if ($countresult > 0) {

        while ($row = mysqli_fetch_array($result)) {
          ?>


          <?php
          $usrid = $_SESSION['delegue_user_id'];
          $modlid = $row['modl_id'];
          $cpid = $row['cp_id'];
          $querydata=mysqli_query($con, "SELECT data_id,data_usr_id,data_modl_id,data_cp_id from tbl_data WHERE data_usr_id='$usrid' AND data_modl_id='$modlid' AND data_cp_id='$cpid'") or die (mysqli_error($con));
          $countrowremplis = mysqli_num_rows($querydata);
          ?>

          <?php if($countrowremplis > 0): ?>
          <div class="container " style="padding-bottom:20px;margin-bottom:20px;background-color:rgba(54, 245, 102, 0.38)">
          <p class="right">Statut: <span class="tag" style="background-color:rgba(0, 218, 94, 0.86)">Terminé</span></p>
          <?php else: ?>
            <div class="container" style="padding-bottom:20px;margin-bottom:20px;background-color:rgba(255, 80, 80, 0.3)">
          <?php endif; ?>


            <h1><?php echo $row['modl_name']; ?></h1>
            <div class="container" style="background-color:rgba(142, 190, 255, 0.8);margin-bottom:15px;">
              <h3 style="color:rgb(0, 109, 252)">Détails sur le CP <i class="fa fa-book" style="font-size:24px"></i></h3>
              <p>Titre: <?php echo $row['cp_title']; ?></p>
              <span>Programmé le <span style="color:rgba(0, 0, 0, 0.7)"><?php echo $row['cp_datetime']; ?></span></span>
              <?php
              $promid = $_SESSION['delegue_promotion_id'];
              $sql = "SELECT prom_name FROM tbl_promo WHERE prom_id='$promid'";
              $resultPromName = mysqli_query($con, $sql);
              $resultPromName = mysqli_fetch_array($resultPromName);
              ?>
              <p> Promotion <span style="color:rgba(0, 0, 0, 0.7)"><?php echo $resultPromName['prom_name']; ?></span></p>
              <p> Semestre N° <span style="color:rgba(0, 0, 0, 0.7)"><?php echo $row['cp_semestre']; ?></span></p>

              <p>Le lieu : <span style="color:rgba(0, 0, 0, 0.7)"><?php echo $row['cp_location']; ?> </span> </p>
              <p> <strong>Ordre du jour :</strong> <?php echo $row['cp_ordre']; ?></p>
              <!-- <button class="button dark-grey right" onclick="ReadMore()" >Lire la suite</button> -->
              <?php
              if ($row['cp_status'] == 1) {
                ?><h5>Etat : <span style="color:green;">activé</span> </h5><?php
              }else {
                ?><h5>Etat : <span style="color:red">disactivé</span> </h5><?php
              }
              ?>
            </div>


            <form  action="get_submitted_data.php" method="post">
              <?php
                $rowquerydata = mysqli_fetch_array($querydata);
               ?>
              <input type="hidden" name="cpid" value="<?php echo $row['cp_id']; ?>">
              <input type="hidden" name="mdlid" value="<?php echo $row['modl_id']; ?>">
              <input type="hidden" name="mdlname" value="<?php echo $row['modl_name']; ?>">
              <input type="hidden" name="dataid" value="<?php echo $rowquerydata['data_id']; ?>">


              <?php if($countrowremplis > 0): ?>

                <?php if ($row['cp_status'] == 1) {
                  ?>
                  <button name="btn_to_mydata_formulaire" class="button green right btn_frm" >DONNÉS DE MODULE <i class="fa fa-angle-double-right"></i> </button>
                  <?php
                }else{
                  ?>
                  <button type="button" class="button green right btn_frm btn_cp_info" >DONNÉS DE MODULE <i class="fa fa-angle-double-right"></i> </button>

                  <?php
                } ?>

              <?php else: ?>
                <?php if ($row['cp_status'] == 1) {
                  ?>
                  <button name="btn_to_addmdl_data" class="button dark-grey right btn_frm" >REMPLIR FORMULAIRE <i class="fa fa-angle-double-right"></i> </button>

                  <?php
                }else{
                  ?>
                  <button type="button" class="button dark-grey right btn_frm btn_cp_info" >REMPLIR FORMULAIRE <i class="fa fa-angle-double-right"></i> </button>
                  <?php
                } ?>
              <?php endif; ?>

            </form>
          </div>


          <?php
        }

      }else {

        ?>
        <div class="container light-grey card-4 round-xxlarge" style="padding-bottom:20px;margin-bottom:20px;">
          <h1 style="color:rgba(0, 0, 0, 0.53)"> aucun module !</h1>
        </div>
        <?php

      }
      ?>


    </div>

  </div>

  <?php include("../modal_info.php"); ?>
  <?php include("modal_change_pass.php"); ?>
  <?php include("../modal_deconnexion.php"); ?>
  <?php include("includes/scripts.php"); ?>

  <script type="text/javascript">
    $('#accueil_return').click(function(){
      window.location.assign("delegue.php");
    });

    // Get the modal cp desactiver
    var modalCpInfo = document.getElementById('idinfo');
    $('.btn_cp_info').click(function(){
      modalCpInfo.style.display = "block";
    });

  </script>


  <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>
  </body>
</html>
