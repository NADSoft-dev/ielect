<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>family tree</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <link href="css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link href="https://bootswatch.com/3/flatly/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dscountdown.css') }}">
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    


    <style>
                /*Now the CSS*/
        * {margin: 0; padding: 0}
        .container {
            width: 100%!important;
            padding-left: 0;
            padding-right: 0
        }
        body{
            background-color:#F2F6FF;
            overflow-x: hidden !important;
        }
         .tree{
             display: flex;
             justify-content: center;
             width: 100%;
             height: 100%;
             cursor: pointer;
             /*  */
            width: 100%;
        
            white-space: nowrap;
            transition: all 0.2s;
            transform: scale(0.98);
            will-change: transform;
            user-select: none;
          
                
         }
         /* .tree ul:first-child{
            overflow-x: scroll;
            
         } */
         .firstUL{
            overflow-x: scroll;
         }
        .tree ul {
            min-width: 100%;
            min-height:55vh;
            padding: 20px 0;
            position: relative;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            display: flex;
            flex-direction: row-reverse;
        }

        .tree li {
            /* overflow-x: auto; */
            float: left; 
            text-align: center;
            list-style-type:none;
            position: relative;
            padding: 20px 5px 0 5px;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            width: 100%;
        }

        /*We will use ::before and ::after to draw the connectors*/

        .tree li::before, .tree li::after{
            content: '';
            position: absolute; top: 0; right: 50%;
            border-top:3px dashed #ccc;
            width: 50%; 
            height: 20px;
            
        }
        .tree li::after{
            right: auto; left: 50%;
            border-left: 3px dashed #ccc;
            
        }
        
        .dropdown-menu  li::before, .dropdown-menu li::after{
            content: '';
            position: absolute; top: 0; right: 50%;
            border-top:1px solid #eee;
            width: 50%; 
            height: 20px;
            
        }
        .dropdown-menu li::after{
            right: auto; left: 50%;
            border-left: 1px solid #eee;
            
        }
        .tree li:only-child::after, .tree li:only-child::before {
            display: none;
        }

        /*Remove space from the top of single children*/
        .tree li:only-child{ padding-top: 0;}

        /*Remove left connector from first child and 
        right connector from last child*/
        .tree li:first-child::before, .tree li:last-child::after{
            border: 0 none;
        }
        /*Adding back the vertical connector to the last nodes*/
        .tree li:last-child::before{
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
        }
        .tree li:first-child::after{
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        /*Time to add downward connectors from parents*/
        .tree ul ul::before{
            content: '';
            position: absolute; top: 0; left: 50%;
            border-left: 1px solid #ccc;
            width: 0; height: 20px;
        }

        .tree li .box{
            border: 1px solid white;
            padding: 5px 10px;
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 11px;
            display: inline-block;
            
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            position: relative;
            background-color: white;
            min-width: 120px;
            min-height: 120px;
        }

        /*Time for some hover effects*/
        /*We will apply the hover effect the the lineage of the element also*/
        .tree li a:hover, .tree li a:hover+ul li a {
            background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
        }
        /*Connector styles on hover*/
        .tree li a:hover+ul li::after, 
        .tree li a:hover+ul li::before, 
        .tree li a:hover+ul::before, 
        .tree li a:hover+ul ul::before{
            border-color:  #94a0b4;
        }

      
        .wrap-select-div{
            position: relative;
        }
        .select-div{
            position: absolute;
            top: 83px;
            left: 0;
            z-index: 99;
            display: none;
            padding: 20px;
            border: 1px solid black;
            background-color: white;
            border-radius: 15px;
            padding: 31%;
            width: 280px
        }
        .select-div .btn-primary{
            margin-top: 10%;
            padding: 2px 37px;
        }
        .stickTopContainer{
            width: 100%;
            color: white;
            /* position: absolute; */
            /* bottom: 0; */
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            bottom: 1%;
            left: 0%;
            
        }
        /* .navbar-default {
            min-width:2500px;
        } */
        .rowSelect{
            position:absolute;
            right:10px;
            top:2px;
        }
       .male{
            color:#1B72DF
        }
        .female{
            color:#DF1DB5
        }
       
         i.male{
            background-color: #DDEAFA;
            border-radius: 50%;
            border: 1px solid #DDEAFA;
            padding: 14px;
            margin-top:20%;
            width: 53px;
            height:53px;
        }
        i.female{
            background-color:#FADDF5;
            border-radius: 50%;
            border: 1px solid #FADDF5;
            padding: 14px;
            margin-top:20%;
            width: 53px;
            height: 53px;
        }
        .add{
         color:#1BDF5D
        }
        i.add{
            background-color:#DDFAE7;
            border-radius: 50%;
            border: 1px solid #DDFAE7;
            padding: 14px;
            margin-top: 13%;
            width: 53px;
            height:53px;
        }
        i.doteIcon{
            position: absolute;
            right:30%;
            top:0;
        }
        .zoomIcon{
            position: fixed;
            left: 1%;
            top: 2%;
            z-index: 999999;
        }
        i.zoom{
            background-color:white;
            border-radius: 50%;
            border: 1px solid #DDFAE7;
            padding: 10px;
            width:37px;
            height:40px;
            
        }
        i.Z_in{
            cursor: zoom-in;
            z-index:100;
            
        }
        i.Z_out{
            cursor: zoom-out;
            z-index:100;
        }
        .divAll{
            position: relative;
        }
        
        .tree.active {
        background: rgba(255,255,255,0.3);
        cursor: grabbing;
        cursor: -webkit-grabbing;
        transform: scale(1);
          }
          /* .selectclass{

          } */

    </style>
</head>
<body class="bodyClass">
       <div class="divAll" >
            <div class="tree" style="zoom:0.4" id="tree"> 
                <?php
                $person=DB::table('electors')->where('id',$id)->first();
                $couple=DB::table('electors')->where('couple',$IDNumber)->first();
                $all_Id_Numbers=DB::table('electors')->where('mother_id',0)->where('father_id',0)->where('id','!=',$person->id ?? 0)->where('id','!=',$couple->id ?? 0)->get();
                $father=DB::table('electors')->where('IDNumber',$person->father_id)->first();
                $mother=DB::table('electors')->where('IDNumber',$person->mother_id)->first();
                if($person->gender == 2){
                $person_mother=$person->mother_id;
                $children=DB::table('electors')->where('mother_id',$IDNumber)->get();
                $brother=DB::table('electors')->where('mother_id','!=',0)->where('mother_id',$person_mother)->get();
                }
                else{
                $person_father=$person->father_id;
                $children=DB::table('electors')->where('father_id',$IDNumber)->get();
                $brother=DB::table('electors')->where('father_id','!=',0)->where('father_id',$person_father)->get();
                }
               
                
                ?>
            
                
                {{-- {{count($brother)}}     --}}
                <ul class="firstUL">
                    <li>
                                
                        @if (isset($person) && $person!=null && $person->gender !=null)
                        
                                @if(isset($mother) && !empty($mother))
                                    <div class="mother box">
                                        {{-- <p style="margin: 3% 0;color:black">Mother</p> --}}
                                        <i style="font-size:24px" class="fa female openPoppup" data-id="{{$mother->IDNumber ?? ''}}">&#xf221;</i>
                                
                                        <p style="margin: 3% 0"> {{$mother->PersonalName ?? ''}}</p>
                                        <p style="margin: 3% 0;color:black;">גיל:{{$mother->birthYear ? Carbon\Carbon::now()->format('Y')- $mother->birthYear : ''}}</p>

                                        <input type="checkbox" data-id="{{$mother->IDNumber ?? ''}}" id="parent{{$mother->IDNumber ?? ''}}" name="parent{{$mother->IDNumber ?? ''}}" value="{{$mother->IDNumber ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$mother->IDNumber ?? 0}})">
                                        
                                    </div>
                                @endif
                                
                                @if(isset($father) && !empty($father))
                                    <div class="father box"> 
                                        {{-- <p style="margin: 3% 0;color:black">father</p> --}}
                                        <i style="font-size:24px" class="fa male openPoppup" data-id="{{$father->IDNumber ?? ''}}">&#xf222;</i>
                                        <p style="margin: 3% 0"> {{$father->PersonalName ?? ''}}</p>
                                        <p style="margin: 3% 0;color:black;">גיל:{{$father->birthYear ? Carbon\Carbon::now()->format('Y')- $father->birthYear : ''}}</p>

                                        <input type="checkbox" data-id="{{$father->IDNumber ?? ''}}" id="parent{{$father->IDNumber ?? ''}}" name="parent{{$father->IDNumber ?? ''}}" value="{{$father->IDNumber ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$father->IDNumber ?? 0}})">
                                            
                                    </div>
                                @endif
                        
                        @endif
                    {{-- <li> --}}
                        <ul >
                            
                            <li> 
                                    @if (isset($couple) && $couple!=null && $couple->gender !=null)
                                    
                                        <div class="partner box"> 
                                            <input type="checkbox" data-id="{{$couple->IDNumber ?? ''}}" id="parent{{$couple->IDNumber ?? ''}}" name="parent{{$couple->IDNumber ?? ''}}" value="{{$couple->IDNumber ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$couple->IDNumber ?? 0}})">
                                                    @if($couple->gender === 1 )
                                                    <i style="font-size:24px" class="fa male openPoppup" data-id="{{$couple->IDNumber ?? ''}}">&#xf222;</i>
                                                    @else
                                                    <i style="font-size:24px" class="fa female openPoppup" data-id="{{$couple->IDNumber ?? ''}}">&#xf221;</i>
                                                    @endif   
                                        
                                                <p style="margin: 3% 0;"> {{$couple->PersonalName ?? ''}}</p>

                                                <p style="margin: 3% 0;color:black;">גיל:{{$couple->birthYear ? Carbon\Carbon::now()->format('Y')- $couple->birthYear : ''}}</p>
                                            
                                        </div>
                                    @endif  
                                    @if(isset($person) && $person!=null)
                                        <div class="person box" style="border:1px solid black">
                                            @if (isset($person) && $person!=null && $person->gender !=null)
                                                @if($person->gender === 1 )
                                                <i style="font-size:24px" class="fa male openPoppup" data-id="{{$person->IDNumber ?? ''}}" >&#xf222;</i>
                                                @else
                                                <i style="font-size:24px" class="fa female openPoppup" data-id="{{$person->IDNumber ?? ''}}" >&#xf221;</i>
                                                @endif   
                                            @endif 
                                                <p style="margin: 3% 0"> {{$person->PersonalName ?? ''}}</p>
                                                <p style="margin: 3% 0;color:black;">גיל:{{$person->birthYear ? Carbon\Carbon::now()->format('Y')- $person->birthYear : ''}}</p>

                                                <input type="checkbox" data-id="{{$person->IDNumber ?? ''}}" id="parent{{$person->IDNumber ?? ''}}" name="parent{{$person->IDNumber ?? ''}}" value="{{$person->IDNumber ?? ''}}" class="rowSelect checkboxSelect" onclick="fillCheckbox({{$person->IDNumber ?? 0}})">
                                            
                                        </div>
                                
                                    @endif
                                    {{-- {{print_r($couple).'H' }} --}}
                                @if(isset($brother) && !empty($brother) && (count($brother) > 0) &&  (count($children)==0)  )
                                {{-- @if(isset($brother) && !empty($brother) && count($brother) > 0 && ($couple == null || $couple == 0) && count($children)==0  ) --}}

                                    
                                    @foreach($brother as  $brotherfirst)
                                    <?php 
                                    $children_brother=DB::table('electors')->where('mother_id',$brotherfirst->IDNumber)->orWhere('father_id',$brotherfirst->IDNumber)->get();
                                    
                                    $couple_brother=DB::table('electors')->where('couple',$brotherfirst->IDNumber)->first();
                                        // echo($brotherfirst->IDNumber);
                                    ?>
                                    @if($brotherfirst->IDNumber != $person->IDNumber )
                                    <li>   
                                        <ul>  
                                        <li>                     
                                            <div class="brother box">
                                                @if($brotherfirst->gender == 1 )
                                                <i style="font-size:24px" class="fa male openPoppup" data-id="{{$brotherfirst->IDNumber ?? ''}}">&#xf222;</i>
                                                @else
                                                <i style="font-size:24px" class="fa female openPoppup" data-id="{{$brotherfirst->IDNumber ?? ''}}">&#xf221;</i>
                                                @endif   
                                            
                                                <p style="margin: 3% 0"> {{$brotherfirst->PersonalName ?? ''}}</p>
                                                <p style="margin: 3% 0;color:black;">גיל:{{$brotherfirst->birthYear ? Carbon\Carbon::now()->format('Y')- $brotherfirst->birthYear : ''}}</p>

                                                <input type="checkbox" data-id="{{$brotherfirst->IDNumber ?? ''}}" id="parent{{$brotherfirst->IDNumber ?? ''}}" name="parent{{$brotherfirst->IDNumber ?? ''}}" value="{{$brotherfirst->IDNumber ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$brotherfirst->IDNumber ?? 0}})"> 
                                            </div>
                                        </li>
                                        <li>
                                            @if (isset($couple_brother) && ($couple_brother !== null || $couple_brother !=0) )
                                                <div class="brother box">
                                                    @if($couple_brother->gender == 1 )
                                                    <i style="font-size:24px" class="fa male openPoppup" data-id="{{$couple_brother->IDNumber ?? ''}}">&#xf222;</i>
                                                    @else
                                                    <i style="font-size:24px" class="fa female openPoppup" data-id="{{$couple_brother->IDNumber ?? ''}}">&#xf221;</i>
                                                    @endif   
                                                
                                                    <p style="margin: 3% 0"> {{$couple_brother->PersonalName ?? ''}}</p>
                                                    <p style="margin: 3% 0;color:black;">גיל:{{$couple_brother->birthYear ? Carbon\Carbon::now()->format('Y')- $couple_brother->birthYear : ''}}</p>

                                                    <input type="checkbox" data-id="{{$couple_brother->IDNumber ?? ''}}" id="parent{{$couple_brother->IDNumber ?? ''}}" name="parent{{$couple_brother->IDNumber ?? ''}}" value="{{$couple_brother->IDNumber ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$couple_brother->IDNumber ?? 0}})"> 
                                                </div> 
                                            @endif 
                                            @if(isset($children_brother) && !empty($children_brother) && count($children_brother)>0)
                                                <ul>
                                                        @foreach ($children_brother as $brother_child)
                                                                
                                                                    <li>
                                                                        <div class="person box">
                                                                            @if (isset($children_brother) && $children_brother!=null && $brother_child->gender !=null)
                                                                                @if($brother_child->gender === 1 )
                                                                                <i style="font-size:24px" class="fa male openPoppup" data-id="{{$brother_child->IDNumber ?? ''}}">&#xf222;</i>
                                                                                @else
                                                                                <i style="font-size:24px" class="fa female openPoppup" data-id="{{$brother_child->IDNumber ?? ''}}">&#xf221;</i>
                                                                                @endif   
                                                                            @endif 
                                                                                <p style="margin: 3% 0"> {{$brother_child->PersonalName ?? ''}}</p>
                                                                                <p style="margin: 3% 0;color:black;">גיל:{{$brother_child->birthYear ? Carbon\Carbon::now()->format('Y')- $brother_child->birthYear : ''}}</p>
                                        
                                                                                <input type="checkbox" data-id="{{$brother_child->IDNumber ?? ''}}" id="parent{{$brother_child->IDNumber ?? ''}}" name="parent{{$brother_child->IDNumber ?? ''}}" value="{{$brother_child->IDNumber ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$brother_child->IDNumber ?? 0}})">
                                                                            
                                                                        </div>

                                                                    </li>
                                                                
                                                        @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                        </ul>
                                    
                                        
                                    </li>
                                    @endif
                                    @endforeach

                                    <li>
                                        <div class="wrap-select-div box" id="showselect" onclick="showSelect({{$person->id ?? 0}})">
                                                <i style="font-size:24px" class="fa add">&#xf067;</i>
                                            <p style="margin-top:15%">הוסף </p>
                                            <div class="select-div" id="select-div{{$person->id }}">
                                                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('/storeIdNumber')}}">
                                                
                                                    <select name="idNumberSelect" id="selectAdd{{$person->id }}" class=" selectclass selectpicker" onchange="selectChange({{$person->id }})">
                                                            <option value="0">choose</option>
                                                            @foreach ($all_Id_Numbers as $Id_Number )
                                                                
                                                            <option value="{{$Id_Number->IDNumber }}" data-select="{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}" >{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}</option>
                                                            @endforeach
                                                            
                                                    </select>
                                                    <p id="paraId{{$person->id }}"  style="display: none;margin: 10%"></p>

                                                    <input type="hidden" value="{{$children[0]->mother_id ?? ''}}" name="mother_id" />
                                                    <input type="hidden" value="{{$children[0]->father_id ?? ''}}" name="father_id" />
                                                    <input type="hidden" value="{{$person->id ?? 0}}" name="id" />
                                                    <input type="hidden" value="{{$person->IDNumber ?? ''}}" name="idNumber" />
                                                    <div>
                                                    <button type="submit" class="btn btn-primary" id="addbutton{{$person->id }}" disabled >הוסף</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </li>  
                                    
                                @endif
                            
                                @if(isset($children) && !empty($children) && count($children)>0)
                                <ul>
                                    
                                    <li>
                                        <div class="wrap-select-div box" id="showselect" onclick="showSelect({{$person->id ?? 0}})">
                                                <i style="font-size:24px" class="fa add">&#xf067;</i>
                                            <p style="margin-top:15%">הוסף </p>
                                            <div class="select-div" id="select-div{{$person->id }}">
                                                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('/storeIdNumber')}}">
                                                
                                                    <select name="idNumberSelect" id="selectAdd{{$person->id }}" class=" selectclass selectpicker" onchange="selectChange({{$person->id }})">
                                                            <option value="0">choose</option>
                                                            @foreach ($all_Id_Numbers as $Id_Number )
                                                                
                                                            <option value="{{$Id_Number->IDNumber }}" data-select="{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}" >{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}</option>
                                                            @endforeach
                                                            
                                                    </select>
                                                    <p id="paraId{{$person->id }}"  style="display: none;margin: 10%"></p>

                                                    <input type="hidden" value="{{$children[0]->mother_id ?? ''}}" name="mother_id" />
                                                    <input type="hidden" value="{{$children[0]->father_id ?? ''}}" name="father_id" />
                                                    <input type="hidden" value="{{$person->id ?? 0}}" name="id" />
                                                    <input type="hidden" value="{{$person->IDNumber ?? ''}}" name="idNumber" />
                                                    <div>
                                                    <button type="submit" class="btn btn-primary" id="addbutton{{$person->id }}" disabled>הוסף</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </li>   
                                        @foreach ($children as $child)
                                            <li>
                                                <!-- first change -->
                                                    <?php
                                                        $children_Children=DB::table('electors')->where('mother_id',$child->IDNumber)->orWhere('father_id',$child->IDNumber)->get();
                                                    
                                                        $couple_chlidren=DB::table('electors')->where('IDNumber',$child->couple)->first();

                                                    ?>
                                                    @if (isset($child->couple) && $child->couple!=null )
                                                        <ul> 
                                                            <li>
                                                                <div class="partner box"> 
                                                                    <input type="checkbox" data-id="{{$child->couple ?? ''}}" id="parent{{$child->couple ?? ''}}" name="parent{{$child->couple ?? ''}}" value="{{$child->couple ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$child->couple ?? 0}})">
                                                                    @if (isset($couple_chlidren) && $couple_chlidren!=null && $couple_chlidren->gender !=null)
                                                                        @if($couple_chlidren->gender == 1 )
                                                                        <i style="font-size:24px" class="fa male openPoppup" data-id="{{$child->couple ?? ''}}">&#xf222;</i>
                                                                        @else
                                                                        <i style="font-size:24px" class="fa female openPoppup" data-id="{{$child->couple ?? ''}}">&#xf221;</i>
                                                                        @endif   
                                                                    @endif   
                                                                
                                                                        <p style="margin: 3% 0;"> {{$couple_chlidren->PersonalName ?? ''}}</p>

                                                                        <p style="margin: 3% 0;color:black;">גיל:{{$couple_chlidren->birthYear ? Carbon\Carbon::now()->format('Y')- $couple_chlidren->birthYear : ''}}</p>
                                                                    
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="child box">
                                                                    @if (isset($children) && $children!=null && $child->gender !=null)
                                                                        @if($child->gender == 1 )
                                                                        <i style="font-size:24px" class="fa male openPoppup" data-id="{{$child->IDNumber ?? ''}}">&#xf222;</i>
                                                                        @else
                                                                        <i style="font-size:24px" class="fa female openPoppup" data-id="{{$child->IDNumber ?? ''}}">&#xf221;</i>
                                                                        @endif   
                                                                    @endif 
                                                                    <p style="margin: 3% 0"> {{$child->PersonalName ?? ''}}</p>
                
                                                                    <p style="margin: 3% 0;color:black;">גיל:{{$child->birthYear ? Carbon\Carbon::now()->format('Y')- $child->birthYear : ''}}</p>
                                                                    <input type="checkbox" data-id="{{$child->IDNumber ?? ''}}" id="parent{{$child->IDNumber ?? ''}}" name="parent{{$child->IDNumber ?? ''}}" value="{{$child->IDNumber ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$child->IDNumber ?? 0}})"> 
                                                                </div>
                                                                @if(isset($children_Children) && !empty($children_Children) && count($children_Children)>0)
                                                    
                                                                    <ul>
                                                                        @if(isset($children_Children) && count($children_Children)>0)
                                                                        <li>
                                                                            {{-- <i  class="fa doteIcon">&#xf111;</i> --}}
                                                                            <div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>
                                                                            <div class="wrap-select-div box" id="showselect" onclick="showSelect({{$child->id ?? 0}})">
                                                                                {{-- <button id="showselect" onclick="showSelect({{$child->id ?? 0}})"> --}}
                                                                                    <i style="font-size:24px" class="fa add">&#xf067;</i>
                                                                                {{-- </button> --}}
                                                                                <p style="margin-top:15%">הוסף </p>
                                                                                <div class="select-div" id="select-div{{$child->id ?? 0}}">
                                                                                    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('/storeIdNumber')}}">
                                                                                    
                                                                                        <select  name="idNumberSelect" id="selectAdd{{$child->id ?? 0}}"  class=" selectclass selectpicker " onchange="selectChange({{$child->id ?? 0}})">
                                                                                                <option value="0">choose</option>
                                                                                                @foreach ($all_Id_Numbers as $Id_Number )
                                                                                                    
                                                                                                <option value="{{$Id_Number->IDNumber }}" data-select="{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}" >{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}</option>
                                                                                                @endforeach
                                                                                                
                                                                                        </select>
                                                                                        <p id="paraId{{$child->id ?? 0}}" style="display: none;margin: 10%" ></p>
                                                                                        <input type="hidden" value="{{$children_Children[0]->mother_id ?? ''}}" name="mother_id" />
                                                                                        <input type="hidden" value="{{$children_Children[0]->father_id ?? ''}}" name="father_id" />
                                                                                        <input type="hidden" value="{{$person->id ?? 0}}" name="id" />
                                                                                        <input type="hidden" value="{{$person->IDNumber ?? ''}}" name="idNumber" />
                                                                                        <div>
                                                                                        <button type="submit" class="btn btn-primary" id="addbutton{{$child->id ?? 0}}" disabled >הוסף</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </li>
                                                                        @endif
                                                                        @foreach ($children_Children as $subchild)
                                                                        <li>
                                                                            <!-- second edit -->
                                                                            <?php
                                                                                $children_Children_Children=DB::table('electors')->where('mother_id',$subchild->IDNumber)->orWhere('father_id',$subchild->IDNumber)->get();
                                                                                // echo($children_Children);
                                                                                $couple_children_Children=DB::table('electors')->where('IDNumber',$subchild->couple)->first();
                        
                                                                            ?>
                                                                            @if (isset($subchild->couple) && $subchild->couple!=null )
                                                                            <ul>
                                                                                    <li>
                                                                                        <div class="partner box"> 
                                                                                        <input type="checkbox" data-id="{{$subchild->couple ?? ''}}" id="parent{{$subchild->couple ?? ''}}" name="parent{{$subchild->couple ?? ''}}" value="{{$subchild->couple ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$subchild->couple ?? 0}})">
                                                                                            @if (isset($couple_children_Children) && $couple_children_Children!=null && $couple_children_Children->gender !=null)
                                                                                                @if($couple_children_Children->gender == 1 )
                                                                                                <i style="font-size:24px" class="fa male openPoppup" data-id="{{$subchild->couple ?? ''}}">&#xf222;</i>
                                                                                                @else
                                                                                                <i style="font-size:24px" class="fa female openPoppup" data-id="{{$subchild->couple ?? ''}}">&#xf221;</i>
                                                                                                @endif   
                                                                                            @endif   
                                                                                    
                                                                                            <p style="margin: 3% 0;"> {{$couple_children_Children->PersonalName ?? ''}}</p>
                                    
                                                                                            <p style="margin: 3% 0;color:black;">גיל:{{$couple_children_Children->birthYear ? Carbon\Carbon::now()->format('Y')- $couple_children_Children->birthYear : ''}}</p>
                                                                                        
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="childchild box">
                                                                                            @if (isset($children_Children) && $children_Children!=null && $subchild->gender !=null)
                                                                                                @if($subchild->gender === 1 )
                                                                                                <i style="font-size:24px" class="fa male openPoppup" data-id="{{$subchild->IDNumber ?? ''}}">&#xf222;</i>
                                                                                                @else
                                                                                                <i style="font-size:24px" class="fa female openPoppup" data-id="{{$subchild->IDNumber ?? ''}}">&#xf221;</i>
                                                                                                @endif   
                                                                                            @endif 
                                                                                            <p style="margin: 3% 0"> {{$subchild->PersonalName ?? ''}}</p>
                                    
                                                                                            <p style="margin: 3% 0;color:black;">גיל:{{$subchild->birthYear ? Carbon\Carbon::now()->format('Y')- $subchild->birthYear : ''}}</p>
                                    
                                                                                            <input type="checkbox" data-id="{{$subchild->IDNumber ?? ''}}" id="parent{{$subchild->IDNumber ?? ''}}" name="parent{{$subchild->IDNumber ?? ''}}" value="{{$subchild->IDNumber ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$subchild->IDNumber ?? 0}})"> 
                                                                                        </div>
                                                                                        @if(isset($children_Children_Children) && !empty($children_Children_Children) && count($children_Children_Children)>0)
                                                                                            <ul>
                                                                                                @foreach ($children_Children_Children as $subsubchild)
                                                                                                    <li>
                                                                                                        {{-- <i  class="fa doteIcon">&#xf111;</i> --}}
                                                                                                        <div class="childchild box">
                                                                                                            @if (isset($children_Children_Children) && $children_Children_Children!=null && $subsubchild->gender !=null)
                                                                                                                @if($subsubchild->gender === 1 )
                                                                                                                <i style="font-size:24px" class="fa male openPoppup" data-id="{{$subsubchild->IDNumber ?? ''}}">&#xf222;</i>
                                                                                                                @else
                                                                                                                <i style="font-size:24px" class="fa female openPoppup" data-id="{{$subsubchild->IDNumber ?? ''}}">&#xf221;</i>
                                                                                                                @endif   
                                                                                                            @endif
                                                                                                            <p style="margin: 3% 0"> {{$subsubchild->PersonalName ?? ''}}</p>
                                    
                                                                                                            <p style="margin: 3% 0;color:black;">גיל:{{$subsubchild->birthYear ? Carbon\Carbon::now()->format('Y')- $subsubchild->birthYear : ''}}</p>
                                    
                                                                                                            <input type="checkbox" data-id="{{$subsubchild->IDNumber ?? ''}}" id="parent{{$subsubchild->IDNumber ?? ''}}" name="parent{{$subsubchild->IDNumber ?? ''}}" value="{{$subsubchild->IDNumber ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$subsubchild->IDNumber ?? 0}})"> 
                                                                                                        </div>
                                                                                                        
                                                                                                        
                                                                                                    </li>
                                                                                                    
                                    
                                                                                                @endforeach
                                                                                                <li>
                                                                                                    <div class="wrap-select-div box" id="showselect" onclick="showSelect({{$subsubchild->id ?? 0}})">
                                                                                                        {{-- <button id="showselect" onclick="showSelect({{$child->id ?? 0}})"> --}}
                                                                                                            <i style="font-size:24px" class="fa add">&#xf067;</i>
                                                                                                        {{-- </button> --}}
                                                                                                        <p style="margin-top:15%">הוסף </p>
                                                                                                        <div class="select-div" id="select-div{{$subsubchild->id ?? 0}}">
                                                                                                            <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('/storeIdNumber')}}">
                                                                                                            
                                                                                                                <select  name="idNumberSelect" id="selectAdd{{$subsubchild->id ?? 0}}"  class=" selectclass selectpicker " onchange="selectChange({{$subsubchild->id ?? 0}})">
                                                                                                                        <option value="0">choose</option>
                                                                                                                        @foreach ($all_Id_Numbers as $Id_Number )
                                                                                                                            
                                                                                                                        <option value="{{$Id_Number->IDNumber }}" data-select="{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}" >{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}</option>
                                                                                                                        @endforeach
                                                                                                                        
                                                                                                                </select>
                                                                                                                <p id="paraId{{$subsubchild->id ?? 0}}" style="display: none;margin: 10%" ></p>
                                                                                                                <input type="hidden" value="{{$children_Children_Children[0]->mother_id ?? ''}}" name="mother_id" />
                                                                                                                <input type="hidden" value="{{$children_Children_Children[0]->father_id ?? ''}}" name="father_id" />
                                                                                                                <input type="hidden" value="{{$person->id ?? 0}}" name="id" />
                                                                                                                <input type="hidden" value="{{$person->IDNumber ?? ''}}" name="idNumber" />
                                                                                                                <div>
                                                                                                                <button type="submit" class="btn btn-primary" id="addbutton{{$subsubchild->id ?? 0}}" disabled >הוסף</button>
                                                                                                                </div>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                </div>
                                                                                            </li>
                                                                                            </ul>
                                                                                            
                                                                                        @endif
                                                                                    </li>
                                                                            </ul>
                                                                            @else
                                                                                <div class="childchild box">
                                                                                    @if (isset($children_Children) && $children_Children!=null && $subchild->gender !=null)
                                                                                        @if($subchild->gender === 1 )
                                                                                        <i style="font-size:24px" class="fa male openPoppup" data-id="{{$subchild->IDNumber ?? ''}}">&#xf222;</i>
                                                                                        @else
                                                                                        <i style="font-size:24px" class="fa female openPoppup" data-id="{{$subchild->IDNumber ?? ''}}">&#xf221;</i>
                                                                                        @endif   
                                                                                    @endif 
                                                                                    <p style="margin: 3% 0"> {{$subchild->PersonalName ?? ''}}</p>
                            
                                                                                    <p style="margin: 3% 0;color:black;">גיל:{{$subchild->birthYear ? Carbon\Carbon::now()->format('Y')- $subchild->birthYear : ''}}</p>
                            
                                                                                    <input type="checkbox" data-id="{{$subchild->IDNumber ?? ''}}" id="parent{{$subchild->IDNumber ?? ''}}" name="parent{{$subchild->IDNumber ?? ''}}" value="{{$subchild->IDNumber ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$subchild->IDNumber ?? 0}})"> 
                                                                                </div>
                                                                                @if(isset($children_Children_Children) && !empty($children_Children_Children) && count($children_Children_Children)>0)
                                                                                    <ul>
                                                                                        @foreach ($children_Children_Children as $subsubchild)
                                                                                            <li>
                                                                                                {{-- <i  class="fa doteIcon">&#xf111;</i> --}}
                                                                                                <div class="childchild box">
                                                                                                    @if (isset($children_Children_Children) && $children_Children_Children!=null && $subsubchild->gender !=null)
                                                                                                        @if($subsubchild->gender === 1 )
                                                                                                        <i style="font-size:24px" class="fa male openPoppup" data-id="{{$subsubchild->IDNumber ?? ''}}">&#xf222;</i>
                                                                                                        @else
                                                                                                        <i style="font-size:24px" class="fa female openPoppup" data-id="{{$subsubchild->IDNumber ?? ''}}">&#xf221;</i>
                                                                                                        @endif   
                                                                                                    @endif
                                                                                                    <p style="margin: 3% 0"> {{$subsubchild->PersonalName ?? ''}}</p>
                            
                                                                                                    <p style="margin: 3% 0;color:black;">גיל:{{$subsubchild->birthYear ? Carbon\Carbon::now()->format('Y')- $subsubchild->birthYear : ''}}</p>
                            
                                                                                                    <input type="checkbox" data-id="{{$subsubchild->IDNumber ?? ''}}" id="parent{{$subsubchild->IDNumber ?? ''}}" name="parent{{$subsubchild->IDNumber ?? ''}}" value="{{$subsubchild->IDNumber ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$subsubchild->IDNumber ?? 0}})"> 
                                                                                                </div>
                                                                                                
                                                                                                
                                                                                            </li>
                                                                                            
                            
                                                                                        @endforeach
                                                                                        <li>
                                                                                            <div class="wrap-select-div box" id="showselect" onclick="showSelect({{$subsubchild->id ?? 0}})">
                                                                                                {{-- <button id="showselect" onclick="showSelect({{$child->id ?? 0}})"> --}}
                                                                                                    <i style="font-size:24px" class="fa add">&#xf067;</i>
                                                                                                {{-- </button> --}}
                                                                                                <p style="margin-top:15%">הוסף </p>
                                                                                                <div class="select-div" id="select-div{{$subsubchild->id ?? 0}}">
                                                                                                    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('/storeIdNumber')}}">
                                                                                                    
                                                                                                        <select  name="idNumberSelect" id="selectAdd{{$subsubchild->id ?? 0}}"  class=" selectclass selectpicker " onchange="selectChange({{$subsubchild->id ?? 0}})">
                                                                                                                <option value="0">choose</option>
                                                                                                                @foreach ($all_Id_Numbers as $Id_Number )
                                                                                                                    
                                                                                                                <option value="{{$Id_Number->IDNumber }}" data-select="{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}" >{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}</option>
                                                                                                                @endforeach
                                                                                                                
                                                                                                        </select>
                                                                                                        <p id="paraId{{$subsubchild->id ?? 0}}" style="display: none;margin: 10%" ></p>
                                                                                                        <input type="hidden" value="{{$children_Children_Children[0]->mother_id ?? ''}}" name="mother_id" />
                                                                                                        <input type="hidden" value="{{$children_Children_Children[0]->father_id ?? ''}}" name="father_id" />
                                                                                                        <input type="hidden" value="{{$person->id ?? 0}}" name="id" />
                                                                                                        <input type="hidden" value="{{$person->IDNumber ?? ''}}" name="idNumber" />
                                                                                                        <div>
                                                                                                        <button type="submit" class="btn btn-primary" id="addbutton{{$subsubchild->id ?? 0}}" disabled >הוסף</button>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                    </li>
                                                                                    </ul>
                                                                                
                                                                                @endif
                                                                            @endif
                                                                            
                                                                            
                                                                            
                                                                        </li>
                                                                        
                                                                        @endforeach
                                                                        
                                                                    
                                                                    </ul>
                                                                
                                                                @endif
                                                            </li>
                                                        </ul>
                                                @else
                                                        <div class="child box">
                                                            @if (isset($children) && $children!=null && $child->gender !=null)
                                                                @if($child->gender == 1 )
                                                                <i style="font-size:24px" class="fa male openPoppup" data-id="{{$child->IDNumber ?? ''}}">&#xf222;</i>
                                                                @else
                                                                <i style="font-size:24px" class="fa female openPoppup" data-id="{{$child->IDNumber ?? ''}}">&#xf221;</i>
                                                                @endif   
                                                            @endif 
                                                            <p style="margin: 3% 0"> {{$child->PersonalName ?? ''}}</p>

                                                            <p style="margin: 3% 0;color:black;">גיל:{{$child->birthYear ? Carbon\Carbon::now()->format('Y')- $child->birthYear : ''}}</p>
                                                            <input type="checkbox" data-id="{{$child->IDNumber ?? ''}}" id="parent{{$child->IDNumber ?? ''}}" name="parent{{$child->IDNumber ?? ''}}" value="{{$child->IDNumber ?? ''}}" class="rowSelect   checkboxSelect" onclick="fillCheckbox({{$child->IDNumber ?? 0}})"> 
                                                        </div>
                                                @endif

                                                
                                                
                                                
                                            </li>
                                            
                                        @endforeach
                                        
                                    
                                    
                                    
                                </ul>
                                @endif
                            </li>

                        </ul>
                    {{-- </li> --}}
                    </li>
                </ul>
                
            </div> 
            <div class="zoomIcon" >
                <div  id="zoom-in" >
                    <i style="font-size:20px" class="fa zoom Z_in">&#xf067;</i>
                </div> 
                <div  id="zoom-out" >
                    <i style="font-size:20px" class="fa zoom Z_out">&#xf068;</i>
                </div>
            </div>
       </div>

        
        <div class="stickTopContainer">

                <ul class="nav nav-pills" role="tablist">
                    @if(session('is_admin') || session('permission')==1)
                        <li role="presentation">
                            <a href="javascript:void(0);" data-href="/list/add-to" data-title="שייך לפעיל" class="ajaxPOP">שייך לפעיל
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </li>
                        @endif
                        @if(session('is_admin'))
                        <li role="presentation">
                            <a href="javascript:void(0);" data-href="/group/add-to" data-title="שייך לקבוצה" class="ajaxPOP">שייך לקבוצה
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </li>
                        
                        <li role="presentation">
                            <a href="javascript:void(0);" data-href="/mayor/add-to" data-title="שייך לראש ראשות" class="ajaxPOP">שייך לראש רשות
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </li>
                        <li>
                            <div class="btn-group">
                                <button type="button" class="btn btn-ielect dropdown-toggle" data-toggle="dropdown">
                                    ביטול 
                                    <span class="glyphicon glyphicon-remove"></span>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="javascript:void(0);" class="disableList" data-type="list">שיוך פעיל</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="disableList" data-type="group">שיוך קבוצה</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="disableList" data-type="mayor">שיוך ראש רשות</a>
                                    </li>

                                    <li>
                                        <a href="/electors/unvote"  data-title="ביטול הצבעה" data-type="POP">הצבעה</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                    @endif

                </ul>
            
        </div>
        <script>
                var arrarIDNumber =[];
                    function showSelect(id) {
                        // alert('h');
                    document.getElementById("select-div"+id).style.display = "block";

                    }
                    function fillCheckbox(IDNumber){
                      
                        arrarIDNumber.push(IDNumber);
                    
                    }

                    let modal = document.querySelectorAll('.select-div');
                    document.onclick = function(e){
                    //   alert( e.target.classList[e.target.classList.length-1]);
                    
                        if(e.target.classList[0] !== 'select-div' && e.target.classList[0] !== 'fa' && e.target.classList[e.target.classList.length-1] !== 'pull-left' && e.target.classList[e.target.classList.length-1] !== 'text'){
                        //element clicked wasn't the div; hide the div
                        // alert(modal.length);
                        for(let i=0; i< modal.length; i++)
                        {
                            // alert(modal[i].id) ;
                            modal[i].style.display = 'none';
                            

                
                        }
                        
                        }
                    };
                    
                function selectChange(idvalue){
                    //data-select
                    var selectval =$("#selectAdd"+idvalue).val();
                    $("#paraId"+idvalue).text($(".selectAdd"+idvalue).id);
                    $("#paraId"+idvalue).css("display","block");
                    // alert('set add enable');
                    // $("#addbutton"+idvalue).
                    document.getElementById("addbutton"+idvalue).disabled = false;

                }
                        
        </script>
        <script>
            $('#zoom-in').click(function() {
                // alert('zoom');
            updateZoom(0.1);
            });

            $('#zoom-out').click(function() {
            updateZoom(-0.1);
            });


            zoomLevel = 0.4;

            var updateZoom = function(zoom) {
            zoomLevel += zoom;
            $('.tree').css({ zoom: zoomLevel, '-moz-transform': 'scale(' + zoomLevel + ')' });
            }
        </script>
         <script>
        
                const slider = document.querySelector('.firstUL');
                let isDown = false;
                let startX;
                let scrollLeft;

                slider.addEventListener('mousedown', (e) => {
                isDown = true;
                slider.classList.add('active');
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
                });
                slider.addEventListener('mouseleave', () => {
                isDown = false;
                slider.classList.remove('active');
                });
                slider.addEventListener('mouseup', () => {
                isDown = false;
                slider.classList.remove('active');
                });
                slider.addEventListener('mousemove', (e) => {
                if(!isDown) return;
                e.preventDefault();
                const x = e.pageX - slider.offsetLeft;
                const walk = (x - startX) * 3; //scroll-fast
                slider.scrollLeft = scrollLeft - walk;
                console.log(walk);
                });
         </script>
         <script>
                        (function(){
            var curYPos, curXPos, curDown;

            window.addEventListener('mousemove', function(e){ 
                if(curDown){
                window.scrollBy(curXPos - e.pageX, curYPos - e.pageY);
                }
            });

            window.addEventListener('mousedown', function(e){ 
                curYPos = e.pageY; 
                curXPos = e.pageX; 
                curDown = true; 
            });

            window.addEventListener('mouseup', function(e){ 
                curDown = false; 
            });
            })()

        </script>
     
</body>
</html>