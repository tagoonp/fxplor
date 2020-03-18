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

if($stage == 'get_input_data'){

    $handle = fopen("../upload/20200317958.csv", "r");
    $c = 1;
    $row = 1;
    $buffer = array();
    $colname = array();
    $data = array();

    while (($data = fgetcsv($handle, ",")) !== FALSE) {
        $num = count($data);
        $buffer[]['data'] = $data;
        $row++;
    }
    fclose($handle);

    $return[]['data'] = $buffer;

    echo json_encode($return);
    mysqli_close($conn);
    die();
}
