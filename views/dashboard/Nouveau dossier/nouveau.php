<h1><a title="Le signalement des équidés vademecum"  target="_blank"  href="<?php echo URL; ?>tcpdf/docpdf/fr/Le signalement des équidés vademecum.pdf">Signalement des équidés</a></h1><hr><br/>
	    
        <!--	
		<fieldset id="fieldset0">
        <legend>***</legend>
		<?php
		//HTML::Image(URL."public/images/images.jpg", $width = 400, $height = 440, $border = -1, $title = -1, $map = -1, $name = -1, $class = 'image',$id='image');
		?>
		</fieldset>-->	
	<form id="Canvas"  name="formGCS"  action="<?php echo URL."dashboard/create/";  ?>"  method="POST"> 

<div class="tabbed_area">  
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">L’identité de l'équidé </a></li>  
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
				<input  id="Datesigna"   class="cheval"type="TXT"  name="Datesigna"  title="***"    autofocus/>	  
			
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
				<input  id="Pere" class="cheval" type="text" name="Pere" />
				<input  id="NPere"class="cheval" type="text" name="NPere"/>
				<label for=""id="lNPereAR"  >الرقم &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N°</label>
				
				<?php //HTML::EQUIN('jument','class','','Pere','M');       ?>
			  
				<label for=""id="lDNSPAR">تاريخ الميلاد : </label><label for=""id="lDNSPFR">Date de naissance : </label>
				<input  id="DnsP"  class="cheval"type="TXT" name="DnsPere"  placeholder="0000-00-00"/>
				
				<label for=""id="lRACEPAR">السلالة: </label><label for=""id="lRACEPFR">Race: </label>
				<?php HTML::RACE1('idracep','RacePere','cheval','1','Race') ;?>
				
				<label for=""id="lROBEPAR">اللون: </label><label for=""id="lROBEPFR">Robe: </label>
				<?php HTML::ROBE1('idrobep','CouleurPere','cheval','1','Robe') ;?>
				
				<label for=""id="lPUCEPAR">الشريحة: </label><label for=""id="lPUCEPFR">PUCE: </label>
				<input  id="NPUCEPERE"     class="cheval" type="text" name="NPPERE"    placeholder="NPUCEPERE"/>
				
				<label for=""id="lMEREAR">الام: </label><label for=""id="lMEREFR">Mere: </label>
				<input  id="Mere" class="cheval"type="text" name="mere" />
				<input  id="NMere"class="cheval" type="text" name="NMere"/>
				<label for=""id="lNMereAR"  >الرقم &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N°</label>
				
				<?php //HTML::EQUIN('jument','class','','Mere','F');       ?>	
				
				<label for=""id="lDNSMAR">تاريخ الميلاد : </label><label for=""id="lDNSMFR">Date de naissance : </label>
				<input  id="DnsM"  class="cheval"type="TXT" name="DnsMere"  placeholder="0000-00-00"/>
				
				<label for=""id="lRACEMAR">السلالة: </label><label for=""id="lRACEMFR">Race: </label>
				<?php HTML::RACE1('idracem','RaceMere','cheval','1','Race') ;?>
				
				<label for=""id="lROBEMAR">اللون: </label><label for=""id="lROBEMFR">Robe: </label>
				<?php HTML::ROBE1('idrobem','CouleurMere','cheval','1','Robe') ;?>
				
				<label for=""id="lPUCEMAR">الشريحة: </label><label for=""id="lPUCEMFR">PUCE: </label>
				<input  id="NPUCEMERE"     class="cheval" type="text" name="NPMERE"    placeholder="NPUCEMERE"/>
				
			
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
		<h2>Caracteristique</h2> 		  
			<fieldset id="fieldset3">
				<legend>Signalement descriptif</legend>
				<textarea id="Tete"     name="Tete"    placeholder="Tete"    rows="2" cols="107"></textarea></br></br>
				<textarea id="Tete"     name="AG"      placeholder="AG"      rows="2" cols="51"></textarea>
				<textarea id="Tete"     name="AD"      placeholder="AD"      rows="2" cols="51"></textarea></br></br>
				<textarea id="Tete"     name="PG"      placeholder="PG"      rows="2" cols="51"></textarea>
				<textarea id="Tete"     name="PD"      placeholder="PD"      rows="2" cols="51"></textarea></br></br>
				<textarea id="Tete"     name="MARQUES" placeholder="MARQUES" rows="2" cols="107"></textarea>
			</fieldset>	
		
		<?php
        echo '<label for=""id="lmensurationsAR"    >0_H au garrot</label><label for="" id="lmensurationsFR"   >(HG)</label>';            echo '<input  id="Nmensurations"   class="Nmensurations"   type="text" name="Nmensurations"   value="01"  onblur="calcule()"; />';
		echo '<label for=""id="lmensurations1AR"   >1_H Vide sous-sternal</label><label for="" id="lmensurations1FR"  >(VSS)</label>';   echo '<input  id="Nmensurations1"  class="Nmensurations1"  type="text" name="Nmensurations1"  value="01"  onblur="calcule()"; />';
		echo '<label for=""id="lmensurations2AR"   >2_L totale</label><label for="" id="lmensurations2FR"  >(LT)</label>';               echo '<input  id="Nmensurations2"  class="Nmensurations2"  type="text" name="Nmensurations2"  value="00"  onblur="calcule()";/>';
		echo '<label for=""id="lmensurations3AR"   >3_L de l’encolure</label><label for="" id="lmensurations3FR"  >(LE)</label>';        echo '<input  id="Nmensurations3"  class="Nmensurations3"  type="text" name="Nmensurations3"  value="00"  onblur="calcule()";/>';
	    echo '<label for=""id="lmensurations4AR"   >4_T de poitrine</label><label for="" id="lmensurations4FR"  >(TP)</label>';          echo '<input  id="Nmensurations4"  class="Nmensurations4"  type="text" name="Nmensurations4"  value="00"  onblur="calcule()";/>';
		echo '<label for=""id="lmensurations5AR"   >5_H à la croupe</label><label for="" id="lmensurations5FR"  >(HC)</label>';          echo '<input  id="Nmensurations5"  class="Nmensurations5"  type="text" name="Nmensurations5"  value="00"/>';
		echo '<label for=""id="lmensurations6AR"   >6_H de la poitrine</label><label for="" id="lmensurations6FR"  >(HP)</label>';       echo '<input  id="Nmensurations6"  class="Nmensurations6"  type="text" name="Nmensurations6"  value="00" READONLY  onblur="calcule()";  />';
		echo '<label for=""id="lmensurations7AR"   >7_L scapulo-iliaque</label><label for="" id="lmensurations7FR"  >(LSI)</label>';     echo '<input  id="Nmensurations7"  class="Nmensurations7"  type="text" name="Nmensurations7"  value="00"/>';
		echo '<label for=""id="lmensurations8AR"   >8_T de l’encolure</label><label for="" id="lmensurations8FR"  >(TE)</label>';        echo '<input  id="Nmensurations8"  class="Nmensurations8"  type="text" name="Nmensurations8"  value="00"/>';
		echo '<label for=""id="lmensurations9AR"   >9_T abdominal</label><label for="" id="lmensurations9FR"  >(TA)</label>';            echo '<input  id="Nmensurations9"  class="Nmensurations9"  type="text" name="Nmensurations9"  value="00"/>';
		echo '<label for=""id="lmensurations10AR"  >10_T de l’avant bras</label><label for="" id="lmensurations10FR" >(TAB)</label>';    echo '<input  id="Nmensurations10" class="Nmensurations10" type="text" name="Nmensurations10" value="00"/>';
		echo '<label for=""id="lmensurations11AR"  >11_T du canon</label><label for="" id="lmensurations11FR" >(TCA)</label>';            echo '<input  id="Nmensurations11" class="Nmensurations11" type="text" name="Nmensurations11" value="00" onblur="calcule()"; />';
		echo '<label for=""id="lmensurations12AR"  >12_T du genou</label><label for="" id="lmensurations12FR" >(TG)</label>';            echo '<input  id="Nmensurations12" class="Nmensurations12" type="text" name="Nmensurations12" value="00"/>';
		echo '<label for=""id="lmensurations13AR"  >13_T du boulet</label><label for="" id="lmensurations13FR" >(TB)</label>';           echo '<input  id="Nmensurations13" class="Nmensurations13" type="text" name="Nmensurations13" value="00"/>';
		
		
		echo '<DIV id="RESULTAS1"  ></DIV>';
		echo '<DIV id="RESULTAS2"  ></DIV>';
		echo '<DIV id="RESULTAS3"  ></DIV>';
		echo '<DIV id="RESULTAS4"  ></DIV>';
		echo '<DIV id="RESULTAS5"  ></DIV>';
		echo '<DIV id="RESULTAS6"  ></DIV>';
		
		echo '<DIV id="RESULTAS11"  >I corporel de profil</DIV>';
		echo '<DIV id="RESULTAS22"  >I Corporel Relatif</DIV>';
		echo '<DIV id="RESULTAS33"  >I de corpulence</DIV>';
		echo '<DIV id="RESULTAS44"  >I dactylo-thoracique</DIV>';
		echo '<DIV id="RESULTAS55"  >I de conformation</DIV>';
		echo '<DIV id="RESULTAS66"  >I de compacité </DIV>';
		
		//http://www.sorec.ma/fr/
		
		//*la hauteur au garrot (région interscapulaire) (HG)
		//*la hauteur à la croupe(région sacrale) (HC),
		//*Vide sous-sternal (VSS), distance entre le sternum et le sol ;
		//*Hauteur de la poitrine (HP), taille au garrot diminuée du vide sous-sternal ;
		
		//la longueur de la tête (LTe),
		//la distance entre les angles internes des yeux (AIY),
		//*la longueur de l’encolure (bord dorsal du cou) (LE),
		
		//*la longueur totale (LT), 
		//*la longueur scapulo-iliaque (LSH) //humero iliaque  (LSI) 
		
		
		//la longueur de l’épaule (région scapulaire) (LEp)
		//la longueur du bras (région brachiale)(LB),
		//la longueur de l’avant bras (région antébrachiale)(LAB))
		//la longueur du canon (région métacarpienne)(LC),
		//la longueur de l’ilium (LI)
		//la longueur de la cuisse(région fémorale) (LCe)
		
		
       
		//*Tour de l’encolure (TE),
		//*tour de poitrine (région sternale) (TP)
		//*abdominal(TA)
		//*tour de l’avant bras(région antébrachiale) (TAB)
		//*tour du genou(région carpienne) (TG).
		//*tour du canon antérieur (région métacarpienne) (TCA);//tour du canon postérieur (TCP)
		//*tour du boulet (région métacarpo-phalangienne) (TB).

		// *l’indice corporel de profil(HG/LT) 
		// *Indice Corporel Relatif : (LT/TP) ; 
		// *l’indice de corpulence(TP/HG)
		// Indice de la hauteur pectorale (IHP), rapport entre la hauteurde la poitrine (cm) et le vide sous-sternal [7] ;
        // *Indice dactylo-thoracique (IDT), rapport entre le tour du canon antérieur (cm) et le tour de poitrine (cm) [1] ;
        // *Indice de conformation ou l’indice de Baron et Crevat(IBC), 100 multiplié par le rapport entre le tour de poitrine(m) (TP) au carré par la hauteur au garrot (cm) [8] ;
        // *Hauteur devant - derrière (HDD), rapport entre la hauteurau garrot (cm) et la hauteur à la croupe [7] ;
        // *Rapport corporel (RP); rapport entre le tour de poitrine(cm) et la hauteur au garrot (cm) [8].
        // Hauteur Devant Derriére : ((HG)/hauteur à la croupe (HC))
		// l’indice de compacité (PV/HG)
		// le poids vif (PV) selon une formule barymétrique//Poids corporel (PC), estimé comme le tour de poitrine (cm) (TP) au cube multiplié par 80 [1964] ;Formule de Crevat
		// Poids vif (kg) = (Tour de poitrine)2 x Longueur totale (cm)/y  y étant une constante égale à 11877,4 cm3/kg [7]  [1964]    BARBE
		// Formule de Hapgood  Poids = PT164 × HG095 × LC040 / 278
		// Formule de Martin-Rosse  Poids = 7,3 × (PT) − 800
		
		?>	
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

			   <label for=""id="lAprouvéleAR">تاريخ الترخيص: </label><label for=""id="lAprouvéleFR">Autorisé le :</label> 
			   <input  id="Aprouvéle"   class="cheval"type="txt"  name="DateAprouve" />
				
			   <label for=""id="lStationAR">الوحدة: </label><label for=""id="lStationFR">Station :</label> 
			   <?php HTML::STATIONT1('Station','stataprouv','country',Session::get('station'),HTML::nbrtostring('station','id',Session::get('station'),'station')) ;?>
			  
	
			   
				  
			   <label for=""id="lDOrigineAR"  >بلد المصدر: </label><label for=""id="lDOrigineFR"  >Pays de provenance : </label>
			   <?php HTML::PAYS('IDOrigine','Origine','cheval','DZ','Algérie') ;?>
			   
			   
		
		
		</div>
</div>
		<input type="hidden" name="region" value="<?php echo Session::get('region')  ;?>"/>
		<input type="hidden" name="wregion" value="<?php echo Session::get('wregion')  ;?>"/>
		<input type="hidden" name="station" value="<?php echo Session::get('station')  ;?>"/>
        <button id="ajout"  onclick="javascript:Nouveau('<?php echo $_SERVER['SERVER_NAME'];?>');return false;">Nouveau S</button>
		<?php HTML::menuview0('',$_SERVER['SERVER_NAME']);?>
	</form > 


 
	
	 