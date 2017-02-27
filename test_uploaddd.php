<?php


header("Access-Control-Allow-Origin: *");


include 'koneksi.php';
include 'date.php';

//$target_path = "image_timeline/";

$tmpFilePathP = $_FILES['file']['tmp_name'];
$nameFilePathP = uniqid().str_replace(" ","_", basename($_FILES['file']['name']) );
$filePathP = "image_timeline/" .$nameFilePathP;
 
//$target_path = $target_path . basename( $_FILES['file']['name']);
//$nama =  $_FILES['file']['name'];

if(move_uploaded_file($tmpFilePathP, $filePathP)) {

    $sql= mysqli_query($koneksi, "INSERT INTO timeline (idunib,agenda,tagin,caption,tanggal,waktu,lat,lng,image) VALUES('xx','Meeting', 'false','masukbos','blmfix','$localDate','xxx','xxx','$nameFilePathP') ") or die(mysqli_error());

    echo "Upload and move success";
}
 else{
    echo "There was an error uploading the file, please try again!";
}

?>
