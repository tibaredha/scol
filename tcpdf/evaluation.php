<?php
if (!ISSET($_POST['Datedebut'])||!ISSET($_POST['Datefin'])){$datejour11 =date("Y-m-d");$datejour22 =date("Y-m-d");}else{if(empty($_POST['Datedebut'])||empty($_POST['Datefin'])){ $datejour11 =date("Y-m-d");$datejour22 =date("Y-m-d");} else{$datejour11 = $_POST['Datedebut'] ;$datejour22 = $_POST['Datefin'];}}
if ($datejour11>$datejour22 or  $datejour11==$datejour22 ){header("Location: ../dashboard/Evaluation/0") ;}
require('cheval.php');
$pdf = new cheval( 'P', 'mm', 'A4',true,'UTF-8',false );
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$datejour1=$pdf->dateFR2US($datejour11);
$datejour2=$pdf->dateFR2US($datejour22);
$station=$_SESSION["station"];

if ($_POST['Evaluation']==0)//Registre signalement
{
$pdf->Regsigna($datejour1,$datejour2,$station);
}

if ($_POST['Evaluation']==1)//Registre saillie
{
$pdf->Regsaille($datejour1,$datejour2,$station);
}

if ($_POST['Evaluation']==2)//Bilan saison de monte
{

$pdf->AddPage('L','A4');
//$pdf->setRTL(true); 
$pdf->SetDisplayMode('fullpage','single');
$pdf->SetFont('dejavusans', '', 12);
$pdf->entetel();
$pdf->SetXY(10,80);$pdf->Cell(270,6,'Station : '.$pdf->nbrtostring('station','id',trim($station),'station'),1,1,'C');
$pdf->SetFillColor(240);
$pdf->SetXY(10,$pdf->GetY()+5);$pdf->Cell(270,6,'Repartition Des Etalons',1,1,1,'L');
$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(10,6,'N°',1,1,1,'L');  
$pdf->SetXY(20,$pdf->GetY()-6);$pdf->Cell(40,6,'N° Mle',1,1,1,'C');
$pdf->SetXY(60,$pdf->GetY()-6);$pdf->Cell(40,6,'Nom',1,1,1,'C');
$pdf->SetXY(100,$pdf->GetY()-6);$pdf->Cell(40,6,'Race',1,1,1,'C');
$pdf->SetXY(140,$pdf->GetY()-6);$pdf->Cell(20,6,'Age',1,1,1,'C');
$pdf->SetXY(160,$pdf->GetY()-6);$pdf->Cell(30,6,'Robe',1,1,1,'C');
$pdf->SetXY(190,$pdf->GetY()-6);$pdf->Cell(30,6,'Pere',1,1,1,'C');
$pdf->SetXY(220,$pdf->GetY()-6);$pdf->Cell(30,6,'Mere',1,1,1,'C');
$pdf->SetXY(250,$pdf->GetY()-6);$pdf->Cell(30,6,'IMPL',1,1,1,'C');
$pdf->SetFillColor(255, 255, 255);
$db_host="localhost"; 
$db_name="cheval"; 
$db_user="root";
$db_pass="";
$cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
$db  = mysql_select_db($db_name,$cnx) ;
mysql_query("SET NAMES 'UTF8' ");// le nom et prenom doit etre lier 
$queryvac = "select * from cheval  WHERE  station=$station  AND Sexe='M' and  aprouve = 1 and ( Datesigna BETWEEN '$datejour1' AND '$datejour2')  order by  Datesigna ";
$resultat=mysql_query($queryvac);
$totalmbr1=mysql_num_rows($resultat);
while($resultvac=mysql_fetch_object($resultat))
{
$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(10,6,trim($resultvac->id),1,1,'L');  
$pdf->SetXY(20,$pdf->GetY()-6);$pdf->Cell(40,6,trim($resultvac->N),1,1,'L');
$pdf->SetXY(60,$pdf->GetY()-6);$pdf->Cell(40,6,trim($resultvac->NomA) ,1,1,'L');
$pdf->SetXY(100,$pdf->GetY()-6);$pdf->Cell(40,6,$pdf->nbrtostring('race','id',trim($resultvac->Race),'race'),1,1,'L');
$pdf->SetXY(140,$pdf->GetY()-6);$pdf->Cell(20,6,trim(substr($resultvac->Dns,0,4)),1,1,'C');
$pdf->SetXY(160,$pdf->GetY()-6);$pdf->Cell(30,6,$pdf->nbrtostring('robe','id',trim($resultvac->Nobo),'robe'),1,1,'C');
$pdf->SetXY(190,$pdf->GetY()-6);$pdf->Cell(30,6,trim($resultvac->Pere),1,1,'C');
$pdf->SetXY(220,$pdf->GetY()-6);$pdf->Cell(30,6,trim($resultvac->mere),1,1,'C');
$pdf->SetXY(250,$pdf->GetY()-6);$pdf->Cell(30,6,$pdf->dateUS2FR(trim($resultvac->Datesigna)),1,1,'C');
}
$pdf->SetFillColor(240);$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(270,6,'Total station : '.$totalmbr1.' étalons',1,1,1,'L');$pdf->SetFillColor(255, 255, 255);




//**************************************************************************************************//

$pdf->AddPage('L','A4');
$pdf->SetDisplayMode('fullpage','single');
$pdf->SetFont('dejavusans', '', 12);
$pdf->entetel();
function jumsai($station,$datejour1,$datejour2,$datemonte)
{
$query_liste = "SELECT * FROM saillie WHERE  station=$station  and ( $datemonte BETWEEN '$datejour1' AND '$datejour2')";  //
$requete = mysql_query( $query_liste ) or die( "ERREUR MYSQL numéro: ".mysql_errno()."<br>Type de cette erreur: ".mysql_error()."<br>\n" );
$totalmbr1=mysql_num_rows($requete);
return $totalmbr1;
}
$pdf->SetFillColor(240);
$pdf->SetXY(10,$pdf->GetY()+40);$pdf->Cell(270,6,'Juments saillies du '.$pdf->dateUS2FR($datejour1).' au '.$pdf->dateUS2FR($datejour2),1,1,1,'L');
$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(67,6,'Au 1èr saut',1,1,1,'L');  
$pdf->SetXY(77,$pdf->GetY()-6);$pdf->Cell(67,6,'Au 2eme saut',1,1,1,'L');  
$pdf->SetXY(144,$pdf->GetY()-6);$pdf->Cell(67,6,'Au 3eme saut',1,1,1,'L');  
$pdf->SetXY(211,$pdf->GetY()-6);$pdf->Cell(69,6,'Total',1,1,1,'L');
$pdf->SetFillColor(255, 255, 255); 
$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(67,6,jumsai($station,$datejour1,$datejour2,'datemonte1'),1,1,'C');  
$pdf->SetXY(77,$pdf->GetY()-6);$pdf->Cell(67,6,jumsai($station,$datejour1,$datejour2,'datemonte2'),1,1,'C');  
$pdf->SetXY(144,$pdf->GetY()-6);$pdf->Cell(67,6,jumsai($station,$datejour1,$datejour2,'datemonte3'),1,1,'C');  
$pdf->SetXY(211,$pdf->GetY()-6);$pdf->Cell(69,6,jumsai($station,$datejour1,$datejour2,'datemonte1')+jumsai($station,$datejour1,$datejour2,'datemonte2')+jumsai($station,$datejour1,$datejour2,'datemonte3'),1,1,'C'); 

function prodec($station,$datejour1,$datejour2,$datemonte)
{
$query_liste = "SELECT * FROM saillie WHERE  station=$station  and  poulin != '0'  and  ( $datemonte BETWEEN '$datejour1' AND '$datejour2')";  //
$requete = mysql_query( $query_liste ) or die( "ERREUR MYSQL numéro: ".mysql_errno()."<br>Type de cette erreur: ".mysql_error()."<br>\n" );
$totalmbr1=mysql_num_rows($requete);
return $totalmbr1;
}
$pdf->SetFillColor(240);
$pdf->SetXY(10,$pdf->GetY()+5);$pdf->Cell(270,6,'Produits déclares du '.$pdf->dateUS2FR($datejour1).' au '.$pdf->dateUS2FR($datejour2),1,1,1,'L');
$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(67,6,'OC',1,1,1,'L');  
$pdf->SetXY(77,$pdf->GetY()-6);$pdf->Cell(67,6,'OI',1,1,1,'L');  
$pdf->SetXY(144,$pdf->GetY()-6);$pdf->Cell(67,6,'Total',1,1,1,'L');  
$pdf->SetXY(211,$pdf->GetY()-6);$pdf->Cell(69,6,'Obs',1,1,1,'L');
$pdf->SetFillColor(255, 255, 255); 
$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(67,6,prodec($station,$datejour1,$datejour2,'dateresultas'),1,1,'C');  
$pdf->SetXY(77,$pdf->GetY()-6);$pdf->Cell(67,6,'0',1,1,'C');  
$pdf->SetXY(144,$pdf->GetY()-6);$pdf->Cell(67,6,prodec($station,$datejour1,$datejour2,'dateresultas'),1,1,'C');  
$pdf->SetXY(211,$pdf->GetY()-6);$pdf->Cell(69,6,'***',1,1,'C'); 


// SELECT *
// FROM table1
// INNER JOIN table2
// WHERE table1.id = table2.fk_id
// SELECT * FROM `saillie` INNER JOIN cheval WHERE saillie.jument= cheval.id


function jumsairace($station,$datejour1,$datejour2,$datemonte,$race)
{
$query_liste = "SELECT * FROM `saillie` INNER JOIN cheval WHERE saillie.station=$station  and ( saillie.$datemonte BETWEEN '$datejour1' AND '$datejour2')  and 	cheval.Race=$race  and  saillie.jument= cheval.id    ";  //
////$query_liste = "SELECT * FROM saillie WHERE  station=$station  and ( $datemonte BETWEEN '$datejour1' AND '$datejour2')";  //
$requete = mysql_query( $query_liste ) or die( "ERREUR MYSQL numéro: ".mysql_errno()."<br>Type de cette erreur: ".mysql_error()."<br>\n" );
$totalmbr1=mysql_num_rows($requete);
return $totalmbr1;
}
$pdf->SetFillColor(240);
$pdf->SetXY(10,$pdf->GetY()+5);$pdf->Cell(270,6,'Recette  saillies du '.$pdf->dateUS2FR($datejour1).' au '.$pdf->dateUS2FR($datejour2),1,1,1,'L');
$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(90,6,'Nombre de juments',1,1,1,'L');  
$pdf->SetXY(100,$pdf->GetY()-6);$pdf->Cell(90,6,'P. U en (DA)',1,1,1,'L');  
$pdf->SetXY(190,$pdf->GetY()-6);$pdf->Cell(90,6,'Montant total',1,1,1,'L');  
$pdf->SetFillColor(255, 255, 255); 
$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(90,6,jumsairace($station,$datejour1,$datejour2,'datemonte1',4),1,1,'C');  
$pdf->SetXY(100,$pdf->GetY()-6);$pdf->Cell(90,6,'2 000.00',1,1,'C');  
$pdf->SetXY(190,$pdf->GetY()-6);$pdf->Cell(90,6,jumsai($station,$datejour1,$datejour2,'datemonte1')*2000,1,1,'C');  
//prevoir le prix par race
$pdf->SetXY(100,$pdf->GetY()+5);$pdf->Cell(195,10,"Le Responssable de la Station de monte ",0,1,'C',0); 
//$pdf->SetY(-10);$pdf->SetFont('helvetica', 'I', 8);$pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

$pdf->AddPage('L','A4');
//$pdf->setRTL(true); 
$pdf->SetDisplayMode('fullpage','single');
$pdf->SetFont('dejavusans', '', 12);
$pdf->entetel();
$pdf->SetXY(10,80);$pdf->Cell(270,6,'Station : '.$pdf->nbrtostring('station','id',trim($station),'station'),1,1,'C');
$pdf->SetFillColor(240);
$pdf->SetXY(10,$pdf->GetY()+5);$pdf->Cell(270,6,'Repartition Des produits declarés',1,1,1,'L');
$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(10,6,'N°',1,1,1,'L');  
$pdf->SetXY(20,$pdf->GetY()-6);$pdf->Cell(40,6,'N° Mle',1,1,1,'C');
$pdf->SetXY(60,$pdf->GetY()-6);$pdf->Cell(40,6,'Nom',1,1,1,'C');
$pdf->SetXY(100,$pdf->GetY()-6);$pdf->Cell(40,6,'Race',1,1,1,'C');
$pdf->SetXY(140,$pdf->GetY()-6);$pdf->Cell(20,6,'Age',1,1,1,'C');
$pdf->SetXY(160,$pdf->GetY()-6);$pdf->Cell(30,6,'Robe',1,1,1,'C');
$pdf->SetXY(190,$pdf->GetY()-6);$pdf->Cell(30,6,'Pere',1,1,1,'C');
$pdf->SetXY(220,$pdf->GetY()-6);$pdf->Cell(30,6,'Mere',1,1,1,'C');
$pdf->SetXY(250,$pdf->GetY()-6);$pdf->Cell(30,6,'IMPL',1,1,1,'C');
$pdf->SetFillColor(255, 255, 255);
$db_host="localhost"; 
$db_name="cheval"; 
$db_user="root";
$db_pass="";
$cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
$db  = mysql_select_db($db_name,$cnx) ;
mysql_query("SET NAMES 'UTF8' ");// le nom et prenom doit etre lier 
$queryvac= "SELECT * FROM saillie WHERE  station=$station  and  poulin != '0'  and  ( datemonte BETWEEN '$datejour1' AND '$datejour2')"; 
$resultat=mysql_query($queryvac);
$totalmbr1=mysql_num_rows($resultat);
while($resultvac=mysql_fetch_object($resultat))
{
$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(10,6,trim($resultvac->poulin),1,1,'L');  
$pdf->SetXY(20,$pdf->GetY()-6);$pdf->Cell(40,6,$pdf->nbrtostring('cheval','id',trim($resultvac->poulin),'N'),1,1,'C');
$pdf->SetXY(60,$pdf->GetY()-6);$pdf->Cell(40,6,$pdf->nbrtostring('cheval','id',trim($resultvac->poulin),'NomA'),1,1,'L');
$pdf->SetXY(100,$pdf->GetY()-6);$pdf->Cell(40,6,$pdf->nbrtostring('race','id',$pdf->nbrtostring('cheval','id',trim($resultvac->poulin),'Race'),'race'),1,1,'L');
$pdf->SetXY(140,$pdf->GetY()-6);$pdf->Cell(20,6,trim(substr($pdf->nbrtostring('cheval','id',trim($resultvac->poulin),'Dns'),0,4)),1,1,'C');
$pdf->SetXY(160,$pdf->GetY()-6);$pdf->Cell(30,6,$pdf->nbrtostring('robe','id',$pdf->nbrtostring('cheval','id',trim($resultvac->poulin),'Nobo'),'robe'),1,1,'L');
$pdf->SetXY(190,$pdf->GetY()-6);$pdf->Cell(30,6,$pdf->nbrtostring('cheval','id',trim($resultvac->poulin),'Pere'),1,1,'L');
$pdf->SetXY(220,$pdf->GetY()-6);$pdf->Cell(30,6,$pdf->nbrtostring('cheval','id',trim($resultvac->poulin),'mere'),1,1,'L');
$pdf->SetXY(250,$pdf->GetY()-6);$pdf->Cell(30,6,$pdf->dateUS2FR(trim($pdf->nbrtostring('cheval','id',trim($resultvac->poulin),'Datesigna'))),1,1,'C');
}
$pdf->SetFillColor(240);$pdf->SetXY(10,$pdf->GetY());$pdf->Cell(270,6,'Total station : '.$totalmbr1.' Produits',1,1,1,'L');$pdf->SetFillColor(255, 255, 255);
$pdf->Output();
}



