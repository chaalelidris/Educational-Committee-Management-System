
<?php
session_start();
require_once("../control/config/dbcon.php");


if (isset($_POST['imprimer_rapport'])) {
  extract($_POST);

  $sql = "SELECT * FROM tbl_cp WHERE cp_id='$cpid'";
    $result = mysqli_query($con, $sql);
    $rowCpData=mysqli_fetch_assoc($result); //tableau


    $promid = $rowCpData['cp_prom_id'];
    $semestre = $rowCpData['cp_semestre'];
    $sql = "SELECT * FROM tbl_module INNER JOIN tbl_users WHERE modl_promo_id='$promid' AND modl_semestre='$semestre' and tbl_module.modl_ens_id=tbl_users.user_id";
    $resultModlData = mysqli_query($con, $sql) or die(mysqli_error($con));


    $sql = "SELECT user_fullname FROM tbl_users INNER JOIN tbl_delegation ON tbl_delegation.delegation_prom_id='$promid' and tbl_users.user_id=tbl_delegation.delegation_del_id";
    $resultDelegueData = mysqli_query($con, $sql) or die(mysqli_error($con));

    $sql = "SELECT * FROM tbl_module WHERE modl_promo_id='$promid' AND modl_semestre='$semestre'";
    $resultAllModules = mysqli_query($con, $sql) or die(mysqli_error($con));
}











require('GenPdf/fpdf.php');

$pdf = new FPDF('P','mm','A4');
$pdf->SetMargins(25, 23, 25);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true,20);

$pdf->SetFont('Times','BI',12);

$pdf->Cell(0,5,iconv("UTF-8", "CP1250//TRANSLIT", 'Université 08 Mai 45 – Guelma'),0,1);
$pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", 'Faculté de Mathématiques, d’Informatique et de Sciences de la Matière'),0,1);
$pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", 'Département d’informatique'),0,1);
$pdf->ln();

$pdf->SetFont('Times','B',12);
$time=strtotime($rowCpData['cp_datetime']);
$pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT",'Le '. date("d F Y",$time)),0,1,'R');
$pdf->ln();
$pdf->ln();


// iconv("UTF-8","CP1250//TRANSLIT",)
// Procès-Verbal de Réunion Du Comité Pédagogique de la 3ème Année licence SI
$title =iconv("UTF-8","CP1250//TRANSLIT",$rowCpData['cp_title']);
$pdf->SetFont('Times','B',20);
$pdf->Multicell(0,8,$title,0,'C');

// $swidth = 160;
// $sheight = 10;
// if ($pdf->GetStringWidth($title) < $swidth) {
//   $pdf->SetFont('Times','B',20);
//   $pdf->Cell(160,$sheight,$title,1,1,'C');
// }else {
//   $textLength = strlen($title);
//   $startChar = 0; //first title char
//   $maxChar = 0;
//   $tempString = ""; //to hold the string fo a ligne temporary
//
//   while ($startChar <= $textLength) {
//     while ($pdf->GetStringWidth($tempString) < $swidth && $maxChar <= $textLength) {
//       $maxChar ++;
//       $tempString = substr($title,$startChar,$maxChar);
//       $pdf->SetFont('Times','B',20);
//       // $pdf->Cell(160,$sheight,$tempString.' '.$swidth,1,1,'C');
//     }
//
//     $startChar = $maxChar;
//
//     $pdf->Cell(160,8, iconv("UTF-8","CP1250//TRANSLIT",$tempString),0,1,'C');
//     $maxChar = $startChar;
//     $tempString = "";
//   }
// }


$pdf->ln();
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", 'Les Enseignants Présents :'),0,1,'L');

$pdf->SetFont('Times','',12);
$pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", $_SESSION['responsable_user_fullname']),0,0,'L');
$pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", 'Président du CP, responsable du parcours '.$_SESSION['responsable_prom_name']),0,1,'R');

