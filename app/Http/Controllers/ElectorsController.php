<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Http\Request as Requests;
use DB;
use Session;
use Excel;
class ElectorsController extends Controller
{
    //

    function getMain($field=false,$val=false){
      $data['field']=$field;
      $data['val']=$val;
      return view('electors.main')->with('data',$data);
    }
    

    function getElectionsDayLists(){
      $allLists=[];
      $lists=DB::table('personal_list')->select('*')->get();
      foreach($lists as $list){
        $theList=(array)$list;

        $stats=DB::table('electors')->where('list',$list->id)->select(DB::raw('COUNT(`id`) as total'),DB::raw('SUM(if(`voted`=1,1,0)) as `voted`'))->first();
        $theList['total']=$stats->total;
        $theList['voted']=$stats->voted;
        if($stats->total>0){
        $theList['votedPer']=($stats->voted/$stats->total)*100;
        }else{
          $theList['votedPer']=0;
        }
        $theList['votedPer']=round($theList['votedPer'],2);
        $allLists[]=$theList;

      }
      $allLists=collect($allLists)->sortBy('votedPer')->reverse()->toArray();

      return view('electors.elections_day_lists')->with('rows',$allLists);
    }
    function getUnvote(){
      return view('electors.unvote');
    }

    function postUnvote(){
      $ids=Request::get('ids');
      // print_r($ids);
      $ids=explode(',',$ids);
      if(count($ids)>0){
      DB::table('electors')->whereIn('IDNumber',$ids)->update(['voted'=>0]);
      }
      return response('')->header('x-callback',"fireEvent('update:success');$('.filterElectors').click();");
    }

    function getElectionsDayKalfy(){
      $allLists=[];
      $lists=DB::table('ballot')->select('*')->get();
      foreach($lists as $list){
        $theList=(array)$list;

        $stats=DB::table('electors')->where('AddCode',$list->ballot_id)->select(DB::raw('COUNT(`id`) as total'),DB::raw('SUM(if(`voted`=1,1,0)) as `voted`'))->first();
        $theList['total']=$stats->total;
        $theList['voted']=$stats->voted;
        $theList['votedPer']=($stats->voted/$stats->total)*100;
        $theList['votedPer']=round($theList['votedPer'],2);
        
        $allLists[]=$theList;

      }
      $allLists=collect($allLists)->sortBy('votedPer')->reverse()->toArray();

      return view('electors.elections_day_kalfy')->with('rows',$allLists);
    }

    function markVoted(Requests $request){
      $user=$request->user;
      if($user->usertype!=3){
        return response()->json(['success'=>false,'error'=>'no permissions'],403);
      }
      $serials=$request->get('serials');
      DB::table('electors')->where('AddCode',$user->kalfy)->whereIn('serial',$serials)->update(['voted'=>1]);
     $voted=DB::table('electors')->where('AddCode',$user->kalfy)->where('voted',1)->count();
     return response()->json(['totalVoted'=>$voted]);
    }
    function postSetVote(){
      $by=Request::get('by');
      if($by=="serial"){
      DB::table('electors')->where('AddCode',Request::get('AddCode'))->where('serial',Request::get('serial'))->update(['voted'=>1]);

      }else if($by=="id"){
        DB::table('electors')->where('IDNumber',Request::get('IDNumber'))->update(['voted'=>1]);
      }
        return response('')->header('x-callback','$(".resetBtn").click();$(".tab-pane.active").find("input:first").focus();');


    }

    function getVoted(){
      return view('electors.voted');
    }

    function getElectionsDay(){
      return view('electors.election_day');
    }

    function getElectionsDayFinal(){
      return view('electors.election_day_final');
    }

    function getElectionsDayFinalTotal($table){
      $select['mayors']='mayors.full_name as name';
      $select['parties']='parties.name';

      $rows=DB::table('votes_links')->where('link_table',$table)->groupBy('linkId')->join($table,$table.'.id','=','votes_links.linkId')->select($select[$table],DB::Raw('sum(votes_links.votes) as total'),'linkId')->get();
      return view('electors.final_table')->with('rows',$rows)->with('table',$table);

    }

