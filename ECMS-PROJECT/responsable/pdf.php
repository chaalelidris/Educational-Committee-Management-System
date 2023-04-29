
<?php
require('GenPdf/fpdf.php');
session_start();
require_once("../control/config/dbcon.php");


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

  // Get department
  $department_sql = "SELECT d.* 
                  FROM tbl_promo p
                  JOIN tbl_department d
                  ON p.department_id = d.department_id
                  AND p.prom_id = '$prom_id'";
  $department_result = mysqli_query($con, $department_sql) or die(mysqli_error($con));
  $row_department=mysqli_fetch_array($department_result);
}




// Instantiate the FPDF class with page orientation, measurement unit and paper size
$pdf = new FPDF('P', 'mm', 'A4');

// Set the margins for the page
$pdf->SetMargins(10, 10, 10); // Set left, top, and right margins to 10 mm


// Add a new page to the PDF document
$pdf->AddPage();

// Enable auto page break with a margin of 20mm
$pdf->SetAutoPageBreak(true, 20);

// Set the font and style for the PDF document
$pdf->SetFont('Times', 'BI', 12);

// Add the university name to the PDF document
$pdf->Cell(0, 5, mb_convert_encoding('Université 08 Mai 45 - Guelma', 'ISO-8859-1', 'UTF-8'), 0, 1);

// Add the faculty name to the PDF document

$pdf->Cell(0, 5, mb_convert_encoding('Faculté de Mathématiques, d’Informatique et de Sciences de la Matière', 'ISO-8859-1', 'UTF-8'), 0, 1);

// Add the department name to the PDF document
$pdf->Cell(0, 5, mb_convert_encoding($row_department['department_name'], 'ISO-8859-1', 'UTF-8'), 0, 1);

// Add a new line to the PDF document
$pdf->ln();

// Set the font and style for the PDF document
$pdf->SetFont('Times', 'B', 12);

// Convert the date and time from the database to a Unix timestamp
$time = strtotime($cp_row['cp_datetime']);

// Add the date and time to the PDF document in the top right corner
$pdf->Cell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'Le ' . date("d F Y", $time)), 0, 1, 'R');

// Add a new line to the PDF document
$pdf->ln();
$pdf->ln();

// Convert the title from the database to ISO-8859-1 encoding
$title = mb_convert_encoding($cp_row['cp_title'], 'ISO-8859-1', 'UTF-8');

// Set the font and style for the PDF document
$pdf->SetFont('Times','B',20);

// Add the title to the PDF document with centered alignment
$pdf->Multicell(0,8,$title,0,'C');





/// Add a line break
$pdf->ln();

// Set the font to bold, size 12
$pdf->SetFont('Times','B',12);

// Add a cell with the text "Les Enseignants Présents :" and align it to the left
$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Les Enseignants Présents :'),0,1,'L');

// Set the font to normal, size 12
$pdf->SetFont('Times','',12);

// Add a cell with the text of the responsible user's full name and align it to the left
$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_SESSION['responsable_user_fullname']),0,0,'L');

// Add a cell with the text "Président du CP, responsable du parcours [promotion name]" and align it to the right
$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Président du CP, responsable du parcours '.$_SESSION['responsable_prom_name']),0,1,'R');

// Loop through each row of the $modl_result array and output the teacher's name and the module name
while ($row=mysqli_fetch_assoc($modl_result)) {
// Add a cell with the text of the teacher's full name and align it to the left
$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $row['user_fullname']),0,0,'L');

// Add a cell with the text "Chargé du cours de [module name]" and align it to the right
$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Chargé du cours de '.$row['modl_name']),0,1,'R');
}

// Add a line break
$pdf->ln();

// Set the font to bold, size 12
$pdf->SetFont('Times','B',12);

