<div class="row">
<div class="col-xs-12">
<div class="panel panel-default">
<div class="panel-heading">	<h3 class="panel-title"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> רשימת מפלגות
<a href="/#/page/parties-add/">
  <div class="btn btn-xs btn-success pull-left mrg-right-15">הוסף</div>
</a>


</h3>



</div>
<div class="panel-body">
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
    <th>שם</th>
    <th>ניהול</th>
    </thead>
  <tbody>

    @foreach($rows as $row)

<tr class="Row-{{$row->id}}">
<td>{{$row->name}}</td>
<td>
  <a href="/#/page/parties-edit/{{$row->id}}/">
<button class="btn btn-sm btn-primary">עדכון</button>
</a>
<button class="btn btn-sm btn-danger deleteRow" data-controller="parties" data-id="{{$row->id}}">מחיקה</button>
</td>
</tr>
@endforeach
  </tbody>
</table>

</div>
</div>
</div>


</div>


</div>
