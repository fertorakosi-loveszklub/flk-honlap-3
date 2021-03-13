<?php

namespace App\Http\Middleware;

use Closure;

class RedirectToJam
{
    public function handle($request, Closure $next)
    {
        return redirect()->to('https://www.fertorakosi-loveszklub.hu');
    }
}
