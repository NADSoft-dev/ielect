
<div class="row">
  <ol class="breadcrumb">
<li><a href="/#/main/">ראשי</a></li>
<li><a href="/#/group/all/">רשימת קבוצות</a></li>
<li class="active">הוסף</li>
</ol>

  <div class="panel panel-default">
  <div class="panel-heading">הוסף קבוצה</div>

<div class="panel-body">
<form class="form-horizontal"  action="/group/add">
  <div class="row">
<div class="col-sm-6">
<?php
$fields=config('group.fields');
$filters=config('group.create');
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
  @include('partials.filters.'.$field['type'],['field'=>$field,'type'=>'create'])
</div>
</div>
@endforeach
<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">اختر الفئة الام </label>
    <div class="col-sm-9">
              <select
                  class="form-select form-control field-name select-dropdown-style form-select-solid filters form-field-style multi"
                  data-control="select2" data-hide-search="false"
                  data-placeholder="اختر الفئة الام"
                  data-kt-ecommerce-product-filter="status1"
                  name="category_id" >

                  @if (isset($rows) && !empty($rows))
                    <option value="All" selected > </option>
                      @foreach ($rows as $row )
                        <option value="{{$row->id}}">
                          {{ $row->name }}
                        </option>
                      @endforeach
                  @endif

                </select>
    </div>
</div>
</div>
  </div>

<div class="col-xs-12">
<button class="btn btn-sm btn-success ajaxSubmit">שמירה</button>
</div>
</form>

</div>
</div>

</div>
