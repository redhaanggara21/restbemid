<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';
include 'date.php';

$tmpFilePathP = $_FILES['file']['tmp_name'];
$nameFilePathP = uniqid().str_replace(" ","_", basename($_FILES['file']['name']) );
$filePathP = "image_timeline/" .$nameFilePathP;
$codex="";
 

if(move_uploaded_file($tmpFilePathP, $filePathP)) {

    $sql= mysqli_query($koneksi, "INSERT INTO timeline (idunib,agenda,tagin,caption,tanggal,waktu,lat,lng,image) VALUES('xx','Meeting', 'false','masukbos','blmfix','$localDate','xxx','xxx','$nameFilePathP') ") or die(mysqli_error());

    $codex = $nameFilePathP;
}

 else{

     $codex = "false";
 	   
}

echo json_encode($codex);

?>
