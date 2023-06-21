<?php
$row=(array)$row;
?>
<tr class="Row-{{$row['id']}}">
  <td>{{$row['full_name']}}</td>
  <td>{{$row['iden']}}</td>
  <td>{{$row['cell']}}</td>
  <td>{{$row['kalfy']}}</td>
  <td>{{config('workers.fields.shift.data.'.$row['shift'])}}</td>
  <td>{{$row['password']}}</td>
  <td>
  <a href="/#/page/worker-edit/{{$row['id']}}/"><button class="btn btn-xs btn-primary">עריכה</button></a>
  <button class="btn btn-xs btn-danger deleteRow" data-controller="worker" data-id="{{$row['id']}}">מחיקה</button>
<button class="btn btn-xs btn-info sendSmsAjax" data-type="worker" data-id="{{$row['id']}}">שליחת הודעה</button>
<button class="btn btn-xs btn-warning resetPassword" data-controller="workers" data-id="{{$row['id']}}">איפוס סיסמה</button>
  </td>
</tr>