while ($row=mysqli_fetch_assoc($resultModlData)) {
  $pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", $row['user_fullname']),0,0,'L');
  $pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", 'Chargé du cours de '.$row['modl_name']),0,1,'R');
}

// $pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", 'Mr. DJAKHDJAKHA L. '),0,0,'L');
// $pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", 'Chargé du cours de GL2'),0,1,'R');
//
// $pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", 'Mr. SERIDI A.'),0,0,'L');
// $pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", 'Chargée du cours de SE II'),0,1,'R');


$pdf->ln();
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", 'Les Etudiants :'),0,1,'L');
while ($row=mysqli_fetch_assoc($resultDelegueData)) {
  $pdf->SetFont('Times','',12);
  $pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", $row['user_fullname']),0,1,'L');
}


$pdf->ln();
$pdf->SetFont('Times','BU',12);
$pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", 'Ordre du jour :'),0,1,'L');

$pdf->ln();
$pdf->SetFont('Times','',12);

$pdf->Cell(8,5,'',0,0);
$pdf->Multicell(0,5,iconv("UTF-8","CP1250//TRANSLIT",$rowCpData['cp_ordre'] ),0,'L');

// $pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", '       1. Avancement des coursdfd'),0,1,'L');
// $pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", '       2. Validation de TPs, Micro-interrogations...etc'),0,1,'L');
// $pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", "       3. Etat d'absences des étudiants,"),0,1,'L');

// wrap text content
$pdf->ln();
$pdf->Multicell(0,5,iconv("UTF-8","CP1250//TRANSLIT",$rowCpData['cp_detail']));




