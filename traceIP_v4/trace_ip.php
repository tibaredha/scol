<?php
	/////////////////////////////////////////////////////////////////////////////////////
	//  Trace IP v4 - https://www.mlxcorp.net.info - http://www.1001bd.com                //
	/////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////////////////////////////////////////
	//  Début de la configuration                                                       //
	/////////////////////////////////////////////////////////////////////////////////////

	// Si vous utilisez un fichier externe pour la connexion MySQL, spécifiez-le ici
	// sinon commentez cette ligne en mettant // devant le require :
	//require('/lib/mysql.php'); // attention à l'URL relative

	// Si vous préférez spécifier ici vos identifiants MySQL, spécifiez-les ci-dessous
	// sinon (cas de l'utilisation d'un fichier) commentez chacun d'eux :
	$dbhost = 'localhost'; // adresse du serveur MySQL
	$dbport = 3306; // port MySQL
	$dbuname = 'root'; // utilisateur MySQL
	$dbpass = ''; // mot de passe MySQL
	$dbname = 'homologation'; // nom de la base de données où est présente la table de TraceIP

	// Identifiants de connexion à l'administration :
	define('TIP_ADMIN_LOGIN','matthieu');
	define('TIP_ADMIN_PWD','mdp_admin');

	// si votre site a déjà un session start, vous pouvez commenter celui-ci et mettre 0 à la destruction de session
	session_start();
	$detruire_session = 1;

	/////////////////////////////////////////////////////////////////////////////////////
	//  Fin de la configuration                                                        //
	/////////////////////////////////////////////////////////////////////////////////////

	$tip_is_admin = true;
	$get_act = (isset($_GET['act'])) ? $_GET['act'] : '';
	$array_acts = array('admin', 'lock', 'blacklist', 'whitelist', 'config', 'connect', 'logout');

	if (!in_array($get_act, $array_acts)) { $get_act = ''; $tip_is_admin = false; }

	if ((in_array($get_act, array('admin', 'lock', 'blacklist', 'whitelist', 'config'))) && ((!isset($_SESSION['tip_login'])) || ($_SESSION['tip_login'] == '')))
		$get_act = 'connect';

	//echo '<pre>'; print_r($_SESSION); echo '</pre>';


	// visitor general data
	$Vcpt  = 0;
	$Vdate = date('Y-m-d H:i:s');
	$Vdatetime = time(); // timestamp
	$array_server_values = $_SERVER;
	$Vua   = $array_server_values['HTTP_USER_AGENT'];
	$Vip   = $array_server_values['REMOTE_ADDR'];
	$VinList = ''; // default : no list (neither black, nor white)
	$VisLocked = 0;
	$html = '';

	// connexion MySQL
	try
	{
		$connexion = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$dbname, $dbuname, $dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$connexion->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	catch(Exception $e)
	{
		echo 'Erreur : '.$e->getMessage().'<br />';
		echo 'N° : '.$e->getCode();
		exit();
	}


	function TipMailAlert($mailtype)
	{
		global $Vip, $Vdate, $array_server_values;

		if ($mailtype == 'blacklist')
			$tip_subject = '[IP bloquée par liste] '.$Vip.' - '.$Vdate . "\r\n";
		else
			$tip_subject = '[IP Interdite] '.$Vip.' - '.$Vdate . "\r\n";

		// Generate the alert mail
		$tip_headers = 'From: TraceIP v4 <'.TIP_MAIL_FROM.'>' . "\r\n";
		$tip_body  = 'Variables serveur envoyées :'."\n";
		foreach($array_server_values as $key => $val)
			$tip_body .= '  '.$key.' => '.$val."\n";

		$tip_body = addslashes($tip_body);
		eval("\$tip_body = \"$tip_body\";");
		$tip_body = stripslashes($tip_body);
		$tip_body .= "\n\nAccéder à l'administration des IP : ".TIP_ADMIN;

		// Send the mail
		mail(TIP_MAIL_TO, $tip_subject, $tip_body, $tip_headers);
		//echo '<pre>'; print_r($tip_subject); echo '</pre>';
		//echo '<pre>'; print_r($tip_body); echo '</pre>';
	};

	function TipRedirect($destination)
	{
		$html  = '<p style="text-align:center;"><a href="'.$destination.'">Redirection en cours ...</a><script type="text/javascript">';
		$html .= "	window.setTimeout(\"location=('".html_entity_decode($destination)."');\",3000)";
		$html .= '</script></p>';
		return $html;
	};

	function TipDisplayPages($nb_pages, $current_page, $redirect_uri)
	{
		$html = '';

		if ($nb_pages > 1)
		{
			$html .= '<div class="multipages" style="text-align:right; padding-right:1em; margin:1em auto;">';

			// away from page 1 ?
			if ($current_page != 1)
				$html .= '<a href="'.$redirect_uri.'&amp;p='.($current_page-1).'" title="Précédente">&laquo;</a> | ';

			// list all pages
			for($a = 1; $a <= $nb_pages; $a++)
			{
				if ($a == $current_page)
					$html .= '<span>'.$a.'</span> | '.CR;
				else
					$html .= '<a href="'.$redirect_uri.'&amp;p='.$a.'">'.$a.'</a> | ';
			};

			// away from last page ?
			if ($current_page != $nb_pages)
				$html .= '<a href="'.$redirect_uri.'&amp;p='.($current_page+1).$anchor.'" title="Suivante">&raquo;</a>';

			$html .= '</div>';
		};

		return $html;
	};







	// lecture config
	$query = 'SELECT var, val FROM traceip_cfg;';
	$ds = $connexion->query($query);

	while($config = $ds->fetch(PDO::FETCH_ASSOC))
	{
		//echo 'VAR=' . $config['var'].' --VAL='.$config['val'];
		define(strtoupper($config['var']), $config['val']);
	};
	unset($config);
	unset($ds);


	// supprimer les IP non bannies plus vieilles que 60 sec
	$tip_date_limit = date('Y-m-d H:i:s', time() - 60);

	$query = 'DELETE FROM traceip_online WHERE (is_locked=:is_locked AND date_time < :date_time);';
	$requete_prepare_1=$connexion->prepare($query);
	$requete_prepare_1->execute(array( ':is_locked' => 0, ':date_time' => $tip_date_limit));











/* ************************************************************************
 * DEFAULT (visitor count)
 * ********************************************************************** */
	if ($get_act == '')
	{
		// look if visitor is already banned or in (black|white)list
		// look into (black|white)list
		$query = 'SELECT list_type FROM traceip_lists WHERE ip=:ip LIMIT 1;';
		$requete_prepare_1 = $connexion->prepare($query);
		$requete_prepare_1->execute(array( 'ip' => $Vip ));
		$lignes=$requete_prepare_1->fetch(PDO::FETCH_OBJ);

		$VinList = ''; // par défaut vide
		if (isset($lignes->list_type))
			$VinList = $lignes->list_type;


		// look if visitor is in the online visitor's list
		$query = 'SELECT ip, date_time, cpt, is_locked FROM traceip_online WHERE ip=:ip;';
		$requete_prepare_1 = $connexion->prepare($query);
		$requete_prepare_1->execute(array( 'ip' => $Vip ));
		$lignes=$requete_prepare_1->fetch(PDO::FETCH_ASSOC);
		$nb_lignes = $requete_prepare_1->rowCount();

		if ($nb_lignes == 0) // visitor is NOT in the online list
		{
			$is_locked = 0;
			// option 1 : if blacklist, add it & ban it
			if ($VinList == 'blacklist')
			{
				$Vcpt = TIP_MAX_PAGE_COUNT +1;
				$is_locked = 1;

				// send alert mail
				TipMailAlert('blacklist');
			};

			// option 2 : if not in white list, add it
			if ($VinList == '')
			{
				$Vcpt += 1;
				$is_locked = 0;
			};



			$query = 'INSERT INTO traceip_online (ua, ip, date_time, cpt, is_locked) VALUES (:ua, :ip, :date_time, :cpt, :is_locked);';
			$requete_prepare_1=$connexion->prepare($query);
			$requete_prepare_1->execute(array(':ua' => $Vua, ':ip' => $Vip, ':date_time' => date('Y-m-d H:i:s'), ':cpt' => $Vcpt, ':is_locked' => $is_locked));
		}
		else // visitor is already in the online list
		{
			//print_r($lignes);
			$Vcpt = intval($lignes['cpt']);
			$VisLocked = intval($lignes['is_locked']);

			// process next only if not in whitelist
			if ($VinList != 'whitelist')
			{
				if ($VisLocked == 1)
					exit(TIP_MSG_BAN); // bye bye

				// option 1 : if blacklist, ban it
				if ($VinList == 'blacklist')
				{
					$Vcpt = TIP_MAX_PAGE_COUNT +1; // erase value
					$is_locked = 1;

					$query = 'UPDATE traceip_online SET cpt=:cpt, is_locked=:is_locked WHERE ip=:ip;';
					$requete_prepare_1=$connexion->prepare($query);
					$requete_prepare_1->execute(array( ':cpt' => $Vcpt, ':is_locked' => $is_locked, ':ip' => $Vip));
				};


				// option 2 : if not in white list, upgrade counter. If necessary, lock it
				if ($VinList == '')
				{
					$Vcpt += 1;
					$is_locked = ($Vcpt >= TIP_MAX_PAGE_COUNT) ? 1 : 0;

					$query = 'UPDATE traceip_online SET cpt=(cpt+1), is_locked=:is_locked WHERE ip=:ip;';
					$requete_prepare_1=$connexion->prepare($query);
					$requete_prepare_1->execute(array(':is_locked' => $is_locked, ':ip' => $Vip));

					if ($is_locked == 1) // send alert mail
						TipMailAlert('ban');
				};
			}; // end of if ($VinList != 'whitelist')
		}; // end of if (mysql_num_rows($tip_ds_ip) == 0)
	}; // end of if ($get_act == '')






/* ************************************************************************
 * Connection
 * ********************************************************************** */
	if ($get_act == 'connect')
	{
		if (!isset($_POST['tip_submit']))
		{
			$html .= '
			<h2>Connexion Administration TraceIP v4</h2>
			<form id="cnx" method="post" action="?act=connect">
				<p><label for="login">Login :</label><input type="text" id="login" name="login" /></p>
				<p><label for="pwd">Mot de passe :</label><input type="password" id="pwd" name="pwd" /></p>
				<p style="text-align:center;"><input type="submit" name="tip_submit" value="Connexion" /></p>
			</form>'.PHP_EOL;
		}
		else
		{
			$login = (isset($_POST['login'])) ? trim($_POST['login']) : '';
			$pwd = (isset($_POST['pwd'])) ? trim($_POST['pwd']) : '';

			if (($login === TIP_ADMIN_LOGIN) && ($pwd === TIP_ADMIN_PWD))
			{
				$_SESSION['tip_login'] = $login;
				$html .= TipRedirect('?act=admin');
			}
			else
			{
				$html .= '<p>Erreur dans les identifiants de connexion.</p>'."\n";
			};
		};
	}; // end of if ($get_act == 'connect')





/* ************************************************************************
 * Logout
 * ********************************************************************** */
	if ($get_act == 'logout')
	{
		unset($_SESSION['tip_login']);
		if ($detruire_session == 1)
		{
			$_SESSION = array();
			session_destroy();
		};
		$html .= TipRedirect('?act=admin');
	};











/* ************************************************************************
 * SECTION ADMIN
 * ********************************************************************** */
	if ($get_act == 'admin')
	{
		$get_page = (isset($_GET['p']))  ? abs(intval($_GET['p'])) : 1; if ($get_page == 0) { $get_page = 1; }
		$get_id = (isset($_GET['id'])) ? abs(intval($_GET['id'])) : 0;

		if ($get_id != 0)
		{
			$query = 'DELETE FROM traceip_online WHERE id=:id;';
			$requete_prepare_1=$connexion->prepare($query);
			$requete_prepare_1->execute(array( ':id' => $get_id));
			$html .= '<p><strong>Suppression de l\'IP effectuée.</strong></p>';
		};

		$query = 'SELECT COUNT(id) AS num_ip FROM traceip_online;';
		$requete_prepare_1 = $connexion->prepare($query);
		$requete_prepare_1->execute();
		$lignes=$requete_prepare_1->fetch(PDO::FETCH_ASSOC);
		$nb_lignes = $requete_prepare_1->rowCount();



		$num_pages = ceil($lignes['num_ip'] / TIP_NUM_ROWS_PER_PAGE);
		$firstRow = ($get_page -1) * TIP_NUM_ROWS_PER_PAGE;
		$lastRow = TIP_NUM_ROWS_PER_PAGE;
		$redirect_uri = '?act='.$get_act;

		if ($lignes['num_ip'] == 0)
		{
			$html .= '<p><strong>Aucune adresse IP n\'est listée.</strong></p>';
		}
		else
		{

			$html .= TipDisplayPages($num_pages, $get_page, $redirect_uri);
			$html .= '
			<table border="1" cellpadding="3" cellspacing="0" summary="" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Agent Utilisateur</th>
					<th>Adresse IP</th>
					<th>Date</th>
					<th>Compteur pages</th>
					<th>Bloquée ?</th>
					<th>Opérations</th>
				</tr>
			</thead>
			<tbody>';

			//while($tip_dr = mysql_fetch_assoc($tip_ds))
			$query = sprintf("SELECT id, ua, ip, date_time, cpt, is_locked FROM traceip_online ORDER BY date_time DESC LIMIT %d,%d;", $firstRow, $lastRow);
			$requete_prepare_1 = $connexion->query($query);


			while($ligne = $requete_prepare_1->fetch(PDO::FETCH_ASSOC))
			{
				//print_r($ligne);
				// prepare operations
				$add_to_whitelist = '<a href="?act=whitelist&amp;do=add&amp;ip='.$ligne['ip'].'" title="Ajouter à la liste blanche">+WhiteList</a> ';
				$add_to_blacklist = '<a href="?act=blacklist&amp;do=add&amp;ip='.$ligne['ip'].'" title="Ajouter à la liste noire">+BlackList</a> ';
				$del = '<a href="?act=admin&amp;id='.$ligne['id'].'" title="Supprimer cette entrée">Suppr</a> ';
				$lock = '<a href="?act=lock&amp;id='.$ligne['id'].'&amp;lock=1" title="Verrouiller cette IP">Lock</a> ';
				$unlock = '<a href="?act=lock&amp;id='.$ligne['id'].'&amp;lock=0" title="Déverrouiller cette IP">Unlock</a> ';

				$ops = $add_to_whitelist.$add_to_blacklist.$del.$lock.$unlock;

				$is_locked = ($ligne['is_locked'] == 1) ? 'X' : '&nbsp;';

				$html .= '
				<tr>
					<td>'.$ligne['id'].'</td>
					<td>'.$ligne['ua'].'</td>
					<td>'.$ligne['ip'].'</td>
					<td>'.$ligne['date_time'].'</td>
					<td style="text-align:center;">'.$ligne['cpt'].'</td>
					<td style="text-align:center;">'.$is_locked.'</td>
					<td>'.$ops.'</td>
				</tr>'.PHP_EOL;

			};
			$html .= '
			</tbody>
			</table>'.PHP_EOL;
			$html .= TipDisplayPages($num_pages, $get_page, $redirect_uri);
		}; // end of if ($tip_row['num_ip'] == 0)
	}; // end of if ($get_act == 'admin')

















/* ************************************************************************
 * SECTION CONFIG
 * ********************************************************************** */
	if ($get_act == 'config')
	{
		if (isset($_POST['tip_submit']))
		{
			$TIP_NUM_ROWS_PER_PAGE = (isset($_POST['TIP_NUM_ROWS_PER_PAGE'])) ? abs(intval($_POST['TIP_NUM_ROWS_PER_PAGE'])) : 25;
			$TIP_MAX_PAGE_COUNT = (isset($_POST['TIP_MAX_PAGE_COUNT'])) ? abs(intval($_POST['TIP_MAX_PAGE_COUNT'])) : 25;
			$TIP_MAIL_TO = (isset($_POST['TIP_MAIL_TO'])) ? $_POST['TIP_MAIL_TO'] : 'vous@votrefournisseur.tld';
			$TIP_MAIL_FROM = (isset($_POST['TIP_MAIL_FROM'])) ? $_POST['TIP_MAIL_FROM'] : 'peuimporte@votrefournisseur.tld';
			$TIP_ADMIN = (isset($_POST['TIP_ADMIN'])) ? $_POST['TIP_ADMIN'] : $_SERVER['HTTP_REFERER'];
			$TIP_MSG_BAN = (isset($_POST['TIP_MSG_BAN'])) ? $_POST['TIP_MSG_BAN'] : '<b>IP interdite pour abus !</b>';

			// now update DB
			$query = 'UPDATE traceip_cfg SET val=:val WHERE var=:var;';
			$requete_prepare_1=$connexion->prepare($query);

			$requete_prepare_1->execute(array( ':val' => $TIP_NUM_ROWS_PER_PAGE, ':var' => 'TIP_NUM_ROWS_PER_PAGE'));
			$requete_prepare_1->execute(array( ':val' => $TIP_MAX_PAGE_COUNT, ':var' => 'TIP_MAX_PAGE_COUNT'));
			$requete_prepare_1->execute(array( ':val' => $TIP_MAIL_TO, ':var' => 'TIP_MAIL_TO'));
			$requete_prepare_1->execute(array( ':val' => $TIP_MAIL_FROM, ':var' => 'TIP_MAIL_FROM'));
			$requete_prepare_1->execute(array( ':val' => $TIP_ADMIN, ':var' => 'TIP_ADMIN'));
			$requete_prepare_1->execute(array( ':val' => $TIP_MSG_BAN, ':var' => 'TIP_MSG_BAN'));

			$html .= '<p><strong>Configuration de TraceIP v4 mise à jour !</strong></p>';
			$html .= TipRedirect('?act='.$get_act);
		};




		if (!isset($_POST['tip_submit']))
		{
			$html .= '
			<form id="tip_upd_config" method="post" action="?act=config">
				<p><label for="TIP_NUM_ROWS_PER_PAGE">Nombre lignes par page admin :</label><input type="text" id="TIP_NUM_ROWS_PER_PAGE" name="TIP_NUM_ROWS_PER_PAGE" value="'.TIP_NUM_ROWS_PER_PAGE.'" /></p>
				<p><label for="TIP_MAX_PAGE_COUNT">Nombre max. pages par minute :</label><input type="text" id="TIP_MAX_PAGE_COUNT" name="TIP_MAX_PAGE_COUNT" value="'.TIP_MAX_PAGE_COUNT.'" /></p>
				<p><label for="TIP_MAIL_TO">Destinataire du mail d\'alerte :</label><input type="text" id="TIP_MAIL_TO" name="TIP_MAIL_TO" value="'.TIP_MAIL_TO.'" /></p>
				<p><label for="TIP_MAIL_FROM">Expéditeur du mail d\'alerte :</label><input type="text" id="TIP_MAIL_FROM" name="TIP_MAIL_FROM" value="'.TIP_MAIL_FROM.'" /></p>
				<p><label for="TIP_ADMIN">URL de la section admin :</label><input type="text" id="TIP_ADMIN" name="TIP_ADMIN" value="'.TIP_ADMIN.'" /></p>
				<p><label for="TIP_MSG_BAN">Texte renvoyé aux IP bannies (HTML autorisé) :</label><textarea id="TIP_MSG_BAN" name="TIP_MSG_BAN" cols="30" rows="8">'.TIP_MSG_BAN.'</textarea></p>
				<p style="text-align:center;"><input type="submit" name="tip_submit" value="Mettre à jour" /></p>
			</form>'.PHP_EOL;
		}
	}; // end of if ($get_act == 'config')
















/* ************************************************************************
 * SECTION LOCK / UNLOCK
 * ********************************************************************** */
	if ($get_act == 'lock')
	{
		$get_lock = (isset($_GET['lock'])) ? abs(intval($_GET['lock'])) : 1; // 0 unlock, 1 lock
		$get_id = (isset($_GET['id'])) ? abs(intval($_GET['id'])) : 0;

		if ($get_id != 0)
		{
			$query = 'UPDATE traceip_online SET is_locked=:is_locked WHERE id=:id;';
			$requete_prepare_1=$connexion->prepare($query);
			$requete_prepare_1->execute(array( ':is_locked' => $get_lock, ':id' => $get_id));

			if ($get_lock == 0)
				$html .= '<p><strong>Déverrouillage effectué.</strong></p>';
			else
				$html .= '<p><strong>Verrouillage effectué.</strong></p>';
		};

		$html .= TipRedirect('?act=admin');
	}; // end of if ($get_act == 'lock')



















/* ************************************************************************
 * SECTION WHITELIST / BLACKLIST
 * ********************************************************************** */
	if (($get_act == 'blacklist') || ($get_act == 'whitelist'))
	{
		$get_ip   = (isset($_GET['ip'])) ? trim($_GET['ip']) : '';
		$get_do   = (isset($_GET['do'])) ? trim($_GET['do']) : '';
		$get_page = (isset($_GET['p']))  ? abs(intval($_GET['p'])) : 1; if ($get_page == 0) { $get_page = 1; }

		if ($get_ip != '')
		{
			if ($get_do == 'add')
			{
				$query = 'INSERT INTO traceip_lists (ip, date_time, list_type) VALUES (:ip, :date_time, :list_type);';
				$requete_prepare_1=$connexion->prepare($query);
				$requete_prepare_1->execute(array(':ip' => $get_ip, ':date_time' => date('Y-m-d H:i:s'), ':list_type' => $get_act));
			}
			elseif($get_do == 'upd') // switch BL <=> WL
			{
				$query = 'UPDATE traceip_lists SET list_type=:list_type WHERE ip = :ip;';
				$requete_prepare_1=$connexion->prepare($query);
				$requete_prepare_1->execute(array( ':list_type' => $get_act, ':ip' => $get_ip));
			}
			else // del
			{
				$query = 'DELETE FROM traceip_lists WHERE (list_type=:list_type AND ip = :ip);';
				$requete_prepare_1=$connexion->prepare($query);
				$requete_prepare_1->execute(array( ':list_type' => $get_act, ':ip' => $get_ip));
			}

			$do_array = array('add' => 'ajoutée à', 'del' => 'supprimée de');

			if ($get_do == 'upd') { $get_do = 'add'; }
			if ($get_act == 'blacklist')
				$html .= '<p><strong>IP '.$do_array[$get_do].' la liste noire</strong></p>';
			else
				$html .= '<p><strong>IP '.$do_array[$get_do].' la liste blanche.</strong></p>';

			$html .= TipRedirect('?act='.$get_act);
		}
		else // manage list
		{
			$html .= '<h2>Les adresses IP en liste ';
			$html .= ($get_act == 'blacklist') ? 'noire' : 'blanche';
			$html .= '</h2>';


			if (isset($_POST['tip_submit']))
			{
				$post_new_ip = (isset($_POST['tip_add_ip'])) ? trim($_POST['tip_add_ip']) : '';
				$array_new_ip = explode(PHP_EOL, $post_new_ip);

				foreach($array_new_ip as $new_ip)
				{
					$new_ip = trim($new_ip);

					if ($new_ip != '')
					{
						$query = 'INSERT IGNORE INTO traceip_lists (ip, date_time, list_type) VALUES (:ip, :date_time, :list_type);';
						$requete_prepare_1=$connexion->prepare($query);
						$requete_prepare_1->execute(array(':ip' => $new_ip, ':date_time' => date('Y-m-d H:i:s'), ':list_type' => $get_act));
					};
				};

				$html .= '<p><strong>Nouvelle(s) adresse(s) IP ajoutée(s).</strong></p>';
				$html .= TipRedirect('?act='.$get_act);
			};

			if (!isset($_POST['tip_submit']))
			{
				$html .= '<p><a href="#" onclick="if(document.getElementById(\'tip_upd_list\').style.display==\'none\'){ document.getElementById(\'tip_upd_list\').style.display=\'\'; } else { document.getElementById(\'tip_upd_list\').style.display=\'none\'; }">Ajouter une/des IP à la liste</a></p>
				<form id="tip_upd_list" method="post" action="?act='.$get_act.'">
					<p><label for="tip_add_ip">Ajouter IP (1/ligne) :</label><textarea cols="48" rows="8" id="tip_add_ip" name="tip_add_ip"></textarea></p>
					<p style="text-align:center;"><input type="submit" name="tip_submit" value="Ajouter" /></p>
				</form><script type="text/javascript">document.getElementById(\'tip_upd_list\').style.display="none";</script>';


				$query = 'SELECT COUNT(ip) AS num_ip FROM traceip_lists WHERE list_type=:list_type;';
				$requete_prepare_1 = $connexion->prepare($query);
				$requete_prepare_1->execute(array(':list_type' => $get_act));
				$lignes=$requete_prepare_1->fetch(PDO::FETCH_ASSOC);
				$nb_lignes = $requete_prepare_1->rowCount();

				$num_ip_list = $lignes['num_ip'];

				if ($num_ip_list == 0)
					$html .= '<p><strong>Aucune IP dans cette liste.</strong></p>';
				else
				{
					$num_pages = ceil($num_ip_list / TIP_NUM_ROWS_PER_PAGE);
					$firstRow = ($get_page -1) * TIP_NUM_ROWS_PER_PAGE;
					$lastRow = TIP_NUM_ROWS_PER_PAGE;
					$redirect_uri = '?act='.$get_act;


					// extract IP from DB
					$query = sprintf("SELECT id, ip, date_time FROM traceip_lists WHERE list_type='%s' ORDER BY ip ASC LIMIT %d,%d;", $get_act, $firstRow, $lastRow);
					$requete_prepare_1 = $connexion->query($query);

					$html .= TipDisplayPages($num_pages, $get_page, $redirect_uri);
					$html .= '
					<table border="1" cellpadding="3" cellspacing="0" summary="" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Adresse IP</th>
							<th>Date d\'ajout à la liste</th>
							<th>Opérations</th>
						</tr>
					</thead>
					<tbody>'.PHP_EOL;

					while($ligne = $requete_prepare_1->fetch(PDO::FETCH_ASSOC))
					{
						// prepare operations
						$add_to_whitelist = '<a href="?act=whitelist&amp;do=upd&amp;ip='.$ligne['ip'].'" title="Passer à la liste blanche">+WhiteList</a> ';
						$add_to_blacklist = '<a href="?act=blacklist&amp;do=upd&amp;ip='.$ligne['ip'].'" title="Passer à la liste noire">+BlackList</a> ';
						$del_from_whitelist = '<a href="?act=whitelist&amp;do=del&amp;ip='.$ligne['ip'].'" title="Supprimer de la liste blanche">-WhiteList</a> ';
						$del_from_blacklist = '<a href="?act=blacklist&amp;do=del&amp;ip='.$ligne['ip'].'" title="Supprimer de la liste noire">-BlackList</a> ';

						if ($get_act == 'whitelist')
							$ops = $add_to_blacklist.$del_from_whitelist;
						else
							$ops = $add_to_whitelist.$del_from_blacklist;

						$html .= '
						<tr>
							<td>'.$ligne['id'].'</td>
							<td>'.$ligne['ip'].'</td>
							<td>'.$ligne['date_time'].'</td>
							<td>'.$ops.'</td>
						</tr>'.PHP_EOL;

					};
					$html .= '
					</tbody>
					</table>'.PHP_EOL;
					$html .= TipDisplayPages($num_pages, $get_page, $redirect_uri);
				};
			};
		}; // end of if ($get_ip != '')
	}; // end of if (($get_act == 'blacklist') || ($get_act == 'whitelist'))





























































	if ($tip_is_admin === true)
	{
		//exit($get_act);
		$style_active = ' style="border:1px solid #9b2; padding:5px;"';
		$style_inactive = 'style="border:1px solid #FFF; padding:5px;"';

		$style_admin 		= ($get_act == 'admin') ? $style_active : $style_inactive;
		$style_whitelist	= ($get_act == 'whitelist') ? $style_active : $style_inactive;
		$style_blacklist	= ($get_act == 'blacklist') ? $style_active : $style_inactive;
		$style_config		= ($get_act == 'config') ? $style_active : $style_inactive;
		$style_logout		= ($get_act == 'logout') ? $style_active : $style_inactive;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
	<title>Trace IP v4 - Gestion du bannissement d\'IP</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
	body
	{
		margin:10px 0;
		padding:0;
		text-align:center;
		font:0.8em "Trebuchet MS", helvetica, sans-serif;
		background:#dea;
	}

	label
	{
		float:left;
		width:30%;
		text-align:right;
		padding-right:10px;
	}

	input
	{
		width:50%;
	}

	div#conteneur
	{
		width:770px;
		margin:0 auto;
		text-align:left;
		border:2px solid #ab4;
		background:#fff;
		padding:2em;
	}

	h1
	{
		text-align:center;
		font-size:1.4em;
		color:#090 ;
	}

	h2
	{
		padding-left:25px;
		line-height:25px;
		font-size:1.4em;
		color:#9b2 ;
		border-bottom:1px solid #9b2;
	}

	h3
	{
		margin-left:15px;
		padding-left:5px;
		border-bottom:1px solid #9b2;
		border-left:3px solid #9b2;
		color:#9b2;
	}

	p
	{
		text-align:justify;
		text-indent:2em;
		line-height:1.7em;
	}

	a
	{
		color:#8a0;
	}

	a:hover
	{
		color:#9b2;
	}

	th
	{
		text-align:center;
	}
	</style>
</head>

<body>
<div id="conteneur">
	<h1>TraceIP v4</h1>
	<p style="text-align:center;"><a href="?act=admin"<?php echo $style_admin; ?>>Administration générale</a> | <a href="?act=whitelist"<?php echo $style_whitelist; ?>>Gérer liste blanche</a> | <a href="?act=blacklist"<?php echo $style_blacklist; ?>>Gérer liste noire</a> | <a href="?act=config"<?php echo $style_config; ?>>Configuration</a> | <a href="?act=logout"<?php echo $style_logout; ?>>Déconnexion</a></p>
	<?php
		echo $html;
	?>

	<div style="text-align:right; margin-top:2em;"><a href="https://www.mlxcorp.net">https://www.mlxcorp.net</a> - <a href="http://www.1001bd.com/stop_aspirateurs/">http://www.1001bd.com/stop_aspirateurs/</a></div>
</div>
</body>
</html>
<?php
}; // end of if ($tip_is_admin === true)
?>
