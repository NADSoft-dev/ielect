
<div class="row">
  <ol class="breadcrumb">
<li><a href="/#/main/">ראשי</a></li>
<li><a href="/#/group/all/">רשימת קבוצות</a></li>
<li class="active">{{$subid->name}}</li>
</ol>


  <div class="panel panel-default">
  <div class="panel-heading">עדכון פעיל</div>

<div class="panel-body">
<form class="form-horizontal"  action="/group/save/{{$subid->id}}">
<div class="col-sm-6">
<?php
$fields=config('group.fields');
$filters=config('group.edit');

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

    $value=$subid->$filter;


  ?>
<div class="form-group">
<label for="inputEmail3" class="col-sm-3 control-label">{{$field['label']}}</label>
<div class="col-sm-9">
  @include('partials.filters.'.$field['type'],['field'=>$field,'type'=>'edit','value'=>$value])
</div>
</div>
<div class="form-group">
  <label for="inputEmail3" class="col-sm-3 control-label">اختر الفئة الام </label>
  <div class="col-sm-9">
    <?php
      $parent=DB::table('groups')->where('category_id',null)->get();
    ?>
            <select
                class="selectpicker form-control changePagesCount"
                data-control="select2" data-hide-search="false"
                data-placeholder="اختر الفئة الام"
                data-kt-ecommerce-product-filter="status1"
                name="category_id" >

                @if (isset($parent) && !empty($parent))
                <option value="All"  > </option>
                    @foreach ($parent as $row )
                      <?php
                        $subCategory=DB::table('groups')->where('category_id',$row->id)->get();
                      ?>
                       
                        <option  value="{{$row->id}}" @if($row->id == $subid->category_id) selected @endif style="font-weight: bold;">
                          {{ $row->name }}
                          @foreach ($subCategory as $sub)
                            <option value="{{ $sub->id }}" @if($sub->id == $subid->category_id) selected @endif>
                              --{{ $sub->name }}
                            </option>
                            @endforeach
                        </option>
                        @endforeach
                    
                @endif

              </select>
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
