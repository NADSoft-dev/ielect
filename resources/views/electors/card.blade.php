<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">עדכון בוחר</div>

		<div class="panel-body">
			<form class="form-horizontal" action="/electors/save/{{$elector->IDNumber}}">
				<div class="col-sm-6">
					<?php
$fields=config('electors.fields');
$filters=config('electors.edit');
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

    $value=$elector->$filter;


  ?>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">{{$field['label']}}</label>
						<div class="col-sm-9">
							@include('partials.filters.'.$field['type'],['field'=>$field,'type'=>'edit','value'=>$value])
						</div>
					</div>
					@endforeach

				</div>
				@if(session('permission')!=2)
				<div class="col-xs-12">
					<button class="btn btn-sm btn-success ajaxSubmit">שמירה</button>
				</div>
				@endif
			</form>

		</div>
	</div>
	@if(count($parents) || count($kids) || count($couple))
	<div class="panel panel-default">
		<div class="panel-body">
			<ul class="nav nav-pills" role="tablist">
			@if(session('is_admin') || session('permission')==1)
				<li role="presentation">
					<a data-type="direct" href="javascript:void(0);" data-href="/list/add-to" data-title="שייך לפעיל" class="ajaxPOP">שייך לפעיל
						<span class="glyphicon glyphicon-plus"></span>
					</a>
				</li>
		     @endif		
				@if(session('is_admin'))
				<li role="presentation">
					<a data-type="direct" href="javascript:void(0);" data-href="/group/add-to" data-title="שייך לקבוצה" class="ajaxPOP">שייך לקבוצה
						<span class="glyphicon glyphicon-plus"></span>
					</a>
				</li>
				<li role="presentation">
					<a data-type="direct" href="javascript:void(0);" data-href="/mayor/add-to" data-title="שייך לראש ראשות" class="ajaxPOP">שייך לראש רשות
						<span class="glyphicon glyphicon-plus"></span>
					</a>
				</li>
			
				<li role="presentation">
        <div class="btn-group">
					<button type="button" class="btn btn-ielect dropdown-toggle" data-toggle="dropdown">
						ביטול שיוכים
						<span class="glyphicon glyphicon-remove"></span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="javascript:void(0);" class="disableList" data-type="list">פעיל</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="disableList" data-type="group">קבוצה</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="disableList" data-type="mayor">ראש רשות</a>
						</li>
					</ul>
				</div>
				</li>
				@endif
				<li>
				<div class="btn-group">
							<button type="button" class="btn btn-ielect dropdown-toggle" data-toggle="dropdown">

							הדפסה
<span class="glyphicon glyphicon-print"></span>
							<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/electors/print?ids=<?=implode(',',$ids);?>" data-url="/electors/print" class="printSelected"  target="_blank">טבלה</a></li>
								<li><a href="/electors/print/10_3?ids=<?=implode(',',$ids);?>" data-url="/electors/print/10_3" class="printSelected" target="_blank">מדבקות 10/3</a></li>
								<li><a href="/electors/print/8_3?ids=<?=implode(',',$ids);?>" data-url="/electors/print/8_3" class="printSelected" target="_blank">מדבקות 8/3 </a></li>
							</ul>
						</div>
						</li>	

			</ul>
		</div>
	</div>
	@endif 
  @if(count($parents))
	<div class="panel panel-default">
		<div class="panel-heading">הורים</div>
		<div class="panel-body">
			@include('electors.table_default',['electors'=>$parents])
		</div>
		<div class="panel-footer">
			סה"כ: {{count($parents)}}
		</div>
	</div>
	@endif
   @if(count($kids))
	<div class="panel panel-default">
		<div class="panel-heading">ילדים</div>
		<div class="panel-body">
			@include('electors.table_default',['electors'=>$kids])
		</div>
		<div class="panel-footer">
			סה"כ: {{count($kids)}}
		</div>
	</div>
	@endif 
  @if(count($couple))
	<div class="panel panel-default">
		<div class="panel-heading">בן/בת זוג</div>
		<div class="panel-body">
			@include('electors.table_default',['electors'=>$couple])
		</div>
		<div class="panel-footer">
			סה"כ: {{count($couple)}}
		</div>
	</div>
	@endif


   @if(count($brothers))
	<div class="panel panel-default">
		<div class="panel-heading">אחים</div>
		<div class="panel-body">
			@include('electors.table_default',['electors'=>$brothers])
		</div>
		<div class="panel-footer">
			סה"כ: {{count($brothers)}}
		</div>
	</div>
	@endif
</div>
