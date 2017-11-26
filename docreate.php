<?php
include "function.php";
include "config.php";
function getrandstring($length=16){
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol)-1;
   
    for($i=0;$i<$length;$i++){
     $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
    }
    return $str;
   }

   $key=getrandstring();
   $key=time();
//system("copy .\\code\\koishi\\".$_POST['koishi'].".exe .\\runner\\koishi.exe >nul");
//system("copy .\\code\\satori\\".$_POST['satori'].".exe .\\runner\\satori.exe >nul");
//echo "OK";exit(0);
//system(".\\runner\\judge.exe > ./result/$key.txt");
//system(".\\runner\\run.bat $key.txt >nul 2>nul");
$a=$_POST['koishi'];
$b=$_POST['satori'];
if(!isStringLegal($a) || !isStringLegal($b))
{
	echo "FUCK YOU";
	exit(0);
}
$map=$_POST['map'];
if($a=='human' || $b=='human')
{
    $pass=rand(100,999);
    file_put_contents("humantask.txt","$a $b $key $map $pass\n",FILE_APPEND);
}
else
    file_put_contents("task.txt","$a $b $key $map\n",FILE_APPEND);
echo "已创建 KEY为".$key;
if($a=='human' || $b=='human')
echo "密码为$pass";
?>
