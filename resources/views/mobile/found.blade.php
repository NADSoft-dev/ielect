<?php

$elector=DB::table('electors')->where('IDNumber',$IDNumber)->first();
if($elector){
$elector->kalfy_data=DB::table('ballot')->where('ballot_id',$elector->AddCode)->first();
}
?>
@if($elector)
<br>
<ul class="list-group">
  <li class="list-group-item"><h2 style="margin:0;">{{$elector->PersonalName}} {{$elector->FatherName}}  {{$elector->FamilyName}}</h2></li>
  <li class="list-group-item">מס' סידורי: {{$elector->Serial}}</li>
  <li class="list-group-item">מס' קלפי: {{$elector->AddCode}}</li>
  <li class="list-group-item">מיקום: {{$elector->kalfy_data->place_details}}</li>
  <li class="list-group-item">כתובת: {{$elector->kalfy_data->street_name}}</li>
  
</ul>




@else

<h2>לא נמצא !</h2>

@endif