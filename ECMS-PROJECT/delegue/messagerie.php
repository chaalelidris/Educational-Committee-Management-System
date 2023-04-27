
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





<div class="main ">
  <!--                                                    breadcrumb                                                       -->
  <ul class="breadcrumb round-large">
    <li><a href="delegue.php"><?=$translations['home']?></a></li>
    <li><?=$translations['messages']?></li>
  </ul>
  <hr class="rounded">

  <?php
    require_once("../control/config/dbcon.php");
    ?>
  <link rel="stylesheet" href="../admin/css/chat2.css">


  <div class="container">
    <h3 class=" text-center"><?=$translations['messages']?></h3>
    <div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people" style="width:100%">
          <div class="headind_srch">
            <div class="recent_heading" >
              <h5><i class="fa fa-info-circle " aria-hidden="true" style="color:blue;font-size:2em;"></i></h5>
              <ol>
                <li style="opacity:0.8"><?=$translations['sbun']?></li>
                <li style="opacity:0.8"><?=$translations['msg_info2']?></li>
              </ol>
            </div>

            <input style="margin-bottom:0;" id="myInput_search" type="text" placeholder="<?=$translations['search']?>">
            <br><br>
          </div>
          <div class="inbox_chat" id="myContacts">

            <?php
            $delid = $_SESSION['delegue_user_id'];
            $promid = $_SESSION['delegue_promotion_id'];
            $sql = "SELECT prom_resp_id FROM tbl_promo where prom_id='$promid'";
            $resultRespID = mysqli_query($con, $sql);
            $rowresultRespID = mysqli_fetch_array($resultRespID);
            $rspid = $rowresultRespID['prom_resp_id'];

            $sql = "SELECT * FROM tbl_users where user_id != '$delid' AND user_type='admin' OR user_id='$rspid'";
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
                    $sql = "SELECT msg_datetime,msg_status FROM tbl_messagerie where msg_from_id = '$delid' AND msg_to_id = '$user' OR msg_to_id = '$delid' AND msg_from_id = '$user' order by msg_datetime desc limit 1";
                    $resultMsgDate = mysqli_query($con, $sql)  or die(mysqli_error($con));

                    ?>
                    <h5>
                      <?php
                      $myid = $_SESSION['delegue_user_id'];
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
                      <p><?=$translations['promotion_manager']?> <?php echo $rowPromName['prom_name']; ?></p>
                      <?php
                    }elseif ($row['user_type'] == 2) {
                      $idens = $row['user_id'];
                      $query=mysqli_query($con, "SELECT * from tbl_module INNER JOIN  tbl_promo ON tbl_module.modl_promo_id=tbl_promo.prom_id AND tbl_module.modl_ens_id='$idens'") or die(mysqli_error($con));
                      ?>
                      <p><strong style="color:rgb(252, 87, 87);"><?=$translations['teacher_of']?></strong><br></p>
                      <?php

                      while ($row=mysqli_fetch_assoc($query)):?>
                      <span class="text-gray"><?php echo $row['modl_name'] ." | promo ".$row['prom_name']." | sem ".$row['modl_semestre'];?></span> <br>
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
