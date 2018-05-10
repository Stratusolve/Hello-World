<?php
/**
 * Created by PhpStorm.
 * User: Johan Griesel (Stratusolve (Pty) Ltd)
 * Date: 2017/02/18
 * Time: 10:07 AM
 */
if (isset($_GET['phpinfo']))
	echo phpinfo();

echo "To show phpinfo, set GET parameter 'phpinfo=1'<br>";
//JGL: This is a dummy database that is used to check connection latency from various servers
echo "Connecting to test database...<br>";
$ScriptStart = microtime(true);
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
echo "Connection start: ".$ScriptStartObj->format("Y-m-d H:i:s.u")."<br>";
echo "Connection end: ".$ScriptEndObj->format("Y-m-d H:i:s.u")."<br>";
$Duration = 1000*($ScriptEnd - $ScriptStart);
echo "Connection Duration: $Duration ms<br>";

function checkWritable($path) {
	$rm = file_exists($path);
	$handle = @fopen($path, 'a');
	
	if($handle === false) {
		return false;
	}
	
	fclose($handle);
	
	if(!$rm){
		unlink($path);
	}
	
	return true;
}
echo "Checking required extensions...<br>";
if (!function_exists('zip_open')) {
	echo "ZIP extension is not enabled on this installation of PHP. " .
		"To make it work on Linux/MacOS, recompile your installation of PHP with --enable-zip parameter. " .
		"On Windows, enable extension=php_zip.dll in php.ini.<br>";
} else {
	echo "Extensions good!<br>";
}
echo "Checking file permissions...<br>";
if (!checkWritable("file_that_should_be_writable.txt")) {
	echo "Files in html folder need to be writable.<br>";
} else {
	file_put_contents("file_that_should_be_writable.txt", "Test write: ".date("d-M-Y H:i:s"));
	echo "Permissions good!<br>Written to file: ".file_get_contents("file_that_should_be_writable.txt");
}


?>