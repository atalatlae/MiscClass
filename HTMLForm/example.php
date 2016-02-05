<?php

include_once('HTMLForm.php');

$f = new HTMLForm('/foo.php', 'post', 'multipart/form-data', array('class' => 'contact_form', 'data-content' => 'lala'));
$f->addField('Your name', 'name', 'text', '', array('id' => 'name', 'maxlenght'=>'10'));
$f->addField('Your Email', 'email', 'text', '', array('id'=> 'email', 'maxlenght'=>'100'));

$options = array(
	'0' => '----',
	'1' => 'Valdivia',
	'2' => 'Santiago',
	'3' => 'La Serena',
);

$f->addField('Select your city', 'city', 'select', $options);
$f->addField('Your Comment', 'description', 'textarea', 'your description here');
$f->addField('', 'send', 'submit', 'Send Form', array('id'=> 'send'));

echo $f->render()."\n";

/* Output:

<form method="post" action="/foo.php" enctype="multipart/form-data" class="contact_form" data-content="lala" >
	<label>Your name</label>
		<input type="text" name="name" value="" id="name" maxlenght="10" >
	<label>Your Email</label>
		<input type="text" name="email" value="" id="email" maxlenght="100" >
	<label>Select your city</label>
		<select name="city" >
			<option value="0">----</opton>
			<option value="1">Valdivia</opton>
			<option value="2">Santiago</opton>
			<option value="3">La Serena</opton>
		</select>
	<label>Your Comment</label>
		<textarea name="description" >your description here</textarea>
	<input type="submit" name="send" value="Send Form" id="send" >
</form>

*/