    function getFinalPop($table,$id){
      $select['mayors']='mayors.full_name as name';
      $select['parties']='parties.name';

      $rows=DB::table('votes_links')->where('link_table',$table)->where('linkId',$id)->groupBy('kalfy')->join($table,$table.'.id','=','votes_links.linkId')->select($select[$table],DB::Raw('sum(votes_links.votes) as total'),'linkId','kalfy')->get();
      return view('electors.final_pop')->with('rows',$rows);
    }


    function postSave($id){
      $data=Request::all();
      DB::table('electors')->where('IDNumber',$id)->update($data);
      if($data['couple']) DB::table('electors')->where('IDNumber',$data['couple'])->update(['couple'=>$id]);
        return response('')->header('x-callback',"fireEvent('update:success');");
    }

    function postUpdateField($id){

      $field=Request::get('field');
      $val=Request::get('val');
      DB::table('electors')->where('id',$id)->update([$field=>$val]);
    }

    function buildQuery($filter){
      $electors=DB::table('electors');
      if(session('permission')==1){
        $electors=$electors->where(function ($query) {
          $query->where('electors.manid',session('member')->id)
                ->orWhere('electors.manid', '0')->orWhereNull('electors.manid');
      });
      }

      if(session('permission')==2){
        $electors->whereRaw('electors.list = '.session('member')->id);
       
      }
      $onlyFamilyname=false;
      foreach($filter as $key=>$f){
       
        if($f['name']=="onlyFamilyName"){
          
          $onlyFamilyname=$f['value'];
          unset($filter[$key]);
          break;
        }
        
      }
    

      foreach($filter as $f){
      

        if ($f['name'] == "orderBy") {
          $f['value'] = explode("|", $f['value']);
      }
      if($f['name']=='voted'&& $f['value']==2) $f['value']=0;

        switch($f['name']){
          case "haslist":
         
            if($f['value']==1) $electors->whereRaw('electors.list > 0');
            else{
              $electors->where(function ($query) {
                $query->where('list', 0)
                      ->orWhereNull('list');
            });
            }
          break;


          case "hasgroup":
         
            if($f['value']==1) $electors->whereRaw('electors.group > 0');
            else{
              $electors->where(function ($query) {
                $query->where('group', 0)
                      ->orWhereNull('group');
            });
            }
          break;


          case "orderBy":

                    if (count($f['value']) < 1 || strlen($f['value'][0]) < 3) {
                        continue 2;
                    }

                    foreach ($f['value'] as $v) {
                        list($b, $a) = explode(':', $v);

                        $electors = $electors->orderBy($b, $a);

                    }

                    break;


          case "birthYear_from":
            $electors->whereRaw('electors.birthYear >='."'".$f['value']."'");
          break;

         
          case "birthYear_to":
            $electors->whereRaw('electors.birthYear <='."'".$f['value']."'");
          break;


          case "AddCode_from":
            $electors->whereRaw('electors.AddCode >='."'".$f['value']."'");
          break;

          case "AddCode_to":
            $electors->whereRaw('electors.AddCode <='."'".$f['value']."'");
          break;
          case "FamilyName":
          if($onlyFamilyname){
            $electors->where('electors.'.$f['name'],'LIKE',$f['value']);
            //$electors->whereRaw('(electors.FamilyName ='.'"'.$f['value'].'")');
          }else{
            $electors->whereRaw('(electors.FamilyName ='.'"'.$f['value'].'" OR electors.originalFamilyName="'.$f['value'].'")');
          }
            
          break;

          case "group":
            $all_sub=DB::table('groups')->where('category_id',$f['value'])->get();
          
            $all_array_sub=[];
            
            foreach($all_sub as $sub){
              array_push($all_array_sub,$sub->id);
            }
            $sub_sub=DB::table('groups')->whereIn('category_id',$all_array_sub)->get();
            foreach($sub_sub as $sub2){
              array_push($all_array_sub,$sub2->id);
            }
            // print_r($all_array_sub);
            $electors=$electors->orWhereIn('electors.group',$all_array_sub);
            break;


          default:
          $electors->where('electors.'.$f['name'],'LIKE',$f['value']);
          break;

        }
        
      }
      return $electors;
    }

