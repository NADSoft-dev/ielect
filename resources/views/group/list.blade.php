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
    <th>תת קבוצות</th>
    <th>בוחרים</th>
    <th>ניהול</th>
    </thead>
  <tbody>

    @foreach($rows as $row)
   
<?php
// print_r($rows);
$electors=DB::table('electors')->where('group',$row->id)->count();

$subCategoryCount=0;
$mainCount=0;
$sub1Category=DB::table('groups')->where('category_id',$row->id)->get();
$mainCount += count($sub1Category);
if(isset($sub1Category) && !empty($sub1Category) && count($sub1Category)!= 0 ){
  
    for($sub1Id=0;$sub1Id<count($sub1Category);$sub1Id++){
      $idsub1=$sub1Category[$sub1Id];
      $sub2Category=DB::table('groups')->where('category_id',$idsub1->id)->get();
      $electorsSub1=DB::table('electors')->where('group',$idsub1->id)->count();
      $mainCount += count($sub2Category);
      $electors += $electorsSub1;
      if(isset($sub2Category) && !empty($sub2Category) && count($sub2Category)!= 0 ){
        for($sub2Id=0;$sub2Id<count($sub2Category);$sub2Id++){
            $idsub2=$sub2Category[$sub2Id];
            $sub3Category=DB::table('groups')->where('category_id',$idsub2->id)->get();
            $electorsSub2=DB::table('electors')->where('group',$idsub2->id)->count();
            // print_r($sub3Category[$sub2Id]);   
            $mainCount += count($sub3Category);
            $electors += $electorsSub2;

            if(isset($sub3Category) && !empty($sub3Category) && count($sub3Category)!= 0 ){
                for($sub3Id=0;$sub3Id<count($sub3Category);$sub3Id++){
                    $idsub3=$sub3Category[$sub3Id];
                    $sub4Category=DB::table('groups')->where('category_id',$idsub3->id)->get();
                    $electorsSub3=DB::table('electors')->where('group',$idsub3->id)->count();
                    // print_r($sub3Category[$sub2Id]);   
                    $mainCount += count($sub4Category);
                    $electors += $electorsSub3;

                }
              }

        }
      }
    }
}


?>
<tr class="Row-{{$row->id}}">
<td>{{$row->name}}</td>
<td>
  <a href="/#/group/sublist/{{$row->id}}/"> {{$mainCount}}</a>
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
