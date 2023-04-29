
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
      <li><a href="delegue.php"><?=$translations['home']?></a></li>
      <li>Liste des modules</li>
    </ul>
    <hr class="rounded">

    <?php
    require_once("../control/config/dbcon.php");
    ?>


    <div class="cell-row">
      <div class="container cell">
        <p><button id="accueil_return" class="button green hover-green round-large"> <i class="	fa fa-chevron-left"></i> <?=$translations['back']?></button></p>
      </div>
      <div class="container  cell">
      </div>
    </div>



    <div class="container">

      <h1><strong style="color:#191923"><?=$translations['mdl_list']?></strong></h1>


      <?php if (isset($_SESSION['message_success'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message_success']; unset($_SESSION['message_success']); ?></p>
        </div>
      <?php endif; ?>


      <?php
      $id = $_SESSION['delegue_user_id'];
      $cp_id = $_SESSION['cp_id'];
      $sqlCpRows = "SELECT * FROM tbl_cp INNER JOIN tbl_module on tbl_cp.cp_prom_id = tbl_module.modl_promo_id AND tbl_cp.cp_semestre = tbl_module.modl_semestre AND cp_id='$cp_id'";
      $result = mysqli_query($con, $sqlCpRows);
      $countresult = mysqli_num_rows($result);

      if ($countresult > 0) {

        while ($row = mysqli_fetch_array($result)) {
          ?>


          <?php
          $usrid = $_SESSION['delegue_user_id'];
          $modlid = $row['modl_id'];
          $cp_id = $row['cp_id'];
          $querydata=mysqli_query($con, "SELECT data_id,data_usr_id,data_modl_id,data_cp_id 
                                          FROM tbl_data 
                                          WHERE data_usr_id='$usrid' 
                                          AND data_modl_id='$modlid' 
                                          AND data_cp_id='$cp_id'") or die (mysqli_error($con));
                                          
          $countrowremplis = mysqli_num_rows($querydata);
          ?>

          <?php if($countrowremplis > 0): ?>
          <div class="container card-4 round-xxlarge margin-bottom padding-16 pale-green" >
          <p class="right"><?=$translations['status']?>: <span class="tag green"><?=$translations['completed']?></span></p>
          <?php else: ?>
            <div class="container card-4 round-xxlarge margin-bottom padding-16 pale-red" >
            <p class="right"><?=$translations['status']?>: <span class="tag red"><?=$translations['not_completed']?></span></p>
          <?php endif; ?>


            <h1><?php echo $row['modl_name']; ?></h1>
            <div class="container card-4 cyan round-xxlarge margin-bottom" >
              <h3 style="color:rgb(0, 109, 252)">Détails sur le CP <i class="fa fa-book" style="font-size:24px"></i></h3>
              <h3>
                <?php echo $row['cp_title']; ?>
              </h3>

              <?php if ($row['cp_status'] == 1): ?>
              <p><strong> <?=$translations['status']?>: </strong><span class="tag green round-large"><?=$translations['activated']?></span></p>
              <?php else: ?>
              <p><strong> <?=$translations['status']?>: </strong><span class="tag red round-large"><?=$translations['desactivated']?></span></p>
              <?php endif; ?>

              <p><strong><?=$translations['cp_datetime']?>: </strong><span> <?php echo $row['cp_datetime']; ?> </span></p>

              <?php
              $promid = $_SESSION['delegue_promotion_id'];
              $sql = "SELECT prom_name FROM tbl_promo WHERE prom_id='$promid'";
              $resultPromName = mysqli_query($con, $sql);
              $resultPromName = mysqli_fetch_array($resultPromName);
              ?>

              <p><strong><?=$translations['promotion']?>: </strong><span><?php echo $resultPromName['prom_name']; ?></span></p>
              
              <p><strong><?=$translations['semester_nb']?></strong><span> <?php echo $row['cp_semestre']; ?></span></p>

              <p><strong><?=$translations['cp_location']?>: </strong><span> <?php echo $row['cp_location']; ?> </span> </p>

              <p><strong><?=$translations['cp_agenda']?>:</strong></p>
              <ul>
                <?php foreach (explode("\n", $row['cp_ordre']) as $item): ?>
                  <li><strong><?= $item ?></strong></li>
                <?php endforeach; ?>
              </ul>
            </div>


            <form  action="get_submitted_data.php" method="post">
              <?php
                $rowquerydata = mysqli_fetch_array($querydata);
               ?>
              <input type="hidden" name="cp_id" value="<?php echo $row['cp_id']; ?>">
              <input type="hidden" name="mdlid" value="<?php echo $row['modl_id']; ?>">
              <input type="hidden" name="mdlname" value="<?php echo $row['modl_name']; ?>">
              <input type="hidden" name="dataid" value="<?php echo $rowquerydata['data_id']; ?>">


              <?php if($countrowremplis > 0): ?>

                <?php if ($row['cp_status'] == 1) :?>
                  <button name="btn_to_mydata_formulaire" class="button green right round-large" ><?=$translations['edit']?>  <i class="fa fa-edit"></i> </button>
                <?php else: ?>
                  <button type="button" class="button green right round-large btn_cp_info" ><?=$translations['edit']?>  <i class="fa fa-edit"></i></i> </button>
                <?php endif; ?>

              <?php else: ?>

                <button <?= $row['cp_status'] == 1 ? 'name="btn_to_addmdl_data" class="button dark-grey right round-large"' : 'type="button" class="button dark-grey right round-large btn_cp_info"' ?>>
                  <?=$translations['add_learning_data']?> <i class="fa fa-angle-double-right"></i>
                </button>

              <?php endif; ?>

            </form>
          </div>


          <?php
        }

      }else{?>

        <div class="container light-grey card-4 round-xxlarge" >
          <h1 style="color:rgba(0, 0, 0, 0.53)"> aucun module !</h1>
        </div>
        <?php

      }?>


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
