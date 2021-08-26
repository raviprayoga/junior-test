<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Timezone
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
        $route = $request->route();
        $timezone = request('change_timezone');

        if ($timezone) {
            session()->put('timezone', $timezone);
            Config::set('app.timezone', $timezone);

            // return redirect(route($route->getName()));
        } elseif (session('timezone')) {
            $timezone = session('timezone');
            Config::set('app.timezone', Session::get('timezone'));
        } else {

            session()->put('timezone', 'Asia/Jakarta');
            Config::set('app.timezone', 'Asia/Jakarta');
        }

        return $next($request);
    }
}
