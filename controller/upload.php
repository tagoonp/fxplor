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

if($stage == 'csv'){
  if((!isset($_GET['pid'])) || (!isset($_GET['uid']))){ mysqli_close($conn); die(); }

  $pid = mysqli_real_escape_string($conn, $_GET['pid']);
  $uid = mysqli_real_escape_string($conn, $_GET['uid']);


      $error = false;
      $files = array();

      $path = "../upload";
      if(!is_dir($path)){
        mkdir($path);
      }

      $uploaddir = $path."/";

      // foreach($_FILES as $file){
      //
      //     $tempFile = $file['tmp_name'];
      //     $filename = $pid.'-'.date('U').'-'.basename($file['name']);
      //     $fullpart = $uploaddir.$filename;
      //     $url = ROOT_DOMAIN."upload/".$filename;
      //
      //     // if(move_uploaded_file($file['tmp_name'], $uploaddir.basename($file['name'])))
      //     if(move_uploaded_file($file['tmp_name'], $uploaddir.$filename))
      //     {
      //         $files[] = $uploaddir.$file['name'];
      //
      //         $strSQL = "UPDATE fr3x_user_upload SET file_status = 'N' WHERE file_pid = '$pid'";
      //         $queryUpdate = mysqli_query($conn, $strSQL);
      //
      //         $strSQL = "INSERT INTO fr3x_user_upload (file_name, file_url, file_type, file_pid, file_datetime)
      //                     VALUES ('$filename', '$url', 'CSV', '$pid', '$sysadate')";
      //         $query = mysqli_query($conn, $strSQL);
      //
      //         echo "Y";
      //
      //     }
      //     else
      //     {
      //         $error = true;
      //     }
      // }
      //
      // $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);

      foreach($_FILES as $file){
        $strSQL = "UPDATE fr3x_user_upload SET file_status = 'N' WHERE file_pid = '$pid'";
        $queryUpdate = mysqli_query($conn, $strSQL);

        $tempFile = $file['tmp_name'];
        $filename = $pid.'-'.date('U').'-'.basename($file['name']);
        $fullpart = ROOT_DOMAIN."upload/".$filename;
        if(move_uploaded_file($file['tmp_name'], $uploaddir.$filename)){
          $strSQL = "INSERT INTO fr3x_user_upload (file_name, file_url, file_type, file_pid, file_datetime)
                    VALUES ('$filename', '$fullpart', 'CSV', '$pid', '$sysdatetime')";
          $query = mysqli_query($conn, $strSQL);
          if($query){
            echo "Y";
          }else{
            echo "N1";
          }
        }else{
          echo "N2";
        }
      }

  mysqli_close($conn);
  die();
}

if($stage == 'info'){
  if(
      (!isset($_POST['uid'])) ||
      (!isset($_POST['role']))
    ){
      mysqli_close($conn);
      die();
    }

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $strSQL = "SELECT * FROM fr3x_account WHERE UID = '$uid' AND role = '$role' AND allow_stage = 'Y' AND delete_stage = 'N'";
    $query = mysqli_query($conn, $strSQL);
    if(($query) && (mysqli_num_rows($query) > 0)){
        while($row = mysqli_fetch_array($query)){
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

?>
