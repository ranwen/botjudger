<?php
include "function.php";
include "config.php";
$type=$_POST['type'];
$filename=$_POST['filename'];
if(!isStringLegal($filename))
{
	echo "illegal filename";
	exit(0);
}
if($type!='satori' && $type!='koishi')
{
	echo "FUCK YOU";
	exit(0);
}
file_put_contents("./com.cpp",$_POST['nr']);
system("\"$gccpath\" com.cpp -o com.exe --std=c++11 > out.txt 2>&1");
$gg=file_get_contents("out.txt");
echo $gg;
system("move com.exe ./code/$type/$filename.exe >nul");
system("move com.cpp ./source/$type/$filename.cpp >nul");
//$fileurl="./code/".$_POST['type']."/".$_POST['filename']."cpp";
//file_put_contents($fileurl, $_POST['nr']);
echo "完成";
?>
