<?php

$pin = 2;
if(isset($_REQUEST['pin']) && (intval($_REQUEST['pin']) > 0)) {
  $pin = intval($_REQUEST['pin']);
}

echo 'Test GPIO, read pin ' . $pin . '. Status: ';
exec ( "gpio -g read " . $pin, $status );
echo ($status[0] == 1) ? 'ON' : 'OFF';
