<?php

namespace App\Http\Controllers;
use DB;
use GF;

use Request;
class ListController extends Controller
{
    function getAddTo(){
    return view('list.add_to');
    }


    function getPrint($type=false){
      $rows=DB::table('personal_list')->select('*')->get();
     return view('print.list')->with('rows',$rows)->with('title','רשימת פעילים');

    }
    function postCancel(){
      $data=Request::all();
      $ids=explode(',',$data['ids']);
      DB::table('electors')->whereIn('IDNumber', $ids)->update(['list'=>"",'manid'=>'']);
    }

    function postByDelegate(){
     $list=DB::table('personal_list')->where('under',Request::get('val'))->select('id','full_name as val')->get();
     return view('partials.helpers.select_options')->with('list',$list);
    }


    function getInfoPanel($id){
      $row=DB::table('personal_list')->where('id',$id)->first();
      return view('list.panel_info',compact(['row']));
    }


    function postSave($id){
      $data=Request::all();
      DB::table('personal_list')->where('id',$id)->update($data);
        return response('')->header('x-callback',"fireEvent('update:success');");
    }

    function getAdd(){
      return view('list.add');
    }


    function postAdd(){
      $data=Request::all();
      $data['password']=GF::randomPassword(2);
      DB::table('personal_list')->insert($data);
      return response('')->header('x-callback',"window.location.href='/#/list/all/';fireEvent('create:success');");
    }

    function postAddTo(){
      $data=Request::all();
      if(isset($data['full_name']) && $data['full_name']){
        $vars=config('list.create_pop');
        foreach($vars as $var) $theData[$var]=Request::get($var);
        $theData['password']=GF::randomPassword(2);
        $data['list']=DB::table('personal_list')->insertGetId($theData);
      }
        $list=DB::table('personal_list')->where('id',$data['list'])->first();
        $ids=explode(',',$data['ids']);



      DB::table('electors')->whereIn('IDNumber', $ids)->update(['list'=>$list->id,'manid'=>$list->under]);
      return response('')->header('x-callback',"$('.popover').popover('destroy');$('.selected').addClass('hasList').removeClass('selected');");
    }

    function getEdit($id){
      $row=DB::table('personal_list')->where('id',$id)->first();
      return view('list.edit')->with('row',$row);
    }
    function getAll(){
      if(session('is_admin')) $list=DB::table('personal_list')->select('*')->paginate(15);
      if(session('permission')==1) $list=DB::table('personal_list')->where('under',session('member')->id)->select('*')->paginate(15);
      if(session('permission')==2) return "";
      $list->withPath('/#/list/all/');
      return view('list.list')->with('rows',$list);
    }

    function getByDelegate($id){
      
      $list=DB::table('personal_list')->where('under',$id)->select('*')->paginate(15);
      $delegate=DB::table('delegate')->find($id);
      return view('list.list')->with('rows',$list)->with('delegate',$delegate);
    }

    function postUpdateField($id){
      $field=Request::get('field');
      $val=Request::get('val');
      DB::table('personal_list')->where('id',$id)->update([$field=>$val]);
    }


    function getDelete($id){

      return view('list.delete');
    }
}
