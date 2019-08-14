<?php

namespace MiscClass;

class Crypt
{
    private $key;
    private $iv;
    private $ivLen;
    private $tag;
    private $cipherAlg;
    private $encoded  = true;
    private $option = 0;

    public function __construct($key, $encoded = true)
    {
        $this->key = $key;
        $this->cipherAlg = 'aes-128-cbc';

        if (!$encoded) {
            $this->encoded = $encoded;
            $this->option = OPENSSL_RAW_DATA;
        }

        if (!in_array($this->cipherAlg, openssl_get_cipher_methods())) {
            throw new Exception('Unknown cipher algorithm');
        }

        $this->ivLen = openssl_cipher_iv_length($this->cipherAlg);
        $this->iv = openssl_random_pseudo_bytes($this->ivLen);
    }

    public function crypt($data)
    {
        $cipherData = openssl_encrypt(
            $data,
            $this->cipherAlg,
            $this->key,
            $this->option,
            $this->iv
        );

        if ($this->encoded) {
            return base64_encode($this->iv.$cipherData);
        }
        return $this->iv.$cipherData;
    }

    public function decrypt($data)
    {
        if ($this->encoded) {
            $data = base64_decode($data);
        }

        $this->iv = substr($data, 0, $this->ivLen);
        $data = substr($data, $this->ivLen);

        $clearData = openssl_decrypt(
            $data,
            $this->cipherAlg,
            $this->key,
            $this->option,
            $this->iv
        );
        return $clearData;
    }
}
