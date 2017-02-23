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

$idt = $_POST['idt']; 
$agenda = $_POST['agenda']; 
$tagin = $_POST['tagin'];
$outp = "";

if($tagin == "true"){

   $result = mysqli_query($koneksi, "DELETE FROM tag WHERE idt = '$idt' ") or die (mysqli_error());

    if($agenda == "Meeting"){

        $result = mysqli_query($koneksi, "DELETE FROM checkin WHERE idt = '$idt' ") or die (mysqli_error());

        $result = mysqli_query($koneksi, "DELETE FROM timeline WHERE idt = '$idt' LIMIT 1") or die (mysqli_error());
        
    }
    else{
        
        $result = mysqli_query($koneksi,"SELECT image FROM timeline WHERE idt = '$idt' ") or die(mysqli_error());
        
        while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
             if($rs["image"] == ""){
                $outp = "empty";
             }
             else{
                    $outp = "".$rs['photo'];
             }

        }
        
        if ($outp != "empty"){
            unlink('image_timeline/'. $outp);
        }
        
        $result = mysqli_query($koneksi, "DELETE FROM timeline WHERE idt = '$idt' LIMIT 1") or die (mysqli_error());

    }
    
}
else{

      if($agenda == "Meeting"){

        $result = mysqli_query($koneksi, "DELETE FROM checkin WHERE idt = '$idt' ") or die (mysqli_error());

        $result = mysqli_query($koneksi, "DELETE FROM timeline WHERE idt = '$idt' LIMIT 1") or die (mysqli_error());
    }
    else{
        
        $result = mysqli_query($koneksi,"SELECT image FROM timeline WHERE idt = '$idt' ") or die(mysqli_error());
        
        while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
             
            if($rs["image"] == ""){
                $outp = "empty";
             }
             else{
                    $outp = "".$rs['photo'];
             }

        }
        
        if ($outp != "empty"){
            unlink('image_timeline/'. $outp);
        }
        

        $result = mysqli_query($koneksi, "DELETE FROM timeline WHERE idt = '$idt' LIMIT 1") or die (mysqli_error());

    }

}

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
