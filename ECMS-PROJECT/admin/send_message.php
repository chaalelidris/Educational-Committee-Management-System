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





<!-- ===================================== CONTENT ======================================= -->

<div class="main ">


  <!-- ===================================== BREADCUMB =====================================  -->
  <ul class="breadcrumb round-large">
    <li><a href="dashboard.php">accueil</a></li>
    <li> <a href="messagerie.php">Messagerie</a> </li>
    <li>envoyer message</li>
  </ul>
  <hr class="rounded">

  <?php
    require_once("../control/config/dbcon.php");
    ?>
  <link rel="stylesheet" href="css/chat2.css">


  <div class="container">
    <?php
    $useridme = $_SESSION['admin_user_id'];
    $userid = $_SESSION['messagerie_user_id'];
    $sql = "SELECT * FROM tbl_users WHERE user_id='$userid'";
    $result = mysqli_query($con, $sql);
    $rowuserdata = mysqli_fetch_array($result);
     ?>

    <h3 class=" text-center">Messagerie</h3>
    <div class="messaging ">
      <div class="inbox_msg">
        <div class="mesgs" style="margin:0;padding: 0;padding-top:10px;background-color:rgba(0, 0, 0, 0.08);width:100%">

          <div class="" style="padding:10px">
            <a href="messagerie.php"><i class="fa fa-chevron-left"
                style="font-size:250%;font-weight:20px;cursor:pointer;margin-right:10px;"></i></a>
            <i class="fa fa-user-circle-o" style="font-size:250%">
              <?php echo $rowuserdata['user_name']; ?>
            </i>
            <?php
            if ($rowuserdata['user_type'] == 1) {
              $userid = $rowuserdata['user_id'];
              $sql = "SELECT prom_name FROM tbl_promo where prom_resp_id='$userid'";
              $resultPrmName = mysqli_query($con, $sql);
              $rowPromName = mysqli_fetch_array($resultPrmName);
              
            ?>
            
            
            
            <?php if(isset($rowPromName) && !empty($rowPromName)): ?>
              <p style="color:rgba(0, 0, 0, 0.5)">responsable de promotion <?php echo $rowPromName['prom_name']; ?></p>
            <?php else: ?>
              <p style="color:rgba(0, 0, 0, 0.5)">No promotion affected</p>
            <?php endif; ?>

            
            <?php

            }elseif ($rowuserdata['user_type'] == 2) {
              $idens = $rowuserdata['user_id'];
              $query=mysqli_query($con, "SELECT * from tbl_module INNER JOIN  tbl_promo ON tbl_module.modl_promo_id=tbl_promo.prom_id AND tbl_module.modl_ens_id='$idens'") or die(mysqli_error($con));
              ?>
            <p style="margin-top:10px;"><strong style="color:rgb(252, 87, 87);">Enseignant de(s) module(s)</strong><br>
            </p>
            <?php

              while ($row=mysqli_fetch_assoc($query)):?>
            <span style="color:rgba(0, 0, 0, 0.69);">
              <?php echo $row['modl_name'] ." | promo ".$row['prom_name']." | sem ".$row['modl_semestre'];?>
            </span> <br>
            <?php
            endwhile;

          }elseif ($rowuserdata['user_type'] == 3) {
            $userid = $rowuserdata['user_id'];
            $sql = "SELECT prom_name FROM tbl_delegation INNER JOIN tbl_users ON tbl_delegation.delegation_del_id='$userid' INNER JOIN tbl_promo ON tbl_promo.prom_id=tbl_delegation.delegation_prom_id";
            $resultPrmName = mysqli_query($con, $sql);
            $rowPromName = mysqli_fetch_array($resultPrmName);
            ?>
            <p for="" style="color:rgba(0, 0, 0, 0.5)">délégué de promotion
              <?php echo $rowPromName['prom_name']; ?>
            </p>
            <?php
          }?>

          </div>

          <div class="msg_history" style="padding-top:20px;background-color:rgba(255, 255, 255, 1)">

            <?php
            $sql = "SELECT * FROM tbl_messagerie WHERE msg_from_id='$useridme' AND msg_to_id='$userid' OR msg_from_id='$userid' AND msg_to_id='$useridme' order by msg_datetime";
            $resultMessages = mysqli_query($con, $sql);
            $countresultMessages = mysqli_num_rows($resultMessages);

             ?>

            <!-- messages -->
            <?php
            if ($countresultMessages > 0) {
              while ($rowresultMessages = mysqli_fetch_array($resultMessages)) {


              if ($rowresultMessages['msg_from_id'] == $useridme) {
                ?>
            <div class="outgoing_msg">
              <div class="sent_msg">
                <p><strong>Sujet:
                    <?php echo $rowresultMessages['msg_subject']; ?>
                  </strong> </p>
                <div style="width:100%;height:1px;background-color:rgba(87, 175, 238, 0.83)">
                </div>
                <p>
                  <?php echo $rowresultMessages['msg_content']; ?>
                </p>
                <?php
                      $srttime = strtotime($rowresultMessages['msg_datetime']);
                     ?>
                <span class="time_date">
                  <?php echo date('h:ia \| d F Y', $srttime); ?>
                </span>
              </div>
            </div>

            <?php
              }else {
                ?>
            <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="../images/user.png" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p><strong>Sujet:
                      <?php echo $rowresultMessages['msg_subject']; ?>
                    </strong></p>
                  <div style="width:100%;height:1px;background-color:rgba(139, 139, 139, 0.41)">
                  </div>
                  <p>
                    <?php echo $rowresultMessages['msg_content']; ?>
                  </p>
                  <?php
                        $srttime = strtotime($rowresultMessages['msg_datetime']);
                       ?>
                  <span class="time_date">
                    <?php echo date('h:ia \| d F Y', $srttime); ?>
                  </span>
                </div>
              </div>
            </div>


            <?php
                $myid = $_SESSION['admin_user_id'];
                $usrid = $_SESSION['messagerie_user_id'];
                $result_msg_from_to = mysqli_query($con, "SELECT * FROM tbl_messagerie where msg_from_id = '$myid' and msg_to_id = '$usrid' or msg_from_id = '$usrid' and msg_to_id = '$myid' ORDER BY msg_datetime desc LIMIT 1")  or die(mysqli_error($con));
                $row_result_msg_from_to = mysqli_fetch_array($result_msg_from_to);
                 ?>

            <?php
                 if (!empty($row_result_msg_from_to)) {
                   if ($row_result_msg_from_to['msg_to_id'] == $myid): ?>
            <?php if ($row_result_msg_from_to['msg_status'] == 1): ?>
            <?php
                     $msgid = $row_result_msg_from_to['msg_id'];
                     $query = mysqli_query($con, "UPDATE tbl_messagerie SET msg_status='0' WHERE msg_id='$msgid'")or die(mysqli_error($con));
                      ?>

            <?php endif; ?>
            <?php endif;
                  }
                  ?>


            <?php
                }
              }
            }
             ?>




          </div>

          <div class="type_msg">
            <div class="input_msg_write">
              <button id="send_message" class="msg_send_btn" style="width:100%"><i class="fa fa-paper-plane"
                  aria-hidden="true"></i></button>
            </div>
          </div>

        </div>
      </div>

    </div>



  </div>

</div>


<?php include("../modal_send_message.php"); ?>
<?php include("includes/modals/modal_change_pass.php"); ?>
<?php include("includes/modals/modal_add_promotion.php"); ?>
<?php include("includes/modals/modal_add_module.php"); ?>
<?php include("includes/modals/modal_add_user.php"); ?>
<?php include("includes/modals/modal_delete_user.php") ?>
<?php include("../modal_deconnexion.php"); ?>

<?php include("includes/scripts.php"); ?>
<script type="text/javascript">
  // Get the modal desconnect
  var modal_send_message = document.getElementById('idSendMessage');

  $('#send_message').click(function () {
    modal_send_message.style.display = "block";
  });
</script>

<script>
  $(".messages").animate({
    scrollTop: $(document).height()
  }, "fast");
</script>


<?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>


</body>

</html>