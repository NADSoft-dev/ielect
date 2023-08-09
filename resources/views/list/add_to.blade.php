<div style="width:300px;" class="under-line">


<form class="form-horizontal" method="POST" action="/list/add-to">
<input id="idsValue" name="ids" class="selectedIDS" type="hidden" value=""  />

<?php
$field=config('list.fields.manid');
$field['name']="under";
?>

<div class="form-group">
<label for="inputEmail3" class="col-sm-3 control-label">{{$field['label']}}</label>
<div class="col-sm-9">
 @include('partials.filters.select',['field'=>$field])
</div>
</div>



   <?php
$field=config('list.fields.list');

$field['name']="list";
   ?>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-3 control-label">{{$field['label']}}</label>
  <div class="col-sm-9">
    @include('partials.filters.select',['field'=>$field])
  </div>
  </div>
  <?php

if(session('permission')==1){
 ?>
 <script>
$('.run-rselect.field-under').val('<?php=session('member')->id;?>').trigger('change').closest('.form-group').remove();
</script>

 <?php
}
?>

<div class="col-xs-12 no-padding pad-tp-10 pad-btm-10 under-line mrg-btm-15"  data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  הוסף רשימה
</div>
<div class="col-xs-12">
<?php
$fields=config('list.fields');
$filters=config('list.create_pop');
?>

<div class="collapse" id="collapseExample">

  @foreach($filters as $filter)
  <?php

      $field=$fields[$filter];
      $field['name']=$filter;
    ?>
     @if($field['name']=='under' && session('is_admin') || $field['name']!='under')
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-3 control-label">{{$field['label']}}</label>
  <div class="col-sm-9">
    @include('partials.filters.'.$field['type'],['field'=>$field])
  </div>
  </div>

@else
<input type="hidden" name="{{$field['name']}}" value="{{session('member')->id}}">
@endif

  @endforeach




</div>

 <button type="button" class="btn btn-success btn-xs mrg-btm-15 ajaxSubmit">שמירה</button>
  <button type="button" class="btn btn-warning btn-xs mrg-btm-15" onclick="$(this).closest('.popover').popover('destroy');">סגירה</button>
</div>

</form>
</div>

<script>
  
  // alert((arrarIDNumber.length));
  // alert(window.selectedIds.length);
if(window.selectedIds.length ){
  // alert(window.selectedIds.length);
  var join=window.selectedIds.join();
  // console.log(join);
  $('.selectedIDS').val(join);
  // document.getElementsById(idsValue).value =arrarIDNumber;
  // $('.selectedIDS').val(arrarIDNumber);
}
else if((arrarIDNumber.length)!=0){
  // alert('second');

  $('.selectedIDS').val(arrarIDNumber);
}
else{
  $('.popover').popover('destroy');
  ShowAlert('עליך לבחור מרשימת הבוחרים');
}
</script>
