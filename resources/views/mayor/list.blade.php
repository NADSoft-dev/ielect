<div class="row">
<div class="col-xs-12">
<div class="panel panel-default">
<div class="panel-heading">	<h3 class="panel-title"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> רשימת ראשי רשויות
<a href="/#/mayor/add/">
  <div class="btn btn-xs btn-success pull-left">הוסף</div>
</a>
</h3>



</div>
<div class="panel-body">
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
    <th>שם</th>
    <th>
    תומכים ?
    </th>
<th>
  בוחרים
</th>

    <th>ניהול</th>
    </thead>
  <tbody>

    @foreach($rows as $row)
<?php
$electors=DB::table('electors')->where('mayor',$row->id)->count();
?>
<tr class="Row-{{$row->id}}">
<td>{{$row->full_name}}</td>
<td>
  <?php
  $selected=$row->support ? "checked":"";
  ?>
  <input type="radio" name="support" class="supportMayor" {{$selected}} value="{{$row->id}}">
</td>
<td>
  <a href="/#/electors/main/mayor/{{$row->id}}/">{{$electors}}</a>
</td>
<td>
  <a href="/#/mayor/edit/{{$row->id}}/">
<button class="btn btn-sm btn-primary">עדכון</button>
</a>
<button class="btn btn-sm btn-danger deleteRow" data-controller="mayor" data-id="{{$row->id}}">מחיקה</button>
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
