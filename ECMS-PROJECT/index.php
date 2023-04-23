<!doctype html>
<html class="no-js" lang="">

<head>
  <?php
    session_start();
    // require_once("control/auth_login.php");
    $redirect_url = "";
    $user_id = "";
    if (!empty($_SESSION['super_admin_user_id'])) {
      $redirect_url = "super-admin/dashboard.php";
      $user_id = $_SESSION['super_admin_user_id'];
    } else if (!empty($_SESSION['admin_user_id'])) {
      $redirect_url = "admin/dashboard.php";
      $user_id = $_SESSION['admin_user_id'];
    } else if (!empty($_SESSION['responsable_user_id'])) {
      $redirect_url = "responsable/responsable.php";
      $user_id = $_SESSION['responsable_user_id'];
    } else if (!empty($_SESSION['enseignant_user_id'])) {
      $redirect_url = "enseignant/enseignant.php";
      $user_id = $_SESSION['enseignant_user_id'];
    } else if (!empty($_SESSION['delegue_user_id'])) {
      $redirect_url = "delegue/delegue.php";
      $user_id = $_SESSION['delegue_user_id'];
    }
    
    if (!empty($redirect_url)) {
      header("location: " . $redirect_url);
      exit;
    }
    ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Gestion Des CPs | Université 8 Mai 1945 Guelma</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <meta name="description" content="Le système de gestion de comité éducatif 
                                    est une plateforme de gestion efficace pour les comités éducatifs des établissements 
                                    scolaires et universitaires. Il permet de suivre les activités du comité, la planification 
                                    des réunions, la gestion des membres et des tâches, ainsi que la communication entre les membres.
                                    Ce système est conçu pour améliorer l'efficacité et la productivité des comités éducatifs, 
                                    tout en offrant une expérience utilisateur conviviale et intuitive.">

  <meta name="keywords" content="System, Login, Connection,Admin,Responsible,Report,Managment,Commite,Commité,Pidagogique,Délégé,Enseignant,Teacher,Delegate">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://ent.univ-guelma.dz/gcp">
  <!-- CSS -->
  <link rel="stylesheet" href="style/css/bootstrap.min.css">
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
        <strong style="color:rgba(0, 0, 0, 0.4)"><img src="images/committee-image.jpg" alt="GCP"
            style="max-width: 100%; height: auto;">
        </strong>
      </div>

      <div style="background:#191923; " class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12 ">

        <?php
      if (isset($_GET['errorm']) && isset($_GET['erroru'])) {
          echo '<div class="alert with-close alert-danger alert-dismissible fade show" style="color:#fff;background-color: #BF1363;border:0px;">';
          echo '<li>' . $_GET['erroru'] . '</li>';
          echo '<li>' . $_GET['errorm'] . '</li>';
          echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
          echo '</div>';
      } elseif (isset($_GET['erroru'])) {
          echo '<div class="alert with-close alert-danger alert-dismissible fade show" style="color:#fff;background-color: #BF1363;border:0px;">';
          echo '<li>' . $_GET['erroru'] . '</li>';
          echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
          echo '</div>';
      } elseif (isset($_GET['errorm'])) {
          echo '<div class="alert with-close alert-danger alert-dismissible fade show" style="color:#fff;background-color: #BF1363;border:0px;">';
          echo '<li>' . $_GET['errorm'] . '</li>';
          echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
          echo '</div>';
      } elseif (isset($_GET['errorlog'])) {
          echo '<div class="alert with-close alert-danger alert-dismissible fade show" style="color:#fff;background-color: #BF1363;border:0px;">';
          echo '<li>' . $_GET['errorlog'] . '</li>';
          echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
          echo '</div>';
      }
      ?>


        <form method="POST" action="control\auth_login.php" autocomplete="on">
          <div class="form-group">
            <label style="color:#fff"><strong>Nom D'utilisateur</strong></label>
            <input type="text" class="form-control" placeholder="Pseudo" style="" name="username"
              value="<?php echo $_GET['username']?>">
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
          <button id="conn" style="" title="Cliquez ici pour vous connecter" type="submit" name="user_submit"
            class="btn-s"><strong>Connection</strong></button>
        </form>
        <!-- </div> -->
      </div>
    </div>
    <footer class="row mt-0" style="background: #191923; padding:10px;">
      <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 text-center" style="color:#868e96;">
        <div>Copyright &copy;2023 Université 8 mai 1945, Département d'informatique</div>
        <div>EQUIPE DE DEVELOPEMENT <strong>sous Encadrement de</strong> DR Halimi khaled</div>

        <div>Chaalel idris (2020 - 2023)</div>
        <div>Khebizi hamed (2020)</div>
        <div class="btn-group">
          <button class="btn btn-secondary" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-info-circle" aria-hidden="true"></i> Info
          </button>
        </div>


      </div>
    </footer>
  </div>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <!-- Modal content-->
      <div class="modal-content" style="border-radius:0px;">
        <button type="button" class="close" data-dismiss="modal"
          style="display:inline;text-align:right;margin:5px 15px;">&times;</button>
        <h3 style="margin-left:1em;">GESTION DES COMITES PIDAGOGIQUES</h3>
        <div class="modal-body">
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




  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>
</body>

</html>