if ($_POST['Evaluation']==3)
{
$pdf->AddPage('P','A4');
$pdf->entetex('CONCLUSION',$datejour1,$datejour2,$station);

//************************//

$h=10;
$h1=20;
$h2=30;
$h3=40;
$h4=50;
$h5=60;
$h6=70;
$h7=80;
$h8=90;
$h9=100;


$x=50;
$y=200-30;
$w=110;
$pdf->RoundedRect($x-5, $y-$w, 110, $w, 2.50, '1111');
$pdf->SetFillColor(154 ,205 ,50);
$pdf->SetXY($x,$y-$h);    $pdf->Cell(8,$h,'10',1,1,'C',1,0,''); 
$pdf->SetXY($x+10,$y-$h1);$pdf->Cell(8,$h1,'20',1,1,'C',1,0,''); 
$pdf->SetXY($x+20,$y-$h2);$pdf->Cell(8,$h2,'30',1,1,'C',1,0,''); 
$pdf->SetXY($x+30,$y-$h3);$pdf->Cell(8,$h3,'40',1,1,'C',1,0,''); 
$pdf->SetXY($x+40,$y-$h4);$pdf->Cell(8,$h4,'50',1,1,'C',1,0,''); 
$pdf->SetXY($x+50,$y-$h5);$pdf->Cell(8,$h5,'60',1,1,'C',1,0,''); 
$pdf->SetXY($x+60,$y-$h6);$pdf->Cell(8,$h6,'70',1,1,'C',1,0,''); 
$pdf->SetXY($x+70,$y-$h7);$pdf->Cell(8,$h7,'80',1,1,'C',1,0,''); 
$pdf->SetXY($x+80,$y-$h8);$pdf->Cell(8,$h8,'90',1,1,'C',1,0,''); 
$pdf->SetXY($x+90,$y-$h9);$pdf->Cell(8,$h9,'100',1,1,'C',1,0,''); 
$pdf->SetFillColor(0, 0, 0);

// $pdf->Write(0, 'Répartition Des Juments Saillies par race ');

$xc = 100;
$yc = 230;
$r = 50;


$pdf->RoundedRect(45,175, 110, $w, 2.50, '1111');
$pdf->SetFillColor(0, 0, 255);
$pdf->PieSector($xc, $yc, $r, 0, 160, 'FD', false, 0, 2);


$pdf->SetFillColor(0, 0, 100);
$pdf->PieSector($xc, $yc, $r, 0, 45, 'FD', false, 0, 2);

$pdf->SetFillColor(0, 255, 0);
$pdf->PieSector($xc, $yc, $r, 120, 250, 'FD', false, 0, 2);

$pdf->SetFillColor(255, 0, 0);
$pdf->PieSector($xc, $yc, $r, 250, 20, 'FD', false, 0, 2);







$pdf->AddPage('P','A4');
$pdf->entetebsm('',$datejour1,$datejour2,$station);//.$station

//**************************************1ere partie etalon ************************************************************//
$pdf->AddPage('P','A4');
$pdf->entetex('Les étalons en activites étatiques et prives',$datejour1,$datejour2,$station);
//a Repartition des effectifs étalons par race et par categorie
    $pdf->etalonsep($pdf->dateFR2US($_POST["Datedebut"]),$pdf->dateFR2US($_POST["Datefin"])); 
//b Repartition des effectifs étalons par race et par région
    $pdf->etalonsrr($pdf->dateFR2US($_POST["Datedebut"]),$pdf->dateFR2US($_POST["Datefin"]));
///c Répartition des étalons par région et station
	$pdf->mysqlconnect();
	$queryvac = "select * from region where id!=1 ORDER BY id ";
	$resultat=mysql_query($queryvac);
	$num_rows = mysql_num_rows($resultat);
	while($resultvac=mysql_fetch_object($resultat))
	{
	$pdf->AddPage('P','A4');
	$pdf->entetex('Répartition des étalons par région et station ( public et privé )',$datejour1,$datejour2,$station);
	$pdf->equinr($resultvac->id,'M');
	}
//**************************************2eme partie juments ************************************************************//
$pdf->AddPage('P','A4');
$pdf->entetex("Effectif des juments saillies par race d'etalon",$datejour1,$datejour2,$station);
//a Repartition du nombre de juments saillies par race d'etalon et par categorie  
$pdf->jse($datejour1,$datejour2);
//b Repartition du nombre de juments saillies par race d'etalon et par et par région 
$pdf->jsey($datejour1,$datejour2); 
//c Répartition des juments par région et station ( public et privé )
    $pdf->mysqlconnect();
	$queryvac = "select * from region where id!=1 ORDER BY id ";
	$resultat=mysql_query($queryvac);
	$num_rows = mysql_num_rows($resultat);
	while($resultvac=mysql_fetch_object($resultat))
	{
	$pdf->AddPage('P','A4');
	$pdf->entetex('Répartition des juments par région et station ( public et privé )',$datejour1,$datejour2,$station);
	$pdf->equinr($resultvac->id,'F');
	}
//**************************************3eme partie produits ************************************************************//
$pdf->AddPage('P','A4');
$pdf->entetex('Effectif produits déclarés',$datejour1,$datejour2,$station);
//a Repartition du nombre de produits déclarés par race et par categorie 
    $pdf->produit($pdf->dateFR2US($_POST["Datedebut"]),$pdf->dateFR2US($_POST["Datefin"])); 
//b Repartition du nombre de produits déclarés par race et par région 
    $pdf->produitreg($pdf->dateFR2US($_POST["Datedebut"]),$pdf->dateFR2US($_POST["Datefin"])); 
//c Répartition des equides par age
    $pdf->mysqlconnect();
	$queryvac = "select * from region where id!=1 ORDER BY id ";
	$resultat=mysql_query($queryvac);
	$num_rows = mysql_num_rows($resultat);
	while($resultvac=mysql_fetch_object($resultat))
	{
	$pdf->AddPage('P','A4');
	$pdf->entetex('Répartition des produits declarés par région et station ( public et privé )',$datejour1,$datejour2,$station);
	$pdf->equinpr($resultvac->id,$pdf->dateFR2US($_POST["Datedebut"]),$pdf->dateFR2US($_POST["Datefin"]));
	}

//**************************************4eme partie JUMENT - PRODUIT -RACE -REGION-STATION  ************************************************************//
$pdf->AddPage('P','A4');
$pdf->entetex('Répartition Des Juments Saillies Et Des Produits Declarés Par Race (Région et Station) ',$datejour1,$datejour2,$station);
//a Repartition du nombre de juments saillies par race  produit region station   







//**************************************5eme partie ETAT COMPARATIF SAISON DE MONTE   ************************************************************//
$pdf->AddPage('P','A4');
$pdf->entetex('ETAT COMPARATIF SAISONS DE MONTE',$datejour1,$datejour2,$station);



//**************************************6eme CONCLUSION   ************************************************************//
$pdf->AddPage('P','A4');
$pdf->entetex('CONCLUSION',$datejour1,$datejour2,$station);

//************************//

$pdf->SetFillColor(248, 248, 255);;
$pdf->SetXY(10,120);$pdf->Cell(10,36,'',1,1,'L'); 
$pdf->SetFillColor(0, 0, 0);





//*****************//






// write labels
// $pdf->SetTextColor(255,255,255);
// $pdf->Text(105, 65, 'BLUE');
// $pdf->Text(60, 95, 'GREEN');
// $pdf->Text(120, 115, 'RED');





    // $pdf->AddPage('P','A4');
    // $pdf->entetex('Répartition des equides par age',$datejour1,$datejour2,$station);
	// $pdf->SetFillColor(240);
	// $pdf->SetXY(10,$pdf->GetY()+20);$pdf->Cell(40,12,'Année de naissance',1,1,'C',1);
	// $pdf->SetXY(50,$pdf->GetY()-12);$pdf->Cell(40,12,'Age en Année',1,1,'C',1);
	// $pdf->SetXY(90,$pdf->GetY()-12);$pdf->Cell(55,12,"Nombre Equides",1,1,'C',1);
	// $queryjsa = "SELECT SUBSTR(Dns, 1, 4) AS AGE1 ,count(SUBSTR(Dns, 1, 4)) AS AGE FROM cheval  GROUP BY AGE1";
	// $resultatjsa=mysql_query($queryjsa);
	// $num_rows = mysql_num_rows($resultatjsa);
	// $pdf->SetFont('aefurat', '', 11);
	// $pdf->SetFillColor(255, 255, 255);
	// while($resultjsa=mysql_fetch_object($resultatjsa))
	// {
	// $pdf->SetXY(10,$pdf->GetY());$pdf->Cell(40,6,trim($resultjsa->AGE1),1,1,'C',0);
	// $pdf->SetXY(50,$pdf->GetY()-6);$pdf->Cell(40,6,date('Y')-trim($resultjsa->AGE1),1,1,'C',0);
	// $pdf->SetXY(90,$pdf->GetY()-6);$pdf->Cell(55,6,trim($resultjsa->AGE),1,1,'C',0);
	// }
$pdf->Output();
}


