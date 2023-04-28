<!-- ================================                  Navbar                 ===================================-->





<div class="top">
  <div class="bar theme-l2 left-align large">
    <a class="bar-item button left hide-large hover-white large theme-primary" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    <a href="enseignant.php" class="bar-item button theme-primary"><i class="fa fa-home margin-right"></i> GCP | ENSEIGNANT</a>
    <a href="#" id="disscon" class="bar-item button right hover-white"><i class="fa fa-sign-out"></i></a>

    <div class="dropdown-hover right">
      <a href="#" class="button hover-white" title=""><?php echo $_SESSION['enseignant_user_name']; ?> </i></a>
      <!-- <div class="dropdown-content bar-block hover-primary">
        <a href="#" class="bar-item button" >Profile</a>
      </div> -->
    </div>

    <select class="button-sm blue hover-primary right" id="language-select"
      style="margin-top: 10px;margin-right: 10px;">
      <option value="en" <?php echo ($_SESSION['lang']=='en' ) ? 'selected' : '' ; ?>>English</option>
      <option value="fr" <?php echo ($_SESSION['lang']=='fr' ) ? 'selected' : '' ; ?>>Français</option>
      <option value="ar" <?php echo ($_SESSION['lang']=='ar' ) ? 'selected' : '' ; ?>>العربية</option>
    </select>
    <!-- <a href="#" class="bar-item button hide-small hide-medium hover-white">5</a> -->
    <!-- <a href="#" class="bar-item button hide-small right hover-teal" title="Search"><i class="fa fa-search"></i></a> -->
  </div>
</div>


<script>
  document.getElementById("language-select").addEventListener("change", function() {
    var lang = this.value;
    window.location.href = "../lang/change_language.php?lang=" + lang; // change_language.php is the file that changes the language
  });
</script>