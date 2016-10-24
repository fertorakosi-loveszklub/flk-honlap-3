<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\User;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Log;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class FacebookAuthController extends Controller
{
    public function login(LaravelFacebookSdk $facebookSdk)
    {
        $redirectUrl = $facebookSdk->getLoginUrl(['public_profile'], url('/facebook/callback'));
        return redirect($redirectUrl);
    }

    public function callback(LaravelFacebookSdk $facebookSdk)
    {
        // Obtain an access token.
        try {
            $token = $facebookSdk->getAccessTokenFromRedirect(url('/facebook/callback'));
        } catch (Exception $e) {
            Log::notice("Error during FB login, no token found.");
            return redirect('/');
        }

        if (! $token) {
            return redirect('/');
        }

        if (! $token->isLongLived()) {
            // OAuth 2.0 client handler
            $oauthClient = $facebookSdk->getOAuth2Client();

            // Extend the access token.
            try {
                $token = $oauthClient->getLongLivedAccessToken($token);
            } catch (Exception $e) {
                Log::notice("Can't obtain long-lived token.");
                return redirect('/');
            }
        }

        $response = $facebookSdk->get('/me?fields=id,name', $token);
        $fbUser = $response->getGraphUser();

        $user = User::createOrUpdateGraphNode($fbUser);

        Auth::login($user, true);

        return redirect('/');
    }

    public function saveName(Request $request)
    {
        auth()->user()->update(['custom_name' => $request->get('custom_name')]);

        return redirect()->back()->with('status', [
            'type' => 'success',
            'message' => 'Sikeresen megváltoztattad a neved.'
        ]);
    }
}
