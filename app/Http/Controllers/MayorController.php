<?php

namespace App\Http\Controllers;
use DB;

use Request;
class MayorController extends Controller
{
    function getAddTo(){
    return view('mayor.add_to');
    }
   
    function postCancel(){
      $data=Request::all();
      $ids=explode(',',$data['ids']);
      DB::table('electors')->whereIn('IDNumber', $ids)->update(['mayor'=>""]);
    }

    function postSupport($id){
      DB::table('mayors')->update(['support'=>0]);
      DB::table('mayors')->where('id',$id)->update(['support'=>1]);
      return response('success')->header('x-callback',"fireEvent('update:success');");
    }



    function postSave($id){
      $data=Request::all();
      DB::table('mayors')->where('id',$id)->update($data);
        return response('')->header('x-callback',"fireEvent('update:success');");
    }



    function getAdd(){
      return view('mayor.add');
    }


    function postAdd(){
      $data=Request::all();
      DB::table('mayors')->insert($data);
      return response('')->header('x-callback',"window.location.href='/#/mayor/all/';fireEvent('create:success');");
    }

    function postAddTo(){
      $data=Request::all();
      if(isset($data['full_name'])){
        unset($data['mayor']);
        $ids=$data['ids'];
        unset($data['ids']);
        $group=DB::table('mayors')->insertGetId($data);
        $data['mayor']=$group;
        $data['ids']=$ids;
      }

      $ids=explode(',',$data['ids']);
      DB::table('electors')->whereIn('IDNumber', $ids)->update(['mayor'=>$data['mayor']]);
      return response('')->header('x-callback',"$('.popover').popover('destroy');$('.selected').removeClass('selected');");
    }




    function getEdit($id){
      $row=DB::table('mayors')->where('id',$id)->first();
      return view('mayor.edit')->with('row',$row);
    }
    function getAll(){
      $list=DB::table('mayors')->select('*')->get();
      return view('mayor.list')->with('rows',$list);
    }
}
