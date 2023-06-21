<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ielect</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
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
  <body class="rtl">
      <style>
          body{
            padding-top: 80px;
          }
          </style>
    <div class="alert alert-success stickyAlert" role="alert">
      הפעולה נשמרה בהצלחה
    </div>

    <div class="jumbotron">
      <div class="container">
        <h3 class="display-7">שלום {{Session::get('memberMobile')->full_name}}</h3>
        <p class="lead">אתה רשום לקלפי מספר: {{Session::get('memberMobile')->kalfy}}</p>
      </div>
    </div>
<div class="modal fade alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">הודעת מערכת</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h6></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal">אישור</button>
      </div>
    </div>
  </div>
</div>


<div class="loading Loading" style="display:none;">Loading&#8230;</div>
<div id="dModals"></div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom-primary fixed-top">
      <div class="container">


        <a class="navbar-brand" href="#"><img src="/images/logo.png" /></a>

<a href="/mobile/logout" class="btn btn-sm btn-danger pull-left mrg-tp-15">יציאה</a>
    </div>
    
    </nav>

    <!-- Page Content -->
    <div class="container app-container" id="pjax-container">
      @yield('content')
    </div>
    <!-- /.container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
      <script src="/js/jquery.routes.js"></script>
    <script src="/js/app.routes.js?v=<?=rand();?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.2.1/typeahead.bundle.min.js"></script>
    <script src="/js/megatam.js?v=<?=rand();?>"></script>
    <script type="text/javascript" src="/js/main.js?v=<?=rand();?>"></script>
      <script type="text/javascript" src="/js/events.js?v=<?=rand();?>"></script>
      <script type="text/javascript" src="/js/dscountdown.min.js"></script>

  @stack('scripts')
<script>
function successAlert(){
  $('.stickyAlert').fadeIn();
  setTimeout(function(){
    $('.stickyAlert').fadeOut();
  },2000);
}

</script>
  </body>
</html>
