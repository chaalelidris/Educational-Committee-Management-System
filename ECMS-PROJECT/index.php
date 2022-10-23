<!doctype html>
<html class="no-js" lang="">

<head>
  <?php
    session_start();
    // require_once("control/auth_login.php");
    if (empty($_SESSION['admin_user_id'])) {
        if (empty($_SESSION['responsable_user_id'])) {
            if (empty($_SESSION['enseignant_user_id'])) {
                if (empty($_SESSION['delegue_user_id'])) {
                } else {
                    header('location:delegue/delegue.php');
                }
            } else {
                header('location:enseignant/enseignant.php');
            }
        } else {
            header('location:responsable/responsable.php');
        }
    } else {
        header('location:admin/admin.php');
    }
    ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>System | Connection</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- <link rel="stylesheet" href="style/css/normalize.css"> -->
  <link rel="stylesheet" href="style/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="style/css/font-awesome.min.css"> -->
  <!-- <link rel="stylesheet" href="style/css/themify-icons.css"> -->
  <!-- <link rel="stylesheet" href="style/css/flag-icon.min.css"> -->
  <!-- <link rel="stylesheet" href="style/css/cs-skin-elastic.css"> -->
  <!-- <link rel="stylesheet" href="style/css/lib/datatable/dataTables.bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="style/css/lib/chosen/chosen.min.css"> -->

  <!-- <link rel="stylesheet" href="style/scss/style.css"> -->
  <link rel="stylesheet" href="style/css/font-awesome.min.css">
  <link rel="stylesheet" href="style/loginHome.css">
</head>

<?php error_reporting(0); ?>
<!-- linear-gradient(90deg, rgb(0, 184, 252),rgb(0, 83, 194)) -->

<body style="background:#f0f2f5 ;">

  <div class="container mt-lg-5 mt-sm-0" style="background: #fff;box-shadow: 0 0 0.9rem 0.2rem #bdbdbd ; ">
    <div class="row ">
      <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12" style="background: #191923; ">
        <h1 style="color:white; padding:10px; text-align: center;">GESTION DES COMITE PIDAGOGIQUE</h1>
      </div>
    </div>

    <div class="row mt-0" style="">
      <div class="col-lg-9 col-xl-9 col-md-8 col-sm-12 col-xs-12 " style="padding:0">
        <strong style="color:rgba(0, 0, 0, 0.4)"><img src="images/committee-image.jpg" alt="GCP" style="max-width: 100%; height: auto;">
        </strong>
        <!-- image description -->
        <!-- <img src="images" class="col-sm-12" style="padding: 5px;"> -->
      </div>

      <div style="background:#191923; " class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12 ">


        <?php if ($_GET['errorm'] & $_GET['erroru']) {?>
        <div class=" alert with-close alert-danger alert-dismissible fade show " style="color:#fff;background-color: #BF1363;border:0px;">
          <!-- <span class="badge badge-pill badge-danger">Error</span> -->
          <li><?php echo $_GET['erroru']; ?></li>
          <li><?php echo $_GET['errorm']; ?></li>

          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } elseif ($_GET['erroru']) {?>
        <div class=" alert with-close alert-danger alert-dismissible fade show " style="color:#fff;background-color: #BF1363;border:0px;">
          <!-- <span class="badge badge-pill badge-danger">Error</span> -->
          <li><?php echo $_GET['erroru'];?></li>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } elseif ($_GET['errorm']) {?>
        <div class=" alert with-close alert-danger alert-dismissible fade show " style="color:#fff;background-color: #BF1363;border:0px;">
          <!-- <span class="badge badge-pill badge-danger">Error</span> -->
          <li><?php echo $_GET['errorm'];?></li>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } elseif ($_GET['errorlog']) {?>
        <div class=" alert with-close alert-danger alert-dismissible fade show " style="color:#fff;background-color: #BF1363;border:0px;">
          <!-- <span class="badge badge-pill badge-danger">Error</span> -->
          <li><?php echo $_GET['errorlog'];?></li>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } ?>


        <!-- forgot ////// -->
        <?php if ($_GET['error']=="forgot") {?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <span class="badge badge-pill badge-success">Success</span>
          Demande envoyée avec succés
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } ?>

        <?php // TODO: action ??? index.php?>

        <form method="POST" action="control\auth_login.php" autocomplete="on">
          <div class="form-group">
            <label style="color:#fff"><strong>Nom D'utilisateur</strong></label>
            <input type="text" class="form-control" placeholder="Pseudo" style="" name="username" value="<?php echo $_GET['username']?>">
          </div>

          <div class="form-group">
            <label style="color:#fff"><strong>Mot de passe</strong></label>
            <input type="password" class="form-control" placeholder="Mot De Passe" name="password">
          </div>

          <div class="checkbox">
            <label class="">
              <a href="#forgot" data-toggle="modal" style="color:dodgerblue">Mot de passe oublié?</a>
            </label>
          </div>
          <!-- class="btn btn-success btn-flat btn-block " -->
          <button id="conn" style="" title="Cliquez ici pour vous connecter" type="submit" name="user_submit" class="btn-s"><strong>Connection</strong></button>
        </form>
        <!-- </div> -->
      </div>
    </div>
    <div class="row mt-0">
      <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12" style="background: #191923; padding:10px;">
        <center style="color:#868e96;">
          <!-- target ==> _blank -->
          <!-- Visit <a href="#!" target="" style="color: dodgerblue" >@Chaalel.khebizi</a> -->
          Copyright &copy;2020 Université 8 mai 1945, Département d'informatique<br>
          EQUIPE DE DEVELOPEMENT <strong>sous Encadrement de</strong> DR Halimi khaled<br>
          ►Chaalel idris <strong>et</strong> Khebizi hamed <br>
          <div class="btn-group">
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#">Contact</button> -->
            <button style="background-color:rgb(105, 105, 105);color:white;border-radius:0;" type="button" class="btn" data-toggle="modal" data-target="#myModal"><i class="fa fa-info-circle" aria-hidden="true"></i> info </button>
          </div>
        </center>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg modal-dialog-centered" >

      <!-- Modal content-->
      <div class="modal-content" style="border-radius:0px;">
        <button type="button" class="close" data-dismiss="modal" style="display:inline;text-align:right;margin:5px 15px;">&times;</button>
        <h3 style="margin-left:1em;">GESTION DES COMITES PIDAGOGIQUES</h3>
        <div class="modal-body" >
          <p style="text-align: justify;text-justify: inter-word; margin:0 1em 0 1em">
            Le système permet d'une
            part à l'administration de bien gérer et de bien contrôler les membres qui ont pour rôle de
            concrétiser les différentes actions à caractères pédagogiques, de fixer les dates de réunion,
            l’envoi des invitations, etc. Et d'une autre part, il permet aux acteurs (responsables de parcours,
            Enseignants et Etudiants) de suivre les opérations pédagogiques au sein du département
            à savoir : le suivi d’avancement des cours, l’achèvement des chapitres, la programmation des
            contrôles continus etc... </p>
        </div>

      </div>

    </div>
  </div>




  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>
