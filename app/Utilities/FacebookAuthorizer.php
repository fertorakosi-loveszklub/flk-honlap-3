<?php
namespace App\Utilities;

use App\Exceptions\FacebookRequestException;
use Facebook\Authentication\AccessToken;
use Facebook\GraphNodes\GraphEdge;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Session;

/**
 * Class responsible for authorization with Facebook.
 */
class FacebookAuthorizer
{
    /**
     * The Facebook SDK object.
     *
     * @var \SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
     */
    private $fb;

    /**
     * Initializes a news instance of the FacebookAuthenticator class.
     *
     * @param \SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb Facebook SDK.
     */
    public function __construct(LaravelFacebookSdk $fb)
    {
        $this->fb = $fb;
    }

    /**
     * Checks if the user with the given ID has admin rights.
     *
     * @param integer   $userId User ID.
     *
     * @return boolean A value indicating whether the user with
     *                 the given ID is an admin.
     */
    public function isAdmin($userId)
    {
        $roles = collect($this->getUsers()->all());

        return $roles
            ->where('user', $userId)
            ->where('role', 'administrators')
            ->count() == 1;
    }

    /**
     * Gets the list of all users in the current application and their roles.
     *
     * @return GraphEdge
     */
    public function getUsers()
    {
        try {
            $appId = env('FACEBOOK_APP_ID');
            $appSecret = env('FACEBOOK_APP_SECRET');

            // Set app access token
            $token = new AccessToken("$appId|$appSecret");

            // Get roles
            $response = $this->fb->get("$appId/roles", $token);
            $users = $response->getGraphEdge();
        } catch (\Exception $e) {
            throw new FacebookRequestException();
        }

        return $users;
    }
}
