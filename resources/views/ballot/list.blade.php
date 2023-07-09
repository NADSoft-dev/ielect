<div class="row">
<div class="col-xs-12">
<div class="panel panel-default">
<div class="panel-heading">	<h3 class="panel-title"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> רשימת קלפיות
<a href="/kalfy/print/" target="_blank">
  <div class="btn btn-xs btn-primary pull-left mrg-right-15">הדפסה <span class="glyphicon glyphicon-print"></span></div>
</a>

</h3>

</div>
<div class="panel-body">
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
      <th>מס' קלפי</th>
      <th>שם רחוב</th>
    <th>מס' בית</th>
    <th>מקום קלפי</th>
    <th>בוחרים</th>
    <th>עריכה</th>
    </thead>
  <tbody>

    @foreach($rows as $row)
    <?php
      $count=DB::table('electors')->where('AddCode',$row->ballot_id)->count();
    ?>

<tr>
<td>{{$row->ballot_id}}</td>
<td>{{$row->street_name}}</td>
<td>{{$row->home_num}}</td>
<td>{{$row->place_details}}</td>
<td><a href="/#/electors/main/AddCode/{{$row->ballot_id}}/">{{$count}}</a></td>
<td><a href="/#/kalfy/edit/{{$row->id}}/">
<button class="btn btn-xs btn-primary">עדכון</button>
</a></td>
</tr>
@endforeach
  </tbody>
</table>

</div>
</div>
</div>


</div>


</div>
