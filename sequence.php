<?php

/**
 * Pin positions on the Pi that control circuits.
 */
$pins = array(2,3,17);

/*
 * Sequence file expected to be a CSV.
 * Each row should be another beat, at whatever pace.
 * There should be as many columns as $pins.
 * Each value should be 0 or 1.
 *
 * The file can be specified as a querystring param 'sequence'.
 * The param should not have any slashes or dots in it, or
 * contain an extension.
 */
$sequence_filename = 'regular101.csv';
if(isset($_REQUEST['sequence'])) {
  $sequence_filename = $_REQUEST['sequence'];
  $sequence_filename = str_replace(array('/', '.'), '', $sequence_filename);
  $sequence_filename .= '.csv';
}

$pace_seconds = 0.5;
if(isset($_REQUEST['pace']) && (floatval($_REQUEST['pace']) > 0.1)) {
  $pace_seconds = floatval($_REQUEST['pace']);
}

foreach($pins as $pin) {
  system( "gpio -g mode " . $pin . " out" );
}

if(!file_exists('sequences/' . $sequence_filename)) exit('Sequence file not found.');

$file = fopen('sequences/' . $sequence_filename, 'r');
if($file === FALSE) exit('Could not open sequence file.');

$row_count = 0;
while($row = fgetcsv($file)) {
  foreach($pins as $pin) {
    $value = array_shift($row);
    if(NULL === $value) continue;
    system( 'gpio -g write ' . $pin . ' ' . $value );
  }
  $row_count++;
  sleep($pace_seconds);
}

echo 'Hope you enjoyed the sequence! There were ' . $row_count . ' beats, output at a pace of ' . $pace_seconds . 's.';