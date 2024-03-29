<?php
  require_once("../control/config/dbcon.php");
  include("includes/head.php");
  include("includes/navbar.php");
  include("includes/sidebar.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "responsable";
  }else {
    $_SESSION["current_session"] = "responsable";
  }

 ?>


<!-- =====================================                  contenus               ======================================= -->

<div id="idfacp" class="main show">
  <!--                                                    breadcrumb                                                       -->
  <ul class="breadcrumb round-large">
    <li><a href="responsable.php"><?=$translations['home']?></a></li>
    <li>CPs
      <?php echo $_SESSION['responsable_prom_name'];?>
    </li>
  </ul>
  <hr class="rounded">


  <div class="container">
    <?php
      // get the logged in user's ID
      $responsable_user_id = $_SESSION['responsable_user_id'];

      // query to fetch all CPs belonging to promotions managed by the logged in user
      $sql = "SELECT * 
              FROM tbl_cp 
              INNER JOIN tbl_promo ON tbl_cp.cp_prom_id = tbl_promo.prom_id 
              WHERE tbl_promo.prom_resp_id = '$responsable_user_id' 
              ORDER BY cp_datetime DESC";

      $result = mysqli_query($con, $sql);

      ?>

    <?php while ($row = mysqli_fetch_array($result)) :?>

    <div class="container light-grey card-4 round-xxlarge padding-large margin-bottom <?php echo $row['cp_status'] == '1' ? 'pale-green' : 'pale-red'; ?>" >
    
    
      <h1><strong><?php echo $row['cp_title']; ?></strong></h1>
      
      <p><strong><?=$translations['status']?> :</strong><span class="tag <?php echo ($row['cp_status'] == 1) ? 'green' : 'red'; ?> round-large"><?php echo ($row['cp_status'] == 1) ? $translations['activated'] : $translations['desactivated']; ?></span></p>


      <p><strong><?=$translations['cp_datetime']?>: </strong><span ><?php echo $row['cp_datetime']; ?></span></p>
      
      <p><strong><?=$translations['semester_nb']?></strong><span ><?php echo $row['cp_semestre']; ?></span></p>

      <p><strong><?=$translations['cp_location']?>: </strong><span ><?php echo $row['cp_location']; ?></span></p>

      <p><strong><?=$translations['cp_agenda']?>:</strong></p>
      <ul>
        <?php foreach (explode("\n", $row['cp_ordre']) as $item): ?>
          <li><strong><?= $item ?></strong></li>
        <?php endforeach; ?>
      </ul>


      


      <div class="container card-4 round-xlarge" style="background-color:rgba(142, 190, 255, 0.8);margin-bottom:15px;">
        <h4><strong><?=$translations['consult_delegates']?></strong> <i class="fa fa-book" aria-hidden="true"></i></h4>
        <?php
        $promid = $row['cp_prom_id'];
        $sql = "SELECT * FROM tbl_users 
                INNER JOIN tbl_delegation ON tbl_users.user_id=tbl_delegation.delegation_del_id 
                AND tbl_delegation.delegation_prom_id='$promid'";
        $resultDelegue = mysqli_query($con, $sql);
        $countresultDelegue = mysqli_num_rows($resultDelegue);

        if ($countresultDelegue > 0) {
            echo '<ol>';
            while ($rowresultDelegue = mysqli_fetch_array($resultDelegue)) {
                ?>
                <form action="get_submitted_data.php" method="post">
                    <input type="hidden" name="cp_id" value="<?= $row['cp_id'] ?>">
                    <input type="hidden" name="delid" value="<?= $rowresultDelegue['user_id'] ?>">
                    <li style="margin-bottom:10px">
                        <?= $rowresultDelegue['user_name'] ?>
                        <button class="button green padding-small hover-green round-large" name="consulter">
                            <?=$translations['consult']?> <i class="fa fa-eye"></i>
                        </button>
                    </li>
                </form>
                <?php
            }
            echo '</ol>';
        } else {
            // Handle case where there are no delegues
        }
        ?>

      </div>
    

      <form action="get_submitted_data.php" method="post">
        <input type="hidden" name="cp_id" value="<?php echo $row['cp_id']; ?>">
        <button name="btn_to_formulaire" class="button green hover-amber round-large right "><?=$translations['consult']?> <i class="fa fa-angle-double-right"></i> </button>
      </form>

      
    </div>


    <?php endwhile; ?>

  </div>


</div>


<?php include("../modal_deconnexion.php"); ?>
<?php include("includes/scripts.php"); ?>


<script type="text/javascript">

    // var dots = document.getElementById("");
    // var moreText = document.getElementById("");
    // var btnText = document.getElementById("");
    //
    // if (dots.style.display === "none") {
    //   dots.style.display = "inline";
    //   btnText.innerHTML = "Read more";
    //   moreText.style.display = "none";
    // } else {
    //   dots.style.display = "none";
    //   btnText.innerHTML = "Read less";
    //   moreText.style.display = "inline";
    // }
</script>


<?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>
</body>

</html>