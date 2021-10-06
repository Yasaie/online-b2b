<?php

namespace App\Http\Middleware;

use App\Exceptions\PermissionException;
use App\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Laravel\Passport\Bridge\AccessToken;
use Laravel\Passport\Passport;

/**
 * Class    Permission
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-13
 *
 * @package App\Http\Middleware
 */
class Permission
{

    /**
     * @author  Payam Yasaie <payam@yasaie.ir>
     * @since   2019-11-13
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     * @throws AuthenticationException
     * @throws PermissionException
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::guard('api')->check()) {
            \Auth::shouldUse('api');
        } else {
            \Auth::login(User::find(1));
        }

        /** @var User $user */
        $user = \Auth::user();
        $route = $request->route()->getName();

        if (!$user->can($route)) {
            if ($user->hasRole('guest')) {
                throw new AuthenticationException();
            } else {
                throw new PermissionException();
            }
        }

        return $next($request);
    }
}
