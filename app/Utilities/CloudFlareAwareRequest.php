<?php
/**
 * Created by Feki Webstudio - 2016. 06. 17. 8:03
 * @author Zsolt
 * @copyright Copyright (c) 2016, Feki Webstudio Kft.
 */

namespace App\Utilities;

use Illuminate\Http\Request;

/**
 * Class CloudFlareAwareRequest is a subclass of Illuminate\Http\Request
 * that also checks for the headers set by CloudFlare's SSL proxy
 * to determine whether the incoming request is secure.
 *
 * @package App\Utilities
 *
 * @see http://www.code-examples.com/laravel-5-ssl-routes-behind-a-load-balancer/
 */
class CloudFlareAwareRequest extends Request
{
    /**
     * @inheritdoc
     */
    public function isSecure()
    {
        $isSecure = parent::isSecure();

        if ($isSecure) {
            return true;
        }

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            return true;
        } else {
            if (
                !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ||
                !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'
            ) {
                return true;
            }
        }

        return false;
    }
}
