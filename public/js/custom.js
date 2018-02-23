$(document).ready(function() {	
});

$(document).ready(function()
{
		$(".country").change(function()
		{
			var id=$(this).val();
			var dataString = 'id='+ id;

			$.ajax
			({
				type: "POST",                        // Le type de ma requete
				url: "/cheval/public/js/AJAXWC.PHP",     // L'url vers laquelle la requete sera envoyee
				data: dataString,                    // Les donnees que l'on souhaite envoyer au serveur au format varaible ,JSON
				cache: false,
				success: function(html)              // La reponse du serveur est contenu dans data  text xml json JSON (JavaScript Object Notation) 
						{
						$(".COMMUNEN").html(html);   // On peut faire ce qu'on veut avec ici
						} 		
			});

		});
});
function Nouveau(url) {
	window.location = "http://"+url+"/cheval/dashboard/nouveaux/";	
}
function Nouveaux(url) {
	window.location = "http://"+url+"/cheval/dashboard/nouveau/";	
}
function list(url) {
	window.location = "http://"+url+"/cheval/dashboard/search/0/10?o=NomP&q=";	
}

function Vacciner(id,url) {
	window.location = "http://"+url+"/cheval/dashboard/Vacciner/"+id;	
}

function Bilanter(id,url) {
	window.location = "http://"+url+"/cheval/dashboard/Bilanter/"+id;	
}

function Traiter(id,url) {
	window.location = "http://"+url+"/cheval/dashboard/ordonnacednr/"+id;	
}
function Saillir(id,url) {
	window.location = "http://"+url+"/cheval/dashboard/Saillir/"+id;	
}
function view(id,url) {
	window.location = "http://"+url+"/cheval/dashboard/view/"+id;	
}


function list1(url) {
	window.location = "http://"+url+"/cheval/dashboard/nouveaux/";	
}






$(document).ready(function()
{
		$(".cheval0").change(function()
		{
			var id=$(this).val();
			var dataString = 'id='+ id;

			$.ajax
			({
				type: "POST",                        // Le type de ma requete
				url: "/cheval/public/js/AJAXWR.PHP",     // L'url vers laquelle la requete sera envoyee
				data: dataString,                    // Les donnees que l'on souhaite envoyer au serveur au format varaible ,JSON
				cache: false,
				success: function(html)              // La reponse du serveur est contenu dans data  text xml json JSON (JavaScript Object Notation) 
						{
						$(".cheval1").html(html);   // On peut faire ce qu'on veut avec ici
						} 		
			});

		});
});


$(document).ready(function()
{
		$(".cheval1").change(function()
		{
			var id=$(this).val();
			var dataString = 'id='+ id;

			$.ajax
			({
				type: "POST",                        // Le type de ma requete
				url: "/cheval/public/js/AJAXS.PHP",     // L'url vers laquelle la requete sera envoyee
				data: dataString,                    // Les donnees que l'on souhaite envoyer au serveur au format varaible ,JSON
				cache: false,
				success: function(html)              // La reponse du serveur est contenu dans data  text xml json JSON (JavaScript Object Notation) 
						{
						$(".cheval2").html(html);   // On peut faire ce qu'on veut avec ici
						} 		
			});

		});
});

/*Activates the Tabs*/
function tabSwitch(new_tab, new_content) {    
    document.getElementById('content_1').style.display = 'none';  
    document.getElementById('content_2').style.display = 'none';  
    document.getElementById('content_3').style.display = 'none';  
	/*document.getElementById('content_3').style.display = 'none';*/ 
	document.getElementById(new_content).style.display = 'block';     
    document.getElementById('tab_1').className = '';  
    document.getElementById('tab_2').className = '';  
    document.getElementById('tab_3').className = '';  
	/*document.getElementById('tab_3').className = ''; */        
    document.getElementById(new_tab).className = 'active';        
}

function calcule()
{
// affectation de la variable pour le calcul
var a = parseFloat(this.document.formGCS.Nmensurations.value);                 
var b = parseFloat(this.document.formGCS.Nmensurations1.value);                 
var c = parseFloat(this.document.formGCS.Nmensurations2.value);                
var d = parseFloat(this.document.formGCS.Nmensurations4.value);                
var e = parseFloat(this.document.formGCS.Nmensurations11.value);                

// calcul et affectation du résultat à la variable ... result
var result =  parseFloat(a - b );               
var result1 =  parseFloat(a / c );  
var result2 =  parseFloat(c / d );  
var result3 =  parseFloat(d / a );
var result4 =  parseFloat(e / d );
var result5 =  parseFloat( 100 * ( ( d * d ) / a) );
var result6 =  parseFloat( d * d * d * 80 );



// affichage du résultat
document.getElementById("RESULTAS1" ).innerHTML = result1;
document.getElementById("RESULTAS2" ).innerHTML = result2;
document.getElementById("RESULTAS3" ).innerHTML = result3;
document.getElementById("RESULTAS4" ).innerHTML = result4;
document.getElementById("RESULTAS5" ).innerHTML = result5;
document.getElementById("RESULTAS6" ).innerHTML = result6;
this.document.formGCS.Nmensurations6.value = result;                   
}









