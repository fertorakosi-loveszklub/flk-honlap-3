<?php

namespace App\Traits;

trait EncryptedAttributes
{
    public function getAttribute($key)
    {
        if (array_has($this->encryptedAttributes, $key)) {
            return decrypt(parent::getAttribute($key));
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        if (array_has($this->encryptedAttributes, $key)) {
            return parent::setAttribute($key, encrypt($value));
        }

        return parent::setAttribute($key, $value);
    }
}
