<div style="width:300px;" class="under-line">


<form class="form-horizontal" method="POST" action="/mayor/add-to">
<input name="ids" class="selectedIDS" type="hidden" />
   <?php
$field=config('electors.fields.mayor');
$field['name']="mayor";
   ?>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-3 control-label">{{$field['label']}}</label>
  <div class="col-sm-9">
    @include('partials.filters.select',['field'=>$field])
  </div>
  </div>


<div class="col-xs-12 no-padding pad-tp-10 pad-btm-10 under-line mrg-btm-15"  data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
   הוסף ראש ראשות
</div>
<div class="col-xs-12">
<?php
$fields=config('mayor.fields');
$filters=config('mayor.create');
?>

<div class="collapse" id="collapseExample">

  @foreach($filters as $filter)
   <?php
      $field=$fields[$filter];
      $field['name']=$filter;
    ?>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-3 control-label">{{$field['label']}}</label>
  <div class="col-sm-9">
    @include('partials.filters.'.$field['type'],['field'=>$field])
  </div>
  </div>
  @endforeach




</div>

 <button type="button" class="btn btn-success btn-xs mrg-btm-15 ajaxSubmit">שמירה</button>
 <button type="button" class="btn btn-warning btn-xs mrg-btm-15" onclick="$(this).closest('.popover').popover('destroy');">סגירה</button>
</div>

</form>
</div>

<script>
  // alert($('.selectedIDS').length);
if(window.selectedIds.length ){
  var join=window.selectedIds.join();
  console.log(join);
  $('.selectedIDS').val(join);
  // document.getElementsById(idsValue).value =arrarIDNumber;
  // $('.selectedIDS').val(arrarIDNumber);

}
else{
  $('.popover').popover('destroy');
  ShowAlert('עליך לבחור מרשימת הבוחרים');
}
</script>
