<?php
include "../../configuration/fxplor/config.inc.php";
include "../connect.inc.php";
include "../function.inc.php";
include "./secure.php";
$return = array();

if(!isset($_GET['stage'])){
  mysqli_close($conn);
  die();
}

$stage = mysqli_real_escape_string($conn, $_GET['stage']);

if($stage == 'generate'){
  if(
      (!isset($_POST['api']))
  ){
      $return['status'] = 'fail 1';
      echo json_encode($return);
      mysqli_close($conn);
      die();
  }

  $public_key = mysqli_real_escape_string($conn, $_POST['api']);
  if(valid_token($conn, $public_key)){
    // Create token
    $new_token = base64_encode($sysdateu.generateRandomString(10));
    $exp_datetime = date("Y-m-d H:i:s", strtotime('+4 hours', strtotime($sysdatetime)));

    $strSQL = "INSERT INTO fr3x_token (`token`, `token_cdatetime`, `token_expdatetime`, `token_ip`)
               VALUES ('$new_token', '$sysdatetime', '$exp_datetime', '$ip')
              ";
    $resultInsert = mysqli_query($conn, $strSQL);
    if($resultInsert){
        $return['status'] = 'success';
        $return['token'] = $new_token;
    }
  }else{
    $return['status'] = 'fail 2';
  }

  echo json_encode($return);
  mysqli_close($conn);
  die();
}

if($stage == 'token_check'){
  if(
      (!isset($_POST['api'])) ||
      (!isset($_POST['token']))
  ){
      $return['status'] = 'fail 1';
      echo json_encode($return);
      mysqli_close($conn);
      die();
  }
  $public_key = mysqli_real_escape_string($conn, $_POST['api']);
  $token = mysqli_real_escape_string($conn, $_POST['token']);
  if(valid_token($conn, $public_key)){

    $strSQL = "SELECT * FROM fr3x_token WHERE token = '$token' AND token_status = 'Y'";
    $resultCheck = mysqli_query($conn, $strSQL);
    if(($resultCheck) && (mysqli_num_rows($resultCheck) > 0)){
      $return['status'] = 'live '.$strSQL;
      $return['token'] = $token;
    }else{
      // Refresh token
      $new_token = base64_encode($sysdateu.generateRandomString(10));
      $exp_datetime = date("Y-m-d H:i:s", strtotime('+4 hours', strtotime($sysdatetime)));

      $strSQL = "INSERT INTO fr3x_token (`token`, `token_cdatetime`, `token_expdatetime`, `token_ip`)
                 VALUES ('$new_token', '$sysdatetime', '$exp_datetime', '$ip')
                ";
      $resultInsert = mysqli_query($conn, $strSQL);
      if($resultInsert){
          $return['status'] = 'refresh';
          $return['token'] = $new_token;
      }
    }
  }else{
    $return['status'] = 'fail 2';
  }
  echo json_encode($return);
  mysqli_close($conn);
  die();
}

?>
