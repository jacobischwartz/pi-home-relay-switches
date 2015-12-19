<?php

echo 'Test GPIO, read pin 2. Status: ';
exec ( "gpio -g read 2", $status );
echo ($status[0] == 1) ? 'ON' : 'OFF';
