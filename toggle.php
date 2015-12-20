<?php

$pin = 2;
if(isset($_REQUEST['pin']) && (intval($_REQUEST['pin']) > 0)) {
  $pin = intval($_REQUEST['pin']);
}

exec( "gpio -g read " . $pin, $status_before );
system( "gpio -g mode " . $pin . " out" );
system( 'gpio -g write ' . $pin . ' ' . ($status_before[0] ? 0 : 1) );
exec( "gpio -g read " . $pin, $status_after );

echo 'Pin ' . $pin . ' changed from ' . $status_before[0] . ' to ' . $status_after[0];
