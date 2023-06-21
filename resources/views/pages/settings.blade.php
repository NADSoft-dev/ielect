
<div class="row">
  <ol class="breadcrumb">
<li><a href="/#/main/">ראשי</a></li>

<li class="active">הגדרות מערכת</li>
</ol>


  <div class="panel panel-default">
  <div class="panel-heading">הגדרות מערכת</div>

<div class="panel-body">
<form class="form-horizontal"  action="/page/settings">
<div class="col-sm-12">
<?
$fields=config('settings.fields');
$filters=config('settings.edit');


$i=0;
$row['data']=json_decode($row['data'],true);

?>
@foreach($filters as $filter)
  <?
    $i++;

    $field=$fields[$filter];
    $field['name']=$filter;

    $value=isset($row['data'][$filter]) ? $row['data'][$filter]:"";


  ?>
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 col-xs-3 text-center control-label">{{$field['label']}}</label>
<div class="col-sm-4 col-xs-9">
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
