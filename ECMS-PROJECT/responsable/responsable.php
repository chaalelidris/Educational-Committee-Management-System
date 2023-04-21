
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





  <div class="main " >
    <!--                                                    breadcrumb                                                       -->
    <ul class="breadcrumb" >
      <li><a href="#">accueil</a></li>
    </ul>
    <hr class="rounded">

    <?php
    require_once("../control/config/dbcon.php");
    ?>

    <div class="row ">
      <div class="twothird container">

      </div>
      <div class="third container">


        <?php if (isset($_SESSION['message_edit_pass_succ'])): ?>
          <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container ">
            <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
            <br>
            <p><?php echo $_SESSION['message_edit_pass_succ']; unset($_SESSION['message_edit_pass_succ']); ?></p>
          </div>
        <?php endif; ?>


        <?php if (isset($_SESSION['message_edit_pass_err'])): ?>
          <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container ">
            <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
            <br>
            <p><?php echo $_SESSION['message_edit_pass_err']; unset($_SESSION['message_edit_pass_err']); ?></p>
          </div>
        <?php endif; ?>


        <div class="card_prf light-grey" style="margin-top:10px;padding-top:10px;">
          <h3 style="text-align:center">Utilisateur, <span style="color:rgba(0, 0, 0, 0.67)"> <?php echo $_SESSION['responsable_user_name']; ?></span></h3>
          <h1><?php echo $_SESSION['responsable_user_fullname']; ?></h1>

          <?php
          $idresp = $_SESSION['responsable_user_id'];
          $query=mysqli_query($con, "SELECT * from tbl_promo where prom_resp_id='$idresp' LIMIT 1 ");
          $rowprmid=mysqli_fetch_assoc($query); //tableau
          $_SESSION['responsable_prom_name']=$rowprmid['prom_name'];
           ?>
          <p class="title"> <strong style="color:rgb(255, 68, 68)">Responsable de la promotion </strong> <span style="color:rgba(0, 0, 0, 0.9)"> <?php echo $rowprmid['prom_name']; ?></span></p>
          <p><button id="ChangePass" class="button_prf">Changer mot de passe</button></p>
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
