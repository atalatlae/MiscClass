<?php

class Crypt
{
	private $_key;
	private $_iv;
	private $_cipher;

	function __construct($key = '') {
		$this->_key = $key;
		$this->_cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
		$ivSize = mcrypt_enc_get_iv_size($this->_cipher);
		$tmpIV = bin2hex(mcrypt_create_iv($ivSize));
		$this->_iv = substr($tmpIV, 0, $ivSize);

	}

	public function crypt($data) {
		mcrypt_generic_init($this->_cipher, $this->_key, $this->_iv);
		$result = base64_encode(mcrypt_generic($this->_cipher, $data));
		mcrypt_generic_deinit($this->_cipher);

		return base64_encode($this->_iv.':'.$result);
	}

	public function decrypt($data) {
		list($this->_iv, $data) = explode(":", base64_decode($data));

		mcrypt_generic_init($this->_cipher, $this->_key, $this->_iv);
		$result = mdecrypt_generic($this->_cipher, base64_decode($data));
		mcrypt_generic_deinit($this->_cipher);

		return $result;
	}
}

