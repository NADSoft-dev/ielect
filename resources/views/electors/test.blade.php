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