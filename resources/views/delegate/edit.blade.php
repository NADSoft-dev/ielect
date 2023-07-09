
<div class="row">
  <ol class="breadcrumb">
<li><a href="/#/main/">ראשי</a></li>
<li><a href="/#/delegate/all/">רשימת אחראיים</a></li>
<li class="active">{{$row->full_name}}</li>
</ol>


  <div class="panel panel-default">
  <div class="panel-heading">עדכון פעיל</div>

<div class="panel-body">
<form class="form-horizontal"  action="/delegate/save/{{$row->id}}">
<div class="col-sm-6">
<?php
$fields=config('delegate.fields');
$filters=config('delegate.edit');

$count=round(count($filters)/2);
$i=0;

?>
@foreach($filters as $filter)
  <?php
    $i++;
    if($i>$count){
      ?>
    </div>
    <div class="col-sm-6">
      <?php
    }
    $field=$fields[$filter];
    $field['name']=$filter;

    $value=$row->$filter;


  ?>
<div class="form-group">
<label for="inputEmail3" class="col-sm-3 control-label">{{$field['label']}}</label>
<div class="col-sm-9">
  @include('partials.filters.'.$field['type'],['field'=>$field,'type'=>'edit','value'=>$value])
</div>
</div>
@endforeach

</div>
<div class="col-xs-12">
<button class="btn btn-sm btn-success ajaxSubmit">שמירה</button>
</div>
</form>

</div>
</div>

</div>
