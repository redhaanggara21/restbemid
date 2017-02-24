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
include 'date.php';

$postData = file_get_contents('php://input');

$type = "Meeting";
$user = "30303";
$message = "eaaa";
$datetime = "eaa";


if(!empty($_FILES)){
	$tmpFilePathP = $_FILES['file']['tmp_name'];
	$nameFilePathP = uniqid().str_replace(" ","_", $_FILES['file']['name']);
	$filePathP = "image_timeline/" .$nameFilePathP;
		if(move_uploaded_file($tmpFilePathP, $filePathP)){				
				$sql= mysqli_query($koneksi, "INSERT INTO timeline (idunib,agenda,caption,tanggal,image) VALUES('$user','$type','$message','$datetime','$nameFilePathP') ") or die(mysqli_error());
		}
}



?>
