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

$bulan = $_POST['bulan'];

$result = mysqli_query($koneksi,"SELECT * FROM calendar WHERE bulan = '$bulan'") or die(mysqli_error());

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"idck":"'                       . $rs["idck"]                        . '",';

    $outp .= '"bulan":"'                       . $rs["bulan"]                        . '",';

    $outp .= '"start":"'                       . $rs["start"]                       . '",';

     $outp .= '"finish":"'                       . $rs["finish"]                       . '",';

    $outp .= '"kegiatan":"'                       . $rs["kegiatan"]                       . '",';

    $outp .= '"dinas":"'                       . $rs["dinas"]                       . '",';

    $outp .= '"ketupel":"'                       . $rs["ketupel"]                       . '"}';

}
$outp ='{"records":['.$outp.']}';

echo($outp);

?>