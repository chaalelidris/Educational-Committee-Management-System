
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
    <ul class="breadcrumb" >
      <li><a href="enseignant.php">accueil</a></li>
      <li><a href="module_data.php">Donnés de mon module</a></li>
      <li>Modifier l'état d'avancement de mon module</li>
    </ul>
    <hr class="rounded">

    <?php
    require_once("../control/config/dbcon.php");
    ?>

    <div class="cell-row">
      <div class="container cell">
        <p><button id="modl_data_return" class="button green hover-green"> <i class="	fa fa-chevron-left"></i> Arrière</button></p>
      </div>
      <div class="container  cell">
      </div>
    </div>

    <div class="container responsive" style="background:#191923">


      <?php if (isset($_SESSION['message_suc'])): ?>
        <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container ">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p><?php echo $_SESSION['message_suc']; unset($_SESSION['message_suc']); ?></p>
        </div>
      <?php endif; ?>


      <form id="regForm_form_ms" action="edit_data.php" method="post" class="">

        <h1 class="h1_form_ms">Modifier les champ SVP:</h1>
        <h2 for="">Module <?php echo $_SESSION['mdl_mdlname']; ?></h2>

        <!-- One "tab" for each step in the form: -->
        <div class="tab_form_ms">Avancement globale:
          <p><input value="<?php echo $_SESSION['sess_data8']; ?>" name="avancement" class="input_form_ms" placeholder="Avancement globale..." ></p>
          Nombre de chapitres achevés / En cours
          <p><input value="<?php echo $_SESSION['sess_data7']; ?>" name="nbr_chap" class="input_form_ms" placeholder="Nombre de chapitres achevés / En cours..." ></p>
        </div>

        <div class="tab_form_ms">Nombre de séances de cours faites:
          <p><input value="<?php echo $_SESSION['sess_data6']; ?>" name="nbr_seances" class="input_form_ms" placeholder="Nombre de séances de cours faites..." ></p>
          Nombre de séances de TD et TP faites:
          <p><input value="<?php echo $_SESSION['sess_data5']; ?>" name="nbr_seances_tdtp" class="input_form_ms" placeholder="Nombre de séances de TD et TP faites..." ></p>
          Nombre de séances (Cours, TD, TP) non faites:
          <p><input value="<?php echo $_SESSION['sess_data4']; ?>" name="nbr_ceances_ctdtp_no" class="input_form_ms" placeholder="Nombre de séances (Cours, TD, TP) non faites..." ></p>
        </div>

        <div class="tab_form_ms">Exposés + Micro:
          <p><input value="<?php echo $_SESSION['sess_data3']; ?>" name="exps_micro" class="input_form_ms" placeholder="Exposés + Micro..." ></p>
          Validation de TP:
          <p><input value="<?php echo $_SESSION['sess_data2']; ?>" name="valid_tp" class="input_form_ms" placeholder="Validation de TP..." ></p>
          Polycopie de cours:
          <p><input value="<?php echo $_SESSION['sess_data1']; ?>" name="Polycopie_cours" class="input_form_ms" placeholder="Polycopie de cours..." ></p>
        </div>

        <!-- <div class="tab_form_ms">Login Info:
          <p><input class="input_form_ms" placeholder="Password..." ></p>
        </div> -->

        <input  type="hidden" name="cpid" value="<?php echo $_SESSION['cp_id']; ?>">
        <input  type="hidden" name="mdlid" value="<?php echo $_SESSION['mdl_id']; ?>">
        <input  type="hidden" name="dataid" value="<?php echo $_SESSION['data_id']; ?>">


        <div style="overflow:auto;">
          <div style="float:right;">
            <button class="button_form_ms" type="button" id="#prevBtn_form_ms" onclick="nextPrev(-1)">Précédent</button>
            <button name="insert_modl_data" class="button_form_ms" type="button" id="nextBtn" onclick="nextPrev(1)">Suivant</button>
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
        document.getElementById("nextBtn").innerHTML = "Soumettre";
      } else {
        document.getElementById("nextBtn").innerHTML = "Suivant";
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
