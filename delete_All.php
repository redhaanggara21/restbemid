<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}


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

        $result = mysqli_query($koneksi,"SELECT FROM timeline") or die(mysqli_error());
          
           while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

                 if($rs["image"] != "" || $rs["image"] != NULL){
                    
                     //$outp = ''.$rs['image'];

                      if(unlink('image_timeline/'. $rs['image'])){
                       
                         echo "enter/";
                         
                      }
                 }
            }


$result1 = mysqli_query($koneksi, "DELETE FROM checkin") or die (mysqli_error());

if($result1){
    
  $result2 = mysqli_query($koneksi, "DELETE FROM tag") or die (mysqli_error());
    
    if ($result2) {
        
      $result3 = mysqli_query($koneksi, "DELETE FROM comment") or die (mysqli_error());
        
        if ($result3) {


          }
    }
}

?>
