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
;

$sql= "SELECT * FROM user ORDER BY idu ASC";

$result= mysqli_query($koneksi,$sql);

$outp = "";

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"idu":"'                       . $rs["idu"]                        . '",';

    $outp .= '"nib":"'                       . $rs["nib"]                        . '",';

    $outp .= '"nama":"'                       . $rs["nama"]                       . '",';

    $outp .= '"posisi":"'                       . $rs["posisi"]                       . '",';

    $outp .= '"jabatan":"'                       . $rs["jabatan"]                       . '",';

    $outp .= '"email":"'                       . $rs["email"]                       . '",';

    $outp .= '"nohp":"'                       . $rs["nohp"]                       . '",';

    $outp .= '"idline":"'                       . $rs["idline"]                       . '",';

    $outp .= '"jurusan":"'                       . $rs["jurusan"]                       . '",';

    $outp .= '"angkatan":"'                       . $rs["angkatan"]                       . '",';

    $outp .= '"alamat":"'                       . $rs["alamat"]                       . '",';

    $outp .= '"domisili":"'                       . $rs["domisili"]                       . '",';

    $outp .= '"photo":"'                       . $rs["photo"]                       . '"}';

}

$outp ='{"records":['.$outp.']}';

echo($outp);

?>