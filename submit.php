<?php
$pa=$_POST['passwd'];
$ripw=file_get_contents("passwd");
if(strcmp($pa."\x20\x0d\x0a",$ripw))
{
    echo "错误密码";
    exit(0);
}
$ty=$_POST['type'];
$nr=$_POST['nr'];
file_put_contents("./humanrunner/$ty"."in.txt",$nr);
echo "请求已发送";
?>