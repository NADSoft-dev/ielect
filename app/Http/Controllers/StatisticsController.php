<?php

namespace App\Http\Controllers;

use Request;
use DB;
use Session;
use Excel;
use Storage;
class StatisticsController extends Controller
{
    //



    function buildQuery($filter){
      $electors=DB::table('electors');
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
            else $electors->whereRaw('electors.list < 1');
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
            
            $electors->whereRaw('(electors.FamilyName ='.'"'.$f['value'].'")');
          }else{
            $electors->whereRaw('(electors.FamilyName ='.'"'.$f['value'].'" OR electors.originalFamilyName="'.$f['value'].'")');
          }
            
          break;

          


          default:
            $electors->whereRaw('electors.'.$f['name'].' =  "'.$f['value'].'"');
          break;

        }
      }
      return $electors;
    }

    

    public static function setToShow($group, $electors)
    {
        switch ($group) {
            case "list":
                $electors->leftJoin('personal_list', 'electors.list', '=', 'personal_list.id')->select($group, 'personal_list.full_name as toshow', DB::raw('COUNT(electors.`' . $group . '`) as `total`'));
                break;

            case "mayor":
                $electors->leftJoin('mayors', 'electors.mayor', '=', 'mayors.id')->select($group, 'mayors.full_name as toshow', DB::raw('COUNT(electors.`' . $group . '`) as `total`'));
                break;

            case "manid":
                $electors->leftJoin('delegate', 'electors.manid', '=', 'delegate.id')->select($group, 'delegate.full_name as toshow', DB::raw('COUNT(electors.`' . $group . '`) as `total`'));
                break;

            case "group":
                $electors->leftJoin('groups', 'electors.group', '=', 'groups.id')->select($group, 'groups.name as toshow', DB::raw('COUNT(electors.`' . $group . '`) as `total`'));
                break;


            default:

                $electors->select($group . ' as toshow', DB::raw('COUNT(`' . $group . '`) as `total`'), $group);
                break;
        }
        return ($electors);
    }

    function getMain(){
      return view('stats.main');
    }

    function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}

    function getGraph(){
        $filter=json_decode(Request::get('filter'),true);
        $el1=SELF::buildQuery($filter);
        $el2=SELF::buildQuery($filter);
        $el3=SELF::buildQuery($filter);
        $el4=SELF::buildQuery($filter);
        return view('stats.graph',compact(['el1', 'el2','el3','el4']));
    }

    function getPrint(){
      $filename=Request::cookie('statsFile');
      $html=Storage::disk('stats')->get($filename);
      return view('print.statisticsTable')->with('html',$html);
    }

    function getAll(){
      $group=Request::get('statsBy');
      $type=Request::get('type');
      $orderBy=$type == "alphabet" ? 'toshow':'total';
      $orderType=$type == "alphabet" ? 'ASC':'DESC';
      $filter=json_decode(Request::get('filter'),true);
    
      $electors=SELF::buildQuery($filter);
      $electors=SELF::setToShow($group,$electors);
      $electors=$electors->groupBy($group)->orderBy($orderBy,$orderType)->get();

      $filename=Request::cookie('statsFile');
      if($filename)   Storage::disk('stats')->delete($filename);
      $filename=uniqid('stats-');
       $html=view('stats.table')->with('field',$group)->with('type',$type)->with('list',$electors);


      Storage::disk('stats')->put($filename, SELF::sanitize_output($html));
      return response($html)->cookie('statsFile', $filename);
      $electors=$electors->groupBy($group)->select('*')->get();
      $count=$electors->count();

    }

    function getByWorker(){
      return view('stats.by_worker');

    }

    function getByMayor(){
      return view('stats.by_mayor')->with('field','mayor')->with('table','mayors');
    }

    function getByGroup(){
      return view('stats.by_mayor')->with('field','group')->with('table','groups');
    }


}