    function getPrint($type=false){
      $filter=Request::cookie('electorsFilter');
      $filter=json_decode($filter,true);
      $listFields=Request::cookie('electorsListFileds');
      $listFields=json_decode($listFields,true);
      if(Request::has('ids')){
        $electors=SELF::buildQuery([]);
      }else{
      $electors=SELF::buildQuery($filter);
      }
      if(Request::has('ids')){
        $ids=Request::get('ids');
        $ids=explode(',',$ids);
       
        $electors=$electors->whereIn('IDNumber',$ids);
        

      }
      $electors=$electors->select('*')->get();
      $electors=SELF::fixResponse($electors,$listFields);
      if(!$type) return view('print.electors')->with(['listFields'=>$listFields,'electors'=>$electors]);
      else return view('print.'.$type)->with(['listFields'=>$listFields,'electors'=>$electors]);
    }


  function getExport($format){
    $filter=Request::cookie('electorsFilter');
    $filter=json_decode($filter,true);
    $listFields=Request::cookie('electorsListFileds');
    $listFields=json_decode($listFields,true);
    $electors=SELF::buildQuery($filter);
    $electors=$electors->select('*')->get();
    $electors=SELF::fixResponse($electors,$listFields);
    $fields=config('electors.fields');
    $arr=[];
    foreach($electors as $elector){
      $arr2=[];
      foreach($listFields as $f){
        $arr2[$fields[$f]['label']]=$elector->$f;
      }
      $arr[]=$arr2;

    }
    Excel::create('Ielect-'.date('d/m/Y H:i'), function($excel) use ($arr) {

    $excel->sheet('electors', function($sheet) use ($arr) {
        $sheet->fromArray($arr);
        $sheet->setAutoSize(true);

        $sheet->row(1, function($row) {

    // call cell manipulation methods
    $row->setBackground('#2c3e50');
    $row->setFontColor('#ffffff');


});
    });

})->export($format);
  }


