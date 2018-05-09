<?php
/**
 * Created by PhpStorm.
 * User: Johan Griesel (Stratusolve (Pty) Ltd)
 * Date: 2017/02/18
 * Time: 10:07 AM
 */
$ScriptStart = microtime(true);
echo phpinfo();

//JGL: This is a dummy database that is used to check connection latency from various servers
$con = mysqli_connect("dedi1237.jnb1.host-h.net","server_844","SFxGZhzmas8","server_db351");

// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error()."<br>";
} else {
	echo "Connected to MySQL;<br>";
}
$ScriptEnd = microtime(true);
$Micro = sprintf("%06d",($ScriptStart - floor($ScriptStart)) * 1000000);
$ScriptStartObj = new DateTime(date('Y-m-d H:i:s.'.$Micro, $ScriptStart));

$Micro = sprintf("%06d",($ScriptEnd - floor($ScriptEnd)) * 1000000);
$ScriptEndObj = new DateTime(date('Y-m-d H:i:s.'.$Micro, $ScriptEnd));
echo "Script start: ".$ScriptStartObj->format("Y-m-d H:i:s.u")."<br>";
echo "Script end: ".$ScriptEndObj->format("Y-m-d H:i:s.u")."<br>";
$Duration = 1000*($ScriptEnd - $ScriptStart);
echo "Duration: $Duration ms";