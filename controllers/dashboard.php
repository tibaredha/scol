<?php

class Dashboard extends Controller {
     
	public $controleur="dashboard";
	
	function __construct() {
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		if ($logged == false) {
			Session::destroy();
			header('location: ../login');
			exit;
		}
		$this->view->js = array('dashboard/js/default.js');	
	}
	function logout()
	{
		Session::destroy();
		header('location: ' . URL .  'login');
		exit;
	}
	function mail($id) 
	{
	    $this->view->title = 'mail';
		$this->view->user =$this->model->userSingleList($id);
		$this->view->render($this->controleur.'/mail');
	}
	function dump() 
	{
	    $this->view->title = 'dump';
		$this->view->render($this->controleur.'/dump');
	}
	function XLS() 
	{
	    $this->view->title = 'XLS';
		$this->view->render($this->controleur.'/XLS');
	}
	function user() 
	{
	    $this->view->title = 'user';
		$this->view->userList = $this->model->userList() ;
		$this->view->render($this->controleur.'/user');
	}
	function userSave($id) 
	{
	    $data = array();
		$data['id']         = $id;
		$data['login']      = $_POST['login'];
		$data['password']   = md5($_POST['password']);
		$data['region']    = $_POST['region'];
		$data['wregion']   = $_POST['wregion'];
		$data['station']   = $_POST['station'];
		//echo '<pre>';print_r ($data);echo '<pre>';
		$this->model->userSave($data);
		header('location: ' . URL .$this->controleur."/logout");
	}
	function index() 
	{
	    $this->view->title = 'dashboard';
		$this->view->render($this->controleur.'/index');
	}
	
	function ondeec($id) 
	{	
	    $this->view->title = 'Evaluation';
		
		if($id!=0) {
		$this->view->render($this->controleur.'/ondeec'.$id);
		} else {
		$this->view->render($this->controleur.'/ondeec');
		}	
	}
	
	
	
	function Evaluation($id) 
	{	
	    $this->view->title = 'Evaluation';
		
		if($id!=0) {
		$this->view->render($this->controleur.'/Evaluation'.$id);
		} else {
		$this->view->render($this->controleur.'/Evaluation');
		}	
	}
	
	function graphe($id) 
	{
	    $this->view->title = 'dashboard';
		if($id!=0) {
		$this->view->render($this->controleur.'/index'.$id);
		} else {
		$this->view->render($this->controleur.'/index');
		}	
	}
	
