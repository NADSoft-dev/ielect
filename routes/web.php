<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('find',function(){
  return view('mobile.find');
});

Route::get('find/{id}',function($id){
  return view('mobile.found')->with('IDNumber',$id);
});
Route::group(['middleware' => ['app'],'prefix'=>'mobile'], function () {
  Route::get('/login',function(){
  return view('mobile.login');
  
  });
  
  Route::get('/logout', function () {
    Session::flush();
      return Redirect::to('/mobile/login');
  });
  
  Route::post('/login',function(){
    $worker=DB::table('workers')->where('iden',Request::get('username'))->where('password',Request::get('password'))->first();
  
    if($worker){
      Session::put('loggedMobile',true);
      Session::put('memberMobile',$worker);
      return Redirect::to('/mobile');
    }else{
      return Redirect::to('/mobile/login')->withErrors('error!');
    }
  
  });
  
  
  Route::get('/', function () {
      return Redirect::to('/mobile/page/main');
  });
  AdvancedRoute::controller('page', 'MobileController');
  });

  
Route::get('/login', function () {
    return view('pages.login');
});

Route::post('/login',function(){
  $username=Request::get('username');
  if(is_numeric($username)){
    $data=Request::only(['username','password']);
    $tables=[
      1=>'delegate',
      2=>'personal_list',
  ];
  $userType=$data['password'][0];
  $user=DB::table($tables[$userType])->where('iden',$data['username'])->where('password',$data['password'])->first();
  if($user){
    $user->username=$user->full_name;
  Session::put('permission',$userType);
  Session::put('is_admin',false);
  Session::put('logged',true);
  
  Session::put('member',$user);
  return Redirect::to('/');
  }
  return Redirect::to('/login')->withErrors('error!');
   
    die;
  }
  $member=DB::table('members')->where('username',Request::get('username'))->first();
  if($member){
    $hash=$member->hash;
    $hash = substr(base64_decode($hash),13);
    $valid = Google2FA::verifyKey($hash, Request::get('password'));
    if($valid){
    Session::put('logged',true);
    Session::put('member',$member);
    Session::put('is_admin',true);

    return Redirect::to('/');
}else{
  return Redirect::to('/login')->withErrors('error!');
}

  }else{
    return Redirect::to('/login')->withErrors('error!');
  }

});


Route::get('/logout', function () {
  Session::flush();
    return Redirect::to('/login');
});


Route::group(['middleware' => ['admin']], function () {
  Route::get('/', function () {
      return view('pages.dashboard');
  });
  Route::get('/main','PageController@dashboard');
  AdvancedRoute::controller('stats', 'StatisticsController');
  AdvancedRoute::controller('page', 'PageController');
  AdvancedRoute::controller('list', 'ListController');
  AdvancedRoute::controller('delegate', 'DelegateController');
  AdvancedRoute::controller('delete', 'DeleteController');
  AdvancedRoute::controller('group', 'GroupController');
  AdvancedRoute::controller('mayor', 'MayorController');
  AdvancedRoute::controller('electors', 'ElectorsController');
  AdvancedRoute::controller('kalfy', 'KalfyController');
  AdvancedRoute::controller('sms', 'SmsController');

});
