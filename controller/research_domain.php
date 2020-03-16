<?php
include "../config.inc.php";
include "../connect.inc.php";
include "../function.inc.php";

$return = array();

if(!isset($_GET['stage'])){
  mysqli_close($conn);
  die();
}

$stage = mysqli_real_escape_string($conn, $_GET['stage']);

if($stage == 'get'){
  $strSQL = "SELECt * FROM fr3x_knowledge_domain WHERE knw_status = 'Y' ORDER BY knw_domain";
  $resultNoti = mysqli_query($conn, $strSQL);
  if(($resultNoti) && (mysqli_num_rows($resultNoti) > 0)){
    while($row = mysqli_fetch_array($resultNoti)){
        $b = array();
        foreach ($row as $key => $value) {
          if(!is_int($key)){
            $b[$key] = $value;
          }
        }
        $return[] = $b;
    }
  }
  echo json_encode($return);
  mysqli_close($conn);
  die();
}
