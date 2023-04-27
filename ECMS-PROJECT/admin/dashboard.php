<?php
    // Require database connection file
    require_once("../control/config/dbcon.php");

    

    // Include header, navigation bar, and sidebar files
    include("includes/head.php");
    include("includes/navbar.php");
    include("includes/sidebar.php");

    // Unset the current session variable if it is already set
    if (isset($_SESSION["current_session"])) {
        unset($_SESSION["current_session"]);
    }
    
    // Set the current session variable to "admin"
    $_SESSION["current_session"] = "admin";

    // SQL query to select distinct user IDs based on the current admin's department ID
    $sql = "SELECT DISTINCT u.user_id
            FROM tbl_users u
            JOIN tbl_user_department ud ON u.user_id = ud.user_id
            JOIN tbl_department d ON ud.department_id = d.department_id
            WHERE d.department_id = '{$_SESSION['admin_department_id']}'";

    // Execute the query to get the number of teachers
    $result_enseignant = mysqli_query($con, $sql . " AND u.user_type = 2");
    $num1 = mysqli_num_rows($result_enseignant);

    // Execute the query to get the number of responsible users
    $result_responsable = mysqli_query($con, $sql . " AND u.user_type = 1");
    $num2 = mysqli_num_rows($result_responsable);

    // Execute the query to get the number of delegate users
    $result_delegue = mysqli_query($con, $sql . " AND u.user_type = 3");
    $num3 = mysqli_num_rows($result_delegue);
?>

<!-- ===================================== CONTENT ======================================= -->
<div class="main ">
  <!-- Breadcrumb -->
  <ul class="breadcrumb round-large">
    <li><a href="#"><?=$translations['home']?></a></li>
  </ul>
  <hr class="rounded">

  <div class="row_sc " style="margin: 0 auto;">

    <!-- Card for managing teachers -->
    <a href="gst_enseignant.php">
      <div class="column_sc card_sc round-large margin hover-primary">
        <p><i class="fa fa-user fa_sc"></i></p>
        <h3>
          <?php echo $num1; ?>
        </h3>
        <p><?=$translations['teachers']?></p>
      </div>
    </a>

    <!-- Card for managing responsible users -->
    <a href="gst_responsable.php">
      <div class="column_sc card_sc round-large margin hover-primary">
        <p><i class="fa fa-group fa_sc"></i></p>
        <h3>
          <?php echo $num2; ?>
        </h3>
        <p><?=$translations['managers']?></p>
      </div>
    </a>

    <!-- Card for managing delegate users -->
    <a href="gst_delegue.php">
      <div class="column_sc card_sc round-large margin hover-primary">
        <p><i class="fa fa-mortar-board fa_sc"></i></p>
        <h3>
          <?php echo $num3; ?>
        </h3>
        <p><?=$translations['delegates']?></p>
      </div>
    </a>
  </div>
  <hr>
  <div class="row_sc " style="margin: 0 auto;">

    <!-- Card for managing teachers -->
    <a href="gst_promos.php">
      <div class="column_sc card_sc round-large margin hover-primary">
        <p><i class="fa fa-cogs fa_sc"></i></p>
        <h3>
          <?php echo ""; ?>
        </h3>
        <p><?=$translations['manage_promos']?></p>
      </div>
    </a>

    <!-- Card for managing responsible users -->
    <a href="gst_modules.php" >
      <div class="column_sc card_sc round-large margin hover-primary">
        <p><i class="fa fa-flask fa_sc"></i></p>
        <h3>
          <?php echo ""; ?>
        </h3>
        <p><?=$translations['manage_modules']?></p>
      </div>
    </a>

    <!-- Card for managing delegate users -->
    <a href="consulter.php" >
      <div class="column_sc card_sc round-large hover-primary margin">
        <p><i class="fa fa-calendar fa_sc"></i></p>
        <h3>
          <?php echo ""; ?>
        </h3>
        <p><?=$translations['view_cp']?></p>
      </div>
    </a>
  </div>

</div>

<!-- Include modal files for adding promotions, modules, users, and deleting users -->
<?php include("includes/modals/modal_add_user.php"); ?>
<?php include("includes/modals/modal_add_promotion.php"); ?>
<?php include("includes/modals/modal_add_module.php"); ?>

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