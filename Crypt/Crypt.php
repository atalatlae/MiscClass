<?php

class Crypt
{
	private $_key;
	private $_iv;
	private $_cipher;
	private $_ivSize;

	function __construct($key = '') {
		$this->_key = $key;
		$this->_cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
		$this->_ivSize = mcrypt_enc_get_iv_size($this->_cipher);
		$tmpIV = bin2hex(mcrypt_create_iv($this->_ivSize));
		$this->_iv = substr($tmpIV, 0, $this->_ivSize);

	}

	public function crypt($data) {
		mcrypt_generic_init($this->_cipher, $this->_key, $this->_iv);
		$result = base64_encode(mcrypt_generic($this->_cipher, $data));
		mcrypt_generic_deinit($this->_cipher);

		return base64_encode($this->_iv.':'.$result);
	}

	public function decrypt($data) {
		$raw_data = base64_decode($data);
		$this->_iv = substr($raw_data, 0, $this->_ivSize);
		$data = substr($raw_data, $this->_ivSize + 1);

		mcrypt_generic_init($this->_cipher, $this->_key, $this->_iv);
		$result = mdecrypt_generic($this->_cipher, base64_decode($data));
		mcrypt_generic_deinit($this->_cipher);

		return $result;
	}
}

