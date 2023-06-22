<div class="row">
<div class="col-xs-12">
<div class="panel panel-default">
<div class="panel-heading">	<h3 class="panel-title"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> רשימת קבוצות
<a href="/#/group/add/">
  <div class="btn btn-xs btn-success pull-left mrg-right-15">הוסף</div>
</a>

<a href="/group/print/" target="_blank">
  <div class="btn btn-xs btn-primary pull-left mrg-right-15">הדפסה <span class="glyphicon glyphicon-print"></span></div>
</a>
</h3>



</div>
<div class="panel-body">
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead>
    <th>שם</th>
    <th>sub cat</th>
    <th>בוחרים</th>
    <th>ניהול</th>
    </thead>
  <tbody>

    @foreach($rows as $row)
<?php
$electors=DB::table('electors')->where('group',$row->id)->count();
$subCategoryCount=DB::table('groups')->where('category_id',$row->id)->count();
$subCategory=DB::table('groups')->where('category_id',$row->id)->first();
if(isset($subCategory) || !empty($subCategory) || $subCategory !=null){
$electorsSub=DB::table('electors')->where('group',$subCategory->id)->count();
// $subSubCategory=DB::table('groups')->where('category_id',$subCategory->id)->first();
  // if(isset($subSubCategory) || !empty($subSubCategory) || $subSubCategory !=null){
  // $electorsSubSub=DB::table('electors')->where('group',$subSubCategory->id)->count();}
  // else{
  //   $electorsSubSub=0;
  // }
}

$electors += $electorsSub;
?>
<tr class="Row-{{$row->id}}">
<td>{{$row->name}}</td>
<td>
  <a href="/#/group/sublist/{{$row->id}}/"> {{$subCategoryCount}}</a>
</td>
<td>
  <a href="/#/electors/main/group/{{$row->id}}/">{{$electors}}</a>
</td>
<td>
  <a href="/#/group/edit/{{$row->id}}/">
<button class="btn btn-sm btn-primary">עדכון</button>
</a>
<button class="btn btn-sm btn-danger deleteRow" data-controller="group" data-id="{{$row->id}}">מחיקה</button>
<button class="btn btn-sm btn-info sendSmsAjax" data-type="group" data-id="{{$row->id}}">שליחת הודעה</button>
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
