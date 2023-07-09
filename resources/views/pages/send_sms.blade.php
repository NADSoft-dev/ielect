
<div class="row">
  <ol class="breadcrumb">
<li><a href="/#/main/">ראשי</a></li>

<li class="active">שליחת הודעות</li>
</ol>


  <div class="panel panel-default">
  <div class="panel-heading">שליחת הודעות</div>

<div class="panel-body">
<div class="sendStep1">
<div class="col-xs-6">
<h4>תוכן הודעה</h4>
<textarea class="form-control msgText" rows="5"></textarea>
<p class="mrg-tp-15"><span class="charsCount">0</span> אותיות / <span class="smsCount">0</span> הודעות</p>
</div>
<?php
$groups=DB::table('groups')->select('*')->get();
?>
<div class="col-xs-12 mrg-tp-15">
  <hr />
  <h4>קבוצות</h4>
  <div class="fields_select mrg-tp-15">
@foreach($groups as $group)
<span class="label label-lg label-primary activeSwitch groups" data-id="{{$group->id}}">{{$group->name}}</span>
@endforeach
</div>
</div>




<?php
$groups=DB::table('personal_list')->select('*')->get();
?>
<div class="col-xs-12 mrg-tp-15">
  <hr />
  <h4>פעילים</h4>
  <div class="fields_select mrg-tp-15">
@foreach($groups as $group)
<span class="label label-lg label-primary activeSwitch lists" data-id="{{$group->id}}">{{$group->full_name}}</span>
@endforeach
</div>
</div>



<?php
$groups=DB::table('delegate')->select('*')->get();
?>
<div class="col-xs-12 mrg-tp-15">
  <hr />
  <h4>אחראים</h4>
  <div class="fields_select mrg-tp-15">
@foreach($groups as $group)
<span class="label label-lg label-primary activeSwitch delegates" data-id="{{$group->id}}">{{$group->full_name}}</span>
@endforeach
</div>
</div>
</div>





</div>
<div class="panel-footer " style="text-align: left;">
 <button class="btn btn-primary btn-sm prepareSms">הבא</button>
</div>
</div>

</div>
