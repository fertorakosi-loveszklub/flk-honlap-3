<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Imgur\Client;

class Gallery extends Model
{
    use Sluggable,
        SluggableScopeHelpers;

    protected $fillable = [
        'title',
        'description',
        'imgur_url'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getImgurIdAttribute()
    {
        $url = parse_url($this->imgur_url, PHP_URL_PATH);
        $pathParts = explode('/', $url);

        return $pathParts[count($pathParts) - 1];
    }

    public function getCoverImageUrlAttribute()
    {
        $client = app(Client::class);
    }
}
