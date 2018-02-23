<?php
if (isset($_SESSION['errorregister'])) {
$sError = '<h1><span id="error">' . $_SESSION['errorregister'] . '</span></h1><hr><br/>';		
echo $sError;			
}
else
{
$sError="<h1>Créer un compte SIRE ONDEEC</h1><hr><br/>";
echo $sError;
}
?>
<fieldset id="fieldset0">
<legend>ONDEEC</legend>
<?php HTML::photosdb('IS NOT NULL'); ?>
</fieldset>
<p id="ONDEEC">ONDEEC</p>

<form action="register/Registerrun" method="post">	


<fieldset id="fieldset1">
<legend>ONDEEC</legend>
<?php HTML::REGION('region','cheval0','1','Region') ;	?>
<?php HTML::WREGION('wregion','cheval1','22','Wilaya');?>
<?php HTML::STATION('station','cheval2','30','Station');?>
<input id="region" class="cheval" type="hidden"  name="role" value="default" />
</fieldset>

<fieldset id="fieldset1">
<legend>ONDEEC</legend>
<input id="region" class="cheval" type="text" name="login" />
<input id="region" class="cheval" type="password" name="password" />
<input id="region1" type="submit" />
</fieldset>


</form>

<?php //HTML::Br(10);?>

<p id="lrege">region</p></br>
<?php HTML::REGION_F('id','region','nom','1','region');?>


<p id="lts"   >type structure</p></br>
<?php HTML::TS_HJSP('id','region','nom1','1','type_structure');?>






<?php HTML::Br(28);?>