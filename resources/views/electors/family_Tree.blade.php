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
         .tree{
             display: flex;
             justify-content: right;
             width: 100%;
             height: 100%;
             /* overflow-x: scroll;
            overflow-y: hidden; */
                
         }
         .tree:first-child{
            overflow-x: scroll;
         }
        .tree ul {
            padding-top: 20px; position: relative;
            
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            /* overflow-x: auto; */
            display: flex;
            flex-direction: row-reverse;
        }

        .tree li {
            /* overflow-x: auto; */
            float: left; text-align: center;
            list-style-type: none;
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
            border-top: 1px solid #ccc;
            width: 50%; height: 20px;
        }
        .tree li::after{
            right: auto; left: 50%;
            border-left: 1px solid #ccc;
        }

        /*We need to remove left-right connectors from elements without 
        any siblings*/
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
            border: 1px solid #ccc;
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

        /*Thats all. I hope you enjoyed it.
        Thanks :)*/
        /* .wrap-select-div:hover .select-div{
           display: block;
        } */
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
        }
        .select-div .btn-primary{
            margin-top: 10%;
            padding: 2px 37px;
        }
    </style>
</head>
<body>

<div class="tree"> 
    <?php
     $person=DB::table('electors')->where('id',$id)->first();
     $children=DB::table('electors')->where('mother_id',$IDNumber)->orWhere('father_id',$IDNumber)->get();
     $couple=DB::table('electors')->where('couple',$IDNumber)->first();
     $all_Id_Numbers=DB::table('electors')->where('mother_id',0)->where('father_id',0)->where('id','!=',$person->id)->where('id','!=',$couple->id)->pluck('IDNumber');
    //   echo($IDNumber);
    ?>
    @if(isset($person) && !empty($person) && $person->couple !=0) <!-- is single or not -->
        <ul>
            
            <li>
                @if (isset($couple) && $couple!=null && $couple->gender !=null)
                
                <div class="partner box"> 
                    <p style="margin: 3% 0;color:black">partner</p>
                        @if($couple->gender === 1 )
                        <i style="font-size:24px" class="fa">&#xf222;</i>
                        @else
                        <i style="font-size:24px" class="fa">&#xf221;</i>
                        @endif   
                
                    
                    <p style="margin: 3% 0"> {{$couple->PersonalName ?? ''}}: {{$couple->IDNumber ?? ''}}</p>
                    <input type="checkbox" data-id="{{$couple->IDNumber ?? ''}}" id="parent{{$couple->IDNumber ?? ''}}" name="parent{{$couple->IDNumber ?? ''}}" value="{{$couple->IDNumber ?? ''}}" class="rowSelect  elector">
                    
                </div>
                @endif  
                <div class="person box">
                    @if (isset($person) && $person!=null && $person->gender !=null)
                        @if($person->gender === 1 )
                        <i style="font-size:24px" class="fa">&#xf222;</i>
                        @else
                        <i style="font-size:24px" class="fa">&#xf221;</i>
                        @endif   
                    @endif 
                <p style="margin: 3% 0"> {{$person->PersonalName ?? ''}}: {{$person->IDNumber ?? ''}}</p>
                <input type="checkbox" data-id="{{$person->IDNumber ?? ''}}" id="parent{{$person->IDNumber ?? ''}}" name="parent{{$person->IDNumber ?? ''}}" value="{{$person->IDNumber ?? ''}}" class="rowSelect  elector">
                    
                </div>
                
            
                <ul>
                    
                    
                    @if(isset($children) && !empty($children))
                            
                        @foreach ($children as $child)

                            <li>
                                <div class="child box">
                                    @if (isset($children) && $children!=null && $child->gender !=null)
                                        @if($child->gender == 1 )
                                        <i style="font-size:24px" class="fa">&#xf222;</i>
                                        @else
                                        <i style="font-size:24px" class="fa">&#xf221;</i>
                                        @endif   
                                    @endif 
                                    <p style="margin: 3% 0"> {{$child->PersonalName ?? ''}}: {{$child->IDNumber ?? ''}}</p>
                                    <input type="checkbox" data-id="{{$child->IDNumber ?? ''}}" id="parent{{$child->IDNumber ?? ''}}" name="parent{{$child->IDNumber ?? ''}}" value="{{$child->IDNumber ?? ''}}" class="rowSelect  elector"> 
                                </div>
                                <?php
                                    $children_Children=DB::table('electors')->where('mother_id',$child->IDNumber)->orWhere('father_id',$child->IDNumber)->get();
                                    // print_r($children_Children);
                                ?>
                                @if(isset($children_Children) && !empty($children_Children))
                                    
                                    <ul>
                                        @if(isset($children_Children) && count($children_Children)>0)
                                        <li>
                                            <div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>
                                            <div class="wrap-select-div">
                                                <button id="showselect" onclick="showSelect({{$child->id}})"><i style="font-size:24px" class="fa">&#xf067;</i></button>
                                                <div class="select-div" id="select-div{{$child->id}}">
                                                    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('/storeIdNumber')}}">
                                                    
                                                        <select  name="idNumberSelect" id="selectAdd{{$child->id}}" class="selectclass">
                                                                <option value="0">choose</option>
                                                                @foreach ($all_Id_Numbers as $Id_Number )
                                                                    
                                                                    <option value="{{$Id_Number }}" >{{$Id_Number}}</option>
                                                                @endforeach
                                                                
                                                        </select>
                                                        <input type="hidden" value="{{$children_Children[0]->mother_id ?? ''}}" name="mother_id" />
                                                        <input type="hidden" value="{{$children_Children[0]->father_id ?? ''}}" name="father_id" />
                                                        <input type="hidden" value="{{$person->id ?? ''}}" name="id" />
                                                        <input type="hidden" value="{{$person->IDNumber ?? ''}}" name="idNumber" />
                                                        <button type="submit" class="btn btn-primary" >add</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                        @foreach ($children_Children as $subchild)
                                        <li>
                                            
                                            <div class="childchild box">
                                                @if (isset($children_Children) && $children_Children!=null && $subchild->gender !=null)
                                                    @if($subchild->gender === 1 )
                                                    <i style="font-size:24px" class="fa">&#xf222;</i>
                                                    @else
                                                    <i style="font-size:24px" class="fa">&#xf221;</i>
                                                    @endif   
                                                @endif 
                                                <p style="margin: 3% 0"> {{$subchild->PersonalName ?? ''}}: {{$subchild->IDNumber ?? ''}}</p>
                                                <input type="checkbox" data-id="{{$subchild->IDNumber ?? ''}}" id="parent{{$subchild->IDNumber ?? ''}}" name="parent{{$subchild->IDNumber ?? ''}}" value="{{$subchild->IDNumber ?? ''}}" class="rowSelect  elector"> 
                                            </div>
                                            <?php
                                                $children_Children_Children=DB::table('electors')->where('mother_id',$subchild->IDNumber)->get();
                                                // echo($children_Children);
                                            ?>
                                            @if(isset($children_Children_Children) && !empty($children_Children_Children))
                                                
                                                <ul>
                                                    @foreach ($children_Children_Children as $subsubchild)
                                                    <li>
                                                        
                                                        <div class="childchild box">
                                                            @if (isset($children_Children_Children) && $children_Children_Children!=null && $subsubchild->gender !=null)
                                                                @if($subsubchild->gender === 1 )
                                                                <i style="font-size:24px" class="fa">&#xf222;</i>
                                                                @else
                                                                <i style="font-size:24px" class="fa">&#xf221;</i>
                                                                @endif   
                                                            @endif
                                                            <p style="margin: 3% 0"> {{$subsubchild->PersonalName ?? ''}}: {{$subsubchild->IDNumber ?? ''}}</p>
                                                            <input type="checkbox" data-id="{{$subsubchild->IDNumber ?? ''}}" id="parent{{$subsubchild->IDNumber ?? ''}}" name="parent{{$subsubchild->IDNumber ?? ''}}" value="{{$subsubchild->IDNumber ?? ''}}" class="rowSelect  elector"> 
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
                            <div class="wrap-select-div">
                                <button id="showselect" onclick="showSelect({{$person->id}})"><i style="font-size:24px" class="fa">&#xf067;</i></button>
                                <div class="select-div" id="select-div{{$person->id }}">
                                    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('/storeIdNumber')}}">
                                    
                                        <select name="idNumberSelect" id="selectAdd{{$person->id}}" class="selectclass">
                                                <option value="0">choose</option>
                                                @foreach ($all_Id_Numbers as $Id_Number )
                                                    
                                                    <option value="{{$Id_Number }}" >{{$Id_Number}}</option>
                                                @endforeach
                                                
                                        </select>
                                        <input type="hidden" value="{{$children[0]->mother_id ?? ''}}" name="mother_id" />
                                        <input type="hidden" value="{{$children[0]->father_id ?? ''}}" name="father_id" />
                                        <input type="hidden" value="{{$person->id ?? ''}}" name="id" />
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
                <?php
                $father=DB::table('electors')->where('IDNumber',$person->father_id)->first();
                $mother=DB::table('electors')->where('IDNumber',$person->mother_id)->first();
                $brother=DB::table('electors')->where('mother_id',$person->mother_id)->orWhere('father_id',$person->father_id)->get();
                
                // print_r($all_Id_Numbers);
                ?>
                @if (isset($person) && $person!=null && $person->gender !=null)
                    <div class="mother box">
                        <p style="margin: 3% 0;color:black">Mother</p>
                        <i style="font-size:24px" class="fa">&#xf221;</i>
                
                        <p style="margin: 3% 0"> {{$mother->PersonalName ?? ''}}: {{$mother->IDNumber ?? ''}}</p>
                        <input type="checkbox" data-id="{{$mother->IDNumber ?? ''}}" id="parent{{$mother->IDNumber ?? ''}}" name="parent{{$mother->IDNumber ?? ''}}" value="{{$mother->IDNumber ?? ''}}" class="rowSelect  elector">
                        
                    </div>
                    <div class="father box"> 
                        <p style="margin: 3% 0;color:black">father</p>
                        <i style="font-size:24px" class="fa">&#xf222;</i>
                        <p style="margin: 3% 0"> {{$father->PersonalName ?? ''}}: {{$father->IDNumber ?? ''}}</p>
                        <input type="checkbox" data-id="{{$father->IDNumber ?? ''}}" id="parent{{$father->IDNumber ?? ''}}" name="parent{{$father->IDNumber ?? ''}}" value="{{$father->IDNumber ?? ''}}" class="rowSelect  elector">
                            
                    </div>
                
                @endif
            
            
                <ul>
                
                
                    <li>
                        <div class="wrap-select-div">
                            <button id="showselect" onclick="showSelect2({{$person->id}})"><i style="font-size:24px" class="fa">&#xf067;</i></button>
                            <div class="select-div" id="select-div2{{$person->id}}">
                                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('/storeIdNumber')}}">
                                
                                    <select name="idNumberSelect" id="selectAdd" class="selectclass" >
                                            <option value="0">choose</option>
                                            @foreach ($all_Id_Numbers as $Id_Number )
                                                
                                                <option value="{{$Id_Number }}" >{{$Id_Number}}</option>
                                            @endforeach
                                            
                                    </select>
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
                            <i style="font-size:24px" class="fa">&#xf222;</i>
                            @else
                            <i style="font-size:24px" class="fa">&#xf221;</i>
                            @endif   
                        
                            <p style="margin: 3% 0"> {{$brotherfirst->PersonalName ?? ''}}: {{$brotherfirst->IDNumber ?? ''}}</p>
                            <input type="checkbox" data-id="{{$brotherfirst->IDNumber ?? ''}}" id="parent{{$brotherfirst->IDNumber ?? ''}}" name="parent{{$brotherfirst->IDNumber ?? ''}}" value="{{$brotherfirst->IDNumber ?? ''}}" class="rowSelect  elector"> 
                        </div>
                    </li>
                    @endforeach
                        
                    @endif
                    
                    
                        
                </ul>
            </li>

        </ul>
    @endif
    
