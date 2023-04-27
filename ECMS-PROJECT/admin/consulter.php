
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





  <div class="main " >
    <!--                                                    breadcrumb                                                       -->
    <ul class="breadcrumb round-large" >
      <li><a href="#"><?=$translations['home']?></a></li>
      <li>Liste des promotions</li>
    </ul>
    <hr class="rounded">

    <?php
    require_once("../control/config/dbcon.php");
    ?>

    <div class="container">
      <ul class="ul card-4 blue">
        <li><h3><?=$translations['select_promotion']?></h3></li>
        <?php
        $sql = "SELECT * FROM tbl_promo WHERE tbl_promo.department_id = '{$_SESSION['admin_department_id']}' order by prom_name";
        $result = mysqli_query($con, $sql);
        $countresult = mysqli_num_rows($result);
        if ($countresult > 0) {
          while ($row  = mysqli_fetch_array($result)) {
            ?>
            <li > <a href="get_prom_data.php?idpromo=<?php echo $row['prom_id']; ?>"><?php echo $row['prom_name']; ?></a></li>
            <?php
          }
        }else {
          ?>
          <li> <strong>Aucun promotion !</strong> </li>
          <?php
        }
         ?>
      </ul>

    </div>



  </div>

  <?php include("includes/modals/modal_add_promotion.php"); ?>
  <?php include("includes/modals/modal_add_module.php"); ?>
  <?php include("includes/modals/modal_add_user.php"); ?>
  <?php include("includes/modals/modal_delete_user.php") ?>
  <?php include("../modal_deconnexion.php"); ?>
  <?php include("includes/scripts.php"); ?>


  <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>
  </body>
</html>
