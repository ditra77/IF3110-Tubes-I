<?php
include "config.php";
// Fill up array with names
$result = mysql_query("SELECT * FROM pengguna");
while($row = mysql_fetch_array($result))
	$a[]= $row['username'];

//get the q parameter from URL
$q=$_GET["q"];

//lookup all hints from array if length of q>0
if (strlen($q) > 0) {
	$i=0;
	$response="<font color=\"green\">Benar</font>";
	while(($i < count($a)) && ($response == "<font color=\"green\">Benar</font>")) {
	if (strtolower($q)==strtolower($a[$i])) {
	  $response="<font color=\"red\">Username telah terpakai, silahkan coba username lain</font>";
	}
	$i++;
	}
}

//output the response
echo $response;
?>