	function nouveaux() 
	{
	    $this->view->title = 'dashboard';
		$this->view->render($this->controleur.'/nouveaux');
	}
	public function createx() 
	{
		$data = array();
		$data['N']          = $_POST['N'];
		if($_POST['Datesigna']=='') {$data['Datesigna']=date('Y-m-d');}else{$data['Datesigna']  = $_POST['Datesigna'];}
		$data['NomP']       = $_POST['NomP'];
		$data['wil']        = $_POST['wil'];
		$data['com']        = $_POST['com'];
		$data['adresse']    = $_POST['adresse'];
		$data['NomA']       = $_POST['NomA'];
		$data['Dns']        = $_POST['Dns'];
		$data['Race']       = $_POST['Race'];
		$data['Nobo']       = $_POST['Nobo'];
		$data['NPPRODUIT']  = $_POST['NPPRODUIT'];
		$data['Sexe']       = $_POST['Sexe'];
		$data['Pere']       = $_POST['Pere'];
		// $data['DnsPere']    = $_POST['DnsPere'];
		// $data['RacePere']   = $_POST['RacePere'];
		// $data['CouleurPere']= $_POST['CouleurPere'];
		// $data['NPPERE']     = $_POST['NPPERE'];
		$data['mere']       = $_POST['mere'];
		// $data['DnsMere']    = $_POST['DnsMere'];
		// $data['RaceMere']   = $_POST['RaceMere'];
		// $data['CouleurMere']= $_POST['CouleurMere'];
	    // $data['NPMERE']     = $_POST['NPMERE'];
		$data['Tete']       = $_POST['Tete'];
		$data['AG']         = $_POST['AG'];
		$data['AD']         = $_POST['AD'];
		$data['PG']         = $_POST['PG'];
        $data['PD']         = $_POST['PD'];
		$data['MARQUES']    = $_POST['MARQUES'];
		$data['region']     = $_POST['region'];
		$data['wregion']    = $_POST['wregion'];
		$data['station']    = $_POST['station'];
		$data['aprouve']    = $_POST['aprouve'];
		$data['secteur']    = $_POST['secteur'];
		$data['telphone']   = $_POST['telphone'];
		$data['Taille']     = $_POST['Taille'];
		$data['Naisseur']   = $_POST['Naisseur'];
		// $data['NPere']      = $_POST['NPere'];
		// $data['NMere']      = $_POST['NMere'];
		$data['Origine']      = $_POST['Origine'];
		$data['ANaisseur']      = $_POST['ANaisseur'];
		// echo '<pre>';print_r ($data);echo '<pre>';  
		$last_id=$this->model->createx($data);
		header('location: '.URL.$this->controleur.'/createimage/'.$last_id);	
	}
	function nouveauy() 
	{
	    $this->view->title = 'dashboard';
		$this->view->render($this->controleur.'/nouveauy');
	}
	public function createy() 
	{
	    $url1 = explode('/',$_GET['url']);	
		$data = array();
		// $data['N1']               = $url1[2];//id sailli
		// $data['N2']               = $url1[3];//id etalon pere
		// $data['N3']               = $url1[4];//id jument mere
		if($_POST['Datesigna']=='') {$data['Datesigna']=date('Y-m-d');}else{$data['Datesigna']  = $_POST['Datesigna'];}
		$data['Sexe']       = $_POST['Sexe'];
		$data['Taille']     = $_POST['Taille'];
		$data['Naisseur']   = $_POST['Naisseur'];
	    $data['ANaisseur']  = $_POST['ANaisseur'];
		$data['NomA']       = $_POST['NomA'];
		$data['N']          = $_POST['N'];
		$data['Dns']        = $_POST['Dns'];
		$data['Race']       = $_POST['Race'];
		$data['Nobo']       = $_POST['Nobo'];
		$data['NPPRODUIT']  = $_POST['NPPRODUIT'];
		
		$data['Pere']       = $url1[3];//id etalon pere
		$data['mere']       = $url1[4];//id jument mere
		
		$data['Tete']       = $_POST['Tete'];
		$data['AG']         = $_POST['AG'];
		$data['AD']         = $_POST['AD'];
		$data['PG']         = $_POST['PG'];
        $data['PD']         = $_POST['PD'];
		$data['MARQUES']    = $_POST['MARQUES'];
		
		$data['aprouve']      = $_POST['aprouve'];
		$data['DateAprouve']  = $_POST['DateAprouve'];
		$data['Origine']      = $_POST['Origine'];
		
		$data['region']     = $_POST['region'];
		$data['wregion']    = $_POST['wregion'];
		$data['station']    = $_POST['station'];
		
		$data['idsailli']   = $url1[2];//id sailli
		
		//echo '<pre>';print_r ($data);echo '<pre>';  
		$last_id=$this->model->createy($data);
		header('location: '.URL.$this->controleur.'/createimage/'.$last_id);	
	}
	
	
	function nouveau() 
	{
	    $this->view->title = 'dashboard';
		$this->view->render($this->controleur.'/nouveau');
	}
	public function create() 
	{
		$data = array();
		$data['N']          = $_POST['N'];
		if($_POST['Datesigna']=='') {$data['Datesigna']=date('Y-m-d');}else{$data['Datesigna']  = $_POST['Datesigna'];}
		$data['NomP']       = $_POST['NomP'];
		$data['wil']        = $_POST['wil'];
		$data['com']        = $_POST['com'];
		$data['adresse']    = $_POST['adresse'];
		$data['NomA']       = $_POST['NomA'];
		$data['Dns']        = $_POST['Dns'];
		$data['Race']       = $_POST['Race'];
		$data['Nobo']       = $_POST['Nobo'];
		$data['NPPRODUIT']  = $_POST['NPPRODUIT'];
		$data['Sexe']       = $_POST['Sexe'];
		$data['Pere']       = $_POST['Pere'];
		$data['DnsPere']    = $_POST['DnsPere'];
		$data['RacePere']   = $_POST['RacePere'];
		$data['CouleurPere']= $_POST['CouleurPere'];
		$data['NPPERE']     = $_POST['NPPERE'];
		$data['mere']       = $_POST['mere'];
		$data['DnsMere']    = $_POST['DnsMere'];
		$data['RaceMere']   = $_POST['RaceMere'];
		$data['CouleurMere']= $_POST['CouleurMere'];
	    $data['NPMERE']     = $_POST['NPMERE'];
		$data['Tete']       = $_POST['Tete'];
		$data['AG']         = $_POST['AG'];
		$data['AD']         = $_POST['AD'];
		$data['PG']         = $_POST['PG'];
        $data['PD']         = $_POST['PD'];
		$data['MARQUES']    = $_POST['MARQUES'];
		$data['region']     = $_POST['region'];
		$data['wregion']    = $_POST['wregion'];
		$data['station']    = $_POST['station'];
		$data['aprouve']    = $_POST['aprouve'];
		$data['secteur']    = $_POST['secteur'];
		$data['telphone']   = $_POST['telphone'];
		$data['Taille']     = $_POST['Taille'];
		$data['Naisseur']   = $_POST['Naisseur'];
		$data['NPere']      = $_POST['NPere'];
		$data['NMere']      = $_POST['NMere'];
		$data['Origine']      = $_POST['Origine'];
		$data['ANaisseur']      = $_POST['ANaisseur'];
		// echo '<pre>';print_r ($data);echo '<pre>';  
		$last_id=$this->model->create($data);
		header('location: '.URL.$this->controleur.'/createimage/'.$last_id);	
	}
	function liste() 
	{
    $this->view->title = 'liste ';
	$this->view->userListview = $this->model->liste() ;
	$this->view->render('dashboard/liste');
	}
	public function view($id) 
	{
        $this->view->title = 'view';
		$this->view->user =$this->model->userSingleList($id);
		$this->view->render($this->controleur.'/view');
	}
	function createimage() 
	{
        $this->view->title = 'dashboard';	
		$this->view->render($this->controleur.'/createimage');
	}
	
