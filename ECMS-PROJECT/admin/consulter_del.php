
<?php
  include("../head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "admin";
  }else {
    $_SESSION["current_session"] = "admin";
  }

  include("../navbar.php");
  include("../sidebar.php");
 ?>





  <!-- =====================================                  contenus               ======================================= -->





  <div class="main " >
    <!--                                                    breadcrumb                                                       -->
    <?php
    require_once("../control/config/dbcon.php");
    ?>

    <?php
    $promid = $_SESSION['consult_promotion_id'];
    $sql = "SELECT * FROM tbl_promo WHERE prom_id='$promid'";
    $promDataResult = mysqli_query($con, $sql);
    $rowpromDataResult = mysqli_fetch_array($promDataResult);
     ?>



    <ul class="breadcrumb" >
      <li><a href="#">accueil</a></li>
      <li>CPs <?php echo $rowpromDataResult['prom_name'];?></li>
      <li>Consulter formulaire de délégué</li>
    </ul>
    <hr class="rounded">


    <div class="container">
      <?php
      $cpid = $_SESSION['cp_id'];
      $sql = "SELECT cp_title FROM tbl_cp WHERE cp_id='$cpid'";
      $result = mysqli_query($con, $sql);
      $rowcptitle=mysqli_fetch_assoc($result); //tableau
      $cptitle = $rowcptitle['cp_title'];
       ?>
      <h2>Consulter CP <span style="color:rgba(56, 148, 255, 1)">( <?php echo $cptitle; ?> )</span></h2>
      <!-- <p>Cliquez sur les en-têtes pour trier le tableau.</p> -->


      <div class="cell-row">
        <div class="container cell">
          <p><button id="Arrier_cps"class="button green hover-green"> <i class="	fa fa-chevron-left"></i> Arrière</button></p>
        </div>
        <div class="container  cell">
        </div>
      </div>



      <div class="container dark-grey" style="padding-top:15px;">
        <?php
        $promid = $_SESSION['consult_promotion_id'];
        $sql = "SELECT * FROM tbl_promo WHERE prom_id='$promid'";
        $promDataResult = mysqli_query($con, $sql);
        $rowpromDataResult = mysqli_fetch_array($promDataResult);


          $idresp = $rowpromDataResult['prom_resp_id'];

          $query=mysqli_query($con, "SELECT * from tbl_promo where prom_resp_id='$idresp' LIMIT 1 ");
          $row1=mysqli_fetch_assoc($query); //tableau
          $promid=$row1['prom_id'];

          $cpid = $_SESSION['cp_id'];
          $sql = "SELECT cp_semestre FROM tbl_cp WHERE cp_id='$cpid'";
          $result = mysqli_query($con, $sql);
          $row2=mysqli_fetch_assoc($result); //tableau
          $semestre = $row2['cp_semestre'];

          $sql = "SELECT * FROM tbl_module WHERE modl_promo_id='$promid' AND modl_semestre='$semestre'";
          $result = mysqli_query($con, $sql) or die(mysqli_error($con));

          while ($row = mysqli_fetch_array($result)) {
        ?>
          <div class="container light-grey" style="padding-bottom:20px;margin-bottom:20px;margin-right:5%;margin-right:5%;">

            <?php if (isset($_SESSION['message_suc'])): ?>
              <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container ">
                <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
                <br>
                <p><?php echo $_SESSION['message_suc']; unset($_SESSION['message_suc']);unset($_SESSION['message_type']); ?></p>
              </div>
            <?php endif; ?>


            <h1>Module, <strong><?php echo $row['modl_name'];?></strong></h1>
            <?php
            $sql = "SELECT prom_name FROM tbl_promo WHERE prom_id=$promid";
            $resultpromname = mysqli_query($con, $sql) or die(mysqli_error($con));
            $resultpromnamerow = mysqli_fetch_array($resultpromname);
             ?>
            <p>Promotion >> <span><?php echo $resultpromnamerow['prom_name'];?></span></p>
            <p>Semestre N° <span><?php echo $row['modl_semestre'];?></span></p>
            <?php
            $delid =$_SESSION['del_id'];
            $sql = "SELECT user_fullname FROM tbl_users WHERE user_id='$delid'";
            $resultens = mysqli_query($con, $sql) or die(mysqli_error($con));
            $rowensname = mysqli_fetch_array($resultens);
             ?>
            <p>Par : <strong style="color:rgba(0, 0, 0, 0.8)"> <i class="fa fa-user-circle-o"></i> <?php echo $rowensname['user_fullname']; ?></strong> </p>

            <div class="responsive">
              <?php
                $mdlid = $row['modl_id'];
                $sql = "SELECT * FROM tbl_data WHERE data_usr_id='$delid' AND data_modl_id='$mdlid' AND data_cp_id='$cpid'";
                $resultcount = mysqli_query($con, $sql);
                $countdata = mysqli_num_rows($resultcount);

                if ($countdata > 0) {
                  $row3 = mysqli_fetch_array($resultcount);
                  ?>
                  <table class="table-all card-4">
                    <tr >
                      <td  rowspan="9" class="border" style="width:200px;">etat avancement</td>
                    </tr>
                    <tr>
                      <td>Avancement globale</td>
                      <td><?php echo $row3['data_avncm_glob']; ?></td>
                    </tr>
                    <tr>
                      <td>Nombre de chapitres achevés / En cours</td>
                      <td><?php echo $row3['data_nbr_chap']; ?></td>
                    </tr>
                    <tr>
                      <td>Nombre de séances de cours faites</td>
                      <td><?php echo $row3['data_nbr_cours']; ?></td>
                    </tr>
                    <tr>
                      <td>Nombre de séances de TD et TP faites</td>
                      <td><?php echo $row3['data_nbr_tdtp']; ?></td>
                    </tr>
                    <tr>
                      <td>Nombre de séances (Cours, TD, TP) non faites</td>
                      <td><?php echo $row3['data_nbr_crtdtp']; ?></td>
                    </tr>
                    <tr>
                      <td>Exposés + Micro</td>
                      <td><?php echo $row3['data_exps_micro']; ?></td>
                    </tr>
                    <tr>
                      <td>Validation de TP </td>
                      <td><?php echo $row3['data_valid_tp']; ?></td>
                    </tr>
                    <tr>
                      <td>Polycopie de cours </td>
                      <td><?php echo $row3['data_polycp_cour']; ?></td>
                    </tr>
                    <!-- end rowspan -->
                  </table>
                  <?php
                }else{
                  ?>
                  <table class="table-all card-4">
                    <tr >
                      <td  rowspan="9" class="border" style="width:200px;">etat avancement</td>
                    </tr>
                    <tr>
                      <td>Avancement globale</td>
                      <td>aucun donnés</td>
                    </tr>
                    <tr>
                      <td>Nombre de chapitres achevés / En cours</td>
                      <td>aucun donnés</td>
                    </tr>
                    <tr>
                      <td>Nombre de séances de cours faites</td>
                      <td>aucun donnés</td>
                    </tr>
                    <tr>
                      <td>Nombre de séances de TD et TP faites</td>
                      <td>aucun donnés</td>
                    </tr>
                    <tr>
                      <td>Nombre de séances (Cours, TD, TP) non faites</td>
                      <td>aucun donnés</td>
                    </tr>
                    <tr>
                      <td>Exposés + Micro</td>
                      <td>aucun donnés</td>
                    </tr>
                    <tr>
                      <td>Validation de TP </td>
                      <td>aucun donnés</td>
                    </tr>
                    <tr>
                      <td>Polycopie de cours </td>
                      <td>aucun donnés</td>
                    </tr>
                    <!-- end rowspan -->
                  </table>
                  <?php
                }
              ?>
            </div>


            <?php
              if ($countdata > 0) {
                ?>
                <form class="" action="get_submitted_data.php" method="post">
                  <input  type="hidden" name="mdlname" value="<?php echo $row['modl_name'];?>">
                  <input  type="hidden" name="dataid" value="<?php echo $row3['data_id']; ?>">
                  <button name="btn_to_edit_data"class="button green  right btn_frm" onclick="Load()" style="margin-top:18px;">Modifier les donnés <i class="fa fa-pencil"></i> </button>
                </form>
                <?php
              }else {
                ?>
                <!-- <form class="" action="get_submitted_data.php" method="post"> -->
                <!-- <button class="button dark-grey right btn_frm" onclick="Load()" style="margin-top:18px;">REMPLIR LE FORMULAIRE >> </button> -->
                <!-- </form> -->
                <?php
              }
             ?>
          </div>
          <?php
        }
        ?>
      </div>


    </div>

  </div>

  <?php include("../modal_ajouter_promo.php"); ?>
  <?php include("../modal_ajouter_module.php"); ?>
  <?php include("../modal_ajouterutilisateur.php"); ?>
  <?php include("../modal_delete_user.php") ?>
  <?php include("../modal_deconnexion.php"); ?>
  <?php include("scripts.php"); ?>

  <script type="text/javascript">
    $('#Arrier_cps').click(function(){
      window.location.assign("consulter_cps.php");
    });

    // $('#imprimer_rapport').click(function(){
    //   window.location.assign("pdf.php");
    // });


  </script>

  <?php
      if (isset($_SESSION['message'])) {
        unset($_SESSION['message']);
      }
    ?>
  <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>
  </body>
</html>
