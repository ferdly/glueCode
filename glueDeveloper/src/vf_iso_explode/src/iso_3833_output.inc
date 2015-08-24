<?php
// FOR TESTING NOW
//
// MAKE OOP LATER

$output_type = 'print_r';
$supported_output_type_array = array('print_r');
if (in_array($output_type, $supported_output_type_array) !== true) {
    $output = 'some error mechanism parallel to vin class';
    return $output;
}
require_once 'iso_3833.php';
// $vin_input = '1J8HR68226C306828';
$vin_input = '1j8hr68226c306828';// test strtoupper()
// $vin_input = '1J8HR68226C306828X';//wrong length test
// $vin_input = '1J8HR68226C30682I';//1 of 3 improper character tests
// $vin_input = '1J8HR68226C30682O';//1 of 3 improper character tests
// $vin_input = '1J8HR68226C30682Q';//1 of 3 improper character tests
$vin_object = new vin($vin_input);

switch ($output_type) {
    case 'print_r':
        $output = print_r($vin_object, true);
        break;

    default:
        // DEFAULT is also 'print_r' as this is the debugging format
        $output = print_r($vin_object, true);
        break;
}