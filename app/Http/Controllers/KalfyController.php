<?php

namespace App\Http\Controllers;
use DB;

use Request;
class KalfyController extends Controller
{
  function getList(){
    $rows=DB::table('ballot')->select('*')->get()->toArray();
    return view('ballot.list')->with('rows',$rows);
  }


  function getPrint($type=false){
    $rows=DB::table('ballot')->select('*')->get();
   return view('print.ballot')->with('rows',$rows)->with('title','רשימת קלפיות');

  }

  function getEdit($id){
    $row=DB::table('ballot')->where('id',$id)->select('*')->first();

    return view('ballot.edit')->with('row',$row);
  }

  function postSave($id){
    $data=Request::all();
    DB::table('ballot')->where('id',$id)->update($data);
      return response('')->header('x-callback',"fireEvent('update:success');");
  }
}
