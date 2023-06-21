<div class="row">

  <div class="col-xs-12">
    <div class="electorsTopPanel">

    </div>
    <div class="panel panel-default electorsFilterPanel">
<div class="panel-heading">	<h3 class="panel-title"> סינון</h3>
      <span class="pull-left clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></div>
<div class="panel-body">

<form class="form-horizontal" id="filterForm">
<div class="col-sm-6">
<?php
$fields=config('electors.fields');


$filters=config('electors.filter');
$count=round(count($filters)/2);
if(session('permission')==1) $count=$count-3;
if(session('permission')==2) $count=$count-4;
$currentPage="electors";
$i=0;
?>
@foreach($filters as $filter)
  <?php
  if(session('permission')==1){
    if($filter=='group'){
       continue;
    }

    if($filter=='mayor'){
      continue;
   }
    if($filter=='manid'){
      continue;
     
   }

   if($filter=='list'){
    $fields[$filter]['data'].=',under,'.session('member')->id;
   
 }
  }



  if(session('permission')==2){
    if($filter=='group'){
       continue;
    }

    if($filter=='mayor'){
      continue;
   }
    if($filter=='manid'){
      continue;
     
   }

   if($filter=='list'){
    continue;
   
 }
  }

    $i++;
    if($i>$count){
      ?>
    </div>
    <div class="col-sm-6">
      <?php
    }
    $field=$fields[$filter];
    $field['name']=$filter;


    
    if($field['type']=='disabled') $field['type']='text';
  ?>
<div class="form-group">
<label for="inputEmail3" class="col-sm-3 control-label">{{$field['label']}}</label>
<div class="col-sm-9">
  @include('partials.filters.'.$field['type'],['field'=>$field])
</div>
</div>
@endforeach

</div>
</form>

</div>

</div>
<div class="panel panel-default">
  <div class="panel-heading">שדות להצגה
    <button type="submit" class="btn btn-primary btn-xs mrg-right-15 selectAllFields">בחר הכל</button>
    <button type="submit" class="btn btn-warning btn-xs resetFields">ברירת מחדל</button>
  </div>
  <div class="panel-body">
    <div class="fields_select mrg-tp-15">

<?php
$filters=config('electors.filter_fields');
?>
    @foreach($filters as $filter)
      <?php
      if(session('permission')==1 || session('permission')==2){
        if($filter=='group') continue;
        if($filter=='mayor') continue;
        if($filter=='manid') continue;
      }

      $key=$filter;
      $field=$fields[$filter];
      $field['name']=$filter;

      $default=@$field['list_default'];
      $css=$default ? "active":"";
      $default=$default ? "true":"false";

      ?>
      <span class="label label-lg label-primary activeSwitch {{$css}}" data-name="{{$key}}" data-default="{{$default}}">{{$field['label']}}</span>
    @endforeach
  </div>
    </div>
    <div class="panel-footer mrg-tp-15">
<button type="submit" class="btn btn-primary btn-sm filterElectors"><span class="glyphicon glyphicon-search"></span> סינון</button>
<button type="submit" class="btn btn-info btn-sm" onclick="$('#filterForm')[0].reset();$('#filterForm').find('.selectpicker').val('').selectpicker('render').selectpicker('refresh');;"><span class="glyphicon glyphicon-refresh"></span> ניקוי</button>
    </div>
</div>

  </div>

<div class="col-xs-12">
<div class="panel panel-default">
<div class="panel-heading">	<h3 class="panel-title"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> רשימת בוחרים </h3>

</div>
<div class="panel-body">
<div class="table-responsive electorsTable load-in-tab">

</div>
</div>
</div>


</div>


</div>

<script>
@if($data['field']=='AddCode')
$('.electorsFilterPanel').fadeOut(0);
$('.field-AddCode-from').val('{{$data['val']}}');
$('.field-AddCode-to').val('{{$data['val']}}');
$('.filterElectors').click();
@endif

@if($data['field']=='manid')
$('.electorsTopPanel').load('/delegate/info-panel/{{$data['val']}}');
$('.electorsFilterPanel').fadeOut(0);
$('.field-manid').val('{{$data['val']}}');
$('.filterElectors').click();
@endif

@if($data['field']=='list')
$('.electorsTopPanel').load('/list/info-panel/{{$data['val']}}');
$('.electorsFilterPanel').fadeOut(0);
$('.field-list').val('{{$data['val']}}');
$('.filterElectors').click();
@endif


@if($data['field']=='group')
$('.electorsFilterPanel').fadeOut(0);
$('.field-group').val('{{$data['val']}}');
$('.filterElectors').click();
@endif


@if($data['field']=='mayor')
$('.electorsFilterPanel').fadeOut(0);
$('.field-mayor').val('{{$data['val']}}');
$('.filterElectors').click();
@endif



</script>
