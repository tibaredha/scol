<?php
$id=$_GET["id"];

$idcheval=$_GET["idcheval"];


require('cheval.php');
$pdf = new cheval( 'L', 'mm', 'A5',true,'UTF-8',false );
// $pdf->SetTextColor(0,0,255);
$pdf->setPrintHeader(false);$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->setPrintFooter(false);
$pdf->AddPage('L','A5');
//$pdf->setRTL(true); 
$pdf->SetDisplayMode('fullpage','single');//mode d affichage 

$pdf->SetFont('dejavusans', '', 12);
$pdf->Cell(190,6,'الجمهورية الجزائرية الديمقراطية الشعبية',0,1,'C');$pdf->SetFont('aefurat', '', 12);
$pdf->Cell(190,6,'République Algérienne Démocratique et Populaire',0,1,'C');

$pdf->SetXY(10,25);$pdf->Cell(95,6,'الديوان الوطني لتربية الخيول و الإبل',0,1,'C');
$pdf->SetXY(10+95,25);$pdf->Cell(95,6,'وزارة الفلاحة و التنمية الريفية ',0,1,'C');


$pdf->SetFont('aefurat', '', 12);
$pdf->SetXY(10,31);$pdf->Cell(95,6,'Office National de Développement des ',0,1,'C');
$pdf->SetXY(10,37);$pdf->Cell(95,6,'Elevages  Equins et Camélins',0,1,'C');

$pdf->SetXY(10+95,31);$pdf->Cell(95,6,"Ministere De L'agriculture Et Du",0,1,'C');
$pdf->SetXY(10+95,37);$pdf->Cell(95,6,'Developpement Rural',0,1,'C');

$pdf->SetXY(10,43);$pdf->Cell(190,6,'الجمهورية الجزائرية الديمقراطية الشعبية',0,1,'C');$pdf->SetFont('aefurat', '', 13);
$pdf->SetXY(10,49);$pdf->Cell(190,6,"CERTIFICAT D'IMMATRICULATION",0,1,'C');

