<?php
$value=isset($value) ? $value:"";

$array=is_array($field['data']) ? $field['data']:false;
$field['id']=isset($field['id']) ? $field['id']:false;
$field['disabled']=isset($field['disabled']) ? $field['disabled']:false;
$field['required']=isset($field['required']) ?  "required" : false;
if(!$array){

  if(count(explode(',',$field['data']))==5){
    list($label,$table,$key,$k,$v)=explode(',',$field['data']);
    
    $alldata=DB::table($table)->where($k,$v)->select('*')->get()->toArray();
  }else{
  list($label,$table,$key)=explode(',',$field['data']);
  $alldata=DB::table($table)->select('*')->get()->toArray();
  }
}else{
$key="id";
$label="label";
$alldata=[];
foreach($array as $k=>$v){
  $alldata[]=[$key=>$k,$label=>$v];
}
}

?>
<select class="@if($field['required']) req @endif selectpicker form-control run-{{$field['type']}} field-{{$field['name']}}"   @if($field['id']) id="{{$field['id']}}" @endif @if($field['disabled']) disabled @endif name="{{$field['name']}}" @if($field['type']=='rselect') data-rselect="{{$field['rselect']}}" data-rselectid="{{$field['rselectid']}}"  @endif>
    <option value="0">בחר</option>
  @foreach($alldata as $row)

  <?php

  $row=(array)$row;
  $selected=$row[$key]==$value ? "selected='selected'":"";
  $subCategory=DB::table('groups')->where('category_id',$row[$key])->get();

  ?>
  
  @if ($field['name'] == 'group')
    <option value="{{$row[$key]}}" {{$selected}} style="font-weight: bold;">
        {{$row[$label]}}

        @foreach ($subCategory as $sub)
          <option value="{{ $sub->id }}">
            --{{ $sub->name }}
            <?php
              $subSubCategory=DB::table('groups')->where('category_id',$sub->id)->get();
            ?>
            @if(!empty($subSubCategory))
            @foreach ($subSubCategory as $subSub)
              <option value="{{$subSub->id }}" >---{{$subSub->name}}</option>
            @endforeach
            @endif 
          </option>
        @endforeach
    </option>
  @else
  <option value="{{$row[$key]}}" {{$selected}}>{{$row[$label]}} </option>

  @endif
  

@endforeach
</select>
