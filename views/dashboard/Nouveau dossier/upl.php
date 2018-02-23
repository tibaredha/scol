<?php 
// verifsession();
// lang(Session::get('lang'));
$url1 = explode('/',$_GET['url']);
// view::button('cons',$url1[2]);	
?>
<h1>Changer photos  : <?php echo  HTML::nbrtostring('cheval','id',$url1[2],'NomA')  ;?></h1><hr><br/>
<fieldset id="fieldset0">
<legend>***</legend>
<?php
$file = "d:\\cheval/public/images/cheval/".trim($url1[2]).".jpg"  ;
if (file_exists($file)) 
{
HTML::Image(URL."public/images/cheval/".trim($url1[2]).".jpg?t=".time(), $width = 400, $height = 440, $border = -1, $title = -1, $map = -1, $name = -1, $class = 'image',$id='image');	   
} 
else
{
HTML::Image(URL."public/images/cheval/cr.jpg", $width = 400, $height = 440, $border = -1, $title = -1, $map = -1, $name = -1, $class = 'image',$id='image');	   
}
?>
</fieldset>

<form method="post" action="<?php echo URL;?>dashboard/upl1/<?php  echo $url1[2];?>"  name="fileForm" id="fileForm" enctype="multipart/form-data" > 
<table align="center" border="2">
          <tr>
		  <td align="center">
		  <input type="file"   name="upfile"  size="100">&nbsp;&nbsp;<br/><br/>
		  </td>
		  </tr>
          <tr>
		  <td align="center">
		  <input class="text" type="submit" name="submitBtn" value="Upload"><br/><br/>
		  </td>
		  </tr>
        </table>
      
	    <button id="Cleard" onclick="javascript:Vacciner(<?php echo $url1[2];?>,'<?php echo $_SERVER['SERVER_NAME'];?>');return false;">Vacciner</button>
		<button id="Cleare" onclick="javascript:Bilanter(<?php echo $url1[2];?>,'<?php echo $_SERVER['SERVER_NAME'];?>');return false;">Bilanter</button>
		<button id="Clearf" onclick="javascript:Traiter(<?php echo $url1[2];?>,'<?php echo $_SERVER['SERVER_NAME'];?>');return false;">Traiter</button>
		<button id="Clearg" onclick="javascript:Saillir(<?php echo $url1[2];?>,'<?php echo $_SERVER['SERVER_NAME'];?>');return false;">Saillir</button>
		<button id="Clearh" onclick="javascript:list('<?php echo $_SERVER['SERVER_NAME'];?>');return false;">Lister</button>
	  
	  
	  </form>	
</form>
<hr />

<?php 
if (isset($this->msg)) 
{
echo $this->msg;
}
else 
{
echo '*upload_max_filesize=10M';
}
?>
<?php HTML::Br(32);?>
