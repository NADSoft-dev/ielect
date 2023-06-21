<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request as Requests;
use GF;
use Request;
class DelegateController extends Controller
{


    function postSave($id){
      $data=Request::all();
      DB::table('delegate')->where('id',$id)->update($data);
      $delegate=DB::table('delegate')->select('full_name','iden','phone','cell','email','listid')->first();
      $delegate=(array)$delegate;
      $listid=$delegate['listid'];
      unset($delegate['listid']);
      DB::table('personal_list')->where('id',$listid)->update($delegate);

        return response('')->header('x-callback',"fireEvent('update:success');");
    }

    function getAdd(){
      return view('delegate.add');
    }

    function getListApp(Requests $request){
      $user=$request->user;
      if($user->usertype!=1){
        return response()->json(['success'=>false,'error'=>'no permissions'],403);
      }
      $list=DB::table('personal_list')->where('under',$user->id)->select(['id', 'full_name', 'iden', 'phone', 'cell', 'email', 'city', 'counter'])->get();
      $allList=[];
      foreach($list as $row){
        $row->counter=DB::table('electors')->where('list',$row->id)->count();
        $allList[]=$row;
      }
      return response()->json($allList);
      
    }

    function postUpdateField($id){
      $field=Request::get('field');
      $val=Request::get('val');
      DB::table('delegate')->where('id',$id)->update([$field=>$val]);
    }


    function getInfoPanel($id){
      $row=DB::table('delegate')->where('id',$id)->first();
      return view('delegate.panel_info',compact(['row']));
    }




    function getPrint($type=false){
      $rows=DB::table('delegate')->select('*')->get();
     return view('print.delegate')->with('rows',$rows)->with('title','רשימת אחראיים');

    }


    function postAdd(){
      $data=Request::all();
      $data2=Request::except('statistics','elections_day');
      $data2['password']=GF::randomPassword(2);
      $data['password']=GF::randomPassword(1);
      
      $id=DB::table('personal_list')->insertGetId($data2);
      $data['listid']=$id;
      
      $manid=DB::table('delegate')->insertGetId($data);
      DB::table('personal_list')->where('id',$id)->update(['under'=>$manid]);
      return response('')->header('x-callback',"window.location.href='/#/delegate/all/';fireEvent('create:success');");
    }

    function postAddTo(){
      $data=Request::all();
      if(isset($data['full_name']) && $data['full_name']){
        unset($data['list']);
        DB::table('delegate')->insert($data);
      }else{

        $ids=explode(',',$data['ids']);
        DB::table('electors')->whereIn('IDNumber', $ids)->update(['list'=>$data['list']]);
      }
      return response('')->header('x-callback',"$('.popover').popover('destroy');$('.selected').addClass('hasList').removeClass('selected');");
    }

    function getEdit($id){
      $row=DB::table('delegate')->where('id',$id)->first();
      return view('delegate.edit')->with('row',$row);
    }
    function getAll(){
      $list=DB::table('delegate')->select('*')->paginate(15);
      $list->withPath('/#/delegate/all/');
      return view('delegate.list')->with('rows',$list);
    }


    function getDelete($id){

      return view('delegate.delete');
    }
}
