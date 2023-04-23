
<?php
session_start();
require_once("../control/config/dbcon.php");
require('GenPdf/fpdf.php');


if (isset($_POST['imprimer_rapport'])) {
  $cp_id = $_POST['cp_id'];

  // Get CP data
  $cp_sql = "SELECT * FROM tbl_cp WHERE cp_id='$cp_id'";
  $cp_result = mysqli_query($con, $cp_sql);
  $cp_row = mysqli_fetch_assoc($cp_result);

  // Get module data for current CP
  $prom_id = $cp_row['cp_prom_id'];
  $semestre = $cp_row['cp_semestre'];
  $modl_sql = "SELECT * FROM tbl_module 
               INNER JOIN tbl_users ON tbl_module.modl_ens_id = tbl_users.user_id
               WHERE modl_promo_id='$prom_id' AND modl_semestre='$semestre'";
  $modl_result = mysqli_query($con, $modl_sql) or die(mysqli_error($con));

  // Get delegue data for current CP
  $delegue_sql = "SELECT user_fullname FROM tbl_users 
                  INNER JOIN tbl_delegation ON tbl_delegation.delegation_del_id = tbl_users.user_id
                  WHERE tbl_delegation.delegation_prom_id='$prom_id'";
  $delegue_result = mysqli_query($con, $delegue_sql) or die(mysqli_error($con));

  // Get all modules for current promotion and semester
  $all_modl_sql = "SELECT * FROM tbl_module 
                   WHERE modl_promo_id='$prom_id' AND modl_semestre='$semestre'";
  $all_modl_result = mysqli_query($con, $all_modl_sql) or die(mysqli_error($con));
}





$pdf = new FPDF('P','mm','A4');
$pdf->SetMargins(25, 23, 25);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);

$pdf->SetFont('Times', 'BI', 12);

$pdf->Cell(0, 5, mb_convert_encoding('Université 08 Mai 45 – Guelma', 'ISO-8859-1', 'UTF-8'), 0, 1);
$pdf->Cell(0, 5, mb_convert_encoding('Faculté de Mathématiques, d’Informatique et de Sciences de la Matière', 'ISO-8859-1', 'UTF-8'), 0, 1);
$pdf->Cell(0, 5, mb_convert_encoding('Département d’informatique', 'ISO-8859-1', 'UTF-8'), 0, 1);
$pdf->ln();

$pdf->SetFont('Times', 'B', 12);
$time = strtotime($cp_row['cp_datetime']);
$pdf->Cell(0, 5, iconv('UTF-8', 'ISO-8859-1','Le '. date("d F Y", $time)), 0, 1, 'R');
$pdf->ln();
$pdf->ln();


// iconv("UTF-8","ISO-8859-1",)
// Procès-Verbal de Réunion Du Comité Pédagogique de la 3ème Année licence SI
$title = mb_convert_encoding($cp_row['cp_title'], 'ISO-8859-1', 'UTF-8');
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
//     $pdf->Cell(160,8, iconv("UTF-8","ISO-8859-1",$tempString),0,1,'C');
//     $maxChar = $startChar;
//     $tempString = "";
//   }
// }


$pdf->ln();
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,5,mb_convert_encoding( 'Les Enseignants Présents :',"ISO-8859-1","UTF-8"),0,1,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(0,5,mb_convert_encoding( $_SESSION['responsable_user_fullname'],"ISO-8859-1","UTF-8"),0,0,'L');
$pdf->Cell(0,5,mb_convert_encoding( 'Président du CP, responsable du parcours '.$_SESSION['responsable_prom_name'],"ISO-8859-1","UTF-8"),0,1,'R');

while ($row=mysqli_fetch_assoc($modl_result)) {
  $pdf->Cell(0,5,mb_convert_encoding( $row['user_fullname'],"ISO-8859-1","UTF-8"),0,0,'L');
  $pdf->Cell(0,5,mb_convert_encoding( 'Chargé du cours de '.$row['modl_name'],"ISO-8859-1","UTF-8"),0,1,'R');
}

// $pdf->Cell(0,5,mb_convert_encoding("UTF-8","ISO-8859-1", 'Mr. DJAKHDJAKHA L. '),0,0,'L');
// $pdf->Cell(0,5,mb_convert_encoding("UTF-8","ISO-8859-1", 'Chargé du cours de GL2'),0,1,'R');
//
// $pdf->Cell(0,5,mb_convert_encoding("UTF-8","ISO-8859-1", 'Mr. SERIDI A.'),0,0,'L');
// $pdf->Cell(0,5,mb_convert_encoding("UTF-8","ISO-8859-1", 'Chargée du cours de SE II'),0,1,'R');


