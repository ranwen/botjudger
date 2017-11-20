<?php
function isStringLegal($str)
{
	if(preg_match("/^[a-zA-Z0-9_\s]+$/",$str))
			return 1;
		else
			return 0;
}
?>
