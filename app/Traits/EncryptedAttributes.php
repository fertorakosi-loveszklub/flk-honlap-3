<?php

namespace App\Traits;

trait EncryptedAttributes
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptedAttributes) && $value != '') {
            $value = decrypt($value);
        }

        return $value;
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptedAttributes)) {
            return parent::setAttribute($key, encrypt($value));
        }

        return parent::setAttribute($key, $value);
    }
}
