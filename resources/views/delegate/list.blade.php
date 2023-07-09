<div class="row">
<div class="col-xs-12">
<div class="panel panel-default">
<div class="panel-heading">	<h3 class="panel-title"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> רשימת אחראיים
<a href="/#/delegate/add/">
  <div class="btn btn-xs btn-success mrg-right-15 pull-left">הוסף</div>
</a>


<a href="/delegate/print/" target="_blank">
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
    <th>פעילים</th>
    <th>בוחרים</th>
    <th>ניהול</th>
    </thead>
  <tbody>

    @foreach($rows as $row)
<?php
$list=DB::table('personal_list')->where('under',$row->id)->count();
$electors=DB::table('electors')->where('manid',$row->id)->count();
?>
<tr class="Row-{{$row->id}}">
<td>{{$row->full_name}}</td>
<td>{{$row->iden}}</td>
<td>{{$row->password}}</td>


<td><input type="text" class="fieldUpdate" data-url="/delegate/update-field/{{$row->id}}" data-field="phone" data-id="{{$row->id}}" value="{{$row->phone}}"/></td>
<td><input type="text" class="fieldUpdate" data-url="/delegate/update-field/{{$row->id}}" data-field="cell" data-id="{{$row->id}}" value="{{$row->cell}}"/></td>

<td><a href="/#/list/by-delegate/{{$row->id}}/">{{$list}}</a></td>
<td><a href="/#/electors/main/manid/{{$row->id}}/">{{$electors}}</a></td>
<td>
  <a href="/#/delegate/edit/{{$row->id}}/">
<button class="btn btn-xs btn-primary">עדכון</button>
</a>
<button class="btn btn-xs btn-danger deleteRow" data-controller="delegate" data-id="{{$row->id}}">מחיקה</button>
<button class="btn btn-xs btn-warning resetPassword" data-controller="delegate" data-id="{{$row->id}}">איפוס סיסמה</button>

<!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    שליחת הודעה <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="javascript:void(0);" class="sendSmsAjax" data-type="delegate" data-id="{{$row->id}}">לאחראי</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="javascript:void(0);" class="sendSmsAjax" data-type="delegate-list" data-id="{{$row->id}}">לפעילים</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="javascript:void(0);" class="sendSmsAjax" data-type="delegate-electors" data-id="{{$row->id}}">לבוחרים</a></li>

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
