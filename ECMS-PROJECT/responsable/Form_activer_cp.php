


<?php if (isset($_SESSION['switch_facp'])): ?>
    <div id="idfacp" class="main show" >
  <?php else: ?>
    <div id="idfacp" class="main hide" >
    <?php endif; ?>
  <!--                                                    breadcrumb                                                       -->
  <ul class="breadcrumb" >
    <li><a href="responsable.php">accueil</a></li>
    <li> <a href="#">Programmation CP <?php echo $_SESSION['responsable_prom_name'];?></a> </li>
    <li>Activer un CP <?php echo $_SESSION['responsable_prom_name']; ?></li>
  </ul>
  <hr class="rounded">

  <?php
  require_once("../control/config/dbcon.php");
  ?>

  <div class="container">
    <h2>Activation d'un réunion ( CP )</h2>
    <!-- <p>Cliquez sur les en-têtes pour trier le tableau.</p> -->

    <?php
    require_once("../control/config/dbcon.php");
    ?>

    <div class="cell-row">
      <div class="container cell">
        <p><button id="programmer_cp" class="button green hover-green"> <i class="	fa fa-chevron-left"></i> Arrière</button></p>
      </div>
      <div class="container  cell">
      </div>
    </div>


    <?php if (isset($_SESSION['message_suc'])): ?>
      <div class="panel <?php echo $_SESSION["message_type"]; ?> display-container ">
        <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
        <br>
        <p><?php echo $_SESSION['message_suc']; unset($_SESSION['message_suc']);unset($_SESSION['message_type']); ?></p>
      </div>
    <?php endif; ?>

    <div class="container_actcp">
      <form action="activer_cp.php" method="post">

        <input type="hidden" name="idresp" value="<?php echo $_SESSION['responsable_user_id']; ?>">

        <div class="row">
          <div class="col-25">
            <label class="label_actcp" for="titre">Titre complet du CP</label>
          </div>
          <div class="col-75">
            <input class="input_form_actcp" type="text" name="titre" placeholder="Le titre..">
          </div>
        </div>

        <div class="row" style="margin-bottom:16px;">
          <div class="col-25">
            <label class="label_actcp" for="datetime">Date et Heure du CP</label>
          </div>
          <div class="col-75">
            <input class="input_form_actcp" type="datetime-local" name="datetime" placeholder="La date et l'heure..">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label class="label_actcp" for="lieu">Lieu du CP</label>
          </div>
          <div class="col-75">
            <input class="input_form_actcp" type="text" name="lieu" placeholder="Le lieu..">
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="semestre">sélectionner le semestre</label>
          </div>
          <div class="col-75">
            <select class="select border" name="semestre" title="veuillez sélectionner" style="background-color:#f1f1f1; padding:15px 10px;" required>
              <option value="" disabled selected>Choisissez votre option</option>
              <option value="1">semestre N°1</option>
              <option value="2">semestre N°2</option>
            </select>
          </div>
        </div>




        <div class="row">
          <div class="col-25">
            <label class="label_actcp" for="ordre">Ordre du jour</label>
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
            <label class="label_actcp" for="detail">Détailes</label>
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
            <label class="label_actcp" for="intervension">Interventions diverses.</label>
          </div>
          <div class="col-75">
            <textarea class="input_form_actcp" name="intervension" placeholder="Entrer les détailes..

  EX:

  N’ayant aucun autre point à l’ordre du jour, la séance fut levée à 13H00." style="height:200px"></textarea>
          </div>
        </div>

        <div class="row">
          <input class="input_submit_actcp" name="activer_cp" type="submit" value="Soumettre">
        </div>
      </form>
    </div>

  </div>

</div>
