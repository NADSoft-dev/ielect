<table class="table table-bordered table-hover">
  <thead>
    <?
    $fields=config('electors.fields');
    $show=["IDNumber","FamilyName","PersonalName","FatherName","gender","birthYear","Serial","AddCode","list","mayor","group"];
    ?>
    @foreach($show as $f)
    <th>{{$fields[$f]['label']}}</th>
    @endforeach

  </thead>
<tbody>
  <?
  $electors=App\Http\Controllers\ElectorsController::fixResponse($electors,$show);
  ?>
  @foreach($electors as $elector)
  <?
$css=[];
if($elector->list) $css[]="hasList";
if($elector->voted==1) $css[]="voted";
$css=implode(' ',$css);
if($elector->list){

}else $elector->list="ללא";
  ?>
  <tr data-id="{{$elector->IDNumber}}" class="rowSelect {{$css}} elector">
    @foreach($show as $f)

    <td>{{$elector->$f}}</td>
    @endforeach

  </tr>
  @endforeach

</tbody>
</table>
