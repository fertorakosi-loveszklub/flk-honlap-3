<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title',
        'file_path'
    ];

    protected $visible = [
        'title',
        'url',
    ];

    protected $appends = [
        'url',
    ];

    public function getUrlAttribute()
    {
        return url($this->file_path);
    }
}