$pdf->SetAutoPageBreak(false);
$height_of_cell = 60; // mm
$page_height = 281; // mm (portrait letter)
$bottom_margin = 20; // mm
while ($row=mysqli_fetch_array($resultAllModules)) {

  $mdlid = $row['modl_id'];
  $idresp = $_SESSION['responsable_user_id'];
  $sql = "SELECT * FROM tbl_data WHERE data_usr_id='$idresp' AND data_modl_id='$mdlid' AND data_cp_id='$cpid'";
  $resultData = mysqli_query($con, $sql);
  $countdata = mysqli_num_rows($resultData);



  $space_left=$page_height-($pdf->GetY()+$bottom_margin); // space left on page
  if ($height_of_cell > $space_left) {
    $pdf->AddPage(); // page break
  }

  if ($countdata > 0) {
    $pdf->SetFont('Times','',12);
    $rowResultData = mysqli_fetch_array($resultData);
    // table
    $pdf->ln(4);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(0,0,0);
    $pdf->Cell(0,5.5,iconv("UTF-8","CP1250//TRANSLIT", $row['modl_name']),1,1,'L',true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(58,5.5,iconv("UTF-8","CP1250//TRANSLIT", 'Cours()'),1,0);
    $pdf->Cell(57,5.5,iconv("UTF-8","CP1250//TRANSLIT", 'TD()'),1,0);
    $pdf->Cell(45,5.5,iconv("UTF-8","CP1250//TRANSLIT", 'TP()'),1,1);

    $pdf->ln(3);

    // $pdf->Cell(25,30,iconv("UTF-8","CP1250//TRANSLIT", 'Etat '),1,0,);
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $etat = iconv("UTF-8","CP1250//TRANSLIT", 'Etat d’ avancement');
    $pdf->Multicell(25,17.2,$etat,1,'C');
    $pdf->SetXY($xpos+25,$ypos);
    // $pdf->Cell(77,4.2,iconv("UTF-8","CP1250//TRANSLIT", 'Avancement globale'),0,1);
    // $pdf->Cell(35,4.2,iconv("UTF-8","CP1250//TRANSLIT", ''),0,0);
    $text1 = iconv("UTF-8","CP1250//TRANSLIT", 'Avancement globale');
    $text2 = iconv("UTF-8","CP1250//TRANSLIT", 'Nombre de chapitres achevés / En cours');
    $text3 = iconv("UTF-8","CP1250//TRANSLIT", 'Nombre de séances de cours faites');
    $text4 = iconv("UTF-8","CP1250//TRANSLIT", 'Nombre de séances de TD et TP faites');
    $text5 = iconv("UTF-8","CP1250//TRANSLIT", 'Nombre de séances (Cours, TD, TP) non faites');
    $text6 = iconv("UTF-8","CP1250//TRANSLIT", 'Exposés + Micro');
    $text7 = iconv("UTF-8","CP1250//TRANSLIT", 'Validation de TP');
    $text8 = iconv("UTF-8","CP1250//TRANSLIT", 'Polycopie de cours');
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $pdf->Multicell(90,4.3,$text1."\n".$text2."\n".$text3."\n".$text4."\n".$text5."\n".$text6."\n".$text7."\n".$text8,1,);
    $pdf->SetXY($xpos+90,$ypos);

    $var1 = iconv("UTF-8","CP1250//TRANSLIT", $rowResultData['data_avncm_glob']);
    $var2 = iconv("UTF-8","CP1250//TRANSLIT", $rowResultData['data_nbr_chap']);
    $var3 = iconv("UTF-8","CP1250//TRANSLIT", $rowResultData['data_nbr_cours']);
    $var4 = iconv("UTF-8","CP1250//TRANSLIT", $rowResultData['data_nbr_tdtp']);
    $var5 = iconv("UTF-8","CP1250//TRANSLIT", $rowResultData['data_nbr_crtdtp']);
    $var6 = iconv("UTF-8","CP1250//TRANSLIT", $rowResultData['data_exps_micro']);
    $var7 = iconv("UTF-8","CP1250//TRANSLIT", $rowResultData['data_valid_tp']);
    $var8 = iconv("UTF-8","CP1250//TRANSLIT", $rowResultData['data_polycp_cour']);
    $pdf->Multicell(45,4.3,$var1."\n".$var2."\n".$var3."\n".$var4."\n".$var5."\n".$var6."\n".$var7."\n".$var8,1);


    $pdf->ln(3);
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $pdf->Line($xpos,$ypos,$xpos+160,$ypos);
    $pdf->ln(3);

    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $etat = iconv("UTF-8","CP1250//TRANSLIT", 'Avis de L’enseignant');
    $pdf->Multicell(25,5,$etat,1,'C');

    $pdf->SetXY($xpos+25,$ypos);
    $pdf->SetFont('Arial','B',10);
    $pdf->Multicell(0,10,"R.A.S",1,'C');

    //                                              end table module data

  }else {
    $pdf->SetFont('Times','',12);
    // table
    $pdf->ln(4);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(0,0,0);
    $pdf->Cell(0,5.5,iconv("UTF-8","CP1250//TRANSLIT", $row['modl_name']),1,1,'L',true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(58,5.5,iconv("UTF-8","CP1250//TRANSLIT", 'Cours()'),1,0);
    $pdf->Cell(57,5.5,iconv("UTF-8","CP1250//TRANSLIT", 'TD()'),1,0);
    $pdf->Cell(45,5.5,iconv("UTF-8","CP1250//TRANSLIT", 'TP()'),1,1);

    $pdf->ln(3);

    // $pdf->Cell(25,30,iconv("UTF-8","CP1250//TRANSLIT", 'Etat '),1,0,);
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $etat = iconv("UTF-8","CP1250//TRANSLIT", 'Etat d’ avancement');
    $pdf->Multicell(25,17.2,$etat,1,'C');
    $pdf->SetXY($xpos+25,$ypos);
    // $pdf->Cell(77,4.2,iconv("UTF-8","CP1250//TRANSLIT", 'Avancement globale'),0,1);
    // $pdf->Cell(35,4.2,iconv("UTF-8","CP1250//TRANSLIT", ''),0,0);
    $text1 = iconv("UTF-8","CP1250//TRANSLIT", 'Avancement globale');
    $text2 = iconv("UTF-8","CP1250//TRANSLIT", 'Nombre de chapitres achevés / En cours');
    $text3 = iconv("UTF-8","CP1250//TRANSLIT", 'Nombre de séances de cours faites');
    $text4 = iconv("UTF-8","CP1250//TRANSLIT", 'Nombre de séances de TD et TP faites');
    $text5 = iconv("UTF-8","CP1250//TRANSLIT", 'Nombre de séances (Cours, TD, TP) non faites');
    $text6 = iconv("UTF-8","CP1250//TRANSLIT", 'Exposés + Micro');
    $text7 = iconv("UTF-8","CP1250//TRANSLIT", 'Validation de TP');
    $text8 = iconv("UTF-8","CP1250//TRANSLIT", 'Polycopie de cours');
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $pdf->Multicell(90,4.3,$text1."\n".$text2."\n".$text3."\n".$text4."\n".$text5."\n".$text6."\n".$text7."\n".$text8,1,);
    $pdf->SetXY($xpos+90,$ypos);

    $var1 = iconv("UTF-8","CP1250//TRANSLIT", '/');
    $var2 = iconv("UTF-8","CP1250//TRANSLIT", '/');
    $var3 = iconv("UTF-8","CP1250//TRANSLIT", '/');
    $var4 = iconv("UTF-8","CP1250//TRANSLIT", '/');
    $var5 = iconv("UTF-8","CP1250//TRANSLIT", '/');
    $var6 = iconv("UTF-8","CP1250//TRANSLIT", '/');
    $var7 = iconv("UTF-8","CP1250//TRANSLIT", '/');
    $var8 = iconv("UTF-8","CP1250//TRANSLIT", '/');
    $pdf->Multicell(45,4.3,$var1."\n".$var2."\n".$var3."\n".$var4."\n".$var5."\n".$var6."\n".$var7."\n".$var8,1,'C');


    $pdf->ln(3);
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $pdf->Line($xpos,$ypos,$xpos+160,$ypos);
    $pdf->ln(3);

    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $etat = iconv("UTF-8","CP1250//TRANSLIT", 'Avis de L’enseignant');
    $pdf->Multicell(25,5,$etat,1,'C');

    $pdf->SetXY($xpos+25,$ypos);
    $pdf->SetFont('Arial','B',10);
    $pdf->Multicell(0,10,"R.A.S",1,'C');

    //                                              end table module data

  }

}


$pdf->SetAutoPageBreak(true,20);







$pdf->ln(7);
$xpos = $pdf->GetX();
$ypos = $pdf->GetY();
$pdf->SetXY($xpos+7,$ypos);
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,5,iconv("UTF-8","CP1250//TRANSLIT", '2. Interventions diverses.'),0,1,'L');

$pdf->ln(7);
$pdf->SetFont('Times','',12);
$autres = iconv("UTF-8","CP1250//TRANSLIT", $rowCpData['cp_intervension']);
$pdf->Multicell(0,5,$autres,0,'L');

$pdf->ln(7);
$xpos = $pdf->GetX();
$ypos = $pdf->GetY();
$pdf->SetXY($xpos+80,$ypos);
$pdf->SetFont('Times','B',12);
$president = iconv("UTF-8","CP1250//TRANSLIT", "Le Président du Comité Pédagogique ".$_SESSION['responsable_user_fullname']);
$pdf->Multicell(70,8,$president,0,'C');














$pdf->Output();
?>









<!-- $pdf->SetDrawColor(0,80,180);
$pdf->SetLineWidth(1);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(60,10,'Powered by FPDF.',1,0,'C');

$pdf->SetFont('Arial','',16);
$pdf->SetFillColor(111,111,111);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(70,10,'Powered by FPDF.',1,1,'C',true); -->









<!-- $xpos = $pdf->GetX();
$ypos = $pdf->GetY();
$pdf->Multicell($swidth,$sheight,$title,1);
$pdf->SetXY($xpos+$swidth,$ypos); -->
