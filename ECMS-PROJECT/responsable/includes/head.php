<?php
$title="ESPACE RESPONSABLE";
session_start();
if (empty($_SESSION['responsable_user_id'])) {
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SYSTEM | <?php echo $title;?></title>


  <!-- <link rel="stylesheet" href="../style/css/normalize.css">
  <link rel="stylesheet" href="../style/css/themify-icons.css">
  <link rel="stylesheet" href="../style/css/flag-icon.min.css">
  <link rel="stylesheet" href="../style/css/cs-skin-elastic.css">
  <link rel="stylesheet" href="../style/css/lib/datatable/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="../style/css/lib/chosen/chosen.min.css"> -->
  <!-- <link rel="stylesheet" href="../style/scss/style.css"> -->
  <!-- <link rel="stylesheet" href="../style/css/bootstrap.min.css"> -->

  <!-- =======================                   Style                        ======================= -->
  <link rel="stylesheet" href="../style/css/font-awesome.min.css">

  <link rel="stylesheet" href="../admin/css/ws.css">
  <link rel="stylesheet" href="../admin/css/w3t.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="../admin/css/adminStyle.css">
  <link rel="stylesheet" href="../admin/css/adminsnackbar.css">
  <link rel="stylesheet" href="../delegue/css/profile_style.css">  <!-- delegue style -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="../enseignant/css/style.css">

  <link rel="stylesheet" href="css/Form_act_cp.css">

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="../jquery.min.js" type="text/javascript"></script>

  <!-- select2 -->
  <link href="../select2.min.css" rel="stylesheet" />
  <script src="../select2.min.js"></script>

  <!-- <link rel="stylesheet" href="css/section_counter.css"> -->

  <style>
    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: "Roboto", sans-serif;
    }

    .sidebar {
      z-index: 3;
      width: 260px;
      top: 43px;
      bottom: 0;
      height: inherit;
    }

    .bar a,
    .sidebar a {
      text-decoration: none;
    }
    html{
      /* background-color: #f0f2f5; */
    }
  </style>
</head>

<body>
