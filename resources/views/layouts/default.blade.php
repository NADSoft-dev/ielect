<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ielect</title>
    {{-- <style>
          /*Now the CSS*/
      /* * {margin: 0; padding: 0} */
      .tree{
      display: flex;
      justify-content: right;
      width: 100%;
      height: 100%;
      /* overflow-x: scroll;
      overflow-y: hidden; */
      }
      .tree ul {
      padding-top: 20px; position: relative;
      transition: all 0.5s;
      -webkit-transition: all 0.5s;
      -moz-transition: all 0.5s;
      /* overflow-x: auto; */
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
      background: #C8E4F8; color: #000; border: 1px solid #94A0B4;
      }
      /*Connector styles on hover*/
      .tree li a:hover+ul li::after,
      .tree li a:hover+ul li::before,
      .tree li a:hover+ul::before,
      .tree li a:hover+ul ul::before{
      border-color:  #94A0B4;
      }
      /*Thats all. I hope you enjoyed it.
      Thanks :)*/
      .wrap-select-div:hover .select-div{
      display: block;
      }
      .wrap-select-div{
      position: relative;
      }
      .select-div{
      position: absolute;
      top: 10px;
      right: 0;
      /* display: none; */
      padding: 40px;
      }
    </style> --}}
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link href="https://bootswatch.com/3/flatly/bootstrap.min.css" rel="stylesheet">



<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
<link href="https://fonts.googleapis.com/css?family=Assistant:200|Rubik:300,400" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/font.css') }}">
<link rel="stylesheet" href="{{ asset('css/dscountdown.css') }}">
  <link rel="stylesheet" href="{{ mix('css/all.css') }}">
  
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  {{-- <h1>test</h1> --}}
  <body>
<div class="loading Loading" style="display:none;">Loading&#8230;</div>
<div id="dModals"></div>

<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-wassat">
        <div class="modal-content">

          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12 content">


                  </div>
                  <br />
                <hr />
                      <div class="col-xs-12">
                        <button type="button" class="btn btn-xs btn-success" id="ConfirmModalOk" data-dismiss="modal">&nbsp;כן&nbsp;</button>
                        <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">&nbsp;ביטול&nbsp;</button>


                      </div>


              </div>

          </div><!-- /modal-body -->


        </div><!-- /modal-content -->
    </div><!-- /modal-wassat -->
</div><!-- /modal -->



<div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-wassat">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 content">


                    </div>
                    <br />
                  <hr />
                        <div class="col-xs-12">
                          <button type="button" class="btn btn-xs btn-success" data-dismiss="modal">&nbsp;סגור&nbsp;</button>
                        </div>


                </div>

            </div><!-- /modal-body -->
        </div><!-- /modal-content -->
    </div><!-- /modal-wassat -->
</div><!-- /modal -->



          <nav class="navbar navbar-default no-radius" role="navigation">
            <div class="container no-padding" >


            <div class="navbar-header">

              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <a class="navbar-brand" href="/#/main/"><img src="/images/logo.png" /></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-01">

              <ul class="nav navbar-nav navbar-left">
                <li><a href="/#/electors/main/"><img class="icon" src="/images/icon1.png" /> רשימת בוחרים </a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="icon" src="/images/icon3.png" /> ניהול רשימות <b class="caret"></b></a>
                  <span class="dropdown-arrow"></span>
                  <ul class="dropdown-menu">
                    @if(session('is_admin'))
                    <li><a href="/#/delegate/all/">רשימת אחראיים</a></li>
                    @endif
                    @if(session('is_admin') || session('permission')==1)
                    <li><a href="/#/list/all/">רשימת פעילים</a></li>
                    @endif
                    @if(session('is_admin'))
                    <li class="divider"></li>
                    <li><a href="/#/mayor/all/">ראשי רשויות</a></li>

                    <li class="divider"></li>
                    <li><a href="/#/group/all/">רשימת קבוצות</a></li>
                    @endif
                      <li class="divider"></li>
                      <li><a href="/#/kalfy/list/">רשימת קלפיות</a></li>


                  </ul>

                </li>
                @if(session('is_admin') || (isset(session('member')->statistics) && session('member')->statistics))
                <li><a href="/#/stats/main/"> <img class="icon" src="/images/icon4.png" /> סטטיסטיקות</a></li>
                @endif
                @if(session('is_admin') || (isset(session('member')->elections_day) && session('member')->elections_day))
                


                   <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="icon" src="/images/icon2.png" /> יום בחירות<b class="caret"></b></a>
                  <span class="dropdown-arrow"></span>
                  <ul class="dropdown-menu">
                  <li><a href="/#/electors/elections-day/"> יום בחירות</a></li>
               
                  <li class="divider"></li>
                  <li><a href="/#/electors/elections-day-final/">ספירת קולות</a></li>
           

                  </ul>

                </li>

                @endif  
                  
                @if(session('is_admin') || session('permission')==1)
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="icon" src="/images/icon6.png" /> פעולות<b class="caret"></b></a>
                  <span class="dropdown-arrow"></span>
                  <ul class="dropdown-menu">
                  @if(session('is_admin') || session('permission')==1)
                  <li><a href="/#/electors/voted/">סימון הצבעה</a></li>
                  @endif
                  @if(session('is_admin'))
                  <li class="divider"></li>
                    <li><a href="/#/page/family-join/">איחוד משפחות</a></li>
                    <li class="divider"></li>
                    <li><a href="/#/page/family-join-reset/">איפוס איחוד משפחות</a></li>
                    
                    <li class="divider"></li>
                    <li><a href="/#/page/workers/">ניהול עובדי קלפי</a></li>
                    <li class="divider"></li>
                    <li><a href="/#/page/parties/">ניהול מפלגות</a></li>
                  @endif

                  </ul>

                </li>
                @endif

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">  {{session('member')->username}} <b class="caret"></b></a>
                  <span class="dropdown-arrow"></span>
                  <ul class="dropdown-menu">
                  @if(session('is_admin'))
                    <li><a href="/#/page/settings/">הגדרות</a></li>
                    <li class="divider"></li>
                  @endif  
                    <li><a href="/logout">יציאה</a></li>
                  </ul>
                </li>


               </ul>
               <ul class="nav navbar-nav navbar-left">



               </ul>

            </div><!-- /.navbar-collapse -->
              </div>

          </nav><!-- /navbar -->
  <div class="container" id="MainContent">
    <script>
    if(!window.location.hash) window.location.href="#/main/";
    </script>

  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
      <script src="js/jquery.routes.js"></script>
    <script src="js/app.routes.js?v=<?=rand();?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.2.1/typeahead.bundle.min.js"></script>
    <script src="js/megatam.js?v=<?=rand();?>"></script>
    <script type="text/javascript" src="js/main.js?v=<?=rand();?>"></script>
      <script type="text/javascript" src="js/events.js?v=<?=rand();?>"></script>
      <script type="text/javascript" src="js/dscountdown.min.js"></script>


  </body>
</html>
