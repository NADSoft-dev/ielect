<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class CheckAppAuth
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
        $tables=[
            'delegate'=>1,
            'personal_list'=>2,
            'workers'=>3,
        ];
        if(!$request->hasHeader('token')){
            return response()->json(['success'=>false,'error'=>'no token!'],403);
        }
        $token=$request->header('token');
        $user=DB::table('users_token')->where('token',$token)->first();
        if(!$user){
            return response()->json(['success'=>false,'error'=>'wrong token!'],403); 
        }
        $table=$user->link_table;
        $user=DB::table($user->link_table)->where('id',$user->link_id)->first();
        if(!$user){
            return response()->json(['success'=>false,'error'=>'user not found!'],403); 
        }
        unset($user->password);
        $user->usertype=$tables[$table];
        $request->user=$user;
        return $next($request);
    }
}
