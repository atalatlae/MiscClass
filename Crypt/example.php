<?php

include_once('Crypt.php');

use MiscClass\Crypt\Crypt;

$key = 'super_secret_key';
$text = 'Hello world';

$c1 = new Crypt($key);
$encrypted_text = $c1->crypt($text);

echo "encrypted text: $encrypted_text\n";

$c2 = new Crypt($key);
$plain_text = $c2->decrypt($encrypted_text);

echo "plain text: $plain_text\n";
