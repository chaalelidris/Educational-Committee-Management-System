
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



<div class="main ">
  <!--                                                    breadcrumb                                                       -->
  <ul class="breadcrumb round-large">
    <li><a href="dashboard.php">accueil</a></li>
    <li>Messagerie</li>
  </ul>
  <hr class="rounded">

  <?php
    require_once("../control/config/dbcon.php");
    ?>
  <link rel="stylesheet" href="../admin/css/chat2.css">


  <div class="container">
    <h3 class=" text-center">Messagerie</h3>
    <div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people" style="width:100%">
          <div class="headind_srch">
            <div class="recent_heading" style="">
              <h5><i class="fa fa-info-circle " aria-hidden="true" style="color:blue;font-size:2em;"></i></h5>
              <ol>
                <li style="opacity:0.8">Recherche par nom d'utilisateur.</li>
                <li style="opacity:0.8">Taper le mot <strong>message</strong> pour voire les messages non lus.</li>
              </ol>
            </div>

            <input style="margin-bottom:0;" id="myInput_search" type="text" placeholder="Rechercher..">
            <br><br>
          </div>
          <div class="inbox_chat" id="myContacts">

            <?php
            $respid = $_SESSION['responsable_user_id'];
            $promid = $_SESSION['responsable_prom_id'];
            $sql = "SELECT * FROM tbl_users where user_type='admin'";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
              ?>

              <?php
               ?>


               <!-- admin chat -->
              <div class="chat_list">
                <form action="get_user_data.php" method="post">
                  <input type="hidden" name="iduser" value="<?php echo $row['user_id']; ?>">
                </form>
                <div class="chat_people">
                  <div class="chat_img"> <img src="../images/user.png" alt="user"> </div>
                  <div class="chat_ib">
                    <?php
                    $user = $row['user_id'];
                    $sql = "SELECT msg_datetime,msg_status FROM tbl_messagerie where msg_from_id = '$respid' AND msg_to_id = '$user' OR msg_to_id = '$respid' AND msg_from_id = '$user' order by msg_datetime desc limit 1";
                    $resultMsgDate = mysqli_query($con, $sql)  or die(mysqli_error($con));

                      ?>
                      <h5>
                        <?php
                        $myid = $_SESSION['responsable_user_id'];
                        $amdid = $row['user_id'];
                        $result_msg_from_to = mysqli_query($con, "SELECT * FROM tbl_messagerie where msg_from_id = '$myid' and msg_to_id = '$amdid' or msg_from_id = '$amdid' and msg_to_id = '$myid' ORDER BY msg_datetime desc LIMIT 1")  or die(mysqli_error($con));
                        $row_result_msg_from_to = mysqli_fetch_array($result_msg_from_to);
                         ?>

                         <?php
                         if (!empty($row_result_msg_from_to)) {
                           if ($row_result_msg_from_to['msg_to_id'] == $myid): ?>
                           <?php if ($row_result_msg_from_to['msg_status'] == 1): ?>
                             <span class="tag red round left">neveaux message par </span>
                           <?php endif; ?>
                           <?php endif;
                          }
                          ?>

                        &nbsp<?php echo $row['user_name']; ?>
                      <?php
                        if ($rowResultMsgDate = mysqli_fetch_array($resultMsgDate)) {
                          ?>
                          <span class="chat_date"><?php echo $rowResultMsgDate['msg_datetime']; ?></span>
                          <?php
                        }
                         ?>
                      </h5>
                      <?php

                    if ($row['user_type'] == 1) {
                      $userid = $row['user_id'];

                      $sql = "SELECT prom_name FROM tbl_promo where prom_resp_id='$userid'";
                      $resultPrmName = mysqli_query($con, $sql);
                      $rowPromName = mysqli_fetch_array($resultPrmName);
                      ?>
                      <p>responsable de promotion <?php echo $rowPromName['prom_name']; ?></p>
                      <?php
                    }elseif ($row['user_type'] == 2) {
                      $idens = $row['user_id'];
                      $query=mysqli_query($con, "SELECT * from tbl_module INNER JOIN  tbl_promo ON tbl_module.modl_promo_id=tbl_promo.prom_id AND tbl_module.modl_ens_id='$idens'") or die(mysqli_error($con));
                      ?>
                      <p><strong style="color:rgb(252, 87, 87);">Enseignant de(s) module(s)</strong><br></p>
                      <?php

                      while ($row=mysqli_fetch_assoc($query)):?>
                      <span style="color:rgba(0, 0, 0, 0.69);"><?php echo $row['modl_name'] ." | promo ".$row['prom_name']." | sem ".$row['modl_semestre'];?></span> <br>
                      <?php
                    endwhile;

                  }elseif ($row['user_type'] == 3) {
                    $userid = $row['user_id'];
                    $sql = "SELECT prom_name FROM tbl_delegation INNER JOIN tbl_users ON tbl_delegation.delegation_del_id='$userid' INNER JOIN tbl_promo ON tbl_promo.prom_id=tbl_delegation.delegation_prom_id";
                    $resultPrmName = mysqli_query($con, $sql);
                    $rowPromName = mysqli_fetch_array($resultPrmName);
                    ?>
                    <p>délégué de promotion <?php echo $rowPromName['prom_name']; ?></p>
                    <?php
                  }
                  ?>
                </div>
              </div>
            </div>
            <!-- end admin chat -->




            <?php
          }
          ?>

            <?php
            $respid = $_SESSION['responsable_user_id'];
            $promid = $_SESSION['responsable_prom_id'];
            $sql = "SELECT * FROM tbl_users  inner join tbl_module on tbl_users.user_id=tbl_module.modl_ens_id AND tbl_module.modl_promo_id='$promid'";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
              ?>

              <?php
               ?>

              <div class="chat_list">
                <form action="get_user_data.php" method="post">
                  <input type="hidden" name="iduser" value="<?php echo $row['user_id']; ?>">
                </form>
                <div class="chat_people">
                  <div class="chat_img"> <img src="../images/user.png" alt="user"> </div>
                  <div class="chat_ib">
                    <?php
                    $user = $row['user_id'];
                    $sql = "SELECT msg_datetime,msg_status FROM tbl_messagerie where msg_from_id = '$respid' AND msg_to_id = '$user' OR msg_to_id = '$respid' AND msg_from_id = '$user' order by msg_datetime desc limit 1";
                    $resultMsgDate = mysqli_query($con, $sql)  or die(mysqli_error($con));

                    ?>
                    <h5>
                      <?php
                      $myid = $_SESSION['responsable_user_id'];
                      $ensid = $row['user_id'];
                      $result_msg_from_to = mysqli_query($con, "SELECT * FROM tbl_messagerie where msg_from_id = '$myid' and msg_to_id = '$ensid' or msg_from_id = '$ensid' and msg_to_id = '$myid' ORDER BY msg_datetime desc LIMIT 1")  or die(mysqli_error($con));
                      $row_result_msg_from_to = mysqli_fetch_array($result_msg_from_to);
                       ?>


                       <?php
                       if (!empty($row_result_msg_from_to)) {
                         if ($row_result_msg_from_to['msg_to_id'] == $myid): ?>
                         <?php if ($row_result_msg_from_to['msg_status'] == 1): ?>
                           <span class="tag red round left">neveaux message par </span>
                         <?php endif; ?>
                         <?php endif;
                        }
                        ?>


                      &nbsp<?php echo $row['user_name']; ?>
                      <?php
                      if ($rowResultMsgDate = mysqli_fetch_array($resultMsgDate)) {
                        ?>
                        <span class="chat_date"><?php echo $rowResultMsgDate['msg_datetime']; ?></span>
                        <?php
                      }
                       ?>
                    </h5>
                    <?php
                    if ($row['user_type'] == 1) {
                      $userid = $row['user_id'];

                      $sql = "SELECT prom_name FROM tbl_promo where prom_resp_id='$userid'";
                      $resultPrmName = mysqli_query($con, $sql);
                      $rowPromName = mysqli_fetch_array($resultPrmName);
                      ?>
                      <p>responsable de promotion <?php echo $rowPromName['prom_name']; ?></p>
                      <?php
                    }elseif ($row['user_type'] == 2) {
                      $idens = $row['user_id'];
                      $query=mysqli_query($con, "SELECT * from tbl_module INNER JOIN  tbl_promo ON tbl_module.modl_promo_id=tbl_promo.prom_id AND tbl_module.modl_ens_id='$idens'") or die(mysqli_error($con));
                      ?>
                      <p><strong style="color:rgb(252, 87, 87);">Enseignant de(s) module(s)</strong><br></p>
                      <?php

                      while ($row=mysqli_fetch_assoc($query)):?>
                      <span style="color:rgba(0, 0, 0, 0.69);"><?php echo $row['modl_name'] ." | promo ".$row['prom_name']." | sem ".$row['modl_semestre'];?></span> <br>
                      <?php
                    endwhile;

                  }elseif ($row['user_type'] == 3) {
                    $userid = $row['user_id'];
                    $sql = "SELECT prom_name FROM tbl_delegation INNER JOIN tbl_users ON tbl_delegation.delegation_del_id='$userid' INNER JOIN tbl_promo ON tbl_promo.prom_id=tbl_delegation.delegation_prom_id";
                    $resultPrmName = mysqli_query($con, $sql);
                    $rowPromName = mysqli_fetch_array($resultPrmName);
                    ?>
                    <p>délégué de promotion <?php echo $rowPromName['prom_name']; ?></p>
                    <?php
                  }
                  ?>
                </div>
              </div>
            </div>

            <?php
          }
          ?>


            <?php
            $respid = $_SESSION['responsable_user_id'];
            $promid = $_SESSION['responsable_prom_id'];

            $sql = "SELECT * FROM tbl_users INNER JOIN tbl_delegation ON tbl_users.user_id=tbl_delegation.delegation_del_id AND tbl_delegation.delegation_prom_id='$promid'";
            $result = mysqli_query($con, $sql);
            $count = mysqli_num_rows($result);
            while ($row = mysqli_fetch_array($result)) {
              ?>

              <div class="chat_list">
                <form action="get_user_data.php" method="post">
                  <input type="hidden" name="iduser" value="<?php echo $row['user_id']; ?>">
                </form>
                <div class="chat_people">
                  <div class="chat_img"> <img src="../images/user.png" alt="user"> </div>
                  <div class="chat_ib">
                    <?php
                    $user = $row['user_id'];
                    $sql = "SELECT msg_datetime,msg_status FROM tbl_messagerie where msg_from_id = '$respid' AND msg_to_id = '$user' OR msg_to_id = '$respid' AND msg_from_id = '$user' order by msg_datetime desc limit 1";
                    $resultMsgDate = mysqli_query($con, $sql)  or die(mysqli_error($con));

                    ?>
                    <h5>
                      <?php
                      $myid = $_SESSION['responsable_user_id'];
                      $ensid = $row['user_id'];
                      $result_msg_from_to = mysqli_query($con, "SELECT * FROM tbl_messagerie where msg_from_id = '$myid' and msg_to_id = '$ensid' or msg_from_id = '$ensid' and msg_to_id = '$myid' ORDER BY msg_datetime desc LIMIT 1")  or die(mysqli_error($con));
                      $row_result_msg_from_to = mysqli_fetch_array($result_msg_from_to);
                       ?>


                       <?php
                       if (!empty($row_result_msg_from_to)) {
                         if ($row_result_msg_from_to['msg_to_id'] == $myid): ?>
                         <?php if ($row_result_msg_from_to['msg_status'] == 1): ?>
                           <span class="tag red round left">neveaux message par </span>
                         <?php endif; ?>
                         <?php endif;
                        }
                        ?>


                      &nbsp<?php echo $row['user_name']; ?>
                      <?php
                      if ($rowResultMsgDate = mysqli_fetch_array($resultMsgDate)) {
                        ?>
                        <span class="chat_date"><?php echo $rowResultMsgDate['msg_datetime']; ?></span>
                        <?php
                      }
                       ?>
                    </h5>
                    <?php
                    if ($row['user_type'] == 1) {
                      $userid = $row['user_id'];

                      $sql = "SELECT prom_name FROM tbl_promo where prom_resp_id='$userid'";
                      $resultPrmName = mysqli_query($con, $sql);
                      $rowPromName = mysqli_fetch_array($resultPrmName);
                      ?>
                      <p>responsable de promotion <?php echo $rowPromName['prom_name']; ?></p>
                      <?php
                    }elseif ($row['user_type'] == 2) {
                      $idens = $row['user_id'];
                      $query=mysqli_query($con, "SELECT * from tbl_module INNER JOIN  tbl_promo ON tbl_module.modl_promo_id=tbl_promo.prom_id AND tbl_module.modl_ens_id='$idens'") or die(mysqli_error($con));
                      ?>
                      <p><strong style="color:rgb(252, 87, 87);">Enseignant de(s) module(s)</strong><br></p>
                      <?php

                      while ($row=mysqli_fetch_assoc($query)):?>
                      <span style="color:rgba(0, 0, 0, 0.69);"><?php echo $row['modl_name'] ." | promo ".$row['prom_name']." | sem ".$row['modl_semestre'];?></span> <br>
                      <?php
                    endwhile;

                  }elseif ($row['user_type'] == 3) {
                    $userid = $row['user_id'];
                    $sql = "SELECT prom_name FROM tbl_delegation INNER JOIN tbl_users ON tbl_delegation.delegation_del_id='$userid' INNER JOIN tbl_promo ON tbl_promo.prom_id=tbl_delegation.delegation_prom_id";
                    $resultPrmName = mysqli_query($con, $sql);
                    $rowPromName = mysqli_fetch_array($resultPrmName);
                    ?>
                    <p>délégué de promotion <?php echo $rowPromName['prom_name']; ?></p>
                    <?php
                  }
                  ?>
                </div>
              </div>
            </div>

            <?php
          }
          ?>




          </div>
        </div>
      </div>
    </div>

  </div>

</div>

<?php include("modal_change_pass.php"); ?>
<?php include("../modal_deconnexion.php"); ?>
<?php include("includes/scripts.php"); ?>


<?php
  if (isset($_SESSION['message'])) {
    unset($_SESSION['message']);
  }
?>

<?php
  $idcontact = "myContacts";
   ?>

   <script>

     $("#myInput_search").on("keyup", function() {
       var value = $(this).val().toLowerCase();
       $("#myContacts .chat_list").filter(function() {
         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
       });
     });


     $('.chat_list').click(function(){
       $(this).children("form").submit();
     });

   </script>

   <?php
   if (isset($_SESSION['message'])) {
     unset($_SESSION['message']);
   }
   ?>
 </body>
 </html>
