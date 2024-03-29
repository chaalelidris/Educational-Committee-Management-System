<?php
  require_once("../control/config/dbcon.php");
  include("includes/head.php");
  include("includes/navbar.php");
  include("includes/sidebar.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
  }
  $_SESSION["current_session"] = "responsable";

 ?>





<!-- content -->
<div class="main ">
  <!-- breadcrumb -->
  <ul class="breadcrumb round-large">
    <li><a href="#"><?=$translations['home']?></a></li>
  </ul>

  <hr class="rounded">



  <div class="row ">
    <div class="twothird container">

    </div>

    <div class="third container">

      <?php if (isset($_SESSION['message_edit_pass_succ'])): ?>
      <div class="panel green display-container round-large ">
        <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
        <br>
        <p>
          <?php echo $_SESSION['message_edit_pass_succ']; unset($_SESSION['message_edit_pass_succ']); ?>
        </p>
      </div>
      <?php endif; ?>


      <?php if (isset($_SESSION['message_edit_pass_err'])): ?>
      <div class="panel red display-container round-large ">
        <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
        <br>
        <p>
          <?php echo $_SESSION['message_edit_pass_err']; unset($_SESSION['message_edit_pass_err']); ?>
        </p>
      </div>
      <?php endif; ?>


      <div class="card_prf theme-light padding round-xxlarge" >
        <h3 style="text-align:center"><?=$translations['username']?>, <span class="text-gray">
            <?php echo htmlspecialchars($_SESSION['responsable_user_name'], ENT_QUOTES); ?>
          </span></h3>
        <h1>
          <?php echo htmlspecialchars($_SESSION['responsable_user_fullname'], ENT_QUOTES); ?>
        </h1>

        <?php
        $idresp = $_SESSION['responsable_user_id'];
        $query = mysqli_query($con, "SELECT prom_name FROM tbl_promo WHERE prom_resp_id = '$idresp' LIMIT 1");
        if (mysqli_num_rows($query) > 0) {
          $rowprmid = mysqli_fetch_assoc($query);
          $_SESSION['responsable_prom_name'] = $rowprmid['prom_name'];
        } else {
          $_SESSION['responsable_prom_name'] = 'No promotion'; // or a default value
        }
        ?>


        <p class="title"><strong style="color:rgb(255, 68, 68)"><?=$translations['promotion_manager']?> </strong> <p
            style="color:rgba(0, 0, 0, 0.9)">
            <?php echo htmlspecialchars($_SESSION['responsable_prom_name'], ENT_QUOTES); ?>
          </p></p>
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