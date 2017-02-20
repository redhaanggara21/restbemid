<?php
$host= "us-cdbr-azure-west-b.cleardb.com";
$user= "be826d4ad86399";
$pass= "8670b078";
$db = "dbpalhub";

$koneksi = mysqli_connect($host,$user,$pass,$db);
if (mysqli_connect_errno()) {
	echo "error".mysqli_connect_error();
}

?>