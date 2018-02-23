<?php
if (isset($_SESSION['errorlogin'])) {
$sError = '<h1><span id="errorlogin">' . $_SESSION['errorlogin'] . '</span></h1>';		
echo $sError;			
}
else
{
$sError="<h1>Connecter A SIRE ONDEEC</h1><hr><br/>";
echo $sError;
}
?>

<fieldset id="fieldset0">
<legend>ONDEEC</legend>
<?php HTML::photosdb('IS NOT NULL'); ?>
</fieldset>
<p id="ONDEEC">ONDEEC</p>
<form action="login/run" method="post">	
<fieldset id="fieldset1">
<legend>ONDEEC</legend>
<input id="region" class="cheval" type="text" name="login" />
<input id="region" class="cheval" type="password" name="password" />
<input id="region1" type="submit" />
</fieldset>

</form>
<?php HTML::Br(32);?>