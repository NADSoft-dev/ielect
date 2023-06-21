<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-default ">
<div class="panel-heading">	<h3 class="panel-title"> סינון</h3>
    </div>
<div class="panel-body">

<form class="form-horizontal" id="filterForm">
<div class="col-sm-6">
<?php
$fields=config('statistics.fields');
$by=config('statistics.by');
$filters=config('statistics.filter');
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

  <div class="panel-body">
    <hr>
    <div class="fields_select ">
  <span class="label label-lg label-title">סטטיסטיקות לפי: </span>
      <?php
      $i=0;
      ?>
    @foreach($by as $field)
    <?php
    $i++;
    $css=$i==1 ? "active":"";
    ?>

      <span class="label label-lg label-primary activeRadio {{$css}}" data-name="{{$field['field']}}" data-default="{{$field['label']}}">{{$field['label']}}</span>
    @endforeach
  </div>
    </div>
    <div class="panel-footer mrg-tp-15">
<button type="submit" class="btn btn-primary btn-sm statsElectors" data-type="graph"><span class="glyphicon glyphicon-stats"></span> תרשים</button>
<button type="submit" class="btn btn-primary btn-sm statsElectors" data-type="alphabet"><span class="glyphicon glyphicon-sort-by-alphabet"></span> סינון אלפבית</button>
<button type="submit" class="btn btn-primary btn-sm statsElectors" data-type="numeric"><span class="glyphicon glyphicon-sort-by-order-alt"></span> סינון כמות</button>
<button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-refresh"></span> ניקוי</button>
    </div>
</div>

  </div>



  <div class="col-xs-12">
  <div class="panel panel-default">
  <div class="panel-heading">	<h3 class="panel-title"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> סטטיסטיקות </h3>

  </div>
  <div class="panel-body">
  <div class="table-responsive electorsTable load-in-tab">

  </div>
  </div>
  </div>


  </div>



</div>
