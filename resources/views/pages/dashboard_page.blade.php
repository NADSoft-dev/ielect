<div class="col-xs-12">
  <div class="countDownHead">
<h3 style="text-align:center;margin-bottom:15px;">נשאר לסגירת קלפי:</h3>
<center>
  <div class="countdown"></div>
</center>

</div>


</div>




<div class="col-sm-4 col-xs-12">
  <?php
$data = DB::table('electors')->count();
  ?>
  <div class="tile tile-3" >
    <span class="icon icon-svg-10"></span>
    <h3>בוחרים</h3>
     <h3>{{$data}}</h3>
     <br />
     @if(session('is_admin'))
     <a href="/#/electors/main/"><button class="btn  btn-sm btn-default">חיפוש בוחרים</button></a>
     <a href="/#/stats/main/"><button class="btn  btn-sm btn-default">סטטסטיקות</button></a>
     @endif
  </div>

</div>

<div class="col-sm-4 col-xs-12">
  <?php
$data = DB::table('delegate')->count();
  ?>
  <div class="tile tile-4" >
    <span class="icon icon-svg-11"></span>
    <h3>אחראיים</h3>
     <h3>{{$data}}</h3>
     <br />
     @if(session('is_admin'))
     <a href="/#/delegate/all/"><button class="btn  btn-sm btn-default">רשימת אחראיים</button></a>
     <a href="/#/delegate/add/"><button class="btn  btn-sm btn-default">הוסף אחראי</button></a>
     @endif
  </div>

</div>

<div class="col-sm-4 col-xs-12">
  <?php
$data = DB::table('personal_list')->count();
  ?>
  <div class="tile tile-1" >
    <span class="icon icon-svg-12"></span>
    <h3>פעילים</h3>
     <h3>{{$data}}</h3>
     <br />
     @if(session('is_admin'))
     <a href="/#/list/all/"><button class="btn  btn-sm btn-default">רשימת פעילים</button></a>
     <a href="/#/list/add/"><button class="btn  btn-sm btn-default">הוסף פעיל</button></a>
     @endif
  </div>

</div>



<div class="col-sm-4 col-xs-12 mrg-tp-20">
  <?php
$data = DB::table('groups')->count();
  ?>
  <div class="tile tile-2" >
    <span class="icon icon-svg-15"></span>
    <h3>קבוצות</h3>
     <h3>{{$data}}</h3>
     <br />
     @if(session('is_admin'))
     <a href="/#/group/all/"><button class="btn  btn-sm btn-default"> רשימת קבוצות</button></a>
     <a href="/#/group/add/"><button class="btn  btn-sm btn-default">הוסף קבוצה</button></a>
     @endif
  </div>

</div>



<div class="col-sm-4 col-xs-12 mrg-tp-20">
  <?php
$data = DB::table('mayors')->count();
  ?>
  <div class="tile tile-default" >
    <span class="icon icon-svg-14"></span>
    <h3>ראשי רשויות</h3>
     <h3>{{$data}}</h3>
     <br />
     @if(session('is_admin'))
     <a href="/#/mayor/all/"><button class="btn  btn-sm btn-default">רשימת ראשי רשויות</button></a>
     <a href="/#/mayor/add/"><button class="btn  btn-sm btn-default">הוסף ראש רשות</button></a>
     @endif
  </div>

</div>





<div class="col-sm-4 col-xs-12 mrg-tp-20">
  <?php
$data = DB::table('ballot')->count();
  ?>
  <div class="tile tile-5" >
    <span class="icon icon-svg-13"></span>
    <h3>קלפיות</h3>
     <h3>{{$data}}</h3>
     <br />
     <a href="/#/kalfy/list/"><button class="btn  btn-sm btn-default">רשימת קלפיות</button></a>
  </div>

</div>





<div class="col-xs-12 mrg-tp-20">


<div class="panel panel-default">
<?php
$el1=DB::table('electors');
$el2=DB::table('electors');
$el3=DB::table('electors');
$el4=DB::table('electors');
?>
  <div class="panel-body">
      <div class="row">
@include('stats.graph2')
</div>
  </div>

</div>


</div>


<script>
$(document).ready(function($){
$('.countdown').dsCountDown({
endDate: new Date("October 30, 2018 22:00:00")
});
});
</script>
