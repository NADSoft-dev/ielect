<div class="col-xs-12 stickTopContainer">
	<div class="jumbotron stickTop">

		<ul class="nav nav-pills" role="tablist">
		@if(session('is_admin') || session('permission')==1)
			<li role="presentation">
				<a href="javascript:void(0);" data-href="/list/add-to" data-title="שייך לפעיל" class="ajaxPOP">שייך לפעיל
					<span class="glyphicon glyphicon-plus"></span>
				</a>
			</li>
			@endif
			@if(session('is_admin'))
			<li role="presentation">
				<a href="javascript:void(0);" data-href="/group/add-to" data-title="שייך לקבוצה" class="ajaxPOP">שייך לקבוצה
					<span class="glyphicon glyphicon-plus"></span>
				</a>
			</li>
			
			<li role="presentation">
				<a href="javascript:void(0);" data-href="/mayor/add-to" data-title="שייך לראש ראשות" class="ajaxPOP">שייך לראש רשות
					<span class="glyphicon glyphicon-plus"></span>
				</a>
			</li>
			
			<li>
				<div class="btn-group">
					<button type="button" class="btn btn-ielect dropdown-toggle" data-toggle="dropdown">
						ביטול 
						<span class="glyphicon glyphicon-remove"></span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="javascript:void(0);" class="disableList" data-type="list">שיוך פעיל</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="disableList" data-type="group">שיוך קבוצה</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="disableList" data-type="mayor">שיוך ראש רשות</a>
						</li>

						<li>
							<a href="/electors/unvote"  data-title="ביטול הצבעה" data-type="POP">הצבעה</a>
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
								<li><a href="/electors/print" data-url="/electors/print" class="printSelected"  target="_blank">טבלה</a></li>
								<li><a href="/electors/print/10_3" data-url="/electors/print/10_3" class="printSelected" target="_blank">מדבקות 10/3</a></li>
								<li><a href="/electors/print/8_3" data-url="/electors/print/8_3" class="printSelected" target="_blank">מדבקות 8/3 </a></li>
							</ul>
						</div>
				</li>

@if(session('is_admin') || session('permission')==1)
			<li>
			
				<div class="btn-group">
					<button type="button" class="btn btn-ielect dropdown-toggle" data-toggle="dropdown">

						שליחת הודעה
						<span class="glyphicon glyphicon-envelope"></span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="javascript:void(0)" class="sendSmsAjaxEelectors" data-type="ballot-location">שלח מיקום הצבעה</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="sendSmsAjaxEelectors" data-type="electors">שלח הודעת טקסט</a>
						</li>

					</ul>
				</div>
				
			</li>
			@endif
			<li>

				<div class="btn-group">
					<button type="button" class="btn btn-ielect dropdown-toggle" data-toggle="dropdown">

						יצוא
						<span class="glyphicon glyphicon-export"></span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="/electors/export/xls" target="_blank">Excel - xls</a>
						</li>
						<li>
							<a href="/electors/export/xlsx" target="_blank">Excel - xlsx</a>
						</li>
						<li>
							<a href="/electors/export/csv" target="_blank">CSV</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
</div>

<div class="col-xs-12 mrg-btm-15">
	מפתח צבעים:
	<label class="label label-sm label-selected ">נבחר</label>
	<label class="label label-sm label-haslist">שייך לפעיל</label>
	<label class="label label-sm label-voted ">שייך שהצביע</label>
	<label class="label label-sm label-notlistvoted">לא שייך שהצביע</label>

	<button class="btn btn-xs btn-primary mrg-right-15" onclick="$('.rowSelect').toggleClass('selected'); getSelectedIds();">בחר הכל</button>

  <span style="width:100px;" class="pull-left">
  <label>תוצאות בדף</label>
  <select  class="selectpicker form-control changePagesCount">
  <?
$pageCount=Request::cookie('pageCount');
$pageCount= $pageCount ? $pageCount:50;
  ?>
    @for($i=1; $i<=100; $i++ )
    @if($i % 10 == 0)
    <?
    $count=$i*5;
    $selected= $pageCount == $count ? 'selected':'';
    ?>
      <option value="{{$count}}" {{$selected}}>{{$count}}</option>
    @endif

    @endfor

</select>
</span>

</div>


<table class="table table-bordered table-hover" id="electorsTable">
	<thead>
		<?
    $fields=config('electors.fields');

    ?>
		@foreach($listFields as $f)
		<th>{{$fields[$f]['label']}}</th>
		@endforeach

	</thead>
	<tbody>
		@foreach($electors as $elector)
		<?
   $css=[];
   if($elector->list) $css[]="hasList";
   if($elector->voted==1) $css[]="voted";
   $css=implode(' ',$css);
   if($elector->list){

   }else $elector->list="ללא";
  ?>
		<tr data-id="{{$elector->IDNumber}}" class="rowSelect {{$css}} elector">
			@foreach($listFields as $f) @if($f=='tel' || $f=='cell')
			<td>
				<input type="text" class="fieldUpdate" data-field="{{$f}}" data-id="{{$elector->id}}" value="{{$elector->$f}}" />
			</td>
			@else
			<td>{{$elector->$f}}</td>
			@endif @endforeach

		</tr>
		@endforeach

	</tbody>
</table>
סה"כ: {{$electors->total()}}
<div class="col-xs-12">
	{!! $electors->links() !!}
</div>