$db_host="localhost"; 
$db_name="cheval"; 
$db_user="root";
$db_pass="";
$cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
$db  = mysql_select_db($db_name,$cnx) ;
mysql_query("SET NAMES 'UTF8' ");// le nom et prenom doit etre lier 
$query = "select * from sale WHERE  id=$id    ";
$resultat=mysql_query($query);
while($result=mysql_fetch_object($resultat))
{
$pdf->SetXY(10,55);$pdf->Cell(95,6,'N° : '.$pdf->nbrtostring('cheval','id',trim($result->idcheval),'N'),0,1,'L');         $pdf->SetXY(10,55);$pdf->Cell(95,6,'الرقم : ',0,1,'R');                                                  $pdf->SetXY(10+95,55);$pdf->Cell(95,6,'N°C S : ',0,1,'L');                                                                                                             $pdf->SetXY(10+95,55);$pdf->Cell(95,6,'رقم : ',0,1,'R');
$pdf->SetXY(10,55+10);$pdf->Cell(95,6,'Nom : '.$pdf->nbrtostring('cheval','id',trim($result->idcheval),'NomA'),0,1,'L');     $pdf->SetXY(10,55+10);$pdf->Cell(95,6,'الاسم : ',0,1,'R');                                             $pdf->SetXY(10+95,55+10);$pdf->Cell(95,6,'Annee de Naissance : '.substr($pdf->nbrtostring('cheval','id',trim($result->idcheval),'Dns'), 0, 4),0,1,'L');                $pdf->SetXY(10+95,55+10);$pdf->Cell(95,6,'عام الازدياد : ',0,1,'R');
$pdf->SetXY(10,55+20);$pdf->Cell(95,6,'Race : '.$pdf->nbrtostring('race','id',$pdf->nbrtostring('cheval','id',trim($result->idcheval),'Race'),'race'),0,1,'L');    $pdf->SetXY(10,55+20);$pdf->Cell(95,6,'السلالة : ',0,1,'R');     $pdf->SetXY(10+95,55+20);$pdf->Cell(47,6,'Robe : '.$pdf->nbrtostring('robe','id',$pdf->nbrtostring('cheval','id',trim($result->idcheval),'Nobo'),'robe'),0,1,'L');     $pdf->SetXY(10+95,55+20);$pdf->Cell(47,6,'الون : ',0,1,'R');                $pdf->SetXY(10+95+47,55+20);$pdf->Cell(47,6,'Sexe : '.$pdf->nbrtostring('cheval','id',trim($result->idcheval),'Sexe'),0,1,'L');$pdf->SetXY(10+95+47,55+20);$pdf->Cell(47,6,'الجنس : ',0,1,'R');
$pdf->SetXY(10,55+30);$pdf->Cell(95,6,'Pere : '.$pdf->nbrtostring('cheval','id',trim($result->idcheval),'Pere'),0,1,'L');    $pdf->SetXY(10,55+30);$pdf->Cell(95,6,'الاب : ',0,1,'R');                                              $pdf->SetXY(10+95,55+30);$pdf->Cell(95,6,'Race : '.$pdf->nbrtostring('race','id',$pdf->nbrtostring('cheval','id',trim($result->idcheval),'RacePere'),'race'),0,1,'L'); $pdf->SetXY(10+95,55+30);$pdf->Cell(95,6,'السلالة : ',0,1,'R');
$pdf->SetXY(10,55+40);$pdf->Cell(95,6,'Mere : '.$pdf->nbrtostring('cheval','id',trim($result->idcheval),'mere'),0,1,'L');    $pdf->SetXY(10,55+40);$pdf->Cell(95,6,'الام : ',0,1,'R');                                              $pdf->SetXY(10+95,55+40);$pdf->Cell(95,6,'Race : '.$pdf->nbrtostring('race','id',$pdf->nbrtostring('cheval','id',trim($result->idcheval),'RaceMere'),'race'),0,1,'L'); $pdf->SetXY(10+95,55+40);$pdf->Cell(95,6,'السلالة : ',0,1,'R');
$pdf->SetXY(10,55+50);$pdf->Cell(95,6,'Naisseur : '.$pdf->nbrtostring('cheval','id',trim($result->idcheval),'Naisseur'),0,1,'L');   $pdf->SetXY(50,55+50);$pdf->Cell(95,6,'المولد : ',0,1,'R');     $pdf->SetXY(150,55+50);$pdf->Cell(55,6,'تاشيرة السلطة المتوكلة',0,1,'C'); $pdf->SetXY(150,55+50);$pdf->Cell(55,24+12,'',1,1,'C');
$pdf->SetXY(10,55+60);$pdf->Cell(95,6,'Adresse : ',0,1,'L');    $pdf->SetXY(50,55+60);$pdf->Cell(95,6,'العنوان : ',0,1,'R');    $pdf->SetXY(150,55+55);$pdf->Cell(55,6,"visa de l'autorité de tutelle",0,1,'C');

// $pdf->SetXY(10,97);$pdf->Cell(95,6,'Vendu le  : '.$pdf->dateUS2FR(trim($result->datesale)),0,1,'L');    $pdf->SetXY(10,97);$pdf->Cell(95,6,'بيع في   : ',0,1,'R');
// $pdf->SetXY(10,97+6);$pdf->Cell(95,6,'à Mr   : '.trim($result->NomP),0,1,'L');     $pdf->SetXY(10,97+6);$pdf->Cell(95,6,'الي السيد   : ',0,1,'R');
// $pdf->SetXY(10,97+12);$pdf->Cell(95,6,'Adresse  : '.trim($result->adresse),0,1,'L');  $pdf->SetXY(10,97+12);$pdf->Cell(95,6,'العنوان  : ',0,1,'R');
// $pdf->SetXY(10,97+18);$pdf->Cell(95,6,$pdf->nbrtostring('wil','IDWIL',trim($result->wil),'WILAYAS').'_'.$pdf->nbrtostring('com','IDCOM',trim($result->com),'COMMUNE'),0,1,'L');  $pdf->SetXY(10,97+12);$pdf->Cell(95,6,'العنوان  : ',0,1,'R');
// $pdf->SetXY(10,97+18+6);$pdf->Cell(95,6,'Signature  : ',0,1,'L');$pdf->SetXY(10,97+18+6);$pdf->Cell(95,6, 'أمضاء :',0,1,'R');
}

