<?php
include "function.php";
include "config.php";
function getfiles($path){
	foreach(scandir($path) as $afile)
	{
        if($afile=='.'||$afile=='..') continue; 
        $gg=substr($afile,0,strlen($afile)-4);
		echo "<option value=\"$gg\">$gg</option>";
	} 
}

?>



<form method="POST" action="./docreate.php">
<select name="satori">
<?php getfiles("./code/satori");?>
</select>
<select name="koishi">
<?php getfiles("./code/koishi");?>
</select>
<select name="map">
<?php getfiles("./map");?>
</select>
<input type="submit" value="确认"/>
</form>
