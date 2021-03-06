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

if($stage == 'get_notification_unread'){
  if(
      (!isset($_POST['uid']))
  ){
      mysqli_close($conn);
      die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);

  $strSQL = "SELECT * FROM dj3x_account WHERE uid = '$uid' AND primary_district IS NULL";
  $resultCheck = mysqli_query($conn, $strSQL);
  if(($resultCheck) && (mysqli_num_rows($resultCheck) > 0)){
    $strSQL = "INSERT INTO dj3x_user_nitification (noti_uid, noti_info, noti_datetime) VALUES ('$uid', 'บัญชีผู้ใช้รอการเพิ่มข้อมูลอำเภอที่ดูแลหลัก', '$sysdatetime')";
    $resultInsert = mysqli_query($conn, $strSQL);
  }

  $strSQL = "SELECT * FROM dj3x_account WHERE uid = '$uid' AND primary_subdistrict IS NULL";
  $resultCheck = mysqli_query($conn, $strSQL);
  if(($resultCheck) && (mysqli_num_rows($resultCheck) > 0)){
    $strSQL = "INSERT INTO dj3x_user_nitification (noti_uid, noti_info, noti_datetime) VALUES ('$uid', 'บัญชีผู้ใช้รอการเพิ่มข้อมูลตำบลที่ดูแลหลัก', '$sysdatetime')";
    $resultInsert = mysqli_query($conn, $strSQL);
  }

  $strSQL = "SELECT * FROM dj3x_userinfo WHERE uid = '$uid' AND info_status = 'Y' AND (primary_email IS NULL OR primary_phone IS NULL)";
  $resultCheck = mysqli_query($conn, $strSQL);
  if(($resultCheck) && (mysqli_num_rows($resultCheck) > 0)){
    $strSQL = "INSERT INTO dj3x_user_nitification (noti_uid, noti_info, noti_datetime) VALUES ('$uid', 'บัญชีผู้ใช้รอการเพิ่มข้อมูลอีเมล์แอดเดรสหรือหมายเลขโทรศัพท์', '$sysdatetime')";
    $resultInsert = mysqli_query($conn, $strSQL);
  }

  $strSQL = "SELECT * FROM dj3x_user_nitification WHERE noti_uid = '$uid' AND noti_read = '0'";
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

if($stage == 'current_user'){ //
  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $return = array();

  $strSQL = "SELECT * FROM dj3x_account a INNER JOIN dj3x_userinfo b ON a.uid = b.uid WHERE a.uid = '$uid' AND b.info_status = 'Y' AND a.delete_status = 'N' AND a.allow_status = 'Y' LIMIT 1";
  $query = mysqli_query($conn, $strSQL);

  if(($query) && (mysqli_num_rows($query) > 0)){
    while($row = mysqli_fetch_array($query)){
      $username_tmp = $row['username'];
      $b = explode('@', $username_tmp);
      if(sizeof($b) > 1){
        // Is email
        if($row['primary_email'] == null){
          $strSQL = "UPDATE dj3x_userinfo SET primary_email = '$username_tmp' WHERE uid = '$uid'";
          $resultUpdate = mysqli_query($conn, $strSQL);
        }
      }else{
        // Is phone
        if($row['primary_phone'] == null){
          $strSQL = "UPDATE dj3x_userinfo SET primary_phone = '$username_tmp' WHERE uid = '$uid'";
          $resultUpdate = mysqli_query($conn, $strSQL);
        }
      }
    }
  }

  $strSQL = "SELECT *, c.Name province, d.Name district, e.Name subdistrict
             FROM dj3x_account a INNER JOIN dj3x_userinfo b ON a.uid = b.uid
             LEFT JOIN repos_changwat c ON a.primary_province = c.Changwat
             LEFT JOIN repos_ampur d ON a.primary_province = d.Changwat AND a.primary_district = d.Ampur
             LEFT JOIN repos_tumbon e ON a.primary_province = e.Changwat AND a.primary_district = e.Ampur AND a.primary_subdistrict = e.Tumbon
             WHERE a.uid = '$uid' AND b.info_status = 'Y' AND a.delete_status = 'N' AND a.allow_status = 'Y' LIMIT 1";
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

if($stage == 'updateEmail'){
  if(
      (!isset($_POST['uid'])) ||
      (!isset($_POST['email']))
  ){
      mysqli_close($conn);
      die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  $strSQL = "SELECT * FROM dj3x_account WHERE username = '$email' AND uid != '$uid' AND delete_status = 'N' ";
  $resultCheck = mysqli_query($conn, $strSQL);
  if(($resultCheck) && (mysqli_num_rows($resultCheck) > 0)){
    echo "D";
    mysqli_close($conn);
    die();
  }

  $usertype = 'email';

  // check current user use email or phone to login
  $strSQL = "SELECT * FROM dj3x_account WHERE uid = '$uid' AND delete_status = 'N' ";
  $resultCheck = mysqli_query($conn, $strSQL);
  if(($resultCheck) && (mysqli_num_rows($resultCheck) > 0)){
    $data = mysqli_fetch_assoc($resultCheck);
    $username_tmp = $data['username'];
    $b = explode('@', $username_tmp);
    if(sizeof($b) > 1){
      // Email
      $usertype = 'email';
    }else{
      $usertype = 'phone';
    }
  }

  if($usertype == 'email'){
    $strSQL = "UPDATE dj3x_account SET username = '$email' WHERE uid = '$uid'";
    $resultUpdate = mysqli_query($conn, $strSQL);
    if($resultUpdate){
      $strSQL = "UPDATE dj3x_userinfo SET primary_email = '$email' WHERE uid = '$uid' AND info_status = 'Y'";
      $resultUpdate = mysqli_query($conn, $strSQL);
      if($resultUpdate){
          echo "Y";
      }
    }
  }else{
    $strSQL = "UPDATE dj3x_userinfo SET primary_email = '$email' WHERE uid = '$uid' AND info_status = 'Y'";
    $resultUpdate = mysqli_query($conn, $strSQL);
    if($resultUpdate){
        echo "Y";
    }
  }
  mysqli_close($conn);
  die();
}

if($stage == 'updatePassword'){
  if(
      (!isset($_POST['uid'])) ||
      (!isset($_POST['password']))
  ){
      mysqli_close($conn);
      die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $password = base64_encode(mysqli_real_escape_string($conn, $_POST['password']));

  $strSQL = "UPDATE dj3x_account SET password = '$password' WHERE uid = '$uid' AND delete_status = 'N' ";
  $resultUpdate = mysqli_query($conn, $strSQL);
  if($resultUpdate){
      echo "Y";
  }
  mysqli_close($conn);
  die();
}

if($stage == 'updatePhone'){
  if(
      (!isset($_POST['uid'])) ||
      (!isset($_POST['phone']))
  ){
      mysqli_close($conn);
      die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);

  $strSQL = "SELECT * FROM dj3x_account WHERE username = '$phone' AND uid != '$uid' AND delete_status = 'N' ";
  $resultCheck = mysqli_query($conn, $strSQL);
  if(($resultCheck) && (mysqli_num_rows($resultCheck) > 0)){
    echo "D";
    mysqli_close($conn);
    die();
  }

  $usertype = 'email';

  // check current user use email or phone to login
  $strSQL = "SELECT * FROM dj3x_account WHERE uid = '$uid' AND delete_status = 'N' ";
  $resultCheck = mysqli_query($conn, $strSQL);
  if(($resultCheck) && (mysqli_num_rows($resultCheck) > 0)){
    $data = mysqli_fetch_assoc($resultCheck);
    $username_tmp = $data['username'];
    $b = explode('@', $username_tmp);
    if(sizeof($b) > 1){
      // Email
      $usertype = 'email';
    }else{
      $usertype = 'phone';
    }
  }

  if($usertype == 'phone'){
    $strSQL = "UPDATE dj3x_account SET username = '$phone' WHERE uid = '$uid'";
    $resultUpdate = mysqli_query($conn, $strSQL);
    if($resultUpdate){
      $strSQL = "UPDATE dj3x_userinfo SET primary_phone = '$phone' WHERE uid = '$uid' AND info_status = 'Y'";
      $resultUpdate = mysqli_query($conn, $strSQL);
      if($resultUpdate){
          echo "Y";
      }
    }
  }else{
    $strSQL = "UPDATE dj3x_userinfo SET primary_phone = '$phone' WHERE uid = '$uid' AND info_status = 'Y'";
    $resultUpdate = mysqli_query($conn, $strSQL);
    if($resultUpdate){
        echo "Y";
    }
  }
  mysqli_close($conn);
  die();
}

if($stage == 'updateFullname'){
  if(
      (!isset($_POST['uid'])) ||
      (!isset($_POST['fname'])) ||
      (!isset($_POST['lname']))
  ){
      mysqli_close($conn);
      die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $fname = mysqli_real_escape_string($conn, $_POST['fname']);
  $lname = mysqli_real_escape_string($conn, $_POST['lname']);

  $strSQL = "UPDATE dj3x_userinfo SET fname = '$fname', lname = '$lname' WHERE uid = '$uid' AND info_status = 'Y'";
  $resultUpdate = mysqli_query($conn, $strSQL);
  if($resultUpdate){
      echo "Y";
  }
  mysqli_close($conn);
  die();
}

if($stage == 'updateInstitution'){
  if(
      (!isset($_POST['uid'])) ||
      (!isset($_POST['insitution'])) ||
      (!isset($_POST['province'])) ||
      (!isset($_POST['district'])) ||
      (!isset($_POST['subdistrict']))
  ){
      echo 'error 3';
      mysqli_close($conn);
      die();
  }

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $insitution = mysqli_real_escape_string($conn, $_POST['insitution']);
  $province = mysqli_real_escape_string($conn, $_POST['province']);
  $district = mysqli_real_escape_string($conn, $_POST['district']);
  $subdistrict = mysqli_real_escape_string($conn, $_POST['subdistrict']);

  $strSQL = "UPDATE dj3x_userinfo SET institution = '$insitution' WHERE uid = '$uid' AND info_status = 'Y'";
  $resultUpdate = mysqli_query($conn, $strSQL);
  if($resultUpdate){
      $strSQL2 = "UPDATE dj3x_account
                SET primary_province = '$province',
                primary_district = '$district',
                primary_subdistrict = '$subdistrict'
                WHERE uid = '$uid'";
      mysqli_query($conn, $strSQL2);
      echo "Y";
  }else{
    echo 'error 2';
  }
  mysqli_close($conn);
  die();
}

if($stage == 'register'){ //

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $password = base64_encode($password);

    $return = array();

    $strSQL = "SELECT * FROM fr3x_account WHERE email = '$email' AND delete_stage = 'N'";
    $query = mysqli_query($conn, $strSQL);
    if(($query) && (mysqli_num_rows($query) > 0)){
        $buffer = array();
        $buffer['status'] = "D";
        $return[] = $buffer;
        echo json_encode($return);
        mysqli_close($conn);
        die();
    }

    $uid = base64_encode($sysdateu);
    $strSQL = "INSERT INTO fr3x_account (UID, fname, lname, email, password, reg_datetime)
             VALUES ('$uid', '$fname', '$lname', '$email', '$password', '$sysdatetime')
            ";
    $query = mysqli_query($conn, $strSQL);
    if($query){

      $strSQL = "INSERT INTO fr3x_log (log_datetime, log_ip, log_activity, log_uid) VALUES ('$sysdatetime', '$ip', 'Create account', '$ip')";
                mysqli_query($conn, $strSQL);
      $buffer = array();
      $buffer['status'] = "Y";
      $buffer['uid'] = $uid;
      $buffer['role'] = 'common';
      $return[] = $buffer;

    }else{
      $buffer = array();
      $buffer['status'] = "N";
      $return[] = $buffer;
    }

    echo json_encode($return);
    mysqli_close($conn);
    die();
}

if($stage == 'login'){
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $password = base64_encode($password);

  $return = array();

  $strSQL = "SELECT * FROM fr3x_account WHERE email = '$email' AND password = '$password' AND verification_stage = 'Y' AND allow_stage = 'Y' AND delete_stage = 'N' LIMIT 1";
  $query = mysqli_query($conn, $strSQL);
  if(($query) && (mysqli_num_rows($query) > 0)){
      while($row = mysqli_fetch_array($query)){
          $b = [];
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
