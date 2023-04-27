
<?php
  include("includes/head.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "enseignant";
  }else {
    $_SESSION["current_session"] = "enseignant";
  }

  include("includes/navbar.php");
  include("includes/sidebar.php");
 ?>





  <!-- =====================================                  contenus               ======================================= -->






  <div class="main show" >
    <!--                                                    breadcrumb                                                       -->
    <ul class="breadcrumb round-large" >
      <li><a href="enseignant.php"><?=$translations['home']?></a></li>
      <li><a href="modules.php">Liste des modules</a></li>
      <li>Remplir l'état d'avancement de module</li>
    </ul>
    <hr class="rounded">

    <?php
    require_once("../control/config/dbcon.php");
    ?>

    <div class="cell-row">
      <div class="container cell">
        <p><button id="back_return" class="button green hover-green round-large"> <i class="	fa fa-chevron-left"></i> <?=$translations['back']?></button></p>
      </div>
      <div class="container  cell">
      </div>
    </div>

    <div class="container responsive" >

      <form id="regForm_form_ms" action="insert_del_data.php" method="post" class="">

        <h1 class="h1_form_ms">Remplir les champ SVP:</h1>
        <h2 for=""><?=$translations['module']?> <?php echo $_SESSION['mdl_name']; ?></h2>

        <!-- One "tab" for each step in the form: -->
        <div class="tab_form_ms"><?=$translations['global_adv']?>:
          <p><input name="avancement" class="input_form_ms" placeholder="<?=$translations['global_adv']?>..." ></p>
          <?=$translations['nb_chap_done_progress']?>
          <p><input name="nbr_chap" class="input_form_ms" placeholder="<?=$translations['nb_chap_done_progress']?>..." ></p>
        </div>

        <div class="tab_form_ms"><?=$translations['n_s_c_done']?>:
          <p><input name="nbr_seances" class="input_form_ms" placeholder="<?=$translations['n_s_c_done']?>..." ></p>
          Nombre de séances de TD et TP faites:
          <p><input name="nbr_seances_tdtp" class="input_form_ms" placeholder="Nombre de séances de TD et TP faites..." ></p>
          Nombre de séances (Cours, TD, TP) non faites:
          <p><input name="nbr_ceances_ctdtp_no" class="input_form_ms" placeholder="Nombre de séances (Cours, TD, TP) non faites..." ></p>
        </div>

        <div class="tab_form_ms">Exposés + Micro:
          <p><input name="exps_micro" class="input_form_ms" placeholder="Exposés + Micro..." ></p>
          Validation de TP:
          <p><input name="valid_tp" class="input_form_ms" placeholder="Validation de TP..." ></p>
          Polycopie de cours:
          <p><input name="Polycopie_cours" class="input_form_ms" placeholder="Polycopie de cours..." ></p>
        </div>

        <!-- <div class="tab_form_ms">Login Info:
          <p><input class="input_form_ms" placeholder="Password..." ></p>
        </div> -->

        <input  type="hidden" name="cp_id" value="<?php echo $_SESSION['cp_id']; ?>">
        <input  type="hidden" name="mdlid" value="<?php echo $_SESSION['mdl_id']; ?>">


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
    $('#back_return').click(function(){
      window.location.assign("modules.php");
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
        document.getElementById("nextBtn").innerHTML = "Soumettre";
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
