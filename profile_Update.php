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

$idu = $_POST['idu']; $nib = $_POST['nib']; $nim = $_POST['nim'];

$nama = $_POST['nama']; $password = $_POST['password']; $posisi = $_POST['posisi'];

$jabatan =  $_POST['jabatan']; $dinas =$_POST['dinas']; $email= $_POST['email'];

$nohp = $_POST['nohp']; $idline = $_POST['idline']; $jurusan = $_POST['jurusan'];

$angkatan = $_POST['angkatan'];  $alamat= $_POST['alamat']; $domisili =$_POST['domisili'];

$result = mysqli_query($koneksi, "UPDATE user SET password = '$password', nama='$nama', posisi='$posisi', jabatan='$jabatan', dinas='$dinas',email='$email', nohp='$nohp', idline = '$idline', 
	jurusan='$jurusan', angkatan='$angkatan', alamat='$alamat',domisili= '$domisili' WHERE idu = '$idu'
	") or die (mysqli_error());

$count = mysqli_affected_rows($koneksi);
 if ($count > 0) {
 	 
 	 $codex = "true";
 	 echo json_encode($codex);
 
 }
 else{
 	 $codex = "false";
	 echo json_encode($codex);
 }

?>