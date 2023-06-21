
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>iElect</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="https://maxcdn.bootstrapcdn.com/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
<link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" />
<link rel="stylesheet" type="text/css" href="//www.fontstatic.com/f=rawy-bold" />
<link rel="stylesheet" type="text/css" href="//www.fontstatic.com/f=alhurra,droid-sans" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/login-mobile.css">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700&amp;subset=hebrew" rel="stylesheet">
    <link rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="login-back">
 <div class="loading Loading" style="display:none;">Loading&#8230;</div>

    <div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-wassat">
         <div class="modal-content">
             <div class="modal-header">
                 <div class="modal-title">رسالة</div>


             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col-xs-12 content">

                     </div>

                 </div>
                 <div class="row">
                   <div class="col-xs-12 pull-right  mrg-top-15" style="margin-top:15px;">

                       <button type="button" class="btn btn-xs btn-success pull-right mrg-right-5" data-dismiss="modal">&nbsp;موافق&nbsp;</button>
                   </div>
                 </div>

             </div><!-- /modal-body -->
         </div><!-- /modal-content -->
     </div><!-- /modal-wassat -->
 </div><!-- /modal -->



    <div class="container loginContainer">
      <div class="row formContainer">
        <div class="col-xs-12 right-side">
          <img src="/images/logo_login.png" class="img-responsive" />


        </div>
        <div class="col-xs-12 pull-left left-side">
          <h2>כניסת משתמש</h2>
          <form role="form"  method="post" id="login-form" autocomplete="off">
              <div class="form-group">
                <img src="/images/username.png" class="ico" />
                  <label for="email" required class="sr-only">שם משתמש</label>
                  <input type="text" required name="username" id="email" class="form-control" placeholder="שם משתמש">
              </div>
              <div class="form-group">
                  <img src="/images/password.png" class="ico" />
                  <label for="key" class="sr-only">סיסמה</label>
                  <input type="password" name="password" id="key" class="form-control" placeholder="סיסמה">
              </div>

              <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-login" value="כניסה">
          </form>


        </div>
      </div>




    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://maxcdn.bootstrapcdn.com/js/ie10-viewport-bug-workaround.js"></script>
    <script>
    $(document).ready(function(){

      $('.formContainer').addClass('animated fadeInDown');
    });

    </script>

  </body>
</html>