	public function Aprouve() 
	{
        $url1 = explode('/',$_GET['url']);	
		$data = array();
		$data['id']         = $url1[2];
		$data['aprouve']    = $url1[3];
		//echo '<pre>';print_r ($data);echo '<pre>';
		$this->model->Aprouve($data);
		header('location: ' . URL .$this->controleur.'/search/'.$url1[4].'/'.$url1[5].'?o=id&q=');
	}
	
	
	public function edit($id) 
	{
        $this->view->title = 'Edit';
		$this->view->user = $this->model->userSingleList($id);
		$this->view->render($this->controleur.'/edit');
	}
	public function editSave($id)
	{
		$data = array();
		$data['id']         = $id;
		$data['N']          = $_POST['N'];
		$data['Datesigna']  = $_POST['Datesigna'];
		$data['NomP']       = $_POST['NomP'];
		$data['wil']        = $_POST['wil'];
		$data['com']        = $_POST['com'];
		$data['adresse']    = $_POST['adresse'];
		$data['NomA']       = $_POST['NomA'];
		$data['Dns']        = $_POST['Dns'];
		$data['Race']       = $_POST['Race'];
		$data['Nobo']       = $_POST['Nobo'];
		$data['NPPRODUIT']  = $_POST['NPPRODUIT'];
		$data['Sexe']       = $_POST['Sexe'];
		$data['Pere']       = $_POST['Pere'];
		$data['DnsPere']    = $_POST['DnsPere'];
		$data['RacePere']   = $_POST['RacePere'];
		$data['CouleurPere']= $_POST['CouleurPere'];
		$data['NPPERE']     = $_POST['NPPERE'];
		$data['mere']       = $_POST['mere'];
		$data['DnsMere']    = $_POST['DnsMere'];
		$data['RaceMere']   = $_POST['RaceMere'];
		$data['CouleurMere']= $_POST['CouleurMere'];
	    $data['NPMERE']     = $_POST['NPMERE'];
		$data['Tete']       = $_POST['Tete'];
		$data['AG']         = $_POST['AG'];
		$data['AD']         = $_POST['AD'];
		$data['PG']         = $_POST['PG'];
        $data['PD']         = $_POST['PD'];
		$data['MARQUES']    = $_POST['MARQUES'];
		$data['region']     = $_POST['region'];
		$data['wregion']    = $_POST['wregion'];
		$data['station']    = $_POST['station'];
		$data['aprouve']    = $_POST['aprouve'];
		$data['secteur']    = $_POST['secteur'];
		$data['telphone']   = $_POST['telphone'];
		$data['Taille']     = $_POST['Taille'];
		$data['Naisseur']   = $_POST['Naisseur'];
		$data['NPere']      = $_POST['NPere'];
		$data['NMere']      = $_POST['NMere'];
		$data['Origine']    = $_POST['Origine'];
		$data['ANaisseur']  = $_POST['ANaisseur'];
		$data['stataprouv'] = $_POST['stataprouv'];
		// echo '<pre>';print_r ($data);echo '<pre>';
		$this->model->editSave($data);
		header('location: ' . URL .$this->controleur.'/search/0/10?o=id&q='.$id.'');
	}
	public function delete($id)
	{
	$this->model->delete($id);       
	unlink('C:/wamp/www/cheval/public/images/'.$id.'.jpg');
	header('location: ' . URL .$this->controleur.'/search/0/10?o=NomP&q=');
	}
	//***searchcheval***/
	function search()
	{
	    $url1 = explode('/',$_GET['url']);	
		$this->view->title = 'Search cheval';
	    $this->view->userListviewo = $_GET['o']; //criter de choix
	    $this->view->userListviewq = $_GET['q']; //key word  
		$this->view->userListviewp =$url1[2]; // parametre 2 page                     limit 2,3
		$this->view->userListviewl =10     ; // parametre 3 nombre de ligne par page  limit 2,3 
		$this->view->userListviewb =15       ; // parametre nombre de chiffre dan la barre  navigation
		$this->view->userListview = $this->model->userSearch($this->view->userListviewo,$this->view->userListviewq,$this->view->userListviewp,$this->view->userListviewl);
		$this->view->userListview1= $this->model->userSearch1($this->view->userListviewo,$this->view->userListviewq); // compte total pour bare de navigation
		$this->view->render($this->controleur.'/index');
	}
	//***//
	function SIG($id) 
	{	
	    $this->view->title = 'Systeme Information Geographique';
		switch ($id) 
		{ 
			case 17: 
				$this->view->render($this->controleur.'/djelfacom');
			break;
			
            case 14: 
				$this->view->render($this->controleur.'/tiaret');
			break;
			

			
			default:
				$this->view->render($this->controleur.'/djelfacom');
		}	
	}
	function SIGA() 
	{	
	    $this->view->title = 'Systeme Information Geographique';
		// $id='17000';
	    // $this->view->userListview = $this->model->dnrcommune($id) ;
		//$this->view->render('dnr/ALGERIE');
		$this->view->render($this->controleur.'/algerie');
	}
	//***//
	function Vacciner($id) 
	{
	$this->view->title = 'dashboard';
	$this->view->user =$this->model->userSingleList($id);
	$this->view->userListview = $this->model->listevac($id) ;
	$this->view->render($this->controleur.'/Vacciner');	
	}
	public function createvaccin($id) 
	{
		$data = array();
		$data['datevaccination']          = $_POST['datevaccination'];
		$data['wil']        = $_POST['wil'];
		$data['com']        = $_POST['com'];
		$data['adresse']    = $_POST['adresse'];
		$data['vaccin']     = $_POST['vaccin'];
		$data['veterinaire']= $_POST['veterinaire'];
		$data['id']= $id;
		// echo '<pre>';print_r ($data);echo '<pre>';  
		$last_id=$this->model->createvaccin($data);
		header('location: '.URL.$this->controleur.'/Vacciner/'.$id);	
	}
	