$pdf->AddPage('L','A5');
// $pdf->setRTL(true); 
$pdf->SetDisplayMode('fullpage','single');//mode d affichage where idcheval=58 LIMIT 0,3
$query = "select * from sale  where idcheval=$idcheval  order by  datesale   desc     LIMIT 0,3  ";
$resultat=mysql_query($query);
while($result=mysql_fetch_object($resultat))
{
$pdf->Cell(95,6,'Vendu le  : '.$pdf->dateUS2FR(trim($result->datesale)),0,1,'L');   //$pdf->Cell(95,6,'بيع في   : ',0,1,'R');
$pdf->Cell(95,6,'à Mr   : '.trim($result->NomP),0,1,'L');                           //$pdf->Cell(95,6,'الي السيد   : ',0,1,'R');
$pdf->Cell(95,6,'Adresse  : '.trim($result->adresse),0,1,'L');                      //$pdf->Cell(95,6,'العنوان  : ',0,1,'R');
$pdf->Cell(95,6,$pdf->nbrtostring('wil','IDWIL',trim($result->wil),'WILAYAS').'_'.$pdf->nbrtostring('com','IDCOM',trim($result->com),'COMMUNE'),0,1,'L');  //$pdf->Cell(95,6,'العنوان  : ',0,1,'R');
$pdf->Cell(95,6,'Signature  : ',0,1,'L');//$pdf->Cell(95,6, 'أمضاء :',0,1,'R');
$pdf->Cell(95,6,'___________________________________ ',0,1,'L'); 
$pdf->SetXY(10,$pdf->GetY()+10); 
}
$pdf->AddPage('L','A5');
$pdf->SetFont('dejavusans', '', 12);
$pdf->Cell(190,5,'******',0,1,'C');
$pdf->SetFont('aefurat', '', 12);
$pdf->Cell(190,5,'******',0,1,'C');
$pdf->SetFont('aefurat', '', 10);$pdf->SetXY(105,25);$pdf->Cell(95,10,'*** ',1,1,'C');
$pdf->SetXY(105,35);$pdf->Cell(95,5,'**** ',1,1,'C');
$pdf->SetXY(10,25);$pdf->Cell(95,5,"**** ",1,1,'L');
$pdf->SetXY(10,30);$pdf->Cell(95,5,'***',1,1,'L');
$pdf->SetXY(10,35);$pdf->Cell(95,5,'***',1,1,'L');
$pdf->SetXY(10,40);$pdf->Cell(20,5,'بيـــــع في',1,1,'C');
$pdf->SetXY(30,40);$pdf->Cell(35,5,'الى السيــــــــد',1,1,'C');
$pdf->SetXY(65,40);$pdf->Cell(35,5,'الولاية',1,1,'C');
$pdf->SetXY(100,40);$pdf->Cell(35,5,'البلدية',1,1,'C');
$pdf->SetXY(135,40);$pdf->Cell(35,5,'العنوان',1,1,'C');
$pdf->SetXY(170,40);$pdf->Cell(30,5,'الإمضاء',1,1,'C');
$pdf->SetXY(10,45);$pdf->Cell(20,5,'Vendu le',1,1,'C');
$pdf->SetXY(30,45);$pdf->Cell(35,5,'à Mr  ',1,1,'C');
$pdf->SetXY(65,45);$pdf->Cell(35,5,'wilaya',1,1,'C');
$pdf->SetXY(100,45);$pdf->Cell(35,5,'commune',1,1,'C');
$pdf->SetXY(135,45);$pdf->Cell(35,5,'adresse',1,1,'C');
$pdf->SetXY(170,45);$pdf->Cell(30,5,'Signature',1,1,'C');
$query = "select * from sale  where idcheval=$idcheval  order by  datesale asc LIMIT 0,6  ";//
$resultat=mysql_query($query);
while($result=mysql_fetch_object($resultat))
{
$pdf->SetFont('aefurat', '', 10);
$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(20,15,$pdf->dateUS2FR(trim($result->datesale)),1,1,'C',0);
$pdf->SetXY(30,$pdf->GetY()-15);$pdf->Cell(35,15,trim($result->NomP),1,1,'L',0);
$pdf->SetXY(65,$pdf->GetY()-15);$pdf->Cell(35,15,$pdf->nbrtostring('wil','IDWIL',trim($result->wil),'WILAYAS'),1,1,'L',0);
$pdf->SetXY(100,$pdf->GetY()-15);$pdf->Cell(35,15,$pdf->nbrtostring('com','IDCOM',trim($result->com),'COMMUNE'),1,1,'L');
$pdf->SetXY(135,$pdf->GetY()-15);$pdf->Cell(35,15,trim($result->adresse),1,1,'L',0);
$pdf->SetXY(170,$pdf->GetY()-15);$pdf->Cell(30,15,'',1,1,'C',0); 
}
for ($i = 50; $i <= 130; $i+=15) {
$pdf->SetXY(10,$i);$pdf->Cell(20,15,'',1,1,'C');
$pdf->SetXY(30,$i);$pdf->Cell(35,15,'',1,1,'C');
$pdf->SetXY(65,$i);$pdf->Cell(35,15,'',1,1,'C');
$pdf->SetXY(100,$i);$pdf->Cell(35,15,'',1,1,'C');
$pdf->SetXY(135,$i);$pdf->Cell(35,15,'',1,1,'C');
$pdf->SetXY(170,$i);$pdf->Cell(30,15,'',1,1,'C');   
}
$pdf->Output();
?>


