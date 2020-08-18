<?php
$private_key = 'Mandymorenn203182039123';
$code = '60193';

if($_GET['stage'] == 'encode'){
  echo password_hash($code.$private_key, PASSWORD_DEFAULT);
}

if($_GET['stage'] == 'verify'){
  if (password_verify('rasmuslerdorf', $hash)) {
      echo 'Password is valid!';
  } else {
      echo 'Invalid password.';
  }
}



?>
