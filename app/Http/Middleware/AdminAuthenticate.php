<?php

namespace App\Http\Middleware\Admin;

use Closure;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $this->isAuthenticated() ? $next($request) : $this->getBasicAuthenticateResponse();
    }

    private function isAuthenticated()
    {
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            return false;
        }
        $user = \Config::get('admin.user', 'tx');
        $password = \Config::get('admin.password', 'AB4LmeJJ86gftUnwt74nY4fCtVGvAupqirzW');
        if ($_SERVER['PHP_AUTH_USER'] === $user && $_SERVER['PHP_AUTH_PW'] === $password) {
            return true;
        }

        return false;
    }

    private function getBasicAuthenticateResponse()
    {
        $headers = ['WWW-Authenticate' => 'Basic'];

        return response('Invalid credentials.', 401, $headers);
    }
}
