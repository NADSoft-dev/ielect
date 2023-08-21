<?php
$delegate=isset($delegate) ? $delegate:false;
?>
<div class="row">


<div class="col-xs-12">
  @if($delegate)
  <ol class="breadcrumb">
<li><a href="/#/main/">ראשי</a></li>

<li><a href="/#/delegate/all/">רשימת אחראיים</a></li>
<li class="active">{{$delegate->full_name}}</li>
</ol>
@endif
<div class="panel panel-default">
<div class="panel-heading">	<h3 class="panel-title">
  @if($delegate)
  <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> רשימת פעילים של {{$delegate->full_name}}

  @else
<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> רשימת פעילים
<a href="/#/list/add/">
  <div class="btn btn-xs btn-success pull-left mrg-right-15">הוסף</div>
</a>
@endif
<a href="/list/print/" target="_blank">
  <div class="btn btn-xs btn-primary pull-left mrg-right-15">הדפסה <span class="glyphicon glyphicon-print"></span></div>
</a>
</h3>

</div>
<div class="panel-body">
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
    <th>שם</th>
    <th>ת.ז</th>
    <th>סיסמה</th>
    <th>מס' טלפון</th>
    <th>מס' נייד</th>
    <th>אחראי</th>
    <th>בוחרים</th>
    <th>ניהול</th>
    </thead>
  <tbody>

    @foreach($rows as $row)
<?php

$electors=DB::table('electors')->where('list',$row->id)->count();
$delegate=DB::table('delegate')->find($row->under);
$delegate_name= $delegate ? $delegate->full_name :"";
?>
<tr class="Row-{{$row->id}}">
<td>{{$row->full_name}}</td>
<td>{{$row->iden}}</td>
<td>{{$row->password}}</td>
<td><input type="text" class="fieldUpdate" data-url="/list/update-field/{{$row->id}}" data-field="phone" data-id="{{$row->id}}" value="{{$row->phone}}"/></td>
<td><input type="text" class="fieldUpdate" data-url="/list/update-field/{{$row->id}}" data-field="cell" data-id="{{$row->id}}" value="{{$row->cell}}"/></td>

<td>
{{$delegate_name}}
</td>
<td><a href="/#/electors/main/list/{{$row->id}}/">{{$electors}}</a></td>
<td>
  <a href="/#/list/edit/{{$row->id}}/">
<button class="btn btn-xs btn-primary">עדכון</button>
</a>
<button class="btn btn-xs btn-danger deleteRow" data-controller="list" data-id="{{$row->id}}">מחיקה</button>
<button class="btn btn-xs btn-warning resetPassword" data-controller="personal_list" data-id="{{$row->id}}">איפוס סיסמה</button>
<!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    שליחת הודעה <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">

    <li><a href="javascript:void(0);" class="sendSmsAjax" data-type="list" data-id="{{$row->id}}">לפעיל</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="javascript:void(0);" class="sendSmsAjax" data-type="list-electors" data-id="{{$row->id}}">לבוחרים</a></li>

  </ul>
</div>


</td>
</tr>
@endforeach
  </tbody>
</table>

</div>
{{ $rows->links('vendor.pagination.default2') }}
</div>
</div>


</div>


</div>
