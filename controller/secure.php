<?php
function valid_token($conn, $public_key){
  $strSQL = "SELECT private_key, secret_key FROM fr3x_api WHERE public_key = '$public_key' AND status_key = 'Y'";
  $result = mysqli_query($conn, $strSQL);
  if(($result) && (mysqli_num_rows($result) > 0)){
    $data = mysqli_fetch_assoc($result);
    $pv = $data['private_key'];
    $sk = $data['secret_key'];
    $pk = base64_decode($public_key);
    if (password_verify($sk.$pk, $pv)) {
        return true;
    } else {
        return false;
    }
  }else{
    return false;
  }
}
?>
