<!-- animate-left -->
<nav class="sidebar bar-block collapse large theme-l2 " id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="right xlarge padding-large hover-primary hide-large"
    title="Fermer le menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="bar-item"><b>Menu</b></h4>
  <a href="dashboard.php" class="bar-item button hover-primary round-large"><?=$translations['home']?></a>

  <?php if (isset($_GET["class"])):?>
  <a id="sideacc" class="bar-item button hover-primary round-large greenn" href="#"><i class="fa fa-users"
      aria-hidden="true"></i>
    Gestion des admins <span class="tag red round right"></span></a>
  <div id="demoAcc" class="bar-block <?php echo $_GET['class']; ?> " style="font-size: 16px;">
    <?php else :?>
    <a id="sideacc" class="bar-item button hover-primary round-large " href="#"><i class="fa fa-users"
        aria-hidden="true"></i> Gestion
      des administrateurs <span class="tag red round right"></span></a>
    <div id="demoAcc" class="bar-block m-2 hide" style="font-size: 16px;">
      <?php endif;?>
      <a class="bar-item button text-white mb-2 hover-primary round-large acc_stl btn_add_user"><i class="fa fa-plus"> Ajouter  administrateur</i></a>
      <a href="manage_admins.php?" class="bar-item button hover-primary round-large acc_stl">Administrateurs</a>
    </div>


    <?php if (isset($_GET["class_pr"])):?>
    <a id="sideacc_pr" class="bar-item button hover-primary round-large greenn" href="#"><i class="fa fa-level-up"
        aria-hidden="true"></i> Gestion des departements <span class="tag red round right"></span></a>
    <div id="demoAcc_pr" class="bar-block white <?php echo $_GET['class_pr']; ?> " style="font-size: 16px;">
      <?php else :?>
      <a id="sideacc_pr" class="bar-item button hover-primary round-large " href="#"><i class="fa fa-level-up"
          aria-hidden="true"></i>
        Gestion des departements <span class="tag red round right"></span></a>
      <div id="demoAcc_pr" class="bar-block white hide" style="font-size: 16px;">
        <?php endif;?>

        <a id="add_department" href="#" class="bar-item button hover-primary round-large acc_stl"><i class="fa fa-plus">
            Ajouter departement</i></a>
        <a href="manage_departments.php?" class="bar-item button hover-primary round-large acc_stl">Gérer les
          departement</i></a>
      </div>



      <a href="users_passwords.php" class="bar-item button hover-primary round-large"><i class="fa fa-key"
          aria-hidden="true"></i> Mot
        de passes</a>
      <?php

    require_once("../control/config/dbcon.php");

    $superAdminId = $_SESSION['super_admin_user_id'];
    $sql = "SELECT * FROM tbl_users where user_id != '$superAdminId' ";
    $result = mysqli_query($con, $sql);
    $count = 0;
    while ($row = mysqli_fetch_array($result)) {
    $myid = $_SESSION['super_admin_user_id'];
    $amdid = $row['user_id'];
    $result_msg_from_to = mysqli_query($con, "SELECT * FROM tbl_messagerie where msg_from_id = '$myid' and msg_to_id = '$amdid' or msg_from_id = '$amdid' and msg_to_id = '$myid' ORDER BY msg_datetime desc LIMIT 1")  or die(mysqli_error($con));
    $row_result_msg_from_to = mysqli_fetch_array($result_msg_from_to);

    if (!empty($row_result_msg_from_to)) {
      if ($row_result_msg_from_to['msg_to_id'] == $myid): ?>
      <?php if ($row_result_msg_from_to['msg_status'] == 1): ?>
      <?php $count = $count + 1; ?>
      <?php endif; ?>
      <?php endif;
     }
  }
   ?>
      <a href="messagerie.php" class="bar-item button hover-primary round-large"><i class="fa fa-envelope"
          aria-hidden="true"></i>
        <?=$translations['messages']?>
        <?php if ($count == 0) {
    ?>
        <span class="tag blue round right">
          <?php echo $count; ?>
          <?php
  }else {
    ?>
          <span class="tag red round right">
            <?php echo $count; ?>
          </span>
          <?php
  } ?>
      </a>
      <!-- <a class="bar-item button hover-primary round-large" href="#">Link</a> -->

</nav>




<!-- Overlay effect when opening sidebar on small screens  -->

<div class="overlay hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay">
</div>



<!-- Sidebar + navbar script -->

<script>
  // Get the Sidebar
  var mySidebar = document.getElementById("mySidebar");

  // Get the DIV with overlay effect
  var overlayBg = document.getElementById("myOverlay");

  // Toggle between showing and hiding the sidebar, and add overlay effect
  function w3_open() {
    if (mySidebar.style.display === 'block') {
      mySidebar.style.display = 'none';
      overlayBg.style.display = "none";
    } else {
      mySidebar.style.display = 'block';
      overlayBg.style.display = "block";
    }
  }

  // Close the sidebar with the close button
  function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
  }
</script>




<!-- Accordination scripts for sidebar -->

<script type="text/javascript">

  var x = document.getElementById("demoAcc");
  var x1 = document.getElementById("demoAcc_pr");
  var x2 = document.getElementById("demoAcc_md");

  // Hide and show Accordion
  document.querySelector('#sideacc').addEventListener('click', function () {
    if (x.className.indexOf("show") == -1) {
      x.className = x.className.replace(" hide", " show");
      x.previousElementSibling.className += " greenn";
    } else {
      x.className = x.className.replace(" show", " hide");
      x.previousElementSibling.className =
        x.previousElementSibling.className.replace(" greenn", "");
    }
  });

  // Hide and show Accordion gst promo
  document.querySelector('#sideacc_pr').addEventListener('click', function () {
    if (x1.className.indexOf("show") == -1) {
      x1.className = x.className.replace(" hide", " show");
      x1.previousElementSibling.className += " greenn";
    } else {
      x1.className = x.className.replace(" show", " hide");
      x1.previousElementSibling.className =
        x1.previousElementSibling.className.replace(" greenn", "");
    }
  });

  // Hide and show Accordion gst modules
  document.querySelector('#sideacc_md').addEventListener('click', function () {
    if (x2.className.indexOf("show") == -1) {
      x2.className = x.className.replace(" hide", " show");
      x2.previousElementSibling.className += " greenn";
    } else {
      x2.className = x.className.replace(" show", " hide");
      x2.previousElementSibling.className =
        x2.previousElementSibling.className.replace(" greenn", "");
    }
  });
</script>