$pdf->ln();
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,5,mb_convert_encoding('Les Etudiants :',"ISO-8859-1","UTF-8"),0,1,'L');
while ($row=mysqli_fetch_assoc($delegue_result)) {
  $pdf->SetFont('Times','',12);
  $pdf->Cell(0,5,mb_convert_encoding($row['user_fullname'],"ISO-8859-1","UTF-8"),0,1,'L');
}


$pdf->ln();
$pdf->SetFont('Times','BU',12);
$pdf->Cell(0,5,mb_convert_encoding('Ordre du jour :',"ISO-8859-1","UTF-8"),0,1,'L');

$pdf->ln();
$pdf->SetFont('Times','',12);

$pdf->Cell(8,5,'',0,0);
$pdf->Multicell(0,5,iconv("UTF-8","ISO-8859-1",$cp_row['cp_ordre'] ),0,'L');

// $pdf->Cell(0,5,mb_convert_encoding('       1. Avancement des coursdfd'),0,1,'L');
// $pdf->Cell(0,5,mb_convert_encoding('       2. Validation de TPs, Micro-interrogations...etc'),0,1,'L');
// $pdf->Cell(0,5,mb_convert_encoding("       3. Etat d'absences des étudiants,"),0,1,'L');

// wrap text content
$pdf->ln();
$pdf->Multicell(0,5,mb_convert_encoding($cp_row['cp_detail'],"ISO-8859-1","UTF-8"));




