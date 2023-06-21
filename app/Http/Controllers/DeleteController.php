<?php

namespace App\Http\Controllers;
use DB;

use Request;
class DeleteController extends Controller
{

    function deleteList($id){
      DB::table('personal_list')->where('id',$id)->delete();
    return response('')->header('x-callback',"fireEvent('delete:success',[{'id':$id}]);");
    }
    function getList($id){
      return view('delete.confirm');
    }


    function getWorker($id){
      return view('delete.confirm');
    }

    function getParties($id){
      return view('delete.confirm');
    }



    function deleteParties($id){
      DB::table('parties')->where('id',$id)->delete();
    return response('')->header('x-callback',"fireEvent('delete:success',[{'id':$id}]);");
    }
    function deleteWorker($id){
      DB::table('workers')->where('id',$id)->delete();
    return response('')->header('x-callback',"fireEvent('delete:success',[{'id':$id}]);updateWorkerList();");
    }

    function deleteMayor($id){
      DB::table('mayors')->where('id',$id)->delete();
    return response('')->header('x-callback',"fireEvent('delete:success',[{'id':$id}]);");
    }
    function getMayor($id){
      return view('delete.confirm');
    }




    function deleteDelegate($id){
      DB::table('delegate')->where('id',$id)->delete();
    return response('')->header('x-callback',"fireEvent('delete:success',[{'id':$id}]);");
    }
    function getDelegate($id){
      return view('delete.confirm');
    }




    function deleteGroup($id){
      DB::table('groups')->where('id',$id)->delete();
    return response('')->header('x-callback',"fireEvent('delete:success',[{'id':$id}]);");
    }
    function getGroup($id){
      return view('delete.confirm');
    }



}