if ($_POST['Evaluation']==4)//stud book global
{
$pdf->studbookdz('IS NOT NULL',"DU CHEVAL",$station,$datejour1,$datejour2); 
}

if ($_POST['Evaluation']==5)//stud book  Pur-Sang-Arabe
{
$pdf->studbookdz('=2',"DU PUR-SANG-ARABE",$station,$datejour1,$datejour2); 
}

if ($_POST['Evaluation']==6)//stud book  Pur-Sang-Anglais
{
$pdf->studbookdz('=3',"PUR-SANG-ANGLAIS",$station,$datejour1,$datejour2); 
}

if ($_POST['Evaluation']==7)//stud book  Arabe-Barbe
{
$pdf->studbookdz('=4',"DU ARABE-BARBE",$station,$datejour1,$datejour2);
}

if ($_POST['Evaluation']==8)//stud book  Baudets
{
$pdf->studbookdz('=5',"DU BAUDETS",$station,$datejour1,$datejour2); 
}

if ($_POST['Evaluation']==9)//stud book  Barbe
{
$pdf->studbookdz('=6',"DU BARBE",$station,$datejour1,$datejour2);
}



if ($_POST['Evaluation']==10)//Annuaire des éleveurs
{
$pdf->Annuaire ($datejour1,$datejour2,$station);
}



?>


