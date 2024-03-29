<?php require_once("../control/config/dbcon.php");?>
<?php if (isset($_SESSION['switch_fmdcp'])): ?>
<div id="idfmdcp" class="main show">
  <?php else: ?>
  <div id="idfmdcp" class="main hide">
    <?php endif; ?>
    <!--                                                    breadcrumb                                                       -->
    <ul class="breadcrumb round-large">
      <li><a href="responsable.php"><?=$translations['home']?></a></li>
      <li> <a href="#">
          <?php echo $_SESSION['responsable_prom_name'];?>
        </a> </li>
      <li>Modifier CP
        <?php echo $_SESSION['responsable_prom_name']; ?>
      </li>
    </ul>
    <hr class="rounded">


    <div class="container">
      <h2>Modifier ( CP )</h2>
      <!-- <p><?=$translations['sort_table']?></p> -->

      <?php
    require_once("../control/config/dbcon.php");
    ?>

      <div class="cell-row">
        <div class="container cell">
          <p><button id="modifier_cp" class="button green hover-green round-large"> <i class="	fa fa-chevron-left"></i>
              <?=$translations['back']?></button></p>
        </div>
        <div class="container  cell">
        </div>
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
        <form action="edit_cp.php" method="post">

          <input type="hidden" name="idresp" value="<?php echo $_SESSION['responsable_user_id']; ?>">
          <input type="hidden" name="idcp" value="<?php echo $_SESSION['edit_id'] ?>">

          <div class="row">
            <div class="col-25">
              <label class="label_actcp" for="titre"><?=$translations['cp_title']?></label>
            </div>
            <div class="col-75">
              <input value="<?php echo $_SESSION['edit_titre']; ?>" class="input_form_actcp" type="text" name="titre"
                placeholder="<?=$translations['cp_title']?>..">
            </div>
          </div>

          <div class="row" style="margin-bottom:16px;">
            <div class="col-25">
              <label class="label_actcp" for="datetime"><?=$translations['cp_datetime']?></label>
            </div>
            <div class="col-75">
              <?php
              $srttime = strtotime($_SESSION['edit_datetime']);
            ?>
              <input type="datetime-local" value="<?php echo date('Y-m-d\TH:i', $srttime); ?>" class="input_form_actcp"
                name="datetime" placeholder="La date et l'heure..">
            </div>
          </div>


          <div class="row">
            <div class="col-25">
              <label class="label_actcp" for="lieu"><?=$translations['cp_location']?></label>
            </div>
            <div class="col-75">
              <input value="<?php echo $_SESSION['edit_location']; ?>" class="input_form_actcp" type="text" name="lieu"
                placeholder="<?=$translations['cp_location']?>">
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="<?=$translations['semester']?>"><b><?=$translations['semester']?></b></label>
            </div>
            <div class="col-75">
              <select class="select border" name="semestre" title="veuillez sélectionner"
                style="background-color:#f1f1f1; padding:15px 10px;" required>
                <option value="<?php echo $_SESSION['edit_semestre']; ?>" selected>
                  <?php echo "semestre N°".$_SESSION['edit_semestre_name']  ?>
                </option>
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
              <textarea value="" class="input_form_actcp" name="ordre" placeholder="Entrer lordre du joure..

  EX:
    1- ...
    2- ...
    3- ..." style="height:200px"><?php echo $_SESSION['edit_ordre']; ?></textarea>
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
  retenu ce qui suit :" style="height:200px"><?php echo $_SESSION['edit_detail']; ?></textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label class="label_actcp" for="intervension"><?=$translations['extra_info']?></label>
            </div>
            <div class="col-75">
              <textarea class="input_form_actcp" name="intervension" placeholder="Entrer les détailes..

  EX:

  N’ayant aucun autre point à l’ordre du jour, la séance fut levée à 13H00."
                style="height:200px"><?php echo $_SESSION['edit_intervension']; ?></textarea>
            </div>
          </div>

          <div class="row">
            <input class="input_submit_actcp" name="modifier_cp" type="submit" value="save">
          </div>
        </form>
      </div>

    </div>

  </div>