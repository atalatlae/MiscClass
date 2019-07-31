<?php

include_once('src/HTTPCompress.php');

use MiscClass\HTTPCompress;

HTTPCompress::startCompress();

for ($i = 1; $i < 100; $i++) {
	echo "- $i\n";
}

HTTPCompress::dumpCompress();

