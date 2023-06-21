
<div class="row">
  <ol class="breadcrumb">
<li><a href="/#/main/">ראשי</a></li>

<li class="active">איחוד משפחות</li>
</ol>


  <div class="panel panel-default">
  <div class="panel-heading">איחוד משפחות</div>

<div class="panel-body">
<div class="familyStep1 familyStep">
<h4>נא לבחור משפחות שברצונך לאחד</h4>

<?php
$field=[
  'type'=>"text",
  "label"=>"משפחה",
  'name'=>"FamilyName",
  "placeholder"=>"חיפוש משפחות",
  'autocomplete'=>'/electors/complete/FamilyName',
  "list_default"=>true,
];
?>
<div class="col-sm-6 col-xs-10 mrg-btm-15">

  @include('partials.filters.'.$field['type'],['field'=>$field])

</div>
<div class="col-xs-2 no-padding">
  <button class="btn btn-sm btn-success addFamily"><i class="	glyphicon glyphicon-plus"></i></button>
</div>
<div class="col-xs-12 col-sm-7 mrg-tp-15">
<table class="table table-striped table-bordered familyTable" style="display:none;">
<thead>
  <tr>
    <th>
      משפחה
    </th>

    <th>
      מחיקה
    </th>
  </tr>
</thead>
<tbody>

</tbody>
</table>

</div>


</div>

<div class="familyStep2 familyStep" style="display:none;">
  <h4>נא לבחור משפחה שאליה אתה רוצה לאחד</h4>
  <?php
  $field=[
    'type'=>"text",
    "label"=>"משפחה",
    'name'=>"FamilyName",
    "placeholder"=>"חיפוש משפחות",
    'autocomplete'=>'/electors/complete/FamilyName',
    "list_default"=>true,
  ];
  ?>
  <div class="col-sm-6 col-xs-10 mrg-btm-15">

    @include('partials.filters.'.$field['type'],['field'=>$field])

  </div>
  <div class="col-xs-2 no-padding">
    <button class="btn btn-sm btn-success addFamily" data-empty="true"><i class="	glyphicon glyphicon-plus"></i></button>
  </div>
  <div class="col-xs-12 col-sm-7 mrg-tp-15">
  <table class="table table-striped table-bordered familyTable" style="display:none;">
  <thead>
    <tr>
      <th>
        משפחה
      </th>

      <th>
        מחיקה
      </th>
    </tr>
  </thead>
  <tbody>

  </tbody>
  </table>

  </div>

</div>


<div class="familyStep3 familyStep" style="display:none;">
<h4>האם אתה מאשר ביצוע איחוד משפחות לפי הנתונים הנ"ל ?</h4>
<h5>שם משפחה קודם: <span class="oldFamily"></span></h5>
<h5>שם משפחה חדש:  <span class="newFamily"></span></h5>



</div>




</div>
<div class="panel-footer " style="text-align: left;">
 <button class="btn btn-primary btn-sm familyNext goFamily2" data-step="1" disabled>הבא</button>
</div>
</div>

</div>
<script>
window.familyMerge=[];
</script>
