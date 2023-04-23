
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





  <!-- =====================================                  contenus               ======================================= -->





  <div class="main" >
    <!--                                                    breadcrumb                                                       -->
    <ul class="breadcrumb round-large" >
      <li><a href="enseignant.php">accueil</a></li>
    </ul>
    <hr class="rounded">

    <?php
    require_once("../control/config/dbcon.php");
    ?>


    <div class="row ">
      <div class="twothird container">

        <div class="container">
          <?php

          $id = $_SESSION['enseignant_user_id'];
          $sqlCpRows = "SELECT * FROM tbl_cp INNER JOIN tbl_module on tbl_cp.cp_prom_id = tbl_module.modl_promo_id AND tbl_module.modl_ens_id='$id' AND tbl_cp.cp_semestre = tbl_module.modl_semestre order by cp_datetime desc";
          $result = mysqli_query($con, $sqlCpRows);
          $countrs = mysqli_num_rows($result);


          if ($countrs > 0) :
            $promnamerow = mysqli_fetch_array($result);
            $promid = $promnamerow['modl_promo_id'];
            $sql = "SELECT prom_name FROM tbl_promo WHERE prom_id='$promid'";
            $result1 = mysqli_query($con, $sql) or die(mysqli_error($con));
            $rowprom = mysqli_fetch_array($result1);
            ?>

            <h1><strong style="color:rgb(0, 142, 82)"> CPs promotion <?php echo $rowprom['prom_name']; ?></strong></h1>
            <?php $result = mysqli_query($con, $sqlCpRows); ?>
            <?php while ($row = mysqli_fetch_array($result)) {

                    ?>

              <?php
              $usrid = $_SESSION['enseignant_user_id'];
              $modlid = $row['modl_id'];
              $cp_id = $row['cp_id'];
              $querydata=mysqli_query($con, "SELECT data_id,data_usr_id,data_modl_id,data_cp_id from tbl_data WHERE data_usr_id='$usrid' AND data_modl_id='$modlid' AND data_cp_id='$cp_id'") or die (mysqli_error($con));
              $countrowremplis = mysqli_num_rows($querydata);
              ?>


              <?php if (isset($_SESSION['message_success'])): ?>
                <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
                  <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
                  <br>
                  <p><?php echo $_SESSION['message_success']; unset($_SESSION['message_success']);unset($_SESSION['message_type']); ?></p>
                </div>
              <?php endif; ?>

              <?php if($countrowremplis > 0): ?>
              <div class="container " style="padding-bottom:20px;margin-bottom:20px;background-color:rgba(54, 245, 102, 0.38)">
              <p class="right">Statut: <span class="tag" style="background-color:rgba(0, 218, 94, 0.86)">Terminé</span></p>
              <?php else: ?>
              <div class="container" style="padding-bottom:20px;margin-bottom:20px;background-color:rgba(255, 80, 80, 0.3)">
              <?php endif; ?>
                <!-- success message -->

                <h1><?php echo $row['cp_title']; ?> </h1>
                <span>Programmé le <span style="color:rgba(0, 0, 0, 0.7)"><?php echo $row['cp_datetime']; ?></span></span>
                <p> Promotion <span style="color:rgba(0, 0, 0, 0.7)"><?php echo $rowprom['prom_name']; ?></span></p>
                <p> Module >> <span style="color:rgba(0, 0, 0, 0.7)"><?php echo $row['modl_name']; ?></span></p>
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
                <form  action="get_submitted_data.php" method="post">
                  <?php
                  $rowquerydata = mysqli_fetch_array($querydata);
                  ?>
                  <input type="hidden" name="cp_id" value="<?php echo $row['cp_id']; ?>">
                  <input type="hidden" name="mdlid" value="<?php echo $row['modl_id']; ?>">
                  <input type="hidden" name="dataid" value="<?php echo $rowquerydata['data_id']; ?>">
                  <input type="hidden" name="mdlname" value="<?php echo $row['modl_name']; ?>">
                  <input type="hidden" name="promname" value="<?php echo $rowprom['prom_name']; ?>">

                  <?php if($countrowremplis > 0): ?>
                  <button name="btn_to_mydata_formulaire" class="button green right btn_frm" >AFFICHER ET MODIFIER LES DONNÉS DE MON MODULE <i class="fa fa-angle-double-right"></i> </button>
                  <?php else: ?>

                    <?php if ($row['cp_status'] == 1) {
                      ?>
                      <button name="btn_to_formulaire" class="button dark-grey right btn_frm" >REMPLIR AVANCEMENT <i class="fa fa-angle-double-right"></i> </button>
                      <?php
                    }else{
                      ?>
                      <button type="button" id="btn_cp_info" class="button dark-grey right btn_frm" >REMPLIR AVANCEMENT <i class="fa fa-angle-double-right"></i> </button>
                      <?php
                    } ?>

                  <?php endif; ?>

                </form>
              </div>
                    <?php

                  }?>

          <?php else:?>
              <div class="container light-grey card-4 round-xxlarge" style="padding-bottom:20px;margin-bottom:20px;">
                <h1 style="color:rgba(0, 0, 0, 0.53)"> il n'y a pas de CP activé Actuellement !</h1>
              </div>
          <?php endif; ?>

        </div>

      </div>
      <div class="third container">


        <?php if (isset($_SESSION['message_edit_pass_succ'])): ?>
          <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
            <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
            <br>
            <p><?php echo $_SESSION['message_edit_pass_succ']; unset($_SESSION['message_edit_pass_succ']); ?></p>
          </div>
        <?php endif; ?>


        <?php if (isset($_SESSION['message_edit_pass_err'])): ?>
          <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
            <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
            <br>
            <p><?php echo $_SESSION['message_edit_pass_err']; unset($_SESSION['message_edit_pass_err']); ?></p>
          </div>
        <?php endif; ?>


        <div class="card_prf theme-light padding round-xxlarge">
          <h3 style="text-align:center">Utilisateur : <span style="color:rgba(0, 0, 0, 0.67)"> <?php echo $_SESSION['enseignant_user_name']; ?></span></h3>
          <h1><?php echo $_SESSION['enseignant_user_fullname']; ?></h1>

          <?php
          $idens = $_SESSION['enseignant_user_id'];
          $query=mysqli_query($con, "SELECT * from tbl_module INNER JOIN  tbl_promo ON tbl_module.modl_promo_id=tbl_promo.prom_id AND tbl_module.modl_ens_id='$idens'") or die(mysqli_error($con));
           ?>
           <p class="title"><strong style="color:rgb(252, 87, 87);">Enseignant de(s) module(s)</strong><br>   </p>
           <?php
          while ($row=mysqli_fetch_assoc($query)):?>
          <span style="color:rgba(0, 0, 0, 0.69);"><?php echo $row['modl_name'] ." | promo ".$row['prom_name']." | sem ".$row['modl_semestre'];?></span> <br>
          <?php endwhile;?>

          <p><button id="ChangePass" class="button_prf round-xlarge">Changer mot de passe</button></p>
        </div>

      </div>
    </div>

  </div>

  <?php include("../modal_info.php"); ?>
  <?php include("modal_change_pass.php"); ?>
  <?php include("../modal_deconnexion.php"); ?>
  <?php include("includes/scripts.php"); ?>



  <?php include("snakebar.php"); ?>

  <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>
  </body>
</html>
