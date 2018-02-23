<h1><a title="Le signalement des équidés vademecum"  target="_blank"  href="<?php echo URL; ?>tcpdf/docpdf/fr/Le signalement des équidés vademecum.pdf">Signalement des équidés</a></h1><hr><br/>
	    
        <!--	
		<fieldset id="fieldset0">
        <legend>***</legend>
		<?php
		//HTML::Image(URL."public/images/images.jpg", $width = 400, $height = 440, $border = -1, $title = -1, $map = -1, $name = -1, $class = 'image',$id='image');
		?>
		</fieldset>-->	
	<form id="Canvas" action="<?php echo URL."dashboard/createx/";  ?>"  method="POST"> 

<div class="tabbed_area">  
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">L’identité de l'équidé</a></li>  
            <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Relevé de signalement descriptif</a></li> 
			<li><a href="javascript:tabSwitch('tab_3', 'content_3');" id="tab_3">Relevé de signalement graphique</a></li> 	
        </ul>    
		<div id="content_1" class="content">  	
		
		<!--  	
		<fieldset id="fieldset0">
        <legend>***</legend>
		<?php
		HTML::Image(URL."public/images/images.jpg", $width = 400, $height = 440, $border = -1, $title = -1, $map = -1, $name = -1, $class = 'image',$id='image');
		?>
		</fieldset>
		-->
			
				
				
				
				<label for=""id="lDSAR"  >تاريخ الفحص : </label><label for=""id="lDSFR"  >Date signalement : </label>
				<input  id="Datesigna"   class="cheval"type="TXT"  name="Datesigna"  autofocus/>	  
			
			   <label for=""id="lDSEXEAR"  >الجنس : </label><label for=""id="lDSEXEFR"  >Sexe : </label>
			   <select id="IDSexe"  class="cheval" name="Sexe"  >  
					<option value="M">Masculin</option>
					<option value="F">Feminin</option>  
				</select>
				
				<label for=""id="lTAILLEAR"  >الطول : </label><label for=""id="lTAILLEFR"  >Taille : </label>
				<input  id="IDTaille"  class="Taille" type="text" name="Taille" />
				
				<label for=""id="lNaisseurAR"  >المولد: </label><label for=""id="lNaisseurFR"  >Naisseur : </label>
				<input  id="Naisseur"  class="Naisseur" type="text" name="Naisseur" />
				
				<label for=""id="lANaisseurAR"  >العنوان:&nbsp;&nbsp;&nbsp; Adresse</label>
				<input  id="ANaisseur"  class="ANaisseur" type="text" name="ANaisseur" />
				
				<label for=""id="lNOMAR">الاسم : </label><label for=""id="lNOMFR">Nom : </label>
				<input  id="NomA"  class="cheval" type="text" name="NomA" />
				<input  id="N4"     class="cheval" type="text" name="N"   />
				<label for=""id="lNAR"  >الرقم &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N°</label>
				
				
				<label for=""id="lDNSAR">تاريخ الميلاد : </label><label for=""id="lDNSFR">Date de naissance : </label>
				<input  id="Dnspr"  class="cheval"type="TXT" name="Dns"  placeholder="0000-00-00"/>
				
				<label for=""id="lRACEAR">السلالة: </label><label for=""id="lRACEFR">Race: </label>
				<?php HTML::RACE1('idrace','Race','cheval','1','Race') ;?>
				
				<label for=""id="lROBEAR">اللون: </label><label for=""id="lROBEFR">Robe: </label>
				<?php HTML::ROBE1('idrobe','Nobo','cheval','1','Robe') ;?>
				
				<label for=""id="lPUCEAR">الشريحة: </label><label for=""id="lPUCEFR">PUCE: </label>
				<input  id="N1"     class="cheval" type="text" name="NPPRODUIT"    placeholder="NPUCEPRODUIT"/>
				
				<label for=""id="lPEREAR">الاب: </label><label for=""id="lPEREFR">Pere: </label>
				<label for=""id="lNPereAR"  >الرقم &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N°</label>
				<?php HTML::EQUINx('peredata','Pere','class','','Pere','M');       ?>
			  
				
				
				<label for=""id="lMEREAR">الام: </label><label for=""id="lMEREFR">Mere: </label>
				<label for=""id="lNMereAR"  >الرقم &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N°</label>
				<?php HTML::EQUINx('meredata','mere','class','','Mere','F');       ?>	
				
				
			
			    <label for=""id="lProprietaireAR">المالك: </label><label for=""id="lProprietaireFR">Proprietaire: </label>
			    <input  id="NomP"  class="cheval" type="text" name="NomP" /> 
			
				 <label for=""id="lStatutsAR">الوضعية: </label><label for=""id="lStatutsFR">Statuts: </label>
			     <select id="Statuts"  class="cheval" name="secteur"  >  
					<option value="1">Publique</option>
					<option value="0">Privé</option>  
				</select>
				<label for=""id="lWilayaAR">الولاية: </label><label for=""id="lWilayaFR">Wil :</label>
				<?php HTML::WILAYA('wil','country','17000','Residence') ;?>
				<label for=""id="lCommuneAR">البلدية: </label><label for=""id="lCommuneFR">Com :</label>
				<?php HTML::COMMUNE('com','COMMUNEN','929','Residence') ;?>
				<label for=""id="lAdresseAR">العنوان: </label><label for=""id="lAdresseFR">Adresse :</label>
				<input  id="adresse"  class="cheval" type="text" name="adresse" />
				<label for=""id="lTelAR">الجوال: </label><label for=""id="lTelFR">Tel :</label>
				<input  id="Tel"  class="cheval" type="text" name="telphone" />
                </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>	
		        </br></br></br></br></br></br>
		</div>
		<div id="content_2" class="content"> 
		<h2>Caracteristique</h2></br>    		  
			<fieldset id="fieldset3">
				<legend>Signalement descriptif</legend>
				<textarea id="Tete"     name="Tete"    placeholder="Tete"    rows="2" cols="107"></textarea></br></br>
				<textarea id="Tete"     name="AG"      placeholder="AG"      rows="2" cols="51"></textarea>
				<textarea id="Tete"     name="AD"      placeholder="AD"      rows="2" cols="51"></textarea></br></br>
				<textarea id="Tete"     name="PG"      placeholder="PG"      rows="2" cols="51"></textarea>
				<textarea id="Tete"     name="PD"      placeholder="PD"      rows="2" cols="51"></textarea></br></br>
				<textarea id="Tete"     name="MARQUES" placeholder="MARQUES" rows="2" cols="107"></textarea>
			</fieldset>	
		
		<label for=""id="lmensurationsAR"  >Périmètre </label><label for=""id="lmensurationsFR"  >Avant Bras</label>
		<input  id="Nmensurations"  class="Nmensurations" type="text" name="Nmensurations" />	
		
		<label for=""id="lmensurations1AR"  >Périmètre </label><label for=""id="lmensurations1FR"  >Genoux</label>
		<input  id="Nmensurations1"  class="Nmensurations1" type="text" name="Nmensurations1" />	
		
		<label for=""id="lmensurations2AR"  >Périmètre </label><label for=""id="lmensurations2FR"  >Canon</label>
		<input  id="Nmensurations2"  class="Nmensurations2" type="text" name="Nmensurations2" />	
		
		<label for=""id="lmensurations3AR"  >Périmètre </label><label for=""id="lmensurations3FR"  >Boulet</label>
		<input  id="Nmensurations3"  class="Nmensurations3" type="text" name="Nmensurations3" />	
		
		<label for=""id="lmensurations4AR"  >Périmètre </label><label for=""id="lmensurations4FR"  >Boulet</label>
		<input  id="Nmensurations4"  class="Nmensurations4" type="text" name="Nmensurations4" />	
		
		
		<label for=""id="lmensurations5AR"  >Indice </label><label for=""id="lmensurations5FR"  >Corporel</label>
		<input  id="Nmensurations5"  class="Nmensurations5" type="text" name="Nmensurations5" />	
		
		<label for=""id="lmensurations6AR"  >Indice </label><label for=""id="lmensurations6FR"  >H-Poitrine</label>
		<input  id="Nmensurations6"  class="Nmensurations6" type="text" name="Nmensurations6" />	
		
		<label for=""id="lmensurations7AR"  >Indice </label><label for=""id="lmensurations7FR"  >Compacité</label>
		<input  id="Nmensurations7"  class="Nmensurations7" type="text" name="Nmensurations7" />	
		
		<label for=""id="lmensurations8AR"  >Indice </label><label for=""id="lmensurations8FR"  >03 périmètres</label>
		<input  id="Nmensurations8"  class="Nmensurations8" type="text" name="Nmensurations8" />	
		
		<label for=""id="lmensurations9AR"  >Indice </label><label for=""id="lmensurations9FR"  >D-thoracique</label>
		<input  id="Nmensurations9"  class="Nmensurations9" type="text" name="Nmensurations9" />		
			
		<label for=""id="lmensurations10AR"  >Longueur </label><label for=""id="lmensurations10FR"  >S-I</label>
		<input  id="Nmensurations10"  class="Nmensurations10" type="text" name="Nmensurations10" />	
		
		<label for=""id="lmensurations11AR"  >Longueur </label><label for=""id="lmensurations11FR"  >V-S-S</label>
		<input  id="Nmensurations11"  class="Nmensurations11" type="text" name="Nmensurations11" />	
		
		
		<label for=""id="lmensurations12AR"  >Longueur </label><label for=""id="lmensurations12FR"  >H-coude</label>
		<input  id="Nmensurations12"  class="Nmensurations12" type="text" name="Nmensurations12" />	
		
		<label for=""id="lmensurations13AR"  >Longueur </label><label for=""id="lmensurations13FR"  >H-Poitrine</label>
		<input  id="Nmensurations13"  class="Nmensurations13" type="text" name="Nmensurations13" />	
		
		</br></br></br></br></br></br>
		</div>	
		
		
		
		<div id="content_3" class="content">  
		
				<?php
				HTML::Image(URL."public/images/logoof.png", $width = 400, $height = 440, $border = -1, $title = -1, $map = -1, $name = -1, $class = 'image',$id='image');
				?>

               <label for=""id="lAprouvéAR">مرخص: </label><label for=""id="lAprouvéFR">Autorisé :</label>
               <select id="Aprouvé"  class="cheval" name="aprouve"  >  
					<option value="1">Autorisé</option>
					<option value="0">Non Autorisé</option>  
				</select>

			   <label for=""id="lAprouvéleAR">تاريخ الترخيص : </label><label for=""id="lAprouvéleFR">Autorisé le :</label> 
			   <input  id="Aprouvéle"   class="cheval"type="txt"  name="DateAprouve" />
				
			   <label for=""id="lStationAR">الوحدة: </label><label for=""id="lStationFR">Station :</label> 
			  
				<?php HTML::STATIONT1('Station','stataprouv','country',Session::get('station'),HTML::nbrtostring('station','id',Session::get('station'),'station')) ;?>
			    
			   <label for=""id="lDOrigineAR"  >المنشئ : </label><label for=""id="lDOrigineFR"  >Origine : </label>
			  <?php HTML::PAYS('IDOrigine','Origine','cheval','DZ','Algérie') ;?>
		
		
		</div>
</div>
		<input type="hidden" name="region" value="<?php echo Session::get('region')  ;?>"/>
		<input type="hidden" name="wregion" value="<?php echo Session::get('wregion')  ;?>"/>
		<input type="hidden" name="station" value="<?php echo Session::get('station')  ;?>"/>
		<button id="ajout"  onclick="javascript:Nouveaux('<?php echo $_SERVER['SERVER_NAME'];?>');return false;">Nouveau N</button>
		<?php HTML::menuview0('',$_SERVER['SERVER_NAME']);?>
	</form > 


 
	
	 
	 