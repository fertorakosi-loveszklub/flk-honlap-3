<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes,
        Sluggable;

    protected $fillable = [
        'title',
        'lead',
        'content',
        'published_at'
    ];

    protected $dates = [
        'published_at'
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
                'source' => ['publication_date', 'title']
            ]
        ];
    }

    public function getPublicationDateAttribute()
    {
        return $this->published_at->format('Y-m-d');
    }

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = new Carbon($date);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }
}
