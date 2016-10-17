<?php

namespace App;

use App\Traits\EncryptedAttributes;
use Crypt;
use Illuminate\Database\Eloquent\Model;

class MemberProfile extends Model
{
    use EncryptedAttributes;

    protected $fillable = [
        'user_id',
        'name',
        'born_at',
        'birth_place',
        'mother_name',
        'address',
        'joined_at',
        'phone',
        'email',
        'card_id'
    ];

    protected $encryptedAttributes = [
        'mother_name',
        'address',
        'phone',
        'email',
        'birth_place',
    ];
}
