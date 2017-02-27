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

$target_path = "image_timeline/";
 
$target_path = $target_path . basename( $_FILES['file']['name']);
 
if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {

	$sql= mysqli_query($koneksi, "INSERT INTO timeline (idunib,agenda,tagin,caption,tanggal,lat,lng,image) VALUES('xx','xx', 'xx','xx','xx','xx','xx','$target_path') ") or die(mysqli_error());

    echo "Upload and move success";
}
 else{
echo $target_path;
    echo "There was an error uploading the file, please try again!";
}

?>
