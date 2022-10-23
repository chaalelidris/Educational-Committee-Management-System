
<?php
  include("../head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "admin";
  }else {
    $_SESSION["current_session"] = "admin";
  }

  include("../navbar.php");
  include("../sidebar.php");
 ?>





  <!-- =====================================                  contenus               ======================================= -->





  <div class="main " >
    <!--                                                    breadcrumb                                                       -->
    <ul class="breadcrumb" >
      <li><a href="#">accueil</a></li>
      <li>Liste des promotions</li>
    </ul>
    <hr class="rounded">

    <?php
    require_once("../control/config/dbcon.php");
    ?>

    <div class="container">
      <ul class="ul card-4 blue">
        <li><h3>sélectionner une promotion</h3></li>
        <!-- <button class=" btn green" name="button">Consulter</button> -->
        <?php
        $sql = "SELECT * FROM tbl_promo order by prom_name";
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

  <?php include("../modal_ajouter_promo.php"); ?>
  <?php include("../modal_ajouter_module.php"); ?>
  <?php include("../modal_ajouterutilisateur.php"); ?>
  <?php include("../modal_delete_user.php") ?>
  <?php include("../modal_deconnexion.php"); ?>
  <?php include("scripts.php"); ?>


  <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>
  </body>
</html>
