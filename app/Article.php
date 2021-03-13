<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Date\Date;

class Article extends Model
{
    use SoftDeletes,
        Sluggable;

    protected $fillable = [
        'title',
        'lead',
        'content',
        'published_at',
        'is_visible'
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

    public function getPublicationAttribute()
    {
        return new Date($this->published_at);
    }

    public function getPublicationDateAttribute()
    {
        return $this->published_at->format('Y-m-d');
    }

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = new Carbon($date);
    }

    public function getModificationDateAttribute()
    {
        if ($this->updated_at > $this->published_at) {
            return $this->updated_at;
        }

        return $this->published_at;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query
            ->where('published_at', '<=', Carbon::now())
            ->where('is_visible', true);
    }

    public function toArray()
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'published_at' => [
                'iso' => $this->published_at->format('Y-m-d'),
                'formatted' => $this->publication->format('Y. F j.'),
            ],
            'short_lead' => str_limit($this->lead, 250),
            'lead' => $this->lead,
            'content' => $this->content,
            'author' => empty($this->author) ? null : [
                'name' => $this->author->name,
                'facebook_user_id' => $this->author->facebook_user_id,
            ],
        ];
    }
}