	public function deletevac($id)
	{
	$url1 = explode('/',$_GET['url']);	
	echo '<pre>';print_r ($url1);echo '<pre>'; 
	$this->model->deletevac($id);     //la supression du donneur 
	header('location: ' . URL .$this->controleur.'/Vacciner/'.$url1[3]);
	}
    //***//
	function Bilanter($id) 
	{
	$this->view->title = 'Bilanter';
	$this->view->user =$this->model->userSingleList($id);
	$this->view->userListview = $this->model->listebilan($id) ;
	$this->view->render($this->controleur.'/Bilanter');	
	}
	public function createbilan($id) 
	{
		$data = array();
		$data['datebilan']  = $_POST['datebilan'];
		$data['wil']        = $_POST['wil'];
		$data['com']        = $_POST['com'];
		$data['adresse']    = $_POST['adresse'];
		$data['bilan']      = $_POST['bilan'];
		$data['veterinaire']= $_POST['veterinaire'];
		$data['id']= $id;
		echo '<pre>';print_r ($data);echo '<pre>';  
		$last_id=$this->model->createbilan($data);
		header('location: '.URL.$this->controleur.'/Bilanter/'.$id);	
	}
	
	public function deletebilan($id)
	{
	$url1 = explode('/',$_GET['url']);	
	// echo '<pre>';print_r ($url1);echo '<pre>'; 
	$this->model->deletebilan($id);     //la supression du donneur 
	header('location: ' . URL .$this->controleur.'/Bilanter/'.$url1[3]);
	}
	//***//
	function Saillir($id) 
	{
	$this->view->user =$this->model->userSingleList($id);
	$this->view->userListview = $this->model->listesaillie($id) ;
	$this->view->userListview1 = $this->model->listesaillie1($id) ;
	$this->view->render($this->controleur.'/Saillir');	
	}
	public function createsaillie($id) 
	{
	if ($_POST['jument']!=='' and $_POST['datemonte']!=='') {
	    $data = array();
		$data['datemonte']   = $_POST['datemonte'];
		$data['region']      = $_POST['region'];
		$data['wregion']     = $_POST['wregion'];
		$data['station']     = $_POST['station'];
		$data['typemonte']   = $_POST['typemonte'];
		$data['jument']      = $_POST['jument'];
		$data['veterinaire'] = $_POST['veterinaire'];
		$data['SommeRecu']   = $_POST['SommeRecu'];
		$data['datemonte1']  = $_POST['datemonte1'];
		$data['datemonte2']  = $_POST['datemonte2'];
		$data['datemonte3']  = $_POST['datemonte3'];
		$data['daterevue']   = $_POST['daterevue'];
		$data['id']= $id;
		//echo '<pre>';print_r ($data);echo '<pre>';  
		$last_id=$this->model->createsaillie($data);
		header('location: ' . URL .$this->controleur.'/Saillir/'.$id);	
	} else {
	header('location: '.URL.$this->controleur.'/Saillir/'.$id);
	} 	
	}
	public function deletemonte($id)
	{
	$url1 = explode('/',$_GET['url']);	
	// echo '<pre>';print_r ($url1);echo '<pre>'; 
	$this->model->deletemonte($id,$url1[4]);     
	header('location: ' . URL .$this->controleur.'/Saillir/'.$url1[3]);
	}
	
