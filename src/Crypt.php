<?php

namespace MiscClass;

class Crypt
{
    private $key;
    private $iv;
    private $ivLen;
    private $tag;
    private $cipherAlg;

    function __construct($key = '') {
        $this->key = $key;
        $this->cipherAlg = 'aes-128-cbc';

        if (!in_array($this->cipherAlg, openssl_get_cipher_methods())) {
            throw new Exception('Unknown cipher algorithm');
        }
        $this->ivLen = openssl_cipher_iv_length($this->cipherAlg);
        $this->iv = openssl_random_pseudo_bytes($this->ivLen);
    }

    public function crypt($data) {
        $cipherData = openssl_encrypt($data, $this->cipherAlg, $this->key, $options=0, $this->iv);
        return base64_encode($this->iv.":".$cipherData);
    }

    public function decrypt($data) {
        $raw_data = base64_decode($data);
        $this->iv = substr($raw_data, 0, $this->ivLen);
        $data = substr($raw_data, $this->ivLen + 1);

        $clearData = openssl_decrypt($data, $this->cipherAlg, $this->key, $options=0, $this->iv);
        return $clearData;
    }
}

