<?php
include "function.php";
include "config.php";

?>

<form method="POST" action="./doupload.php">
name:<input name="filename" />
<select name="type">
<option value="koishi">koishi</option> 
<option value="satori">satori</option> 
</select> 
<div align="center" style="border:2px dotted #666;border-radius:10px;">
<textarea name="nr" id="codea" ></textarea>
</div>
<input type="submit" value="确认"/>
</form>
