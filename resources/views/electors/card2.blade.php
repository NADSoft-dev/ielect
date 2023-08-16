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
	
</div>