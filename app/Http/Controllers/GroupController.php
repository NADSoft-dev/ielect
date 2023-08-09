<?php

namespace App\Http\Controllers;
use DB;

use Request;
class GroupController extends Controller
{
    function getAddTo(){
    return view('group.add_to');
    }
    function getPrint($type=false){
      $rows=DB::table('groups')->select('*')->get();
     return view('print.group')->with('rows',$rows)->with('title','רשימת קבוצות');

    }

    function postCancel(){
      $data=Request::all();
      $ids=explode(',',$data['ids']);
      DB::table('electors')->whereIn('IDNumber', $ids)->update(['group'=>""]);
    }

    function getAdd(){
      $list=DB::table('groups')->select('*')->get();
      return view('group.add')->with('rows',$list);
    }

    function postComplete(){
      $data=DB::table('groups')->where('name','LIKE','%'.Request::get('q').'%')->select('name')->take('10')->get();

      $alldata=[];
      foreach($data as $val){
        $alldata[]=$val->name;
      }
      return response()->json(['data'=>$alldata]);
    }


    function postAdd(){
      $data=Request::all();
      // print_r($data);
      DB::table('groups')->insert($data);
      
      return response('')->header('x-callback',"window.location.href='/#/group/all/';fireEvent('create:success');");
    }


    function postSave($id){
      $data=Request::all();
      DB::table('groups')->where('id',$id)->update($data);
        return response('')->header('x-callback',"fireEvent('update:success');");
    }

    function getEdit($id){
      $row=DB::table('groups')->where('id',$id)->first();
      return view('group.edit')->with('row',$row);
    }
    function getEditsublist($id){
      $subid=DB::table('groups')->where('id',$id)->first();
      return view('group.editsublist')->with('subid',$subid);
    }
    function getSublist($id){
      $row=DB::table('groups')->where('id',$id)->first();
      return view('group.sublist')->with('row',$row);
    }



  
    function postAddTo(){
      $data=Request::all();
      if(isset($data['name'])){
        unset($data['group']);
        $ids=$data['ids'];
        unset($data['ids']);
        $group=DB::table('groups')->insertGetId($data);
        $data['group']=$group;
        $data['ids']=$ids;
      }

      $ids=explode(',',$data['ids']);
      DB::table('electors')->whereIn('IDNumber', $ids)->update(['group'=>$data['group']]);
      return response('')->header('x-callback',"$('.popover').popover('destroy');$('.selected').addClass('hasList').removeClass('selected');");
    }

    function getAll(){
      $list=DB::table('groups')->select('*')->where('category_id',null)->OrWhere('category_id',0)->get();
      return view('group.list')->with('rows',$list);
    }


}
