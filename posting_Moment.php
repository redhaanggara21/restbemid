<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include 'koneksi.php';

$postData = file_get_contents('php://input');

$type = $_POST['type'];
$user = $_POST['user'];
$message = $_POST['message'];
$datetime = $_POST['datetime'];
$tag = $_POST['tag'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
//$tagin = $_POST['tagin'];
//$arr = explode(",", $tag);
//$max = count($arr);
//$barcode =  uniqid();

	/*if($tagin == "true"){
	
		$sql= mysqli_query($koneksi, "INSERT INTO timeline (idunib,agenda,tagin,caption,tanggal,barcode,lat,lng) VALUES('$user','$type','$tagin','$message','$datetime','$barcode','$lat','$lng') ") or die(mysqli_error());
		
		$idt = mysqli_insert_id($koneksi);

		for ($i=0; $i < $max; $i++) { 
			
			if($arr[$i] != $user){
				$tag = mysqli_query($koneksi, "INSERT INTO tag (idt,idu,status) VALUES ('$idt','$arr[$i]','Delived') ");
			}	
		}
	}*/
	//else{
		$sql= mysqli_query($koneksi, "INSERT INTO timeline (idunib,agenda,caption,tanggal,lat,lng) VALUES('$user','$type','$message','$datetime','$lat','$lng') ") or die(mysqli_error());
	//}

?>
