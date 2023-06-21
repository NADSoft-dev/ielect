<?php
$value=isset($value) ? $value:"";
$type=isset($type) ? $type:"";
?>
@if($type=='edit')
<input type="text" name={{$field['name']}} class="form-control"  value="{{$value}}" >
@else

<div class="input-group">
                                      <input type="text" class="input-small form-control field-{{$field['name']}}-from"  placeholder="מ-{{$field['label']}}" name="{{$field['name']}}_from" />
                                      <span class="input-group-addon">עד</span>
                                      <input type="text" class="input-small form-control field-{{$field['name']}}-to" placeholder="עד-{{$field['label']}}" name="{{$field['name']}}_to" />
                                    </div>
@endif
