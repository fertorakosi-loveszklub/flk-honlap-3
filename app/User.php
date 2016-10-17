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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
                $authorizer = new FacebookAuthorizer();
                return $authorizer->isAdmin($fbid);
            }
        );
    }

    public static function getByFacebookToken($token)
    {
        return Cache::remember(
            "user-by-fbid:$token",
            60 * 24 * 7,
            function () use ($token) {
                return static::where('facebook_token', $token)->first();
            }
        );
    }
}
