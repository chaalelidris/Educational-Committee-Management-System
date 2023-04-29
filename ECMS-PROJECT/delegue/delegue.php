
<?php
  require_once("../control/config/dbcon.php");
  include("includes/head.php");
  include("includes/navbar.php");
  include("includes/sidebar.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
  }
  $_SESSION["current_session"] = "delegue";

 ?>



  <div class="main " >
    <!--                                                    breadcrumb                                                       -->
    <ul class="breadcrumb round-large" >
      <li><a href="#"><?=$translations['home']?></a></li>
    </ul>
    <hr class="rounded">




    <div class="row ">
      <div class="twothird container">

        <div class="container">
          <h1><strong><?=$translations['cp_list']?> </strong></h1>
          <?php
          $id = $_SESSION['delegue_user_id'];
          $promotion_id = $_SESSION['delegue_promotion_id'];
          $sql = "SELECT * 
                  FROM tbl_cp 
                  INNER JOIN tbl_promo 
                  ON tbl_cp.cp_prom_id = tbl_promo.prom_id 
                  WHERE tbl_promo.prom_id = '$promotion_id'
                  ORDER BY cp_datetime 
                  DESC";

          $result = mysqli_query($con, $sql);
          $countresult = mysqli_num_rows($result);

          if ($countresult > 0) {

            while ($row = mysqli_fetch_array($result)) {?>

              <div class="container light-grey card-4 round-xxlarge padding-large margin-bottom <?php echo $row['cp_status'] == '1' ? 'pale-green' : 'pale-red'; ?>"class="container light-grey card-4 round-xxlarge padding-large margin-bottom <?php echo $row['cp_status'] == '1' ? 'pale-green' : 'pale-red'; ?>" >
                <h1><?php echo $row['cp_title']; ?> </h1>

                <?php if ($row['cp_status'] == 1): ?>
                <p><strong> <?=$translations['status']?>: </strong><span class="tag green round-large"><?=$translations['activated']?></span></p>
                <?php else: ?>
                <p><strong> <?=$translations['status']?>: </strong><span class="tag red round-large"><?=$translations['desactivated']?></span></p>
                <?php endif; ?>

                <p><strong><?=$translations['cp_datetime']?>: </strong><span class="text-gray"> <?php echo $row['cp_datetime']; ?></span></p>
                <p><strong> <?=$translations['promotion']?> </strong><span ><?php echo $row['prom_name']; ?></span></p>
                <p><strong><?=$translations['semester_nb']?></strong><span ><?php echo $row['cp_semestre']; ?></span></p>

                <p><strong><?=$translations['cp_location']?>: </strong><span ><?php echo $row['cp_location']; ?></span> </p>

                <p><strong><?=$translations['cp_agenda']?>:</strong></p>
                <ul>
                  <?php 
                    $ordre_items = explode("\n", $row['cp_ordre']);
                    foreach ($ordre_items as $item) {
                      echo "<li><strong>$item</strong></li>";
                    }
                  ?>
                </ul>


                <form  action="get_submitted_data.php" method="post">
                  <input type="hidden" name="cp_id" value="<?php echo $row['cp_id']; ?>">
                  <button name="btn_to_modules" class="button blue right round-large " ><?=$translations['view_mdl']?> <i class="fa fa-angle-double-right"></i> </button>
                </form>
              </div>


              <?php
            }
            ?>
      <?php
        }else {

          ?>
          <div class="container light-grey card-4 round-xxlarge" >
            <h1 style="color:rgba(0, 0, 0, 0.53)"><?=$translations['no_cp_found']?></h1>
          </div>
          <?php

          }
      ?>


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


        <div class="card_prf theme-light padding round-xxlarge" >
          <h2 style="text-align:center">Profile de <?php echo $_SESSION['delegue_user_name']; ?></h2>
          <h1><?php echo $_SESSION['delegue_user_fullname']; ?></h1>

          <?php
          $idprm = $_SESSION['delegue_promotion_id'];
          $query=mysqli_query($con, "SELECT * from tbl_promo where prom_id='$idprm' LIMIT 1 ");
          $rowprmid=mysqli_fetch_assoc($query); //tableau
           ?>
          <p class="title"><?=$translations['delegate_of']?> <?php echo $rowprmid['prom_name']; ?></p>
          <p><button id="ChangePass" class="button_prf round-xlarge"><?=$translations['change_pass']?></button></p>
        </div>

      </div>
    </div>

  </div>

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


























<!--
Pagination
<div class="center padding-32">
<div class="bar">
<a class="button black" href="#">1</a>
<a class="button hover-primary" href="#">2</a>
<a class="button hover-primary" href="#">3</a>
<a class="button hover-primary" href="#">4</a>
<a class="button hover-primary" href="#">5</a>
<a class="button hover-primary" href="#">»</a>
</div>
</div>


 <footer id="myFooter" class="footer-margin">
 <div class="container theme-l2 padding-32">
 <h4>Footer</h4>
 </div>
 <div class="container theme-primary">
target="_blank"
<p><a href="#" ></a></p>
</div>
</footer> -->