      function getListApp(Requests $request){
        $pageCount=30;
        $user=$request->user;
        
        $filter=[];
        $listFields=["IDNumber","FamilyName","PersonalName","FatherName","gender","birthYear","AddCode"];
        if(Request::has('filter')){
          $filter=json_decode(Request::get('filter'),true);
        }

        if(Request::has('listFields')){
          $listFields=json_decode(Request::get('listFields'),true);
        }
        
        if($user->usertype==2) $filter[]=['name'=>'list','value'=>$user->id];
        if($user->usertype==3)  $filter[]=['name'=>'IDNumber','value'=>'x'];
        
        $electors=SELF::buildQuery($filter);
      $electors=$electors->paginate($pageCount);
  
      
      //$electors->withPath('/#/electors/list/');
      $listFields[]='id';
      $electors=SELF::fixResponse($electors,$listFields);
      $allElectors=[];
      foreach($electors as $elector){
        $elec=[];
        foreach($listFields as $key){
          $elec[$key]=$elector->$key;
        }
        $allElectors[]=$elec;
      }
      $response['total']=$electors->total();
      $response['perPage']=$electors->perPage();
      $response['currentPage']=$electors->currentPage();
      $response['lastPage']=$electors->lastPage();
      $response['data']=$allElectors;
     
      return response()->json($response);

      }
    function getList(){
      $pageCount=Request::cookie('pageCount');
      $pageCount=intval($pageCount);
      $pageCount= $pageCount ? $pageCount:50;

    if(Request::has('filter')){
      // $url =$_SERVER['REQUEST_URI'];
      // echo $url;

        // if (!strpos($url,'car')) {
        //     echo 'Car exists.';
        // } else {
        //     echo 'No cars.';
        // }
      $filter=json_decode(Request::get('filter'),true);
      
      // if(count($filter)>1){
      //   // print_r($filter[1]['name']);
      //   $idfilter=$filter[1]['value'];
      //   $namefilter=$filter[1]['name'];
      // // print_r(count($filter));
      // }
      
    }else{
      $filter=Request::cookie('electorsFilter');
      $filter=json_decode($filter,true);
      
    }
        if(Request::has('listFields')){
      $listFields=json_decode(Request::get('listFields'),true);
      // print_r($listFields);
    }else{

      $listFields=Request::cookie('electorsListFileds');
      $listFields=json_decode($listFields,true);
    }
      // print_r ($listFields);
      // if(isset($namefilter) && $namefilter =='group'){
      //   // print_r($filter[1]['name']);
      //      $all_sub=DB::table('groups')->where('category_id',$idfilter)->get();
        
      //     $all_array_sub=[];
          
      //     foreach($all_sub as $sub){
      //       array_push($all_array_sub,$sub->id);
      //     }
      //     $sub_sub=DB::table('groups')->whereIn('category_id',$all_array_sub)->get();
      //     foreach($sub_sub as $sub2){
      //       array_push($all_array_sub,$sub2->id);
      //     }
      //     // print_r($all_array_sub);
      //     $electors=SELF::buildQuery($filter)->orWhereIn('group',$all_array_sub);
      //     // print_r($electors);
      // }
      // else{
        $electors=SELF::buildQuery($filter);
      // }
      
      // $electors=SELF::buildQuery($filter);
      $electors=$electors->paginate($pageCount);
      //$electors->withPath('/#/electors/list/');
     
      $electors=SELF::fixResponse($electors,$listFields);    
        // print_r($electors);

    $html=view('electors.list')->with(['listFields'=>$listFields,'electors'=>$electors]);
    return response($html)->cookie('electorsFilter', json_encode($filter), 6000)->cookie('electorsListFileds', json_encode($listFields), 6000);


    }
    public function getTree($id,$IDNumber){

      
      $pageCount=Request::cookie('pageCount');
      $pageCount=intval($pageCount);
      $pageCount= $pageCount ? $pageCount:50;

      if(Request::has('filter')){
        $filter=json_decode(Request::get('filter'),true);
      }else{
        $filter=Request::cookie('electorsFilter');
        $filter=json_decode($filter,true);
      }
          if(Request::has('listFields')){
        $listFields=json_decode(Request::get('listFields'),true);
      }else{

        $listFields=Request::cookie('electorsListFileds');
        $listFields=json_decode($listFields,true);
      }
        // print_r ($listFields);
        $electors=SELF::buildQuery($filter);
        $electors=$electors->paginate($pageCount);
        //$electors->withPath('/#/electors/list/');

        $electors=SELF::fixResponse($electors,$listFields);
      $html=view('electors.family_Tree')->with(['listFields'=>$listFields,'electors'=>$electors,'id'=>$id,'IDNumber'=>$IDNumber]);
      return response($html)->cookie('electorsFilter', json_encode($filter), 6000)->cookie('electorsListFileds', json_encode($listFields), 6000);


    }
    public function storeIdNumber(Request $request)
    {
      echo($request::get('idNumberSelect'));
      $idSelected=$request::get('idNumberSelect');
      // $post=DB::table('electors')->where('IDNumber',$idSelected)->first();//person main
      //   $post->mother_id =$request::get('mother_id');
      //   $post->father_id =$request::get('father_id');
      //   $post->save();
        DB::table('electors')->where('IDNumber', $idSelected)->update(['mother_id' =>$request::get('mother_id'),'father_id' =>$request::get('father_id')]);

        return redirect('/#/familyTree'.'/'.$request::get('id').'/'.$request::get('idNumber'))->with('status', 'brother add sucessfully');
    }

