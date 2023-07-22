<div class="row">
<div class="col-xs-12">
<div class="panel panel-default">
<div class="panel-heading">	<h3 class="panel-title"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> רשימת קבוצות


<a href="/group/print/" target="_blank">
  <div class="btn btn-xs btn-primary pull-left mrg-right-15">הדפסה <span class="glyphicon glyphicon-print"></span></div>
</a>
<a href="/#/group/all/">
  <div class="btn btn-xs btn-success pull-left mrg-right-15">back</div>
</a>
</h3>



</div>
<div class="panel-body">
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
    <th>שם:{{$row->name}}</th>
    <th>מס תת קבוצות</th>
    <th>בוחרים</th>
    <th>ניהול</th>

   
    </thead>
  <tbody>

    <?php
    $subCategory=DB::table('groups')->where('category_id',$row->id)->get();
    $categoryCount=DB::table('groups')->where('category_id',$row->id)->count();

    ?>
@foreach ($subCategory as $sub)
<?php
    $SubcategoryCount=DB::table('groups')->where('category_id',$sub->id)->count();
    $electors=DB::table('electors')->where('group',$sub->id)->count();
    ?>
<tr class="Row-{{$sub->id}}">
<td>{{$sub->name}}</td>
<td>
  @if ($SubcategoryCount > 0)
  <a href="/#/group/sublist/{{$sub->id}}/"> {{$SubcategoryCount}}</a>
  @else
  {{$SubcategoryCount}}
  @endif
  
</td>
<td>
  <a href="/#/electors/main/group/{{$sub->id}}/">{{$electors}}</a>
</td>
<td>
  <a href="/#/group/editsublist/{{$sub->id}}/">
    <button class="btn btn-sm btn-primary">עדכון</button>
  </a>
  <button class="btn btn-sm btn-danger deleteRow" data-controller="group" data-id="{{$sub->id}}">מחיקה</button>
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