	public function editresultasmonte($id) 
	{
        $this->view->title = 'Edit';
		$this->view->user = $this->model->userSinglesaillie($id);
		$this->view->render($this->controleur.'/editresultasmonte');
	}
	
	public function editSaveresultasmonte($id)
	{
		$data = array();
		$url1 = explode('/',$_GET['url']);
		$data['id']         = $id;
		$data['Resultas']   = $_POST['Resultas'];
		//$data['poulin']     = $_POST['poulin'];
		$data['dateresultas']     = $_POST['dateresultas'];
		
		
		echo '<pre>';print_r ($data);echo '<pre>';
		$this->model->editSaveresultasmonte($data);
		header('location: ' . URL .$this->controleur.'/Saillir/'.$url1[3].'');
	}
	
	
	//***//
	function Sale($id) 
	{
	$this->view->user =$this->model->userSingleList($id);
	$this->view->userListview = $this->model->listeSale($id) ;
	$this->view->render($this->controleur.'/Sale');	
	}
	public function createSale($id) 
	{
		$data = array();
		$data['datesale']   = $_POST['datesale'];
		$data['NomP']      = $_POST['NomP'];
		$data['wil']        = $_POST['wil'];
		$data['com']        = $_POST['com'];
		$data['adresse']    = $_POST['adresse'];
		$data['payssale']    = $_POST['payssale'];
		$data['id']= $id;
		// echo '<pre>';print_r ($data);echo '<pre>';  
		$this->model->createSale($data);
		$this->model->SaleSave($data);
		header('location: ' . URL .$this->controleur.'/sale/'.$id);	
	}
	