    public static function postPageCount(){
      $count=Request::get('count');
      return response('')
      ->cookie('pageCount', $count, 1000);
    }
    public static function getLabelFromDb($field,$value,$boolean=false){

    list($label,$table,$key)=explode(',',$field);
    $title=DB::table($table)->where($key,$value)->select($label)->first();
    if($title) return($title->$label);
    else{
      if($boolean){
        return 0;
      }else{
      return ('ללא');
      }

    }
    }
    public static function fixResponse($data,$fields){
        $savedData=[];
          foreach($data as $key=>$row){

            foreach($fields as $field){

              switch ($field) {
                case 'gender':
                    $data[$key]->$field=config('electors.fields.gender.data.'.$row->$field);
                break;
                case 'voted':
                if($row->$field==0) $row->$field=2;
                    $data[$key]->$field=config('electors.fields.voted.data.'.$row->$field);
                break;

                case "ballot_address":

                if(isset($savedData['ballot_address'][$data[$key]->AddCode])) $data[$key]->$field=$savedData['ballot_address'][$data[$key]->AddCode];
                else{
                    $savedData['ballot_address'][$data[$key]->AddCode]=SELF::getLabelFromDb('place_details,ballot,ballot_id',$data[$key]->AddCode);

                    $data[$key]->$field=$savedData['ballot_address'][$data[$key]->AddCode];
                 }

                break;


                case 'haslist':
                    $hasList=$row->list ? 1:2;

                    $data[$key]->$field=config('electors.fields.haslist.data.'.$hasList);
                break;

                case 'hasgroup':
                    $hasgroup=$row->group ? 1:2;

                    $data[$key]->$field=config('electors.fields.hasgroup.data.'.$hasgroup);
                break;
                case "list":
                  if(isset($savedData['list'][$data[$key]->$field])) $data[$key]->$field=$savedData['list'][$data[$key]->$field];
                  else{
                      $savedData['list'][$data[$key]->$field]=SELF::getLabelFromDb(config('electors.fields.list.data'),$data[$key]->$field,true);
                      $data[$key]->$field=$savedData['list'][$data[$key]->$field];
                   }
                break;


                case "group":
                  if(isset($savedData['group'][$data[$key]->$field])) $data[$key]->$field=$savedData['group'][$data[$key]->$field];
                  else{
                      $savedData['group'][$data[$key]->$field]=SELF::getLabelFromDb(config('electors.fields.group.data'),$data[$key]->$field);
                      $data[$key]->$field=$savedData['group'][$data[$key]->$field];
                   }
                break;



                case "mayor":
                  if(isset($savedData['mayor'][$data[$key]->$field])) $data[$key]->$field=$savedData['mayor'][$data[$key]->$field];
                  else{
                      $savedData['mayor'][$data[$key]->$field]=SELF::getLabelFromDb(config('electors.fields.mayor.data'),$data[$key]->$field);
                      $data[$key]->$field=$savedData['mayor'][$data[$key]->$field];
                   }
                break;


                case "manid":
                  if(isset($savedData['manid'][$data[$key]->$field])) $data[$key]->$field=$savedData['manid'][$data[$key]->$field];
                  else{
                      $savedData['manid'][$data[$key]->$field]=SELF::getLabelFromDb(config('electors.fields.manid.data'),$data[$key]->$field);
                      $data[$key]->$field=$savedData['manid'][$data[$key]->$field];
                   }
                break;

              }

            }


          }
          return($data);
    }


  function postComplete($field){
    $data=DB::table('electors')->where($field,'LIKE','%'.Request::get('q').'%');
    if($field=='FamilyName') $data=$data->orWhere('originalFamilyName','LIKE','%'.Request::get('q').'%');
    $data=$data->distinct()->get([$field])->take('10');

    $alldata=[];
    foreach($data as $val){
      $alldata[]=$val->$field;
    }
    return response()->json(['data'=>$alldata]);
  }