</div> 


<div class="col-xs-12 stickTopContainer" style="margin: 10%">
	{{-- <div class="jumbotron stickTop"> --}}

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

			<li>

					<div class="btn-group">
							<button type="button" class="btn btn-ielect dropdown-toggle" data-toggle="dropdown">

							הדפסה
                            <span class="glyphicon glyphicon-print"></span>
							<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/electors/print" data-url="/electors/print" class="printSelected"  target="_blank">טבלה</a></li>
								<li><a href="/electors/print/10_3" data-url="/electors/print/10_3" class="printSelected" target="_blank">מדבקות 10/3</a></li>
								<li><a href="/electors/print/8_3" data-url="/electors/print/8_3" class="printSelected" target="_blank">מדבקות 8/3 </a></li>
							</ul>
						</div>
				</li>

           @if(session('is_admin') || session('permission')==1)
			<li>
			
				<div class="btn-group">
					<button type="button" class="btn btn-ielect dropdown-toggle" data-toggle="dropdown">

						שליחת הודעה
						<span class="glyphicon glyphicon-envelope"></span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="javascript:void(0)" class="sendSmsAjaxEelectors" data-type="ballot-location">שלח מיקום הצבעה</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="sendSmsAjaxEelectors" data-type="electors">שלח הודעת טקסט</a>
						</li>

					</ul>
				</div>
				
			</li>
			@endif
			<li>

				<div class="btn-group">
					<button type="button" class="btn btn-ielect dropdown-toggle" data-toggle="dropdown">

						יצוא
						<span class="glyphicon glyphicon-export"></span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="/electors/export/xls" target="_blank">Excel - xls</a>
						</li>
						<li>
							<a href="/electors/export/xlsx" target="_blank">Excel - xlsx</a>
						</li>
						<li>
							<a href="/electors/export/csv" target="_blank">CSV</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>
	{{-- </div> --}}
</div>
    <script>
    
        function showSelect(id) {
            // alert('h');
        document.getElementById("select-div"+id).style.display = "block";
        }

        let modal = document.querySelectorAll('.select-div');
        document.onclick = function(e){
        //   alert(e.target.classList[0]);
         
            if(e.target.classList[0] !== 'select-div' && e.target.classList[0] !== 'fa' && e.target.classList[0] !== 'selectclass'){
            //element clicked wasn't the div; hide the div
            // alert(modal.length);
             for(let i=0; i< modal.length; i++)
             {
                // alert(modal[i].id) ;
                modal[i].style.display = 'none';
    
             }
            
            }
        };
       
    </script>
     
</body>
</html>