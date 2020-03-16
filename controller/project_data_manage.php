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

if($stage == 'get_var_info'){
  if((!isset($_POST['uid'])) || (!isset($_POST['pid'])) || (!isset($_POST['did'])))  {
    mysqli_close($conn);
    die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $pid = mysqli_real_escape_string($conn, $_POST['pid']);
  $did = mysqli_real_escape_string($conn, $_POST['did']);

  $strSQL = "SELECT * FROM fr3x_user_upload WHERE file_pid = '$pid' AND file_status = 'Y' LIMIT 1";
  // $strSQL = "SELECT * FROM fr3x_user_upload WHERE file_pid = '1584035546' AND file_status = 'Y' LIMIT 1";
  $result1 = mysqli_query($conn, $strSQL);
  if($result1){
    $data1 = mysqli_fetch_assoc($result1);
    if($data1['file_type'] == 'CSV'){
      $handle = fopen("../upload/".$data1['file_name'], "r");
      $c = 1;
      $row = 1;
      $buffer = array();
      $colname = array();
      $data = array();

      while (($data = fgetcsv($handle, ",")) !== FALSE) {
          $num = count($data);
          if($row == 1){
            $return['num_param'] = $num;
            for ($c=0; $c < $num; $c++) {
                $colname[] = $data[$c];
            }
          }else{
            $buffer[]['data'] = $data;
          }
          $row++;
      }
      fclose($handle);
    }
  }

  $buff_primary_datatype = array();
  foreach ($buffer as $row) { // each row
    $c = 0;
    foreach ($row as $value) { // each param
      foreach ($value as $key => $value2) {
        $buff_primary_datatype[$key][] = $value2;
      }
    }
    $c++;
  }
  $buff_dt = array();
  for ($i=0; $i < sizeof($buff_primary_datatype); $i++) {
      $buff_dt[] = desicion_type($buff_primary_datatype[$i]);
  }
  $return[]['data'] = $buffer;
  $return[]['column_name'] = $colname;
  $return[]['column_type'] = $buff_dt;

  echo json_encode($return, JSON_PRETTY_PRINT);
  mysqli_close($conn);
  die();
}

if($stage == 'explore_basic'){
  if((!isset($_POST['uid'])) || (!isset($_POST['pid'])) || (!isset($_POST['did'])) || (!isset($_POST['varname'])))  {
    mysqli_close($conn);
    die();
  }
  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $pid = mysqli_real_escape_string($conn, $_POST['pid']);
  $did = mysqli_real_escape_string($conn, $_POST['did']);
  $varname = mysqli_real_escape_string($conn, $_POST['varname']);

  if(isset($_GET['N']))
  {
    $N = $_GET['N'];
    $prefix = generateRandomString(5);
    // execute R script from shell
    // this will save a plot at temp.png to the filesystem
    exec("Rscript script2.r $N $prefix");

    // return image tag
    $nocache = rand();
    echo('<a href="./tmp_result/'.$prefix.'_temp.png" target="_blank">Link</a>');

  }
  
}

function desicion_type($data){
  $generaltype = 'integer';
  $factor_arr = array();
  for ($i = 0; $i < sizeof($data); $i++) {
    if(!is_numeric($data[$i])){
      // echo is_numeric($data[$i]). " " . $data[$i]."<br>";
      $generaltype = 'character';
      if(sizeof($factor_arr) <= 10){
        if (in_array($data[$i], $factor_arr)) {

        }else{
          $factor_arr[] = $data[$i];
        }
      }else{

      }

      if(sizeof($factor_arr) <= 10){
        $generaltype = 'factor';
      }
    }else{
      $generaltype = 'integer';
      if(sizeof($factor_arr) <= 10){
        if (in_array($data[$i], $factor_arr)) {

        }else{
          $factor_arr[] = $data[$i];
        }
      }else{

      }

      if(sizeof($factor_arr) <= 10){
        $generaltype = 'factor';
      }
    }
  }





  return $generaltype;
}