// Add a cell with the text "Les Etudiants :" and align it to the left
$pdf->Cell(0,5,iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Les Etudiants :'),0,1,'L');



// Set font and size for the cells
$pdf->SetFont('Times', '', 12);

// Loop through the result set and output the names of the delegates
while ($row = mysqli_fetch_assoc($delegue_result)) {
  // Convert the name to ISO-8859-1 encoding for FPDF
  $name = utf8_decode($row['user_fullname']);

  // Output the name in a new cell
  $pdf->Cell(0, 5, $name, 0, 1, 'L');
}





// Add line break and set font to bold and underlined
$pdf->ln();
$pdf->SetFont('Times','BU',12);
$pdf->Cell(0,5,mb_convert_encoding('Ordre du jour :',"ISO-8859-1","UTF-8"),0,1,'L');


$pdf->SetFont('Times','',12);

// Add empty space and multicell for displaying the content of the order of the day
$pdf->Cell(8,5,'',0,0);
$pdf->Multicell(0,5,iconv("UTF-8","ISO-8859-1",$cp_row['cp_ordre'] ),0,'L');

// Add line break and multicell for displaying the details of the meeting
$pdf->ln();
$pdf->Multicell(0,5,mb_convert_encoding($cp_row['cp_detail'],"ISO-8859-1","UTF-8"));



$pdf->SetAutoPageBreak(false);
$height_of_cell = 60; // mm
$page_height = 281; // mm (portrait letter)
$bottom_margin = 20; // mm

while ($row=mysqli_fetch_array($all_modl_result)) {

  // Prepare the SQL statement with placeholders
  $sql = "SELECT * FROM tbl_data WHERE data_usr_id=? AND data_modl_id=? AND data_cp_id=?";
  $stmt = mysqli_prepare($con, $sql);

  // Bind the parameters to the statement
  mysqli_stmt_bind_param($stmt, "iii", $_SESSION['responsable_user_id'], $row['modl_id'], $cp_id);
  
  // Execute the statement and get the result set
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);

  // Get the number of rows in the result set
  $countdata = mysqli_num_rows($resultData);
  
  
  

  $space_left = $pdf->getPageHeight() - ($pdf->getY() + $bottom_margin);
  if ($height_of_cell > $space_left) {
      $pdf->AddPage(); // page break
    }
    
    
    if ($countdata > 0) {
      
    $pdf->ln(4);
    // Set the font for the PDF document
    $pdf->SetFont('Times', '', 12);

    // Fetch the data for the current row
    $rowResultData = mysqli_fetch_array($resultData);

    // Set the fill color and text color for the table headers
    $pdf->SetFillColor(0, 0, 0);
    $pdf->SetTextColor(255, 255, 255);

    // Output the module name as a table header cell
    $pdf->Cell(0, 5.5, mb_convert_encoding($row['modl_name'], "ISO-8859-1", "UTF-8"), 1, 1, 'L', true);

    // Reset the text color for the table cells
    $pdf->SetTextColor(0, 0, 0);
    
    $row_width = "95";
    // Output the table headers for the "Cours", "TD", and "TP" columns
    $pdf->Cell(60, 5.5, mb_convert_encoding('Cours', "ISO-8859-1", "UTF-8"), 1, 0);
    $pdf->Cell(60, 5.5, mb_convert_encoding('TD', "ISO-8859-1", "UTF-8"), 1, 0);
    $pdf->Cell(70, 5.5, mb_convert_encoding('TP', "ISO-8859-1", "UTF-8"), 1, 1);

    // Add some spacing before the next row of data
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
    $pdf->Multicell(85,4.3,$text1."\n".$text2."\n".$text3."\n".$text4."\n".$text5."\n".$text6."\n".$text7."\n".$text8,1,);
    $pdf->SetXY($xpos+85,$ypos);

    $var1 = mb_convert_encoding($rowResultData['data_avncm_glob'],"ISO-8859-1","UTF-8");
    $var2 = mb_convert_encoding($rowResultData['data_nbr_chap'],"ISO-8859-1","UTF-8");
    $var3 = mb_convert_encoding($rowResultData['data_nbr_cours'],"ISO-8859-1","UTF-8");
    $var4 = mb_convert_encoding($rowResultData['data_nbr_tdtp'],"ISO-8859-1","UTF-8");
    $var5 = mb_convert_encoding($rowResultData['data_nbr_crtdtp'],"ISO-8859-1","UTF-8");
    $var6 = mb_convert_encoding($rowResultData['data_exps_micro'],"ISO-8859-1","UTF-8");
    $var7 = mb_convert_encoding($rowResultData['data_valid_tp'],"ISO-8859-1","UTF-8",);
    $var8 = mb_convert_encoding($rowResultData['data_polycp_cour'],"ISO-8859-1","UTF-8");
    $pdf->Multicell(80,4.3,$var1."\n".$var2."\n".$var3."\n".$var4."\n".$var5."\n".$var6."\n".$var7."\n".$var8,1);


    $pdf->ln(3);
    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $pdf->Line($xpos,$ypos,$xpos+190,$ypos);
    $pdf->ln(3);

    $xpos = $pdf->GetX();
    $ypos = $pdf->GetY();
    $etat = mb_convert_encoding('Avis de L’enseignant',"ISO-8859-1","UTF-8");
    $pdf->Multicell(25,5,$etat,1,'C');

    $pdf->SetXY($xpos+25,$ypos);
    $pdf->SetFont('Arial','B',10);
    $pdf->Multicell(0,10,mb_convert_encoding($rowResultData['avis_ens'],"ISO-8859-1","UTF-8"),1,'C');

    //                                              end table module data
  
  
    


    

  }else {
    $pdf->SetFont('Times','',12);
    // table
    $pdf->ln(4);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(0,0,0);
    $pdf->Cell(0,5.5,mb_convert_encoding($row['modl_name'],"ISO-8859-1","UTF-8"),1,1,'L',true);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->Cell(58,5.5,mb_convert_encoding('Cours',"ISO-8859-1","UTF-8"),1,0);
    $pdf->Cell(57,5.5,mb_convert_encoding('TD',"ISO-8859-1","UTF-8"),1,0);
    $pdf->Cell(45,5.5,mb_convert_encoding('TP',"ISO-8859-1","UTF-8"),1,1);

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

    $var1 = mb_convert_encoding('/',"ISO-8859-1","UTF-8");
    $var2 = mb_convert_encoding('/',"ISO-8859-1","UTF-8");
    $var3 = mb_convert_encoding('/',"ISO-8859-1","UTF-8");
    $var4 = mb_convert_encoding('/',"ISO-8859-1","UTF-8");
    $var5 = mb_convert_encoding('/',"ISO-8859-1","UTF-8");
    $var6 = mb_convert_encoding('/',"ISO-8859-1","UTF-8");
    $var7 = mb_convert_encoding('/',"ISO-8859-1","UTF-8");
    $var8 = mb_convert_encoding('/',"ISO-8859-1","UTF-8");
    $pdf->Multicell(45,4.3,$var1."\n".$var2."\n".$var3."\n".$var4."\n".$var5."\n".$var6."\n".$var7."\n".$var8,1,'C');


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

    //  end table module data

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
