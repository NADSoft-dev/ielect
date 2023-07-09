<?php
$value=isset($value) ? $value:"";
$field['autocomplete']=isset($field['autocomplete']) ?  $field['autocomplete'] : false;
$field['placeholder']=isset($field['placeholder']) ?  "placeholder='".$field['placeholder']."'" : "";
$field['required']=isset($field['required']) ?  "required" : false;
$currentPage=isset($currentPage) ? $currentPage:'';
?>
<div class="inputContainer">

<input type="text" name={{$field['name']}}  class="@if($field['required']) req @endif form-control field-{{$field['name']}} @if($field['autocomplete']) autocomplete @endif" @if($field['autocomplete'])  data-complete="{{$field['autocomplete']}}" @endif  {!! $field['placeholder'] !!} value="{{$value}}" autocomplete="off" >
@if($field['name']=="FamilyName" && $currentPage=="electors")
<div class="checkbox" style="width: auto;
    display: inherit;
    position: absolute;
    top: 0;
    left: 10px;
    font-size: 12px;
    line-height: 19px;
    text-align: right;">
    <label>
      <input type="checkbox" name="onlyFamilyName" value="1" checked> חיפוש מדויק
    </label>
  </div>
 @endif 
@if($field['autocomplete'])
<div class="searchResults"></div>
@endif
</div>