$pdf->SetAutoPageBreak(false);
$height_of_cell = 60; // mm
$page_height = 281; // mm (portrait letter)
$bottom_margin = 20; // mm
while ($row=mysqli_fetch_array($all_modl_result)) {

  $mdlid = $row['modl_id'];
  $idresp = $_SESSION['responsable_user_id'];
  $sql = "SELECT * FROM tbl_data WHERE data_usr_id='$idresp' AND data_modl_id='$mdlid' AND data_cp_id='$cp_id'";
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
    $pdf->Cell(0,5.5,mb_convert_encoding($row['modl_name'],"ISO-8859-1","UTF-8"),1,1,'L',true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(58,5.5,mb_convert_encoding('Cours()',"ISO-8859-1","UTF-8"),1,0);
    $pdf->Cell(57,5.5,mb_convert_encoding('TD()',"ISO-8859-1","UTF-8"),1,0);
    $pdf->Cell(45,5.5,mb_convert_encoding('TP()',"ISO-8859-1","UTF-8"),1,1);

    $pdf->ln(3);

    
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $etat = mb_convert_encoding('Etat d’ avancement',"ISO-8859-1","UTF-8");
    $pdf->Multicell(25,17.2,$etat,1,'C');
    $pdf->SetXY($xpos+25,$ypos);
    

    $text1 = mb_convert_encoding('Avancement globale',"ISO-8859-1","UTF-8");
    $text2 = mb_convert_encoding('Nombre de chapitres achevés / En cours',"ISO-8859-1","UTF-8");
    $text3 = mb_convert_encoding('Nombre de séances de cours faites',"ISO-8859-1","UTF-8");
    $text4 = mb_convert_encoding('Nombre de séances de TD et TP faites',"ISO-8859-1","UTF-8");
    $text5 = mb_convert_encoding('Nombre de séances (Cours, TD, TP) non faites',"ISO-8859-1","UTF-8");
    $text6 = mb_convert_encoding('Exposés + Micro',"ISO-8859-1","UTF-8");
    $text7 = mb_convert_encoding('Validation de TP',"ISO-8859-1","UTF-8");
    $text8 = mb_convert_encoding('Polycopie de cours',"ISO-8859-1","UTF-8");
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $pdf->Multicell(90,4.3,$text1."\n".$text2."\n".$text3."\n".$text4."\n".$text5."\n".$text6."\n".$text7."\n".$text8,1,);
    $pdf->SetXY($xpos+90,$ypos);

    $var1 = mb_convert_encoding($rowResultData['data_avncm_glob'],"ISO-8859-1","UTF-8");
    $var2 = mb_convert_encoding($rowResultData['data_nbr_chap'],"ISO-8859-1","UTF-8");
    $var3 = mb_convert_encoding($rowResultData['data_nbr_cours'],"ISO-8859-1","UTF-8");
    $var4 = mb_convert_encoding($rowResultData['data_nbr_tdtp'],"ISO-8859-1","UTF-8");
    $var5 = mb_convert_encoding($rowResultData['data_nbr_crtdtp'],"ISO-8859-1","UTF-8");
    $var6 = mb_convert_encoding($rowResultData['data_exps_micro'],"ISO-8859-1","UTF-8");
    $var7 = mb_convert_encoding($rowResultData['data_valid_tp'],"ISO-8859-1","UTF-8",);
    $var8 = mb_convert_encoding($rowResultData['data_polycp_cour'],"ISO-8859-1","UTF-8");
    $pdf->Multicell(45,4.3,$var1."\n".$var2."\n".$var3."\n".$var4."\n".$var5."\n".$var6."\n".$var7."\n".$var8,1);


    $pdf->ln(3);
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $pdf->Line($xpos,$ypos,$xpos+160,$ypos);
    $pdf->ln(3);

    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $etat = mb_convert_encoding('Avis de L’enseignant',"ISO-8859-1","UTF-8");
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
    $pdf->Cell(0,5.5,mb_convert_encoding($row['modl_name'],"ISO-8859-1","UTF-8"),1,1,'L',true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(58,5.5,mb_convert_encoding('Cours()',"ISO-8859-1","UTF-8"),1,0);
    $pdf->Cell(57,5.5,mb_convert_encoding('TD()',"ISO-8859-1","UTF-8"),1,0);
    $pdf->Cell(45,5.5,mb_convert_encoding('TP()',"ISO-8859-1","UTF-8"),1,1);

    $pdf->ln(3);

    // $pdf->Cell(25,30,mb_convert_encoding('Etat '),1,0,);
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $etat = mb_convert_encoding('Etat d’ avancement');
    $pdf->Multicell(25,17.2,$etat,1,'C');
    $pdf->SetXY($xpos+25,$ypos);
    // $pdf->Cell(77,4.2,mb_convert_encoding('Avancement globale'),0,1);
    // $pdf->Cell(35,4.2,mb_convert_encoding(''),0,0);
    $text1 = mb_convert_encoding('Avancement globale');
    $text2 = mb_convert_encoding('Nombre de chapitres achevés / En cours');
    $text3 = mb_convert_encoding('Nombre de séances de cours faites');
    $text4 = mb_convert_encoding('Nombre de séances de TD et TP faites');
    $text5 = mb_convert_encoding('Nombre de séances (Cours, TD, TP) non faites');
    $text6 = mb_convert_encoding('Exposés + Micro');
    $text7 = mb_convert_encoding('Validation de TP');
    $text8 = mb_convert_encoding('Polycopie de cours');
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $pdf->Multicell(90,4.3,$text1."\n".$text2."\n".$text3."\n".$text4."\n".$text5."\n".$text6."\n".$text7."\n".$text8,1,);
    $pdf->SetXY($xpos+90,$ypos);

    $var1 = mb_convert_encoding('/');
    $var2 = mb_convert_encoding('/');
    $var3 = mb_convert_encoding('/');
    $var4 = mb_convert_encoding('/');
    $var5 = mb_convert_encoding('/');
    $var6 = mb_convert_encoding('/');
    $var7 = mb_convert_encoding('/');
    $var8 = mb_convert_encoding('/');
    $pdf->Multicell(45,4.3,$var1."\n".$var2."\n".$var3."\n".$var4."\n".$var5."\n".$var6."\n".$var7."\n".$var8,1,'C');


    $pdf->ln(3);
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $pdf->Line($xpos,$ypos,$xpos+160,$ypos);
    $pdf->ln(3);

    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $etat = mb_convert_encoding('Avis de L’enseignant');
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
$pdf->Cell(0,5,mb_convert_encoding('2. Interventions diverses.',"ISO-8859-1","UTF-8"),0,1,'L');

$pdf->ln(7);
$pdf->SetFont('Times','',12);
$autres = mb_convert_encoding($cp_row['cp_intervension'],"ISO-8859-1","UTF-8");
$pdf->Multicell(0,5,$autres,0,'L');

$pdf->ln(7);
$xpos = $pdf->GetX();
$ypos = $pdf->GetY();
$pdf->SetXY($xpos+80,$ypos);
$pdf->SetFont('Times','B',12);
$president = mb_convert_encoding("Le Président du Comité Pédagogique ".$_SESSION['responsable_user_fullname'],"ISO-8859-1","UTF-8");
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
