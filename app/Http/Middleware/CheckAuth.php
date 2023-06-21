<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;
use DB;
class CheckAuth
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


        if(Session::get('logged')){





        
          return $next($request);

        }else{
          $seg=$request->segments();
          $seg=implode('-',$seg);

          if($seg=="app-questions-check-connection") return response()->json(['success'=>false]);
          if($request->ajax()) return response('<script>window.location.href="/logout";</script>');
          return Redirect::to('/login');
        }

    }
}
