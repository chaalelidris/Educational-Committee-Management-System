
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





  <!-- =====================================                  contenus               ======================================= -->





  <div id="idfacp" class="main" >
  <!--                                                    breadcrumb                                                       -->
  <?php
  require_once("../control/config/dbcon.php");

  $promid = $_SESSION['consult_promotion_id'];
  $sql = "SELECT * FROM tbl_promo WHERE prom_id='$promid'";
  $promDataResult = mysqli_query($con, $sql);
  $rowpromDataResult = mysqli_fetch_array($promDataResult);

  ?>

  <ul class="breadcrumb" >
    <li><a href="responsable.php">accueil</a></li>
    <li>CPs <?php echo $rowpromDataResult['prom_name'];?></li>
  </ul>
  <hr class="rounded">


  <div class="cell-row">
    <div class="container cell">
      <p><button id="Arrier"class="button green hover-green"> <i class="	fa fa-chevron-left"></i> Arrière</button></p>
    </div>
    <div class="container  cell">
    </div>
  </div>


  <?php
  $idresp = $rowpromDataResult['prom_resp_id'];
  $sql = "SELECT * FROM tbl_cp INNER JOIN tbl_promo on tbl_cp.cp_prom_id = tbl_promo.prom_id AND tbl_promo.prom_resp_id='$idresp' order by cp_datetime desc";
  $resultPromCp = mysqli_query($con, $sql);
   ?>
  <div class="container">
    <?php
    $id = $idresp;
    $sql = "SELECT * FROM tbl_cp INNER JOIN tbl_promo on tbl_cp.cp_prom_id = tbl_promo.prom_id AND tbl_promo.prom_resp_id='$id' order by cp_datetime desc";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)) {
      ?>

      <div class="container light-grey" style="padding-bottom:20px;margin-bottom:20px;">
        <h1><?php echo $row['cp_title']; ?> </h1>
        <span>Programmé le <span style="color:rgba(0, 0, 0, 0.7)"><?php echo $row['cp_datetime']; ?></span></span>
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
        <div class="container" style="background-color:rgba(142, 190, 255, 0.8);margin-bottom:15px;">
          <h4>Consulter le formulaire des délégués  <i class="fa fa-book" aria-hidden="true"></i></h4>
          <?php
          $promid = $row['cp_prom_id'];
          $sql = "SELECT * FROM tbl_users INNER JOIN tbl_delegation ON tbl_users.user_id=tbl_delegation.delegation_del_id AND tbl_delegation.delegation_prom_id='$promid'";
          $resultDelegue = mysqli_query($con, $sql);
          $countresultDelegue = mysqli_num_rows($resultDelegue);


          if ($countresultDelegue > 0) {
            ?>
            <ol>
            <?php
            while ($rowresultDelegue = mysqli_fetch_array($resultDelegue)) {
              ?>
              <form class="" action="get_submitted_data.php" method="post">
                <input type="hidden" name="cpid" value="<?php echo $row['cp_id']; ?>">
                <input type="hidden" name="delid" value="<?php echo $rowresultDelegue['user_id']; ?>">
                <li style="margin-bottom:10px"><?php echo $rowresultDelegue['user_name']; ?> <button class="button green padding-small" name="consulter">Consulter <i class="fa fa-eye"></i> </button></li>
              </form>
              <?php
            }
            ?>
            </ol>

            <?php
          }else {

          }
           ?>

        </div>
        <form  action="get_submitted_data.php" method="post">
          <input type="hidden" name="cpid" value="<?php echo $row['cp_id']; ?>">
          <button name="btn_to_formulaire" class="button dark-grey right btn_frm" >FORMULAIRE <i class="fa fa-angle-double-right"></i> </button>
        </form>
      </div>


      <?php
    }
    ?>

  </div>

</div>

  <?php include("includes/modals/modal_add_promotion.php"); ?>
  <?php include("includes/modals/modal_add_module.php"); ?>
  <?php include("includes/modals/modal_add_user.php"); ?>
  <?php include("includes/modals/modal_delete_user.php") ?>
  <?php include("../modal_deconnexion.php"); ?>
  <?php include("includes/scripts.php"); ?>


  <script type="text/javascript">
  $('#Arrier').click(function(){
    window.location.assign("consulter.php");
  });
  </script>


  <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>
  </body>
</html>
