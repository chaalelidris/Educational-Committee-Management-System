<?php
  require_once("../control/config/dbcon.php");
  
  include("includes/head.php");
  include("includes/navbar.php");
  include("includes/sidebar.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
  }
  $_SESSION["current_session"] = "enseignant";
 ?>




<div class="main">
  <!--                                                    breadcrumb                                                       -->
  <ul class="breadcrumb round-large">
    <li><a href="enseignant.php"><?=$translations['home']?></a></li>
    <li>Donnés de mon module</li>
  </ul>
  <hr class="rounded">



  <div class="container">
    <?php
      $cp_id = $_SESSION['cp_id'];
      $sql = "SELECT cp_title,cp_status FROM tbl_cp WHERE cp_id='$cp_id'";
      $result = mysqli_query($con, $sql);
      $rowcp_TS=mysqli_fetch_assoc($result); //tableau
      $cptitle = $rowcp_TS['cp_title'];
      ?>
    <h2><span style="color:rgba(56, 148, 255, 1)">(
        <?php echo $cptitle; ?> )
      </span></h2>

    <div class="margin">
      <?php if ($rowcp_TS['cp_status'] == 1): ?>
      <p><strong> <?=$translations['status']?>: </strong><span class="tag green round-large"><?=$translations['activated']?></span></p>
      <?php else: ?>
      <p><strong> <?=$translations['status']?>: </strong><span class="tag red round-large"><?=$translations['desactivated']?></span></p>
      <?php endif; ?>
    </div>

    <!-- <p><?=$translations['sort_table']?></p> -->

    <div class="cell-row">
      <div class="container cell">
        <p><button id="Arrier_enseignant" class="button green hover-green round-large"> <i
              class="	fa fa-chevron-left"></i> <?=$translations['back']?></button></p>
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

      while ($row = mysqli_fetch_array($resultData)):?>
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

        <?php
          $modlid = $row['data_modl_id'];
          $sql = "SELECT modl_name,modl_semestre FROM tbl_module WHERE modl_id='$modlid'";
          $result = mysqli_query($con, $sql) or die(mysqli_error($con));
          $rowMdlData = mysqli_fetch_assoc($result);
         ?>
        <h1><?=$translations['module']?>, <strong>
            <?php echo $rowMdlData['modl_name'];?>
          </strong></h1>
        <?php
            $promname = $_SESSION['prom_name'];
            ?>
        <p><?=$translations['promotion']?> >> <span>
            <?php echo $promname;?>
          </span></p>
        <p><?=$translations['semester_nb']?> <span>
            <?php echo $rowMdlData['modl_semestre'];?>
          </span></p>
        <?php
            $ensid = $_SESSION['enseignant_user_id'];
            $sql = "SELECT user_fullname FROM tbl_users WHERE user_id='$ensid'";
            $resultens = mysqli_query($con, $sql) or die(mysqli_error($con));
            $rowensname = mysqli_fetch_array($resultens);
            ?>
        <p><?=$translations['by']?>: <strong style="color:rgba(0, 0, 0, 0.8)"> <i class="fa fa-user-circle-o"></i>
            <?php echo $rowensname['user_fullname']; ?>
          </strong> </p>


        <div class="responsive">
          <table class="table-all card-4">
            <tr>
              <td rowspan="9" class="border" style="width:200px;"><?=$translations['advancment']?></td>
            </tr>
            <tr>
              <td><?=$translations['global_adv']?></td>
              <td>
                <?php echo $row['data_avncm_glob']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['nb_chap_done_progress']?></td>
              <td>
                <?php echo $row['data_nbr_chap']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['n_s_c_done']?></td>
              <td>
                <?php echo $row['data_nbr_cours']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['n_s_td_tp_done']?></td>
              <td>
                <?php echo $row['data_nbr_tdtp']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['n_s_ctdtp_not_done']?></td>
              <td>
                <?php echo $row['data_nbr_crtdtp']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['p_m']?></td>
              <td>
                <?php echo $row['data_exps_micro']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['tp_validation']?> </td>
              <td>
                <?php echo $row['data_valid_tp']; ?>
              </td>
            </tr>
            <tr>
              <td><?=$translations['handout_course']?> </td>
              <td>
                <?php echo $row['data_polycp_cour']; ?>
              </td>
            </tr>
            <!-- end rowspan -->
          </table>
        </div>

        <form action="get_submitted_data.php" method="post">
          <input type="hidden" name="dataid" value="<?php echo $dataid; ?>">
          <input type="hidden" name="mdlname" value="<?php echo $rowMdlData['modl_name']; ?>">

          <?php if ($rowcp_TS['cp_status'] == 1): ?>
          <button name="btn_to_modifier_formulaire" class="button green right margin round-large"><?=$translations['edit']?> <i
              class="fa fa-pencil"></i> </button>
          <?php else: ?>
          <button type="button" class="button green margin right round-large btn_cp_info"><?=$translations['edit']?> <i
              class="fa fa-pencil"></i> </button>
          <?php endif; ?>

        </form>
      </div>
      <?php endwhile; ?>

    </div>

  </div>
</div>

<?php include("../modal_info.php"); ?>
<?php include("../modal_deconnexion.php"); ?>
<?php include("includes/scripts.php"); ?>

<script type="text/javascript">
  $('#Arrier_enseignant').click(function () {
    window.location.assign("enseignant.php");
  });

  $('.btn_cp_info').click(function () {
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