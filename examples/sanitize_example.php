<?php

include_once('src/Sanitize.php');

use MiscClass\Sanitize;

$string = 'Hello <b>world</b>';
$clean = Sanitize::clean($string, FS_STRING);
printf("Original text:\n\t%s\nSanitized text:\n\t%s\n\n", $string, $clean);

$email = '(foo@var.com)';
$clean = Sanitize::clean($email, FS_EMAIL);
printf("Original email:\n\t%s\nSanitized email:\n\t%s\n\n", $email, $clean);


$emails = ['foo@var.com', '(foo@var.com)', '<foo@var.com>'];
$clean = Sanitize::clean($emails, FS_ARRAY_EMAIL);
printf("Original emails array:\n%s\nSanitized emails array:\n%s\n\n", var_export($emails, true), var_export($clean, true));

$noarray = 1;
$clean = Sanitize::clean($noarray, FS_ARRAY);
printf("Original value:\n\t%s\nSanitized as array:\n%s\n", $noarray, var_export($clean, true));
