<div class="row">
<div class="col-xs-12">
<div class="panel panel-default">
<div class="panel-heading">	<h3 class="panel-title"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> סימון הצבעה

</h3>



</div>
<div class="panel-body">
<div class="table-responsive">
<ul class="nav nav-pills ielectVote" role="tablist">

  <li role="presentation" >
   <a class="none"> סימון לפי:</a>
  </li>
  <li role="presentation" class="active" >
    <a data-toggle="tab" href="#by-serial">מס' סידורי</a>
  </li>
  <li role="presentation">
    <a data-toggle="tab" href="#by-id">מס' ת.ז</a>
  </li>
</ul>
<div class="tab-content">
<hr>
  <div id="by-serial" class="tab-pane fade in active">
   
  <form action="/electors/set-vote" class="bySerial" >

<div class="form-group row">
  <label class="col-sm-2 col-form-label">מס' קלפי</label>
  <div class="col-md-4 col-sm-10">
    <input type="text" required name="AddCode" class="form-control" >
  </div>
</div>


<div class="form-group row">
  <label  class="col-sm-2 col-form-label">מס' סידורי</label>
  <div class="col-md-4 col-sm-10">
    <input type="text" required name="serial" class="form-control" >
  </div>
</div>
  <input type="hidden" name="by" class="hiddenInput" value="serial" />
<hr />
<button class="btn btn-primary btn-sm ajaxSubmit" type="submit">סימון</button>
<button class="btn btn-info btn-sm resetBtn" type="button"  onclick='$(".bySerial")[0].reset();$(".bySerial").find(".hiddenInput").val("serial");'>ניקוי</button>



</form>

  </div>
  <div id="by-id" class="tab-pane fade">
  <form ajax-form action="/electors/set-vote" class="byId" >

<div class="form-group row">
  <label class="col-sm-2 col-form-label">מס' ת.ז</label>
  <div class="col-md-4 col-sm-10">
    <input type="text" required name="IDNumber" class="form-control" >
  </div>
</div>

  <input type="hidden" name="by" class="hiddenInput" value="id" />
  <hr />
<button class="btn btn-primary btn-sm ajaxSubmit" type="submit">סימון</button>
<button class="btn btn-info btn-sm resetBtn" type="button"  onclick='$(".byId")[0].reset();$(".byId").find(".hiddenInput").val("id");'>ניקוי</button>


</form>
  </div>
</div>
</div>
</div>
</div>


</div>


</div>
