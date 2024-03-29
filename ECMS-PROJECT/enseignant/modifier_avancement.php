
<?php
  include("includes/head.php");
  include("includes/navbar.php");
  include("includes/sidebar.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
  }
  $_SESSION["current_session"] = "enseignant";

 ?>

  <div class="main show" >
    <!--                                                    breadcrumb                                                       -->
    <ul class="breadcrumb round-large" >
      <li><a href="enseignant.php"><?=$translations['home']?></a></li>
      <li><a href="module_data.php">Donnés de mon module</a></li>
      <li>Modifier l'état d'avancement de mon module</li>
    </ul>
    <hr class="rounded">

    <?php
    require_once("../control/config/dbcon.php");
    ?>

    <div class="cell-row">
      <div class="container cell">
        <p><button id="modl_data_return" class="button green hover-green round-large"> <i class="	fa fa-chevron-left"></i> <?=$translations['back']?></button></p>
      </div>
      <div class="container  cell">
      </div>
    </div>

    <div class="container responsive" >


      <?php if (isset($_SESSION['message_success'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message_success']; unset($_SESSION['message_success']); ?></p>
        </div>
      <?php endif; ?>


      <form id="regForm_form_ms" action="edit_data.php" method="post" class="">

        <h1 class="h1_form_ms"><?=$translations['please_fill_the_fields']?></h1>
        <h2 for=""><?=$translations['module']?> <?php echo $_SESSION['mdl_mdlname']; ?></h2>

        <!-- One "tab" for each step in the form: -->
        <div class="tab_form_ms"><?=$translations['global_adv']?>:
          <p><input value="<?php echo $_SESSION['sess_data8']; ?>" name="avancement" class="input_form_ms" placeholder="<?=$translations['global_adv']?>..." ></p>
          <?=$translations['nb_chap_done_progress']?>
          <p><input value="<?php echo $_SESSION['sess_data7']; ?>" name="nbr_chap" class="input_form_ms" placeholder="<?=$translations['nb_chap_done_progress']?>..." ></p>
        </div>

        <div class="tab_form_ms"><?=$translations['n_s_c_done']?>:
          <p><input value="<?php echo $_SESSION['sess_data6']; ?>" name="nbr_seances" class="input_form_ms" placeholder="<?=$translations['n_s_c_done']?>..." ></p>
          <?=$translations['n_s_td_tp_done']?>:
          <p><input value="<?php echo $_SESSION['sess_data5']; ?>" name="nbr_seances_tdtp" class="input_form_ms" placeholder="<?=$translations['n_s_td_tp_done']?>..." ></p>
          <?=$translations['n_s_ctdtp_not_done']?>:
          <p><input value="<?php echo $_SESSION['sess_data4']; ?>" name="nbr_ceances_ctdtp_no" class="input_form_ms" placeholder="<?=$translations['n_s_ctdtp_not_done']?>..." ></p>
        </div>

        <div class="tab_form_ms"><?=$translations['p_m']?>:
          <p><input value="<?php echo $_SESSION['sess_data3']; ?>" name="exps_micro" class="input_form_ms" placeholder="<?=$translations['p_m']?>..." ></p>
          <?=$translations['tp_validation']?>:
          <p><input value="<?php echo $_SESSION['sess_data2']; ?>" name="valid_tp" class="input_form_ms" placeholder="<?=$translations['tp_validation']?>..." ></p>
          <?=$translations['handout_course']?>:
          <p><input value="<?php echo $_SESSION['sess_data1']; ?>" name="Polycopie_cours" class="input_form_ms" placeholder="<?=$translations['handout_course']?>..." ></p>
          <?=$translations['avis_ens']?>
          <p><input value="<?php echo $_SESSION['sess_data0']; ?>" name="avis_ens" class="input_form_ms" placeholder="<?=$translations['avis_ens']?>" ></p>
        </div>

        <!-- <div class="tab_form_ms">Login Info:
          <p><input class="input_form_ms" placeholder="Password..." ></p>
        </div> -->

        <input  type="hidden" name="cp_id" value="<?php echo $_SESSION['cp_id']; ?>">
        <input  type="hidden" name="mdlid" value="<?php echo $_SESSION['mdl_id']; ?>">
        <input  type="hidden" name="dataid" value="<?php echo $_SESSION['data_id']; ?>">


        <div style="overflow:auto;">
          <div style="float:right;">
            <button class="button_form_ms" type="button" id="#prevBtn_form_ms" onclick="nextPrev(-1)"><?=$translations['previous']?></button>
            <button name="insert_modl_data" class="button_form_ms" type="button" id="nextBtn" onclick="nextPrev(1)"><?=$translations['next']?></button>
          </div>
        </div>

        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
          <span class="step_form_ms"></span>
          <span class="step_form_ms"></span>
          <span class="step_form_ms"></span>
          <span class="step_form_ms"></span>
        </div>

      </form>

    </div>

  </div>



  <?php include("../modal_deconnexion.php"); ?>
  <?php include("includes/scripts.php"); ?>

  <script type="text/javascript">
    $('#modl_data_return').click(function(){
      window.location.assign("module_data.php");
    });
  </script>

  <!-- multi steps form Remplir avancement -->
  <script type="text/javascript">
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
      // This function will display the specified tab of the form ...
      var x = document.getElementsByClassName("tab_form_ms");
      x[n].style.display = "block";
      // ... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("#prevBtn_form_ms").style.display = "none";
      } else {
        document.getElementById("#prevBtn_form_ms").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "save";
      } else {
        document.getElementById("nextBtn").innerHTML = "<?=$translations['next']?>";
      }
      // ... and run a function that displays the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab_form_ms");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form... :
      if (currentTab >= x.length) {
        //...the form gets submitted:
        var r = confirm("Vous étes sur ?");
        if (r == true) {
          document.getElementById("regForm_form_ms").submit();
          return false;
        } else {
          currentTab = currentTab - n;
        }
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab_form_ms");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false:
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step_form_ms")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step_form_ms");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class to the current step:
      x[n].className += " active";
    }
  </script>


  <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>
  </body>
</html>
