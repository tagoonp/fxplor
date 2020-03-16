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

if($stage == 'create'){
  if((!isset($_POST['uid'])) || (!isset($_POST['title'])) || (!isset($_POST['cat'])))  {
    mysqli_close($conn);
    die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $cat = mysqli_real_escape_string($conn, $_POST['cat']);
  $desc = mysqli_real_escape_string($conn, $_POST['desc']);

  $pid = $sysdateu;
  $strSQL = "INSERT INTO fr3x_project (PID, proj_title, proj_desc, proj_category, proj_uid, proj_cdatetime, proj_udatetime) VALUES ('$pid', '$title', '$desc', '$cat', '$uid', '$sysdatetime', '$sysdatetime')";
  $resultNoti = mysqli_query($conn, $strSQL);
  if($resultNoti){
    echo "Success";
  }else{
    echo "Fail".$strSQL;
  }
  mysqli_close($conn);
  die();
}

if($stage == 'delete'){
  if((!isset($_POST['uid'])) || (!isset($_POST['pid'])))  {
    mysqli_close($conn);
    die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $pid = mysqli_real_escape_string($conn, $_POST['pid']);

  $strSQL = "DELETE FROM fr3x_project WHERE PID = '$pid'";
  $result = mysqli_query($conn, $strSQL);
  if($result){ echo "Success"; }
  mysqli_close($conn);
  die();
}

if($stage == 'get_info'){
  if((!isset($_POST['uid'])) || (!isset($_POST['pid'])))  {
    mysqli_close($conn);
    die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $pid = mysqli_real_escape_string($conn, $_POST['pid']);

  $strSQL = "SELECT * FROM fr3x_project a LEFT JOIN fr3x_knowledge_domain b ON a.proj_category = b.ID WHERE a.proj_delete = 'N' AND a.proj_uid = '$uid' AND a.PID = '$pid' ";
  $result = mysqli_query($conn, $strSQL);
  if(($result) && (mysqli_num_rows($result) > 0)){
    while($row = mysqli_fetch_array($result)){
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

if($stage == 'get_list'){
  if(!isset($_POST['uid'])) {
    mysqli_close($conn);
    die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $strSQL = "SELECT * FROM fr3x_project a LEFT JOIN fr3x_knowledge_domain b ON a.proj_category = b.ID WHERE a.proj_delete = 'N' AND a.proj_uid = '$uid' ORDER BY a.proj_udatetime DESC";
  $result = mysqli_query($conn, $strSQL);
  if(($result) && (mysqli_num_rows($result) > 0)){
    while($row = mysqli_fetch_array($result)){
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

if($stage == 'get_file_list'){
  if(!isset($_POST['pid'])) {
    mysqli_close($conn);
    die();
  }

  $pid = mysqli_real_escape_string($conn, $_POST['pid']);

  $strSQL = "SELECT * FROM fr3x_user_upload WHERE file_pid = '$pid' AND file_status = 'Y'";
  $result = mysqli_query($conn, $strSQL);
  if(($result) && (mysqli_num_rows($result) > 0)){
    while($row = mysqli_fetch_array($result)){
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
