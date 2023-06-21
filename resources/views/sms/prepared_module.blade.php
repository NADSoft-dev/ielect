<?
if(count($allPhones)==0) $smsCount=0;
else $smsCount=$countMessage/count($allPhones);
$send=true;
?>
<div class="row">
  <ol class="breadcrumb">
<li><a href="/#/main/">ראשי</a></li>

<li class="active">שליחת הודעות</li>
</ol>
<div class="panel panel-default">
<div class="panel-heading">אישור שליחת הודעה</div>
<div class="panel-body">
  @if($balance>=$countMessage)


  @else
  <?
$send=false;
  ?>
  <div class="alert alert-warning" role="alert">
    אין לך מספיק יתרה לשליחת הודעות,נא ליצור איתנו קשר לצורך עדכון חבילת הודעות.
  </div>
  @endif

  @if($countMessage<1)
  <?
  $send=false;
  ?>
  <div class="alert alert-warning" role="alert">
    יש לבחור יעדים עם מספרי טלפון נייד מעודכן !
  </div>
  @endif
   <table class="table table-striped">

     <tbody>
       <tr>
         <td>תוכן הודעה</td>
         <td>{{$data['msg']}}</td>
       </tr>
       <tr>
         <td>מס' הודעות</td>
         <td>{{$smsCount}}</td>
       </tr>
       <tr>
         <td>מס' מקבלי הודעה</td>
         <td>{{count($allPhones)}}</td>
       </tr>

       <tr>
         <td>סה"כ הודעות לחיוב</td>
         <td>{{$countMessage}}</td>
       </tr>

       <tr>
         <td>יתרת ההודעות שלך</td>
         <td>{{$balance}}</td>
       </tr>
     </tbody>
   </table>
</div>
@if($send)
<div class="panel-footer " style="text-align: left;">
 <button class="btn btn-primary btn-sm sendPreparedModuleSms">שליחה</button>
</div>
@endif

</div>
</div>
