<?php
  require_once("../control/config/dbcon.php");

  include("includes/head.php");
  include "includes/navbar.php";
  include("includes/sidebar.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
  }
  $_SESSION["current_session"] = "super_admin";

 ?>


<!-- ===================================== CONTENT ======================================= -->
<div class="main ">

  <!-- ===================================== BREADCUMBS ===================================== -->
  <ul class="breadcrumb round-large">
    <li><a href="#"><?=$translations['home']?></a></li>
  </ul>

  <hr class="rounded">


  <!-- ===================================== USERS CARDS ===================================== -->
  <div class="row_sc " style="margin: 0 auto;">

    <div class="column_sc">
      <div class="card_sc round-large">
        <p><i class="fa fa-user fa_sc"></i></p>
        <?php
          $sql = "SELECT * FROM tbl_users WHERE user_type= '2'";
          $result = mysqli_query($con, $sql);
          $num1 = mysqli_num_rows($result)
          ?>
        <h3>
          <?php echo $num1; ?>
        </h3>
        <p><?=$translations['teachers']?></p>
      </div>
    </div>

    <div class="column_sc">
      <div class="card_sc round-large">
        <p><i class="fa fa-check fa_sc"></i></p>

        <?php
          $sql = "SELECT * FROM tbl_users WHERE user_type= '1'";
          $result = mysqli_query($con, $sql);
          $num2 = mysqli_num_rows($result)
          ?>

        <h3>
          <?php echo $num2; ?>
        </h3>
        <p><?=$translations['managers']?></p>
      </div>
    </div>

    <div class="column_sc">
      <div class="card_sc round-large">
        <p><i class="fa fa-smile-o fa_sc"></i></p>

        <?php
          $sql = "SELECT * FROM tbl_users WHERE user_type= '3'";
          $result = mysqli_query($con, $sql);
          $num3 = mysqli_num_rows($result)
          ?>

        <h3>
          <?php echo $num3; ?>
        </h3>
        <p><?=$translations['delegates']?></p>
      </div>
    </div>

    <a href="manage_admins.php" class="column_sc">
      <div class="card_sc round-large">
        <p><i class="fa fa-user-secret fa_sc"></i></p>

        <?php
          $sql = "SELECT * FROM tbl_users WHERE user_type= 'admin'";
          $result = mysqli_query($con, $sql);
          $num3 = mysqli_num_rows($result)
          ?>

        <h3>
          <?php echo $num3; ?>
        </h3>
        <p><?=$translations['admin']?></p>
      </div>
    </a>

  </div>

</div>

<?php include("includes/modals/modal_add_user.php"); ?>
<?php include("includes/modals/modal_add_department.php"); ?>
<?php include("../modal_deconnexion.php"); ?>

<?php include("includes/snakebar.php"); ?>

<?php include("includes/scripts.php"); ?>

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