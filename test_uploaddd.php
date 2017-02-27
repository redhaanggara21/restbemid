<?php


header("Access-Control-Allow-Origin: *");


include 'koneksi.php';
include 'date.php';

$target_path = "image_timeline/";
 
$target_path = $target_path . basename( $_FILES['file']['name']);
$nama =  $_FILES['file']['name'];

if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {

    $sql= mysqli_query($koneksi, "INSERT INTO timeline (idunib,agenda,tagin,caption,tanggal,waktu,lat,lng,image) VALUES('xx','Meeting', 'false','masukbos','blmfix','$localDate','xxx','xxx','$nama') ") or die(mysqli_error());

    echo "Upload and move success";
}
 else{
    echo "There was an error uploading the file, please try again!";
}

?>
