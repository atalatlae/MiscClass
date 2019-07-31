<?php

include_once('src/Sanitize.php');

use MiscClass\Sanitize;

$snt = new Sanitize();

$string = 'Hello <b>world</b>';
$clean = $snt->sanitizeVar($string, FS_STRING);
var_dump($clean);

$email = '(foo@var.com)';
$clean = $snt->sanitizeVar($email, FS_EMAIL);
var_dump($clean);

$emails = array(
	'foo@var.com',
	'(foo@var.com)',
	'<foo@var.com>'
);
$clean = $snt->sanitizeVar($emails, FS_ARRAY_EMAIL);
var_dump($clean);

$noarray = 1;
$clean = $snt->sanitizeVar($noarray, FS_ARRAY);
var_dump($clean);
