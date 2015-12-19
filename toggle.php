<?php

$pin = 2;
if(isset($_REQUEST['pin']) && (intval($_REQUEST['pin']) > 0)) {
  $pin = intval($_REQUEST['pin']);
}

exec( "gpio -g read " . $pin, $status );
exec( 'gpio -g write ' . $pin . ' ' . !$status[0] );
