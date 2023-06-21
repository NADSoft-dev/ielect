<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;
use DB;
use Config;
class CheckAuthMobile
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

        if($request->path()=='mobile/login') return $next($request);
        if(Session::get('loggedMobile')){





          return $next($request);

        }else{
          $seg=$request->segments();
          $seg=implode('-',$seg);

          if($seg=="app-questions-check-connection") return response()->json(['success'=>false]);
          if($request->ajax()) return response('<script>window.location.href="/mobile/logout";</script>');
          return Redirect::to('/mobile/login');
        }

    }
}
