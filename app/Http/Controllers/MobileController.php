<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Session;

class MobileController extends Controller
{
    public function getMain()
    {
        return view('mobile.main');
    }

    public function postSaveVote(Request $request)
    {
        $serial = $request->get('serial');
        $kalfy = Session::get('memberMobile')->kalfy;
        if ($serial > 0) {
            DB::table('electors')->where('serial', $serial)->where('AddCode', $kalfy)->update(['voted' => 1]);
        }
        return response('')->header('x-callback', '$(".SerialinPUT").val("");successAlert();');
    }

    public function postGetVotes(Request $request)
    {
       
        $kalfy = Session::get('memberMobile')->kalfy;
        $votes = DB::table('votes_links')->where('kalfy', $kalfy)->select('*')->get();
        return response()->json($votes);
      

    }

    public function postSaveVotes(Request $request)
    {
        $all = $request->all();
        $kalfy = $all['kalfy'];
        $table = $all['link_table'];
        unset($all['kalfy']);
        unset($all['link_table']);
        foreach ($all as $key => $value) {
            $u = [];
            if($value<1) continue;
            $u['linkId'] = $key;
            $u['link_table'] = $table;
            $u['kalfy'] = $kalfy;
            $user = \App\LinksVotes::firstOrNew($u);
            $user->votes = $value;
            $user->save();

        }

        return ($all);
        DB::table('votes_links')->where('kalfy', $all['kalfy'])->where('linkId', $all['linkId'])->where('link_table', $all['link_table'])->update(['votes' => $all['votes']]);
        return response('')->header('x-callback', 'successAlert();');
    }

}
