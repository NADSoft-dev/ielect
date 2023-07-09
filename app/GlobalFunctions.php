<?php
namespace App;
use DB;
class GlobalFunctions{

    public static function randomPassword($userType) {
        $alphabet = '1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return $userType.implode($pass); //turn the array into a string
    }


    public static function buildElectorsQuery($filter)
    {


        
        $electors = DB::table('electors');
        
        foreach ($filter as  $val) {
            $key=$val['name'];
            $val=$val['value'];
            $val = trim($val);

            if ($key == "orderBy") {
                $val = explode("|", $val);
            }

         

            switch ($key) {
                case "haslist":
                    if ($val == 1) {
                        $electors = $electors->whereRaw('electors.list > 0');
                    } else if ($val == "NULL") {
                        $electors = $electors->whereNull('electors.list')->orWhere('electors.' . $key, 0);
                    } else {
                        $electors = $electors->whereRaw('electors.list < 1');
                    }

                    break;

                case "orderBy":

                    if (count($val) < 1 || strlen($val[0]) < 3) {
                        continue;
                    }

                    foreach ($val as $v) {
                        list($b, $a) = explode(':', $v);

                        $electors = $electors->orderBy($b, $a);

                    }

                    break;

                case "birthYear_from":
                    $electors = $electors->whereRaw('electors.birthYear >=' . "'" . $val . "'");
                    break;

                case "birthYear_to":
                    $electors = $electors->whereRaw('electors.birthYear <=' . "'" . $val . "'");
                    break;

                case "AddCode_from":
                    $electors = $electors->whereRaw('electors.AddCode >=' . "'" . $val . "'");
                    break;

                case "AddCode_to":
                    $electors = $electors->whereRaw('electors.AddCode <=' . "'" . $val . "'");
                    break;

                case "birthYear-from":
                    $electors = $electors->whereRaw('electors.birthYear >=' . "'" . $val . "'");
                    break;

                case "birthYear-to":
                    $electors = $electors->whereRaw('electors.birthYear <=' . "'" . $val . "'");
                    break;

                case "AddCode-from":
                    $electors = $electors->whereRaw('electors.AddCode >=' . "'" . $val . "'");
                    break;

                case "AddCode-to":
                    $electors = $electors->whereRaw('electors.AddCode <=' . "'" . $val . "'");
                    break;

                case "FamilyName":
                    $electors = $electors->whereRaw('(electors.FamilyName LIKE ' . '"' . $val . '")');
                    break;

                case "Street":
                    $electors = $electors->whereRaw('(electors.Street LIKE ' . '"' . $val . '" OR electors.StCode LIKE ' . '"' . $val . '")');
                    break;

                default:

                    if (is_numeric($val)) {
                        $electors = $electors->whereRaw('electors.' . $key . ' =  "' . $val . '"');
                    } else if ($val == "NULL") {

                        $electors = $electors->whereNull('electors.' . $key)->orWhere('electors.' . $key, 0);
                    } else {
                        $electors = $electors->whereRaw('electors.' . $key . ' LIKE  "%' . $val . '%"');
                    }

                    break;

            }
        }

        return $electors;
    }


}