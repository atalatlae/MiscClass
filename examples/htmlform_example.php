<?php

include_once('src/HTMLForm.php');

use MiscClass\HTMLForm;

$f = new HTMLForm('/foo.php', 'post', 'multipart/form-data', array('class' => 'contact_form', 'data-content' => 'lala'));
$f->addField('Your name', 'name', 'text', '', array('id' => 'name', 'maxlenght'=>'10'));
$f->addField('Your Email', 'email', 'text', '', array('id'=> 'email', 'maxlenght'=>'100'));
$f->addField('Your Password', 'password', 'password', '', array('id'=> 'password', 'maxlenght'=>'64'));

$values = [
	'mr' => 'Mister',
	'ms' => 'Miss'
];
$f->addField('Title', 'title', 'radio', $values);

$values = [
	'b' => 'Banana',
	'o' => 'Orange',
	'a' => 'Apple'
];
$f->addField('Fruit', 'fruits', 'checkbox', $values);

$options = [
	'0' => '----',
	'1' => 'Valdivia',
	'2' => 'Santiago',
	'3' => 'La Serena',
];

$f->addField('Select your city', 'city', 'select', $options);
$f->addField('Your Comment', 'description', 'textarea', 'your description here', array('cols' => 40, 'rows' => '10'));
$f->addField('', 'send', 'submit', 'Send Form', array('id'=> 'send'));

echo "<html><body>\n";
echo $f->render()."\n";
echo "</body></html>\n";
