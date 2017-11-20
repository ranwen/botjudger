<?php
include "function.php";
include "config.php";
function getfiles($gg){
	$path="./code/$gg";
	foreach(scandir($path) as $afile)
	{
		if($afile=='.'||$afile=='..') continue; 
		$nowf=substr($afile,0,strlen($afile)-4);
		echo "<a href=\"./code/$gg/$nowf.cpp\">".$nowf."</a><br/>";
	} 
}

function getfiles2($path){
	foreach(scandir($path) as $afile)
	{
		if($afile=='.'||$afile=='..') continue; 
		echo "<a href=\"./result/$afile\">".$afile."</a><br/>";
	} 
}
function getfiles3($path){
	foreach(scandir($path) as $afile)
	{
		if($afile=='.'||$afile=='..') continue; 
		echo "<a href=\"./map/$afile\">".$afile."</a><br/>";
	} 
}
//echo "<h2>大家好~这里是地灵殿的日常捉迷藏游戏</h2><br/>";
echo "<h2>Satori</h2><br/>";
getfiles("satori");
echo "<h2>Koishi</h2><br/>";
getfiles("koishi");
?>


<br/><br/><br/>
<a href='./upload.php'>upload code</a><br/>
<a href='./create.php'>create game</a><br/>


<br/>map<br/>
<?php
getfiles3("./map");
?>

<br/>result<br/>


<?php
getfiles2("./result");

?>

