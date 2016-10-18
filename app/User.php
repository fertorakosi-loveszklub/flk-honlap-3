<?php

namespace App;

use App\Utilities\FacebookAuthorizer;
use Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;

class User extends Authenticatable
{
    use Notifiable;
    use SyncableGraphNodeTrait;

    public static $graph_node_field_aliases = [
        'id' => 'facebook_user_id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'custom_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        $fbid = $this->facebook_user_id;

        return Cache::remember(
            "is-admin:$fbid",
            60 * 24,
            function () use ($fbid) {
                $authorizer = App(FacebookAuthorizer::class);
                return $authorizer->isAdmin($fbid);
            }
        );
    }

    public function getNameAttribute()
    {
        if ($this->custom_name) {
            return $this->custom_name;
        }

        return $this->attributes['name'];
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }
}
