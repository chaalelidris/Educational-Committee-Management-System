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





<div class="main">
  <!--                                                    breadcrumb                                                       -->
  <ul class="breadcrumb round-large">
    <li><a href="enseignant.php">accueil</a></li>
    <li>Donnés de mon module</li>
  </ul>
  <hr class="rounded">

  <?php
    require_once("../control/config/dbcon.php");
    ?>

  <div class="container">
    <?php
      $cpid = $_SESSION['cp_id'];
      $sql = "SELECT cp_title,cp_status FROM tbl_cp WHERE cp_id='$cpid'";
      $result = mysqli_query($con, $sql);
      $rowcp_TS=mysqli_fetch_assoc($result); //tableau
      $cptitle = $rowcp_TS['cp_title'];
      ?>
    <h2><span style="color:rgba(56, 148, 255, 1)">( <?php echo $cptitle; ?> )</span></h2>
    <?php
    if ($rowcp_TS['cp_status'] == 1) {
      ?><h5>Etat : <span style="color:green;">activé</span> </h5><?php
    }else {
      ?><h5>Etat : <span style="color:red">disactivé</span> </h5><?php
    }
    ?>
    <!-- <p>Cliquez sur les en-têtes pour trier le tableau.</p> -->

    <div class="cell-row">
      <div class="container cell">
        <p><button id="Arrier_enseignant" class="button green hover-green round-large"> <i class="	fa fa-chevron-left"></i> Arrière</button></p>
      </div>
      <div class="container  cell">
      </div>
    </div>




    <div class="container dark-grey card-4 round-xxlarge" style="padding-top:15px;">
      <?php
        $idens = $_SESSION['enseignant_user_id'];
        $dataid = $_SESSION['data_id'];

        $sql = "SELECT * FROM tbl_data WHERE data_id='$dataid'";
        $resultData = mysqli_query($con, $sql) or die(mysqli_error($con));

        while ($row = mysqli_fetch_array($resultData)) {
          ?>
      <div class="container light-grey card-4 round-xxlarge" style="padding-bottom:20px;margin-bottom:20px;margin-right:5%;margin-right:5%;">

        <?php if (isset($_SESSION['message_success'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message_success']; unset($_SESSION['message_success']);unset($_SESSION['message_type']); ?></p>
        </div>
        <?php endif; ?>

        <?php
          $modlid = $row['data_modl_id'];
          $sql = "SELECT modl_name,modl_semestre FROM tbl_module WHERE modl_id='$modlid'";
          $result = mysqli_query($con, $sql) or die(mysqli_error($con));
          $rowMdlData = mysqli_fetch_assoc($result);
         ?>
        <h1>Module, <strong><?php echo $rowMdlData['modl_name'];?></strong></h1>
        <?php
            $promname = $_SESSION['prom_name'];
            ?>
        <p>Promotion >> <span><?php echo $promname;?></span></p>
        <p>Semestre N° <span><?php echo $rowMdlData['modl_semestre'];?></span></p>
        <?php
            $ensid = $_SESSION['enseignant_user_id'];
            $sql = "SELECT user_fullname FROM tbl_users WHERE user_id='$ensid'";
            $resultens = mysqli_query($con, $sql) or die(mysqli_error($con));
            $rowensname = mysqli_fetch_array($resultens);
            ?>
        <p>Par : <strong style="color:rgba(0, 0, 0, 0.8)"> <i class="fa fa-user-circle-o"></i> <?php echo $rowensname['user_fullname']; ?></strong> </p>


        <div class="responsive">
          <table class="table-all card-4">
            <tr>
              <td rowspan="9" class="border" style="width:200px;">etat avancement</td>
            </tr>
            <tr>
              <td>Avancement globale</td>
              <td><?php echo $row['data_avncm_glob']; ?></td>
            </tr>
            <tr>
              <td>Nombre de chapitres achevés / En cours</td>
              <td><?php echo $row['data_nbr_chap']; ?></td>
            </tr>
            <tr>
              <td>Nombre de séances de cours faites</td>
              <td><?php echo $row['data_nbr_cours']; ?></td>
            </tr>
            <tr>
              <td>Nombre de séances de TD et TP faites</td>
              <td><?php echo $row['data_nbr_tdtp']; ?></td>
            </tr>
            <tr>
              <td>Nombre de séances (Cours, TD, TP) non faites</td>
              <td><?php echo $row['data_nbr_crtdtp']; ?></td>
            </tr>
            <tr>
              <td>Exposés + Micro</td>
              <td><?php echo $row['data_exps_micro']; ?></td>
            </tr>
            <tr>
              <td>Validation de TP </td>
              <td><?php echo $row['data_valid_tp']; ?></td>
            </tr>
            <tr>
              <td>Polycopie de cours </td>
              <td><?php echo $row['data_polycp_cour']; ?></td>
            </tr>
            <!-- end rowspan -->
          </table>
        </div>

        <form  action="get_submitted_data.php" method="post">
          <input type="hidden" name="dataid" value="<?php echo $dataid; ?>">
          <input type="hidden" name="mdlname" value="<?php echo $rowMdlData['modl_name']; ?>">

          <?php if ($rowcp_TS['cp_status'] == 1) {
            ?>
            <button name="btn_to_modifier_formulaire" class="button green right btn_frm" style="margin-top:15px;">MODIFIER LES DONNÉS <i class="fa fa-pencil"></i> </button>
            <?php
          }else{
            ?>
            <button type="button" id="btn_cp_info" class="button green right btn_frm" style="margin-top:15px;">MODIFIER LES DONNÉS <i class="fa fa-pencil"></i> </button>
            <?php
          } ?>

        </form>
      </div>
      <?php
        }
        ?>

    </div>

  </div>
</div>

<?php include("../modal_info.php"); ?>
<?php include("../modal_deconnexion.php"); ?>
<?php include("includes/scripts.php"); ?>

<script type="text/javascript">
  $('#Arrier_enseignant').click(function(){
    window.location.assign("enseignant.php");
  });

  $('#btn_cp_info').click(function(){
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
