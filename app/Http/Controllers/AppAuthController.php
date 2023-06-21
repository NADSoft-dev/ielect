<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dirape\Token\Token;
use DB;
class AppAuthController extends Controller
{
   function login(Request $request){
    $data=$request->only(['username','password']);
    if(!isset($data['username']) || !$data['username'] || !isset($data['password']) || !$data['password']) return response()->json(['success'=>false,'error'=>'missing username or password'],403);
    $tables=[
        1=>'delegate',
        2=>'personal_list',
        3=>'workers'
    ];
    $userType=$data['password'][0];
    if(!isset($tables[$userType])) return response()->json(['success'=>false,'error'=>'wrong username or password'],403);
    $user=DB::table($tables[$userType])->where('iden',$data['username'])->where('password',$data['password'])->first();
    if(!$user) return response()->json(['success'=>false,'error'=>'wrong username or password'],403);
    unset($user->password);
    $token=(new Token())->Unique('users_token', 'token', 60);
    $user->token=$token;
    $user->userType=$userType;
    $insert=[
        'link_table'=>$tables[$userType],
        'link_id'=>$user->id,
        'token'=>$token,
    ];
    DB::table('users_token')->where('link_table',$tables[$userType])->where('link_id',$user->id)->delete();
    DB::table('users_token')->insert($insert);
    return response()->json($user);
   }


   function userInfo(Request $request){
        $user=$request->user;
       if($request->user->usertype==3){
        $user->kalfy_data=DB::table('ballot')->where('ballot_id',$user->kalfy)->first();
        $user->kalfy_data->voted=DB::table('electors')->where('AddCode',$user->kalfy)->where('voted',1)->count();
        $user->kalfy_data->total=DB::table('electors')->where('AddCode',$user->kalfy)->count();
       }


       if($request->user->usertype==1){
        $list=DB::table('personal_list')->where('under',$user->id)->count();
        $electors=DB::table('electors')->where('manid',$user->id)->count();
        $voted_electors=DB::table('electors')->where('manid',$user->id)->where('voted',1)->count();
       $user->total_electors=$electors;
       $user->total_voted_electors=$voted_electors;
       $user->total_personal_lists=$list;
       }
    return response()->json($request->user); 
   }


   function updateToken(Request $request){
    $user=$request->user;
    $tables=[
        1=>'delegate',
        2=>'personal_list',
        3=>'workers'
    ];

    $table=$tables[$user->usertype];
    $token=$request->get('onesignal_token');
    if(!$token) return response()->json(['success'=>false,'error'=>'missing onesignal_token field'],400);
    $data['onesignal_token']=$token;
    DB::table($table)->where('id',$user->id)->update($data);
    $user->onesignal_token=$token;
   
return response()->json($user); 
}

}
