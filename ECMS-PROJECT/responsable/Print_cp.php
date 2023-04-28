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


<div class="main">
  <!--                                                    breadcrumb                                                       -->
  <ul class="breadcrumb round-large">
    <li><a href="responsable.php"><?=$translations['home']?></a></li>
    <li> <a href="gnr_cp.php">CPs
        <?php echo $_SESSION['responsable_prom_name'];?>
      </a> 
    </li>
    <li><?=$translations['generate_report']?>
      <?php echo $_SESSION['responsable_prom_name']; ?>
    </li>
  </ul>
  <hr class="rounded">

  <?php
    require_once("../control/config/dbcon.php");
    ?>

  <div class="container">
    <?php
    $cp_id = $_SESSION['cp_id'];
    $sql = "SELECT cp_title FROM tbl_cp WHERE cp_id='$cp_id'";
    $result = mysqli_query($con, $sql);
    $rowcptitle=mysqli_fetch_assoc($result); //tableau
    $cptitle = $rowcptitle['cp_title'];
     ?>
    <h2>Imprimer CP <span style="color:rgba(56, 148, 255, 1)">(
        <?php echo $cptitle; ?> )
      </span></h2>


    <div class="container cell">
      <button id="Arrier_cps" class="button green hover-green round-large ">
        <i class="	fa fa-chevron-left"></i>
        <?=$translations['back']?>
      </button>
    </div>

    <div class="container cell">
      <form action="pdf.php" method="post">
        <input type="hidden" name="cp_id" value="<?php echo $cp_id; ?>">
        <button type="submit" name="imprimer_rapport" class="button dark-gray round-large">
          <strong><?=$translations['printr']?> <i class="fa fa-print"></i></strong>
        </button>
      </form>
    </div>





    <div class="container dark-grey card-4 round-xxlarge padding-16 margin-top">
      <?php
        $idresp = $_SESSION['responsable_user_id'];
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

        ?>

      <?php while ($row = mysqli_fetch_array($result)): ?>

      <div class="container light-grey card-4 round-xxlarge padding-16 margin-bottom">

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
          $ensid = $row['modl_ens_id'];
          $sql = "SELECT user_fullname FROM tbl_users WHERE user_id='$ensid'";
          $resultens = mysqli_query($con, $sql) or die(mysqli_error($con));
          $rowensname = mysqli_fetch_array($resultens);
           ?>
        <p><?=$translations['by']?>: <strong style="color:rgba(0, 0, 0, 0.8)"> <i class="fa fa-user-circle-o"></i>
            <?php echo $rowensname['user_fullname']; ?>
          </strong> </p>

        <div class="responsive">
          <?php
              $mdlid = $row['modl_id'];
              $sql = "SELECT * FROM tbl_data WHERE data_usr_id='$idresp' AND data_modl_id='$mdlid' AND data_cp_id='$cp_id'";
              $resultcount = mysqli_query($con, $sql);
              $countdata = mysqli_num_rows($resultcount);
              
          ?>
          
          <?php if ($countdata > 0): $row3 = mysqli_fetch_array($resultcount);?>
          <table class="table-all card-4">
            <tbody>
              <tr><th rowspan="9" class="border" style="width:200px;"><?=$translations['advancment']?></th></tr>
              <?php 
              $labels = array($translations['global_adv'], 
                              $translations['nb_chap_done_progress'], 
                              $translations['n_s_c_done'],
                              $translations['n_s_td_tp_done'],
                              $translations['n_s_ctdtp_not_done'],
                              $translations['presentation_test'],
                              $translations['tp_validation'],
                              $translations['handout_course'],
                              );

              $data = array(
                'data_avncm_glob', 
                'data_nbr_chap', 
                'data_nbr_cours', 
                'data_nbr_tdtp',
                'data_nbr_crtdtp', 
                'data_exps_micro', 
                'data_valid_tp', 
                'data_polycp_cour');
              ?>

              <?php foreach ($labels as $label): ?>
                <tr>
                  <td><?php echo $label; ?></td>
                  <td><?php echo $row3[$data[array_search($label, $labels)]]; ?></td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>
          <?php else: ?>
            <table class="table-all card-4">
              <tr>
                <td rowspan="9" class="border" style="width:200px;"><?=$translations['advancment']?></td>
              </tr>
              <?php 
              $labels = array($translations['global_adv'], 
                              $translations['nb_chap_done_progress'], 
                              $translations['n_s_c_done'],
                              $translations['n_s_td_tp_done'],
                              $translations['n_s_ctdtp_not_done'],
                              $translations['presentation_test'],
                              $translations['tp_validation'],
                              $translations['handout_course'],
                              );
              ?>

              <?php foreach ($labels as $i => $label): ?>
                <tr>
                  <td><?php echo $label; ?></td>
                  <td><?=$translations['no_data']?></td>
                </tr>
              <?php endforeach; ?>

              <!-- end rowspan -->
            </table>
          <?php endif; ?>

        </div>


        <?php if ($countdata > 0): ?>
        <form action="get_submitted_data.php" method="post">
          <input type="hidden" name="mdlname" value="<?php echo $row['modl_name'];?>">
          <input type="hidden" name="dataid" value="<?php echo $row3['data_id']; ?>">
          <button name="btn_to_edit_data" class="button green right  round-large" style="margin-top:18px;">
            <?=$translations['edit']?> <i class="fa fa-pencil"></i>
          </button>
        </form>
        <?php else: ?>
          <!-- <form action="get_submitted_data.php" method="post">
            <button class="button dark-grey right  round-large" style="margin-top:18px;">
              REMPLIR LE FORMULAIRE >>
            </button>
          </form> -->
        <?php endif; ?>

      </div>
      <?php endwhile; ?>

      
      <form action="pdf.php" method="post">
        <input type="hidden" name="cp_id" value="<?php echo $cp_id; ?>">
        <button type="submit" name="imprimer_rapport" class="button right  round-large">
          <strong><?=$translations['printr']?> <i class="fa fa-print"></i></strong>
        </button>
      </form>

    </div>


  </div>

</div>


<?php include("../modal_deconnexion.php"); ?>
<?php include("includes/scripts.php"); ?>

<script type="text/javascript">
  $('#Arrier_cps').click(() => {
    window.location.assign("gnr_cp.php");
  });
</script>
  // Clear message session
  <?php if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
  }?>

</body>

</html>