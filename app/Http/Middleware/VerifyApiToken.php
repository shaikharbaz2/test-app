<?php
namespace App\Http\Middleware;

use App\Exceptions\TokenMismatchException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class VerifyApiToken
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     * @throws \App\Exceptions\TokenMismatchException
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->verify($request)) {
            return $next($request);
        }

        throw new TokenMismatchException;
    }

    /**
     * Verify token by querying database for existence of the client:token pair specified in headers.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public function verify($request): bool//optional return types

    {
        return User::select('id')->where([ // add select so Eloquent does not query for all fields
            'token' => $request->header('token'), // remove variable that is used only once
        ])->exists();
    }
}
