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
          
                
         }
         .tree ul:first-child{
            overflow-x: scroll;
            
         }
        .tree ul {
            padding: 10px 0; 
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
            top: 22px;
            right: 0;
            display: none;
            padding: 20px;
            border: 1px solid black;
            background-color: white;
            border-radius: 15px;
            padding: 31%;
        }
        .select-div .btn-primary{
            margin-top: 10%;
            padding: 2px 37px;
        }
        .stickTopContainer{
            width: 100%;
            color: white;
            position: absolute;
            /* bottom: 0; */
            display: flex;
            justify-content: center;
            align-items: center;
            
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
    </style>
</head>
<body>
  
        <div class="tree" > 
            <?php
            $person=DB::table('electors')->where('id',$id)->first();
            $children=DB::table('electors')->where('mother_id',$IDNumber)->orWhere('father_id',$IDNumber)->get();
            $couple=DB::table('electors')->where('couple',$IDNumber)->first();
            $all_Id_Numbers=DB::table('electors')->where('mother_id',0)->where('father_id',0)->where('id','!=',$person->id ?? 0)->where('id','!=',$couple->id ?? 0)->get();
            $father=DB::table('electors')->where('IDNumber',$person->father_id)->first();
            $mother=DB::table('electors')->where('IDNumber',$person->mother_id)->first();
            $brother=DB::table('electors')->where('mother_id',$person->mother_id)->orWhere('father_id',$person->father_id)->get();
            // print_r($all_Id_Numbers);
            ?>
            @if(isset($person) && !empty($person) && $person->couple !=0) <!-- is single or not -->
                <ul>
                    
                    <li>
                        @if (isset($couple) && $couple!=null && $couple->gender !=null)
                        
                        <div class="partner box"> 
                            <input type="checkbox" data-id="{{$couple->IDNumber ?? ''}}" id="parent{{$couple->IDNumber ?? ''}}" name="parent{{$couple->IDNumber ?? ''}}" value="{{$couple->IDNumber ?? ''}}" class="rowSelect  elector" onclick="fillCheckbox({{$couple->IDNumber ?? 0}})">
                                    @if($couple->gender === 1 )
                                    <i style="font-size:24px" class="fa male">&#xf222;</i>
                                    @else
                                    <i style="font-size:24px" class="fa female">&#xf221;</i>
                                    @endif   
                        
                                <p style="margin: 3% 0;"> {{$couple->PersonalName ?? ''}}</p>

                                <p style="margin: 3% 0;color:black;">גיל:{{$couple->birthYear ? Carbon\Carbon::now()->format('Y')- $couple->birthYear : ''}}</p>
                            
                        </div>
                        @endif  
                        <div class="person box">
                            @if (isset($person) && $person!=null && $person->gender !=null)
                                @if($person->gender === 1 )
                                <i style="font-size:24px" class="fa male">&#xf222;</i>
                                @else
                                <i style="font-size:24px" class="fa female">&#xf221;</i>
                                @endif   
                            @endif 
                                <p style="margin: 3% 0"> {{$person->PersonalName ?? ''}}</p>
                                <p style="margin: 3% 0;color:black;">גיל:{{$person->birthYear ? Carbon\Carbon::now()->format('Y')- $person->birthYear : ''}}</p>

                                <input type="checkbox" data-id="{{$person->IDNumber ?? ''}}" id="parent{{$person->IDNumber ?? ''}}" name="parent{{$person->IDNumber ?? ''}}" value="{{$person->IDNumber ?? ''}}" class="rowSelect  elector" onclick="fillCheckbox({{$person->IDNumber ?? 0}})">
                            
                        </div>
                        
                    
                        <ul>
                            
                            
                            @if(isset($children) && !empty($children))
                                    
                                @foreach ($children as $child)
                                    <li>
                                        {{-- <i  class="fa doteIcon">&#xf111;</i> --}}
                                        <div class="child box">
                                            @if (isset($children) && $children!=null && $child->gender !=null)
                                                @if($child->gender == 1 )
                                                <i style="font-size:24px" class="fa male">&#xf222;</i>
                                                @else
                                                <i style="font-size:24px" class="fa female">&#xf221;</i>
                                                @endif   
                                            @endif 
                                            <p style="margin: 3% 0"> {{$child->PersonalName ?? ''}}</p>

                                            <p style="margin: 3% 0;color:black;">גיל:{{$child->birthYear ? Carbon\Carbon::now()->format('Y')- $child->birthYear : ''}}</p>
                                            <input type="checkbox" data-id="{{$child->IDNumber ?? ''}}" id="parent{{$child->IDNumber ?? ''}}" name="parent{{$child->IDNumber ?? ''}}" value="{{$child->IDNumber ?? ''}}" class="rowSelect  elector" onclick="fillCheckbox({{$child->IDNumber ?? 0}})"> 
                                        </div>
                                        <?php
                                            $children_Children=DB::table('electors')->where('mother_id',$child->IDNumber)->orWhere('father_id',$child->IDNumber)->get();
                                            // print_r($children_Children);
                                        ?>
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
                                                                            
                                                                            <option value="{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}" >{{$Id_Number->IDNumber}}</option>
                                                                        @endforeach
                                                                        
                                                                </select>
                                                                <p id="paraId{{$child->id ?? 0}}" style="display: none;margin: 10%" ></p>
                                                                <input type="hidden" value="{{$children_Children[0]->mother_id ?? ''}}" name="mother_id" />
                                                                <input type="hidden" value="{{$children_Children[0]->father_id ?? ''}}" name="father_id" />
                                                                <input type="hidden" value="{{$person->id ?? 0}}" name="id" />
                                                                <input type="hidden" value="{{$person->IDNumber ?? ''}}" name="idNumber" />
                                                                <button type="submit" class="btn btn-primary" >add</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endif
                                                @foreach ($children_Children as $subchild)
                                                <li>
                                                    {{-- <i  class="fa doteIcon">&#xf111;</i> --}}
                                                    <div class="childchild box">
                                                        @if (isset($children_Children) && $children_Children!=null && $subchild->gender !=null)
                                                            @if($subchild->gender === 1 )
                                                            <i style="font-size:24px" class="fa male">&#xf222;</i>
                                                            @else
                                                            <i style="font-size:24px" class="fa female">&#xf221;</i>
                                                            @endif   
                                                        @endif 
                                                        <p style="margin: 3% 0"> {{$subchild->PersonalName ?? ''}}</p>

                                                        <p style="margin: 3% 0;color:black;">גיל:{{$subchild->birthYear ? Carbon\Carbon::now()->format('Y')- $subchild->birthYear : ''}}</p>

                                                        <input type="checkbox" data-id="{{$subchild->IDNumber ?? ''}}" id="parent{{$subchild->IDNumber ?? ''}}" name="parent{{$subchild->IDNumber ?? ''}}" value="{{$subchild->IDNumber ?? ''}}" class="rowSelect  elector" onclick="fillCheckbox({{$subchild->IDNumber ?? 0}})"> 
                                                    </div>
                                                    <?php
                                                        $children_Children_Children=DB::table('electors')->where('mother_id',$subchild->IDNumber)->get();
                                                        // echo($children_Children);
                                                    ?>
                                                    @if(isset($children_Children_Children) && !empty($children_Children_Children) && count($children_Children_Children)>0)
                                                        
                                                        <ul>
                                                            @foreach ($children_Children_Children as $subsubchild)
                                                            <li>
                                                                {{-- <i  class="fa doteIcon">&#xf111;</i> --}}
                                                                <div class="childchild box">
                                                                    @if (isset($children_Children_Children) && $children_Children_Children!=null && $subsubchild->gender !=null)
                                                                        @if($subsubchild->gender === 1 )
                                                                        <i style="font-size:24px" class="fa male">&#xf222;</i>
                                                                        @else
                                                                        <i style="font-size:24px" class="fa female">&#xf221;</i>
                                                                        @endif   
                                                                    @endif
                                                                    <p style="margin: 3% 0"> {{$subsubchild->PersonalName ?? ''}}</p>

                                                                    <p style="margin: 3% 0;color:black;">גיל:{{$subsubchild->birthYear ? Carbon\Carbon::now()->format('Y')- $subsubchild->birthYear : ''}}</p>

                                                                    <input type="checkbox" data-id="{{$subsubchild->IDNumber ?? ''}}" id="parent{{$subsubchild->IDNumber ?? ''}}" name="parent{{$subsubchild->IDNumber ?? ''}}" value="{{$subsubchild->IDNumber ?? ''}}" class="rowSelect  elector" onclick="fillCheckbox({{$subsubchild->IDNumber ?? 0}})"> 
                                                                </div>
                                                                
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                        
                                                    @endif
                                                    
                                                </li>
                                                @endforeach
                                            
                                            </ul>
                                            
                                        @endif
                                    </li>
                                    
                                @endforeach
                                <li>
                                    <div class="wrap-select-div box" id="showselect" onclick="showSelect({{$person->id ?? 0}})">
                                        {{-- <button id="showselect" onclick="showSelect({{$person->id}})"> --}}
                                            <i style="font-size:24px" class="fa add">&#xf067;</i>
                                        {{-- </button> --}}
                                        <p style="margin-top:15%">הוסף </p>
                                        <div class="select-div" id="select-div{{$person->id }}">
                                            <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('/storeIdNumber')}}">
                                            
                                                <select name="idNumberSelect" id="selectAdd{{$person->id }}" class=" selectclass selectpicker" onchange="selectChange({{$person->id }})">
                                                        <option value="0">choose</option>
                                                        @foreach ($all_Id_Numbers as $Id_Number )
                                                            
                                                            <option value="{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}" >{{$Id_Number->IDNumber}}</option>
                                                        @endforeach
                                                        
                                                </select>
                                                <p id="paraId{{$person->id }}"  style="display: none;margin: 10%"></p>

                                                <input type="hidden" value="{{$children[0]->mother_id ?? ''}}" name="mother_id" />
                                                <input type="hidden" value="{{$children[0]->father_id ?? ''}}" name="father_id" />
                                                <input type="hidden" value="{{$person->id ?? 0}}" name="id" />
                                                <input type="hidden" value="{{$person->IDNumber ?? ''}}" name="idNumber" />
                                                <button type="submit" class="btn btn-primary">add</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            
                            
                        </ul>
                    </li>

                </ul>
            @else
            
                <ul>
                    
                    <li>
                    
                        @if (isset($person) && $person!=null && $person->gender !=null)
                            <div class="mother box">
                                {{-- <p style="margin: 3% 0;color:black">Mother</p> --}}
                                <i style="font-size:24px" class="fa female">&#xf221;</i>
                        
                                <p style="margin: 3% 0"> {{$mother->PersonalName ?? ''}}</p>
                                <p style="margin: 3% 0;color:black;">גיל:{{$mother->birthYear ? Carbon\Carbon::now()->format('Y')- $mother->birthYear : ''}}</p>

                                <input type="checkbox" data-id="{{$mother->IDNumber ?? ''}}" id="parent{{$mother->IDNumber ?? ''}}" name="parent{{$mother->IDNumber ?? ''}}" value="{{$mother->IDNumber ?? ''}}" class="rowSelect  elector" onclick="fillCheckbox({{$mother->IDNumber ?? 0}})">
                                
                            </div>
                            <div class="father box"> 
                                {{-- <p style="margin: 3% 0;color:black">father</p> --}}
                                <i style="font-size:24px" class="fa male">&#xf222;</i>
                                <p style="margin: 3% 0"> {{$father->PersonalName ?? ''}}</p>
                                <p style="margin: 3% 0;color:black;">גיל:{{$father->birthYear ? Carbon\Carbon::now()->format('Y')- $father->birthYear : ''}}</p>

                                <input type="checkbox" data-id="{{$father->IDNumber ?? ''}}" id="parent{{$father->IDNumber ?? ''}}" name="parent{{$father->IDNumber ?? ''}}" value="{{$father->IDNumber ?? ''}}" class="rowSelect  elector" onclick="fillCheckbox({{$father->IDNumber ?? 0}})">
                                    
                            </div>
                        
                        @endif
                    
                    
                        <ul>
                        
                        
                            <li>
                                <div class="wrap-select-div box" id="showselect" onclick="showSelect({{$person->id ?? 0}})">
                                    {{-- <button id="showselect" onclick="showSelect({{$person->id ?? 0}})"> --}}
                                        <i style="font-size:24px" class="fa add">&#xf067;</i>
                                    {{-- </button> --}}
                                    <p style="margin-top:15%">הוסף </p>
                                    <div class="select-div" id="select-div{{$person->id ?? 0}}">
                                        <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('/storeIdNumber')}}">
                                        
                                            <select name="idNumberSelect" id="selectAdd{{$person->id ?? 0}}" class=" selectclass selectpicker" onchange="selectChange({{$person->id }})">
                                                    <option value="0">choose</option>
                                                    @foreach ($all_Id_Numbers as $Id_Number )
                                                        
                                                        <option value="{{$Id_Number->PersonalName }}:{{$Id_Number->IDNumber }}" >{{$Id_Number->IDNumber}}</option>
                                                    @endforeach
                                                    
                                            </select>
                                            <p id="paraId{{$person->id }}" style="display: none;margin: 10%"></p>

                                            <input type="hidden" value="{{$mother->IDNumber ?? ''}}" name="mother_id" />
                                            <input type="hidden" value="{{$father->IDNumber ?? ''}}" name="father_id" />
                                            <input type="hidden" value="{{$person->id ?? ''}}" name="id" />
                                            <input type="hidden" value="{{$person->IDNumber ?? ''}}" name="idNumber" />
                                            <button type="submit" class="btn btn-primary">add</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            
                                
                            @if(isset($brother) && !empty($brother))
                            @foreach($brother as  $brotherfirst)
                            <li>
                                <div class="brother box" @if($brotherfirst->IDNumber == $person->IDNumber ) style="border:1px solid black" @endif >
                                    @if($brotherfirst->gender == 1 )
                                    <i style="font-size:24px" class="fa female">&#xf221;</i>
                                    @else
                                    <i style="font-size:24px" class="fa female">&#xf221;</i>
                                    @endif   
                                
                                    <p style="margin: 3% 0"> {{$brotherfirst->PersonalName ?? ''}}</p>
                                    <p style="margin: 3% 0;color:black;">גיל:{{$brotherfirst->birthYear ? Carbon\Carbon::now()->format('Y')- $brotherfirst->birthYear : ''}}</p>

                                    <input type="checkbox" data-id="{{$brotherfirst->IDNumber ?? ''}}" id="parent{{$brotherfirst->IDNumber ?? ''}}" name="parent{{$brotherfirst->IDNumber ?? ''}}" value="{{$brotherfirst->IDNumber ?? ''}}" class="rowSelect  elector" onclick="fillCheckbox({{$brotherfirst->IDNumber ?? 0}})"> 
                                </div>
                            </li>
                            @endforeach
                                
                            @endif
                            
                            
                                
                        </ul>
                    </li>

                </ul>
            @endif
            
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
                        {{-- <li>
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
                        </li> --}}
                        
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
        
      function selectChange(id){
        
        $("#paraId"+id).text($("#selectAdd"+id).val());
        $("#paraId"+id).css("display","block");
      }
            
    </script>
     
</body>
</html>