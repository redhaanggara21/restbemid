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

$result = mysqli_query($koneksi,"SELECT timeline.* , user.*, checkin.* FROM timeline,user,checki WHERE timeline.idunib = user.nib AND checkin.idt = timeline.idt ORDER BY idt DESC ") or die(mysqli_error());

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"idt":"'                       . $rs["idt"]                        . '",';

    $outp .= '"idunib":"'                       . $rs["idunib"]                        . '",';

    $outp .= '"agenda":"'                       . $rs["agenda"]                       . '",';

    $outp .= '"tagin":"'                       . $rs["tagin"]                       . '",';

    $outp .= '"caption":"'                       . $rs["caption"]                       . '",';

    $outp .= '"tanggal":"'                       . $rs["tanggal"]                       . '",';

    $outp .= '"waktu":"'                       . $rs["waktu"]                       . '",';

     $outp .= '"barcode":"'                       . $rs["barcode"]                       . '",';

    $outp .= '"lat":"'                       . $rs["lat"]                       . '",';

    $outp .= '"lng":"'                       . $rs["lng"]                       . '",';

    $outp .= '"image":"'                       . $rs["image"]                       . '",';

    $outp .= '"nama":"'                       . $rs["nama"]                       . '",';
    
    $outp .= '"nibin":"'                       . $rs["nibin"]                       . '",';



     if($rs["photo"] == ""){
        $outp .= '"dp":"'                       . "nodp.png"                       . '"}';
     }
     else{
            $outp .= '"dp":"'                       . $rs["photo"]                       . '"}';
     }



}
$outp ='{"records":['.$outp.']}';

echo($outp);

?>
