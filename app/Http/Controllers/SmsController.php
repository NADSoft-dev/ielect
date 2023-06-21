<?php

namespace App\Http\Controllers;

use Request;
use DB;
use Session;
class SmsController extends Controller
{
  private $smsGateway="https://sms.nadsoft.co/api/sms/";
  private $smsApi="Itf2ipTpKat83UenSQc0xfm4NFDrkygj1saxkbgvSlh5jMYksj7gtleXnZUB8Cxf";
  private $smsKey="0UyvfCY1Ja02kXtL";
  public function postPrepare(){
    $filter=Request::get('filter');
    $filter=json_decode($filter,true);
    $msg=Request::get('msg');
    $allElectors=[];
    $electors=DB::table('electors')->where('cell','!=','')->where(function($query) use($filter){
      $query->whereIn('group',$filter['groups'])->orWhereIn('list',$filter['lists']);
    })->select('id')->get();
    foreach($electors as $elec) $allElectors[]=$elec->id;
    $allElectors=json_encode($allElectors);
    return response('')->cookie('smsElectors', $allElectors,6000)->cookie('smsMsg',$msg,6000);
    return($electors);
  }

  function postSend(){
    $electors=Request::cookie('smsElectors');
    $electors=json_decode($electors,true);
    $msg=Request::cookie('smsMsg');
    $electors=DB::table('electors')->whereIn('id',$electors)->select('cell')->get();
    $phones=[];
    foreach($electors as $elec){
      $phones[]=$elec->cell;
    }
    $client = new \GuzzleHttp\Client(['base_uri'=>$this->smsGateway]);
    $data=[
    'api_token'=>$this->smsApi,
    'api_key'=>$this->smsKey,
    'to'=>$phones,
    'message'=>$msg
  ];
  $response=$client->request('POST','send',['form_params'=>$data]);
  $count=$this->calculateSmsCount($msg,$phones);
  $this->updateBalance($count);
  return response('')->cookie('smsElectors','0',1)->cookie('smsMsg','1',1);
  }
  public function getPrepared(){
    $electors=Request::cookie('smsElectors');
    $electors=json_decode($electors,true);
    $msg=Request::cookie('smsMsg');
    $countMessage=$this->calculateSmsCount($msg,$electors);
    $balance=$this->checkBalance();

    return view('sms.prepared',compact('electors', 'msg','countMessage','balance'));
  }


  function postSendModule(){
    $data=Session::get('smsByModule');


    if($data['type']=='ballot-location'){
      $data['id']=explode(',',$data['id']);
      foreach($data['id'] as $id){
        $elector=DB::table('electors')->where('IDNumber',$id)->where('cell','!=','')->select('cell','AddCode','Address','Serial')->first();


        if(!$elector) continue;

        $ballot=DB::table('ballot')->where('ballot_id',$elector->AddCode)->first();

        if(!$ballot) continue;
        $row=[];
        $row['AddCode']=$ballot->ballot_id;
        $row['place_details']=$ballot->place_details;
        $row['Address']=$elector->Address;
        $row['street_name']=$ballot->street_name;
        $row['home_num']=$ballot->home_num;
        $row['Serial']=$elector->Serial;
        $msg=$this->getKalfySms($row);
        $client = new \GuzzleHttp\Client(['base_uri'=>$this->smsGateway]);
        $sdata=[
        'api_token'=>$this->smsApi,
        'api_key'=>$this->smsKey,
        'to'=>$elector->cell,
        'message'=>$msg
      ];
      $response=$client->request('POST','send',['form_params'=>$sdata]);

      }
    }else{
    $phones=$this->getPhonesByType($data);
    $client = new \GuzzleHttp\Client(['base_uri'=>$this->smsGateway]);
    $sdata=[
    'api_token'=>$this->smsApi,
    'api_key'=>$this->smsKey,
    'to'=>$phones,
    'message'=>$data['msg']
  ];
  $response=$client->request('POST','send',['form_params'=>$sdata]);
}
  $this->updateBalance($data['count']);
  Session::forget('smsByModule');
  return response('');

  }

