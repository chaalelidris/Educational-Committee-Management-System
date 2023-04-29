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

  <ul class="breadcrumb round-large">
    <li><a href="enseignant.php"><?=$translations['home']?></a></li>
  </ul>
  <hr class="rounded">

 

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

        <h1><strong style="color:rgb(0, 142, 82)"> CPs promotion <?php echo $rowprom['prom_name']; ?> </strong></h1>
        <?php $result = mysqli_query($con, $sqlCpRows); ?>
        
        <?php while ($row = mysqli_fetch_array($result)):?>

        <?php
              $usrid = $_SESSION['enseignant_user_id'];
              $modlid = $row['modl_id'];
              $cp_id = $row['cp_id'];
              $querydata=mysqli_query($con, "SELECT data_id,data_usr_id,data_modl_id,data_cp_id from tbl_data WHERE data_usr_id='$usrid' AND data_modl_id='$modlid' AND data_cp_id='$cp_id'") or die (mysqli_error($con));
              $countrowremplis = mysqli_num_rows($querydata);
              ?>


        <!-- success message -->
        <?php if (isset($_SESSION['message_success'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p>
            <?php echo $_SESSION['message_success']; unset($_SESSION['message_success']);unset($_SESSION['message_type']); ?>
          </p>
        </div>
        <?php endif; ?>

        <div
          class="container light-grey card-4 round-xxlarge padding-large margin-bottom <?php echo $countrowremplis > 0 ? 'pale-green' : 'pale-red'; ?>">
          <p class="right"><?=$translations['status']?>: 
            <span class="tag <?php echo $countrowremplis > 0 ? 'green' : 'red'; ?> round-large">
              <?php echo $countrowremplis > 0 ? $translations['completed'] : $translations['not_completed'] ?>
            </span>
          </p>

          <h1>
            <?php echo $row['cp_title']; ?>
          </h1>

          <?php if ($row['cp_status'] == 1): ?>
          <p><strong> <?=$translations['status']?>: </strong><span class="tag green round-large"><?=$translations['activated']?></span></p>
          <?php else: ?>
          <p><strong> <?=$translations['status']?>: </strong><span class="tag red round-large"><?=$translations['desactivated']?></span></p>
          <?php endif; ?>

          <p><strong><?=$translations['cp_datetime']?>: </strong><span>
              <?php echo $row['cp_datetime']; ?>
            </span></p>
          <p><strong><?=$translations['promotion']?>: </strong><span>
              <?php echo $rowprom['prom_name']; ?>
            </span></p>
          <p><strong><?=$translations['module_name']?>: </strong><span>
              <?php echo $row['modl_name']; ?>
            </span></p>
          <p><strong><?=$translations['semester_nb']?></strong><span>
              <?php echo $row['cp_semestre']; ?>
            </span></p>

          <p><strong><?=$translations['cp_location']?>: </strong><span>
              <?php echo $row['cp_location']; ?>
            </span> </p>

          <p><strong><?=$translations['cp_agenda']?>:</strong></p>
          <ul>
            <?php foreach (explode("\n", $row['cp_ordre']) as $item): ?>
              <li><strong><?= $item ?></strong></li>
            <?php endforeach; ?>
          </ul>



          <form action="get_submitted_data.php" method="post">
            <?php
                  $rowquerydata = mysqli_fetch_array($querydata);
                  ?>
            <input type="hidden" name="cp_id" value="<?php echo $row['cp_id']; ?>">
            <input type="hidden" name="mdlid" value="<?php echo $row['modl_id']; ?>">
            <input type="hidden" name="dataid" value="<?php echo $rowquerydata['data_id']; ?>">
            <input type="hidden" name="mdlname" value="<?php echo $row['modl_name']; ?>">
            <input type="hidden" name="promname" value="<?php echo $rowprom['prom_name']; ?>">

            <?php if($countrowremplis > 0): ?>
              <button name="btn_to_mydata_formulaire" class="button green right round-large"><?=$translations['btn_desplay_mdl_data']?> <i class="fa fa-angle-double-right"></i> </button>
            <?php else: ?>

              <?php if ($row['cp_status'] == 1): ?>
                <button type="submit" name="btn_to_formulaire" class="button blue right round-large"><?=$translations['add_learning_data']?> <i
                    class="fa fa-angle-double-right"></i> </button>
                <?php else:?>
                <button type="button" class="button blue right round-large btn_cp_info"><?=$translations['add_learning_data']?> <i
                    class="fa fa-angle-double-right"></i> </button>
              <?php endif; ?>

            <?php endif; ?>

          </form>
        </div>
        <?php endwhile; ?>

        <?php else:?>
        <div class="container light-grey card-4 round-xxlarge">
          <h1 style="color:rgba(0, 0, 0, 0.53)"> il n'y a pas de CP <?=$translations['activated']?> Actuellement !</h1>
        </div>
        <?php endif; ?>

      </div>

    </div>
    <div class="third container">

      <!-- MESSAGES -->
      <?php if (isset($_SESSION['message_edit_pass_succ'])): ?>
      <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
        <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
        <br>
        <p>
          <?php echo $_SESSION['message_edit_pass_succ']; unset($_SESSION['message_edit_pass_succ']); ?>
        </p>
      </div>
      <?php endif; ?>

      <?php if (isset($_SESSION['message_edit_pass_err'])): ?>
      <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
        <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
        <br>
        <p>
          <?php echo $_SESSION['message_edit_pass_err']; unset($_SESSION['message_edit_pass_err']); ?>
        </p>
      </div>
      <?php endif; ?>

      <!-- PROFILE -->
      <div class="card_prf theme-light padding round-xxlarge">
        <h3 class="center"><?=$translations['username']?> : <span class="text-gray"><?= $_SESSION['enseignant_user_name'] ?></span></h3>
        <h3><?= $_SESSION['enseignant_user_fullname'] ?></h3>
        <?php
          $idens = $_SESSION['enseignant_user_id'];
          $query = mysqli_query($con, "SELECT * from tbl_module INNER JOIN  tbl_promo ON tbl_module.modl_promo_id=tbl_promo.prom_id AND tbl_module.modl_ens_id='$idens'") or die(mysqli_error($con));
        ?>
        <p class="title"><strong style="color:rgb(252, 87, 87);"><?=$translations['teacher_of']?></strong></p>
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
          <div class="border round-large">
            <span class="text-gray"><strong><?=$translations['module_name']?>:</strong> <?= $row['modl_name'] ?> |<strong> <?=$translations['promotion_name']?>: </strong>   <?=$row['prom_name'] ?> |<strong> <?=$translations['semester']?>: </strong> <?=$row['modl_semestre']?> </span>
          </div>
          
          <?php endwhile; ?>
        <p><button id="ChangePass" class="button_prf round-xlarge"><?=$translations['change_pass']?></button></p>
      </div>

    </div>
  </div>

</div>

<?php include("modal_change_pass.php"); ?>

<?php include("../modal_info.php"); ?>
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