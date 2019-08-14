<?php

include_once('src/Crypt.php');

use MiscClass\Crypt;

$key = 'super_secret_key';
$text = 'Hello world';

$c1 = new Crypt($key);
$cypherText = $c1->crypt($text);
$len = strlen($cypherText);
printf("Plain text: %s\n"
    ."Encrypted len: %d\n"
    ."Encrypted raw text: %s\n\n",
    $text, $len, $cypherText);

$c2 = new Crypt($key, false);
$cypherText = $c2->crypt($text);
$len = strlen($cypherText);

printf("Plain text: %s\n"
    ."Encrypted len: %d\n"
    ."Encrypted raw text: %s\n\n",
    $text, $len, $cypherText);