  function getPhonesByType($data){
    $phones=[];
    switch ($data['type']) {
        case 'worker':
        $phones=DB::table('workers')->where('id',$data['id'])->where('cell','!=','')->select('cell')->get()->toArray();
        break;



        case 'delegate':
        $phones=DB::table('delegate')->where('id',$data['id'])->where('cell','!=','')->select('cell')->get()->toArray();
        break;

        case 'delegate-list':
        $phones=DB::table('personal_list')->where('under',$data['id'])->where('cell','!=','')->select('cell')->get()->toArray();
        break;

        case 'delegate-electors':
        $phones=DB::table('electors')->where('manid',$data['id'])->where('cell','!=','')->select('cell')->get()->toArray();
        break;


        case 'electors':
        $ids=explode(',',$data['id']);
        $phones=DB::table('electors')->whereIn('IDNumber',$ids)->where('cell','!=','')->select('cell')->get()->toArray();
        break;



        case 'list':
        $phones=DB::table('personal_list')->where('id',$data['id'])->where('cell','!=','')->select('cell')->get()->toArray();
        break;

        case 'list-electors':
        $phones=DB::table('electors')->where('list',$data['id'])->where('cell','!=','')->select('cell')->get()->toArray();
        break;


        case 'group':
        $phones=DB::table('electors')->where('group',$data['id'])->where('cell','!=','')->select('cell')->get()->toArray();
        break;


      default:
        return false;
        break;
    }
    $allPhones=[];
    foreach($phones as $phone){
      $phone=(array)$phone;
      if(isset($phone['cell'])) $allPhones[]=$phone['cell'];
    }

    return $allPhones;

  }
  function getKalfySms($row){
    $data['msg']="מיקום ההצבעה שלך הוא:\n";
    $data['msg'].='מס קלפי: '.$row['AddCode']."\n";
    $data['msg'].="מקום קלפי: ".$row['place_details']."\n";
    $data['msg'].="ישוב: ".$row['Address']."\n";
    $data['msg'].="רחוב: ".$row['street_name']."  בית: ".$row['home_num']."\n";
    $data['msg'].="סידורי: ".$row['Serial'];
    return $data['msg'];
  }

  public function getPreparedModule(){
    $data=Session::get('smsByModule');
    if($data['type']=='ballot-location'){
     $row['AddCode']=20;
     $row['place_details']="12345678901234567890";
     $row['Address']='1234567890';
     $row['Zip']="1234567890";
     $row['street_name']="sadhhkasdhkahsdkjhsda";
     $row['home_num']="999";
     $row['Serial']="123";
    $data['msg']=$this->getKalfySms($row);
  }
    $allPhones=$this->getPhonesByType($data);
    $countMessage=$this->calculateSmsCount($data['msg'],$allPhones);
    $data['count']=$countMessage;
    if($data['type']=='ballot-location') $data['msg']='מיקום קלפי';
    Session::put('smsByModule',$data);

    $balance=$this->checkBalance();

    return view('sms.prepared_module',compact('allPhones', 'data','countMessage','balance'));
  }

  public function calculateSmsCount($msg,$to){
    $client = new \GuzzleHttp\Client(['base_uri'=>$this->smsGateway]);
    $data=[
    'api_token'=>$this->smsApi,
    'api_key'=>$this->smsKey,
    'to'=>$to,
    'message'=>$msg
  ];

  $response=$client->request('POST','calculateSMS',['form_params'=>$data]);
  $response=$response->getBody();
  $response=json_decode($response,true);
  return($response['number_of_sms']);

  }
function postPrepareModule($step=1){
  if($step==1){
  $data['type']=Request::get('type');
  $data['id']=Request::get('id');
  Session::put('smsByModule',$data);
}
if($step==2){
  $data=Session::get('smsByModule');
  $data['msg']=Request::get('msg');
  Session::put('smsByModule',$data);
}
  return response('');

}



function getByModule($step=1){
  if($step==1){
    return view('sms.write_msg');
  }
  //$data=Request::cookie('smsByModule');
}
  function checkBalance(){

    $client = new \GuzzleHttp\Client(['base_uri'=>'http://ielect-admin.megatam.net/api/sms/']);
    $response=$client->request('GET','balance/'.Session::get('member')->username);
    //$response=$client->request('GET','balance/demo');
    $response=json_decode($response->getBody(),true);
    if(isset($response['sms_balance'])) return $response['sms_balance'];
    else return 0;

  }



  function updateBalance($balance){
    $data['username']=Session::get('member')->username;
    $data['balance']=$balance;
    $client = new \GuzzleHttp\Client(['base_uri'=>'http://ielect-admin.megatam.net/api/sms/']);
    $response=$client->request('POST','balance/update',['form_params'=>$data]);
    return true;

  }

}
