<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class    Localization
 *
 * @author  Payam Yasaie <payam@yasaie.ir>
 * @since   2019-11-16
 *
 * @package App\Http\Middleware
 */
class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        header(base64_decode('WC1Qb3dlcmVkLUJ5OiBQYXlhbSBZYXNhaWUgKHd3dy55YXNhaWUuaXIp'));
        preg_match('/(\w*),?/', $request->header('Accept-Language'), $match);

        $locale = $match[1] ?: \App::getLocale();

        if ($request->lang) {
            $locale = $request->lang;
        }

        \App::setLocale($locale);
        $response = $next($request);
        $response->headers->set('Content-Language', \App::getLocale());

        return $response;
    }
}
