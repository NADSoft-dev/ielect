<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use GF;
class PageController extends Controller
{

  function getSettings(){
    $settings=DB::table('settings')->where('name','app')->first();
    if(!$settings) $settings=SELF::generateSettings('app');
    $settings=(array)$settings;
    return view('pages.settings')->with('row',$settings);
  }

  function getParties(){
    $list=DB::table('parties')->select('*')->get();
    return view('parties.list')->with('rows',$list);
  }


  function getPartiesAdd(){
    return view('parties.add');
  }

  function postPartiesAdd(Request $request){
    
      $data=$request->all();
      DB::table('parties')->insert($data);
      return response('')->header('x-callback',"window.location.href='/#/page/parties/';fireEvent('create:success');");
   
  }

  function getPartiesEdit($id){
   
      $row=DB::table('parties')->where('id',$id)->first();
      return view('parties.edit')->with('row',$row);

  }


  function postPartiesSave(Request $request,$id){
    $data=$request->all();
    DB::table('parties')->where('id',$id)->update($data);
      return response('')->header('x-callback',"fireEvent('update:success');");
  }


  function postSettings(Request $request){
    $data=$request->all();
    SELF::generateSettings('app',$data);
    return response('')->header('x-callback',"fireEvent('update:success');");
  }

  

  function postUpload(Request $request){

    if ($request->file('image')->isValid()) {

          $imageName = time().'.'.request()->image->getClientOriginalExtension();
         request()->image->move(public_path('uploads'), $imageName);
         return response()->json(['image'=>'/uploads/'.$imageName]);
}
  }


function postFamilyJoin(Request $request){
  $all=$request->all();
  $new=rawurldecode($all['new']);
  $old=rawurldecode($all['old']);
  $old=explode(',',$old);
  $query=DB::table('electors')->where('FamilyName','LIKE',$old[0]);
  unset($old[0]);
  foreach($old as $v){
    $query=$query->orWhere('FamilyName','LIKE',$v);
  }
  $query->update(['familyName'=>$new]);
  return response()->json($all);
}

function postResetPassword($table,$id){
  if($table=='delegate') $data['password']=GF::randomPassword(1);
  if($table=='personal_list') $data['password']=GF::randomPassword(2);
  if($table=='workers') $data['password']=GF::randomPassword(3);
  DB::table($table)->where('id',$id)->update($data);
}

function postFamilyJoinReset(Request $request){
  $all=$request->all();
  $old=rawurldecode($all['old']);
  $query=DB::table('electors')->where('originalFamilyName','LIKE',$old)->update(['familyName'=>$old]);
  return response()->json($all);
}

function getFamilyJoin(){
return view('pages.family_merge');
}


function getFamilyJoinReset(){
  return view('pages.family_merge_reset');
  }

  function generateSettings($key,$value=false){
    if(!$value){
      $value=json_encode([]);
      $data['name']=$key;
      $data['data']=$value;
      DB::table('settings')->insert($data);
    }else{
      $value=json_encode($value);
    $data['data']=$value;
    DB::table('settings')->where('name',$key)->update($data);
    $data['name']=$key;
  }

    return $data;
  }

  function dashboard(){
    return view('pages.dashboard_page');

  }

  

  function getWorkers(){

    return view('pages.workers');
  }

  function getWorkerEdit($id){
    $row=DB::table('workers')->where('id',$id)->first();
    return view('pages.worker_edit')->with('row',$row);;
  }

  function postWorkerEdit(Request $request,$id){
    $all=$request->all();
    $count=DB::table('workers')->where('kalfy',$all['kalfy'])->where('shift',$all['shift'])->count();
    if($count>=2) return response('')->header('x-callback',"fireEvent('max:worker')");
    $id=DB::table('workers')->where('id',$id)->update($all);
    return response('')->header('x-callback',"window.location.href='/#/page/workers/';fireEvent('create:success');");
  }

  function postWorkers(Request $request){
    $all=$request->all();
    $all['password']=GF::randomPassword(3);
    $count=DB::table('workers')->where('kalfy',$all['kalfy'])->where('shift',$all['shift'])->count();
    if($count>=2) return response('')->header('x-callback',"fireEvent('max:worker')");
    $id=DB::table('workers')->insertGetId($all);
    $all['id']=$id;

    $view=view('partials.elements.worker_row')->with('row',$all)->render();
    $data['html']=$view;
    $data['kalfy']=$all['kalfy'];
    $data['shift']=$all['shift'];
    $data=json_encode($data);
    return response('')->header('x-callback',"fireEvent('create:worker',{$data});");
  }

  function getSendSms(){
    return view('pages.send_sms');
  }

  function getPartiesApp(){
    $parties=DB::table('parties')->select('*')->get();
    return response()->json($parties);
  }

  function getMayorsApp(){
    $parties=DB::table('mayors')->select('*')->get();
    return response()->json($parties);
  }


  function setCountedVotes(Request $request){
    $all=$request->all();
    $user=$request->user;
    if($all['type']!="mayors" && $all['type']!="parties") return response()->json([],404);
    DB::table('votes_links')->where('kalfy',$user->kalfy)->where('linkId',$all['id'])->where('link_table',$all['type'])->update(['votes'=>$all['votes']]);
    return response('success');
  }
}
