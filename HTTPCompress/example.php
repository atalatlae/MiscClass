<?php

include_once('HTTPCompress.php');

HTTPCompress::startCompress();

for ($i = 1; $i < 100; $i++) {
	echo "- $i\n";
}

HTTPCompress::dumpCompress();

