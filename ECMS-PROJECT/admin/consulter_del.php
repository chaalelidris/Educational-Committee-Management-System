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





<div class="main ">
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



  <ul class="breadcrumb round-large">
    <li><a href="#"><?=$translations['home']?></a></li>
    <li>CPs
      <?php echo $rowpromDataResult['prom_name'];?>
    </li>
    <li><?=$translations['consult_delegates']?></li>
  </ul>
  <hr class="rounded">


  <div class="container">
    <?php
      $cp_id = $_SESSION['cp_id'];
      $sql = "SELECT cp_title FROM tbl_cp WHERE cp_id='$cp_id'";
      $result = mysqli_query($con, $sql);
      $rowcptitle=mysqli_fetch_assoc($result); //tableau
      $cptitle = $rowcptitle['cp_title'];
       ?>
    <h2><?=$translations['consult']?><span style="color:rgba(56, 148, 255, 1)">(
        <?php echo $cptitle; ?> )
      </span></h2>
    <!-- <p><?=$translations['sort_table']?></p> -->


    <div class="cell-row">
      <div class="container cell">
        <p><button id="Arrier_cps" class="button green hover-green round-large"> <i class="	fa fa-chevron-left"></i>
            <?=$translations['back']?></button></p>
      </div>
      <div class="container  cell">
      </div>
    </div>



    <div class="container dark-grey card-4 round-xxlarge" style="padding-top:15px;">
      <?php
        $promid = $_SESSION['consult_promotion_id'];
        $sql = "SELECT * FROM tbl_promo WHERE prom_id='$promid'";
        $promDataResult = mysqli_query($con, $sql);
        $rowpromDataResult = mysqli_fetch_array($promDataResult);


          $idresp = $rowpromDataResult['prom_resp_id'];

          $query=mysqli_query($con, "SELECT * from tbl_promo where prom_resp_id='$idresp' LIMIT 1 ");
          $row1=mysqli_fetch_assoc($query); //tableau
          $promid=$row1['prom_id'];

          $cp_id = $_SESSION['cp_id'];
          $sql = "SELECT cp_semestre FROM tbl_cp WHERE cp_id='$cp_id'";
          $result = mysqli_query($con, $sql);
          $row2=mysqli_fetch_assoc($result); //tableau
          $semestre = $row2['cp_semestre'];

          $sql = "SELECT * FROM tbl_module WHERE modl_promo_id='$promid' AND modl_semestre='$semestre'";
          $result = mysqli_query($con, $sql) or die(mysqli_error($con));

          while ($row = mysqli_fetch_array($result)) {
        ?>
      <div class="container light-grey card-4 round-xxlarge margin-bottom">

        <?php if (isset($_SESSION['message_success'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p>
            <?php echo $_SESSION['message_success']; unset($_SESSION['message_success']);unset($_SESSION['message_type']); ?>
          </p>
        </div>
        <?php endif; ?>


        <h1><?=$translations['module']?>, <strong>
            <?php echo $row['modl_name'];?>
          </strong></h1>
        <?php
            $sql = "SELECT prom_name FROM tbl_promo WHERE prom_id=$promid";
            $resultpromname = mysqli_query($con, $sql) or die(mysqli_error($con));
            $resultpromnamerow = mysqli_fetch_array($resultpromname);
             ?>
        <p><?=$translations['promotion']?> >> <span>
            <?php echo $resultpromnamerow['prom_name'];?>
          </span></p>
        <p><?=$translations['semester_nb']?> <span>
            <?php echo $row['modl_semestre'];?>
          </span></p>
        <?php
            $delid =$_SESSION['del_id'];
            $sql = "SELECT user_fullname FROM tbl_users WHERE user_id='$delid'";
            $resultens = mysqli_query($con, $sql) or die(mysqli_error($con));
            $rowensname = mysqli_fetch_array($resultens);
             ?>
        <p><?=$translations['by']?>: <strong style="color:rgba(0, 0, 0, 0.8)"> <i class="fa fa-user-circle-o"></i>
            <?php echo $rowensname['user_fullname']; ?>
          </strong> </p>

        <div class="responsive">
          <?php
                $mdlid = $row['modl_id'];
                $sql = "SELECT * FROM tbl_data WHERE data_usr_id='$delid' AND data_modl_id='$mdlid' AND data_cp_id='$cp_id'";
                $resultcount = mysqli_query($con, $sql);
                $countdata = mysqli_num_rows($resultcount);

                if ($countdata > 0) {
                  $row3 = mysqli_fetch_array($resultcount);
                  ?>
          <table class="table-all card-4 padding-32">
            <tr>
              <td rowspan="9" class="border" style="width:200px;"><?=$translations['advancment']?></td>
            </tr>
            <tr>
              <td><?=$translations['global_adv']?></td>
              <td>
                <?php echo $row3['data_avncm_glob']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['nb_chap_done_progress']?></td>
              <td>
                <?php echo $row3['data_nbr_chap']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['n_s_c_done']?></td>
              <td>
                <?php echo $row3['data_nbr_cours']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['n_s_td_tp_done']?></td>
              <td>
                <?php echo $row3['data_nbr_tdtp']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['n_s_ctdtp_not_done']?></td>
              <td>
                <?php echo $row3['data_nbr_crtdtp']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['p_m']?></td>
              <td>
                <?php echo $row3['data_exps_micro']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['tp_validation']?> </td>
              <td>
                <?php echo $row3['data_valid_tp']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['handout_course']?> </td>
              <td>
                <?php echo $row3['data_polycp_cour']; ?>
              </td>
            </tr>
            <!-- end rowspan -->
          </table>
          <?php
                }else{
                  ?>
          <table class="table-all card-4">
            <tr>
              <td rowspan="9" class="border" style="width:200px;"><?=$translations['advancment']?></td>
            </tr>
            <tr>
              <td><?=$translations['global_adv']?></td>
              <td><?=$translations['no_data']?></td>
            </tr>
            <tr>
              <td><?=$translations['nb_chap_done_progress']?></td>
              <td><?=$translations['no_data']?></td>
            </tr>
            <tr>
              <td><?=$translations['n_s_c_done']?></td>
              <td><?=$translations['no_data']?></td>
            </tr>
            <tr>
              <td><?=$translations['n_s_td_tp_done']?></td>
              <td><?=$translations['no_data']?></td>
            </tr>
            <tr>
              <td><?=$translations['n_s_ctdtp_not_done']?></td>
              <td><?=$translations['no_data']?></td>
            </tr>
            <tr>
              <td><?=$translations['p_m']?></td>
              <td><?=$translations['no_data']?></td>
            </tr>
            <tr>
              <td><?=$translations['tp_validation']?> </td>
              <td><?=$translations['no_data']?></td>
            </tr>
            <tr>
              <td><?=$translations['handout_course']?> </td>
              <td><?=$translations['no_data']?></td>
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
          <input type="hidden" name="mdlname" value="<?php echo $row['modl_name'];?>">
          <input type="hidden" name="dataid" value="<?php echo $row3['data_id']; ?>">
          <button name="btn_to_edit_data" class="button green  right " onclick="Load()"
            style="margin-top:18px;">Modifier les donnés <i class="fa fa-pencil"></i> </button>
        </form>
        <?php
              }else {
                ?>
        <!-- <form class="" action="get_submitted_data.php" method="post"> -->
        <!-- <button class="button dark-grey right " onclick="Load()" style="margin-top:18px;">REMPLIR LE FORMULAIRE >> </button> -->
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

<?php include("includes/modals/modal_add_promotion.php"); ?>
<?php include("includes/modals/modal_add_module.php"); ?>
<?php include("includes/modals/modal_add_user.php"); ?>
<?php include("includes/modals/modal_delete_user.php") ?>
<?php include("../modal_deconnexion.php"); ?>
<?php include("includes/scripts.php"); ?>

<script type="text/javascript">
  $('#Arrier_cps').click(function () {
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