    function getView($id){
      $elector=DB::table('electors')->where('IDNumber',$id)->leftJoin('ballot', 'electors.AddCode', '=', 'ballot.ballot_id')->select('electors.*','ballot.place_details as ballot_address')->first();
      $parents=DB::table('electors')->where('IDNumber',$elector->father_id)->orWhere('IDNumber',$elector->mother_id)->select('*')->get();
      $kids=DB::table('electors')->where('father_id',$elector->IDNumber)->orWhere('mother_id',$elector->IDNumber)->select('*')->get();
      
      $fatherID=$elector->father_id;
      $motherID=$elector->mother_id;
      if(!$motherID) $motherID="11";
      if(!$fatherID) $fatherID="11";

      $brothers=DB::select('select * from electors where(father_id="'.$fatherID.'" OR mother_id="'.$motherID.'" ) AND IDNumber!="'.$elector->IDNumber.'"');

      $couple=[];
      if(strlen($elector->couple)>1) $couple=DB::table('electors')->where('IDNumber',$elector->couple)->select('*')->get();
      $ids[]=$elector->IDNumber;
      $kidsIds=[];
      $brothersIds=[];
      $brothersCouples=[];
      $kidsCouples=[];
      foreach($parents as $e) $ids[]= $e->IDNumber;
      foreach($kids as $e) $kidsIds[]= $e->IDNumber;
      foreach($couple as $e) $ids[]= $e->IDNumber;
      foreach($brothers as $e) $brothersIds[]= $e->IDNumber;
      if($brothersIds){
      $brothersCouples=DB::table('electors')->whereIn('couple',$brothersIds)->where('gender','2')->select('IDNumber')->get();
      }
      if($kidsIds){
        $kidsCouples=DB::table('electors')->whereIn('couple',$kidsIds)->where('gender','2')->select('IDNumber')->get();
        }

        foreach($kids as $e) $ids[]= $e->IDNumber;
        foreach($brothers as $e) $ids[]= $e->IDNumber;
        foreach($brothersCouples as $e) $ids[]= $e->IDNumber;
        foreach($kidsCouples as $e) $ids[]= $e->IDNumber;


      //return($electors);
      return view('electors.card')->with('elector',$elector)->with('parents',$parents)->with('kids',$kids)->with('couple',$couple)->with('brothers',$brothers)->with('ids',$ids);
    }
    function getView2($id){ //test
      $elector=DB::table('electors')->where('IDNumber',$id)->leftJoin('ballot', 'electors.AddCode', '=', 'ballot.ballot_id')->select('electors.*','ballot.place_details as ballot_address')->first();
      $parents=DB::table('electors')->where('IDNumber',$elector->father_id)->orWhere('IDNumber',$elector->mother_id)->select('*')->get();
      $kids=DB::table('electors')->where('father_id',$elector->IDNumber)->orWhere('mother_id',$elector->IDNumber)->select('*')->get();
      
      $fatherID=$elector->father_id;
      $motherID=$elector->mother_id;
      if(!$motherID) $motherID="11";
      if(!$fatherID) $fatherID="11";

      $brothers=DB::select('select * from electors where(father_id="'.$fatherID.'" OR mother_id="'.$motherID.'" ) AND IDNumber!="'.$elector->IDNumber.'"');

      $couple=[];
      if(strlen($elector->couple)>1) $couple=DB::table('electors')->where('IDNumber',$elector->couple)->select('*')->get();
      $ids[]=$elector->IDNumber;
      $kidsIds=[];
      $brothersIds=[];
      $brothersCouples=[];
      $kidsCouples=[];
      foreach($parents as $e) $ids[]= $e->IDNumber;
      foreach($kids as $e) $kidsIds[]= $e->IDNumber;
      foreach($couple as $e) $ids[]= $e->IDNumber;
      foreach($brothers as $e) $brothersIds[]= $e->IDNumber;
      if($brothersIds){
      $brothersCouples=DB::table('electors')->whereIn('couple',$brothersIds)->where('gender','2')->select('IDNumber')->get();
      }
      if($kidsIds){
        $kidsCouples=DB::table('electors')->whereIn('couple',$kidsIds)->where('gender','2')->select('IDNumber')->get();
        }

        foreach($kids as $e) $ids[]= $e->IDNumber;
        foreach($brothers as $e) $ids[]= $e->IDNumber;
        foreach($brothersCouples as $e) $ids[]= $e->IDNumber;
        foreach($kidsCouples as $e) $ids[]= $e->IDNumber;


      //return($electors);
      return view('electors.card2')->with('elector',$elector)->with('parents',$parents)->with('kids',$kids)->with('couple',$couple)->with('brothers',$brothers)->with('ids',$ids);
    }



    function getElector($id){
      $elector=DB::table('electors')->where('IDNumber',$id)->leftJoin('ballot', 'electors.AddCode', '=', 'ballot.ballot_id')->select('electors.*','ballot.place_details as ballot_address')->first();
      $parents=DB::table('electors')->where('IDNumber',$elector->father_id)->orWhere('IDNumber',$elector->mother_id)->select('*')->get();
      $kids=DB::table('electors')->where('father_id',$elector->IDNumber)->orWhere('mother_id',$elector->IDNumber)->select('*')->get();
      $fatherID=$elector->father_id;
      $motherID=$elector->mother_id;
      if(!$motherID) $motherID="11";
      if(!$fatherID) $fatherID="11";

      $brothers=DB::select('select * from electors where(father_id="'.$fatherID.'" OR mother_id="'.$motherID.'" ) AND IDNumber!="'.$elector->IDNumber.'"');

      $couple=[];
      if(strlen($elector->couple)>1) $couple=DB::table('electors')->where('IDNumber',$elector->couple)->select('*')->get();

      //return($electors);
      $data['elector']=$elector;
      $data['parents']=$parents;
      $data['kids']=$kids;
      $data['couple']=$couple;
      $data['brothers']=$brothers;
      return response()->json($data);

    }
    function getDatatable(){
        $listFields=session('electorsListFileds');
        $listFields[]="id";
        $electors=DB::table('electors')->select($listFields)->take(10)->get();

        return datatables()->of($electors)->make(true);
    }
}
