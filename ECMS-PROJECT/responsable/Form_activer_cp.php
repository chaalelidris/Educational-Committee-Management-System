<?php

require_once "../control/config/dbcon.php";

$divClass = "main hide";
if (isset($_SESSION['switch_facp'])) {
    $divClass = "main show";
}
?>
<div id="idfacp" class="<?php echo $divClass; ?>">
  <!-- breadcrumb -->
  <ul class="breadcrumb round-large">
    <li><a href="responsable.php"><?=$translations['home']?></a></li>
    <li><a href="#">
        <?php echo $_SESSION['responsable_prom_name']; ?>
      </a></li>
    <li>
      <?php echo $_SESSION['responsable_prom_name']; ?>
    </li>
  </ul>
  <hr class="rounded">




 
    <div class="container">
      <p>
        <button id="programmer_cp" class="button green hover-green round-large">
          <i class="fa fa-chevron-left"></i> <?=$translations['manage_cps']?>
        </button>
      </p>
    </div>
  




    <?php if (isset($_SESSION['message_success'])): ?>
    <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container round-large ">
      <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
      <br>
      <p>
        <?php echo $_SESSION['message_success']; unset($_SESSION['message_success']);unset($_SESSION['message_type']); ?>
      </p>
    </div>
    <?php endif; ?>

    <div class="container_actcp">
      <form action="activer_cp.php" method="post">

        <input type="hidden" name="idresp" value="<?php echo $_SESSION['responsable_user_id']; ?>">

        <div class="row">
          <div class="col-25">
            <label class="label_actcp" for="titre"><?=$translations['cp_title']?></label>
          </div>
          <div class="col-75">
            <input class="input_form_actcp" type="text" name="titre" placeholder="<?=$translations['cp_title']?>..">
          </div>
        </div>

        <div class="row" style="margin-bottom:16px;">
          <div class="col-25">
            <label class="label_actcp" for="datetime"><?=$translations['cp_datetime']?></label>
          </div>
          <div class="col-75">
            <input class="input_form_actcp" type="datetime-local" name="datetime" placeholder="La date et l'heure..">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label class="label_actcp" for="lieu"><?=$translations['cp_location']?></label>
          </div>
          <div class="col-75">
            <input class="input_form_actcp" type="text" name="lieu" placeholder="<?=$translations['cp_location']?>">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="semestre"><?=$translations['semester']?></label>
          </div>
          <div class="col-75">
            <select class="select border" name="semestre" title="veuillez sélectionner"
              style="background-color:#f1f1f1; padding:15px 10px;" required>
              <option value="" disabled selected>Choisissez votre option</option>
              <option value="1"><?=$translations['semester']?> N°1</option>
              <option value="2"><?=$translations['semester']?> N°2</option>
            </select>
          </div>
        </div>




        <div class="row">
          <div class="col-25">
            <label class="label_actcp" for="ordre"><?=$translations['cp_agenda']?></label>
          </div>
          <div class="col-75">
            <textarea class="input_form_actcp" name="ordre" placeholder="Entrer lordre du joure..

  EX:
    1- ...
    2- ...
    3- ..." style="height:200px"></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label class="label_actcp" for="detail"><?=$translations['cp_details']?></label>
          </div>
          <div class="col-75">
            <textarea class="input_form_actcp" name="detail" placeholder="Entrer les détailes..

  EX:

  En l’an deux mille vingt, le quatorzième jour du mois de Janvier, à 12H30 s’est réuni, au niveau
  du département, le comité pédagogique pour débattre les points ci-dessus, et pour lesquels a été
  retenu ce qui suit :" style="height:200px">En l’an [ ANNE], le [ NBR] jour du mois de [ MOIS ], à [ HEUR ] s’est réuni, au niveau
du département, le comité pédagogique pour débattre les points ci-dessus, et pour lesquels a été
retenu ce qui suit :</textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label class="label_actcp" for="intervension"><?=$translations['extra_info']?></label>
          </div>
          <div class="col-75">
            <textarea class="input_form_actcp" name="intervension" placeholder="Entrer les détailes..

  EX:

  N’ayant aucun autre point à l’ordre du jour, la séance fut levée à 13H00." style="height:200px"></textarea>
          </div>
        </div>

        <div class="row">
          <input class="input_submit_actcp" name="activer_cp" type="submit" value="save">
        </div>
      </form>
    </div>

  </div>

</div>