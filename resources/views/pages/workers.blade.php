
<div class="row">
  <ol class="breadcrumb">
<li><a href="/#/main/">ראשי</a></li>
<li class="active">ניהול עובדי קלפי</li>
</ol>


  <div class="panel panel-default">
  <div class="panel-heading">הוסף / עדכון פעיל</div>

<div class="panel-body">
  <form class="form-horizontal" id="workerForm" method="POST" action="/page/workers">

  <div class="col-sm-6">
  <?php
  $fields=config('workers.fields');
  $filters=config('workers.create');
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
  <button class="btn btn-success btn-sm ajaxSubmit" >שמירה</button>
  </form>



<?php
$kalfy=DB::table('ballot')->select('*')->get();
?>
<hr />
@foreach($kalfy as $k)
<div class="panel panel-default theBallot">
<div class="panel-heading">{{$k->ballot_id}} - {{$k->place_details}}</div>

<div class="panel-body">
  <table class="table table-bordered table-ballot-{{$k->ballot_id}}">
    <tr>
      <th>שם</th>
      <th>ת.ז</th>
      <th>מס' טלפון</th>
      <th>קלפי</th>
      <th>משמרת</th>
      <th>סיסמה</th>
      <th>ניהול</th>
    </tr>
    <tbody class="shift1">
      <?php
        $rows=DB::table('workers')->where('kalfy',$k->ballot_id)->where('shift',1)->select('*')->get();
      ?>
      @foreach($rows as $row)
      @include('partials.elements.worker_row')
      @endforeach
    </tbody>
    <tbody class="shift2">
      <?php
        $rows=DB::table('workers')->where('kalfy',$k->ballot_id)->where('shift',2)->select('*')->get();
      ?>
      @foreach($rows as $row)
      @include('partials.elements.worker_row')
      @endforeach
    </tbody>
    <tbody class="shift3">
      <?php
        $rows=DB::table('workers')->where('kalfy',$k->ballot_id)->where('shift',3)->select('*')->get();
      ?>
      @foreach($rows as $row)
      @include('partials.elements.worker_row')
      @endforeach
    </tbody>
  </table>
</div>
</div>
@endforeach
</div>
<div class="panel-footer " style="text-align: left;">

</div>
</div>

</div>
<script>
  updateWorkerList();
</script>
