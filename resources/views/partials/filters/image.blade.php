
<?php
$value=isset($value) && $value ? $value:"http://placehold.it/180";
?>
<div class="uploadContainer">
<label class="btn btn-primary btn-file">
    בחר <input type='file' class="uploadImage" />
</label>

<img class="prevImage" src="{!! $value !!}" style="max-width:180px;max-height:180px;"  />

<input type="hidden" name={{$field['name']}} class="imageFile"  value="{{$value}}" >

</div>
