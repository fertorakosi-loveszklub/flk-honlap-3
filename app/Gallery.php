<?php

namespace App;

use Cache;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Imgur\Api\Model\Album;
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
        return 'https://i.imgur.com/' . $this->getAlbumObject()->getCover() . '.jpg';
    }

    public function getImages()
    {
        return $this->getAlbumObject()->getImages();
    }

    /**
     * Gets the album object from Imgur.
     *
     * @return Album
     */
    protected function getAlbumObject()
    {
        return Cache::remember("album-obj:{$this->id}", 3600, function () {
            $client = app(Client::class);
            $album = $client->api('album')->album($this->imgur_id);
            return $album;
        });
    }
}