	public function deleteSale($id)
	{
	$url1 = explode('/',$_GET['url']);	
	// echo '<pre>';print_r ($url1);echo '<pre>'; 
	$this->model->deleteSale($id);    
	header('location: ' . URL .$this->controleur.'/sale/'.$url1[3]);
	}
	//***/
	
	
	//***************************************************************************************************************************//
	function ordonnacednr($id) 
	{	
	    $this->view->title = 'ordonnacednr';
		$this->view->user =$this->model->userSingleList($id);
		$this->view->render($this->controleur.'/ordonnacednr');
	}
	
	function creationPanier(){
	   if (!isset($_SESSION['ordonnace'])){
		  $_SESSION['ordonnace']=array();
		  $_SESSION['ordonnace']['libelleProduit']    = array();
		  $_SESSION['ordonnace']['doseparprise']      = array();
		  $_SESSION['ordonnace']['nbrdrfoisparjours'] = array();
		  $_SESSION['ordonnace']['nbrdejours']        = array();
		  $_SESSION['ordonnace']['totaltrt']          = array();
		  $_SESSION['ordonnace']['qteProduit']        = array();
		  $_SESSION['ordonnace']['prixProduit']       = array();
		  $_SESSION['ordonnace']['verrou']            = false;
	   }
	   return true;
	}
	function isVerrouille(){
	   if (isset($_SESSION['ordonnace']) && $_SESSION['ordonnace']['verrou'])
	   return true;
	   else
	   return false;
	}
	function ajouterArticle()
	{   
	    $libelleProduit=$_POST['libelleProduit'];
		$doseparprise=$_POST['doseparprise'];
		$nbrdrfoisparjours=$_POST['nbrdrfoisparjours'];
		$nbrdejours=$_POST['nbrdejours'];
		$qteProduit=$_POST['qteProduit'];
		$prixProduit=$_POST['prixProduit'];
		$totaltrt=$doseparprise*$nbrdrfoisparjours*$nbrdejours; 	
		session_start();
		   if ($this->creationPanier() && !$this->isVerrouille())
		   {
		   $positionProduit = array_search($libelleProduit,$_SESSION['ordonnace']['libelleProduit']);
			  if ($positionProduit !== false)
			  {
				 header('location:'.URL.$this->controleur.'/ordonnacednr/'.$_POST['id']);
			  }
			  else
			  {
				 array_push( $_SESSION['ordonnace']['libelleProduit'],$libelleProduit);
				 array_push( $_SESSION['ordonnace']['doseparprise'],$doseparprise);
				 array_push( $_SESSION['ordonnace']['nbrdrfoisparjours'],$nbrdrfoisparjours);
				 array_push( $_SESSION['ordonnace']['nbrdejours'],$nbrdejours);
				 array_push( $_SESSION['ordonnace']['qteProduit'],$qteProduit);
				 array_push( $_SESSION['ordonnace']['prixProduit'],$prixProduit);
				 array_push( $_SESSION['ordonnace']['totaltrt'],$totaltrt);
			  }			      
		   }
	header('location:'.URL.$this->controleur.'/ordonnacednr/'.$_POST['id']);	  
	}
	function modifierQTeArticle($libelleProduit,$qteProduit)
	{
		session_start();
		if ($this->creationPanier() && !$this->isVerrouille())
		{
			if ($qteProduit > 0)
			{
				$positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);
				if ($positionProduit !== false)
				{
				$_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
				}
				header('location: ' . URL .'pan/pan');  
			}
			else
			$this->supprimerArticle($libelleProduit);
		}	
	}
	function supprimerArticle($libelleProduit)
	{
	$url1 = explode('/',$_GET['url']);	
		session_start();
		if ($this->creationPanier() && !$this->isVerrouille())
		{
			$tmp=array();
			$tmp['libelleProduit']    = array();
			$tmp['doseparprise']      = array();
			$tmp['nbrdrfoisparjours'] = array();
			$tmp['nbrdejours']        = array();
			$tmp['totaltrt']          = array();
			$tmp['qteProduit']        = array();
			$tmp['prixProduit']       = array();
			$tmp['verrou'] = $_SESSION['ordonnace']['verrou'];
			for($i = 0; $i < count($_SESSION['ordonnace']['libelleProduit']); $i++)
			{
				if ($_SESSION['ordonnace']['libelleProduit'][$i] !== $libelleProduit)
				{
				array_push( $tmp['libelleProduit'],$_SESSION['ordonnace']['libelleProduit'][$i]);
				array_push( $tmp['doseparprise'],$_SESSION['ordonnace']['doseparprise'][$i]);
				array_push( $tmp['nbrdrfoisparjours'],$_SESSION['ordonnace']['nbrdrfoisparjours'][$i]);
				array_push( $tmp['nbrdejours'],$_SESSION['ordonnace']['nbrdejours'][$i]);
				array_push( $tmp['totaltrt'],$_SESSION['ordonnace']['totaltrt'][$i]);
				array_push( $tmp['qteProduit'],$_SESSION['ordonnace']['qteProduit'][$i]);
				array_push( $tmp['prixProduit'],$_SESSION['ordonnace']['prixProduit'][$i]);
				}
			}
			$_SESSION['ordonnace'] =  $tmp;
			unset($tmp);
			header('location: ' . URL .$this->controleur.'/ordonnacednr/'.$url1[3]); 
		}
	}	
	function supprimePanier(){
	 $url1 = explode('/',$_GET['url']);	
	 session_start();unset($_SESSION['ordonnace']);
     header('location: '.URL.$this->controleur.'/ordonnacednr/'.$url1[2]); 
	}
	function compterArticles()
	{
		if (isset($_SESSION['ordonnace']))
		return count($_SESSION['ordonnace']['libelleProduit']);
		else
		return 0;
	}
	function MontantGlobal(){
		$total=0;
		for($i = 0; $i < count($_SESSION['ordonnace']['libelleProduit']); $i++)
		{
			$total += $_SESSION['ordonnace']['qteProduit'][$i] * $_SESSION['ordonnace']['prixProduit'][$i];
		}
		return $total;
	}
	function miseajour(){
		session_start();
		for ($i = 0 ; $i < count($_POST['q']) ; $i++)
		{
			$this->modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],$_POST['q'][$i]);
		}    
	}	
	//***fin ordonnace dnr ***//
	
	 //**CHANGER PHOTOS**//
	function upl() 
	{
	$this->view->title = 'upload';
	$this->view->render($this->controleur.'/upl');    
	}
	
	function upl1($id) 
	{
		$this->view->title = 'upload';
		if (isset($_POST))
		{
		
			if (isset($_FILES))
			{
				//upload_max_filesize=10M   A MODIFIER DANS PHP.INI
				// $uploadLocation = "d:\\mvc/public/webcam/pat/"; 
				
				
				$uploadLocation = "d:\\cheval/public/images/cheval/";
				
				$target_path = $uploadLocation.trim($id).".jpg";      
				if(move_uploaded_file($_FILES['upfile']['tmp_name'], $target_path)) 
				{	
				$this->view->msg ='le fichier :  '.basename( $_FILES['upfile']['name']).'  a été corectement envoyer merci';
				} 
				else
				{
				$this->view->msg ='il ya une erreur d\'envoie du fichier :  '.basename( $_FILES['upfile']['name']).'  veillez recomencer svp';	
				}
			}	
		}
		header('location: ' . URL .$this->controleur.'/upl/'.$id.'');
		
		   
	}		
	
	//**fin CHANGER PHOTOS**//
	
	
	
	
	//***************************************************************************//
	
	function xhrInsert()
	{
		$this->model->xhrInsert();
	}
	
	function xhrGetListings()
	{
		$this->model->xhrGetListings();
	}
	
	function xhrDeleteListing()
	{
		$this->model->xhrDeleteListing();
	}
	
}