<?php
$fieldlabel=config('electors.fields.'.$field.'.label');
$totAll = 0;
$totMale = 0;
$totFemale = 0;
$totVoted = 0;
$totNotvoted = 0;
$totFriends = 0;
$totNotfriends = 0;
$totNotvotedFriend=0;
$totVotedFriend=0;
?>
<style>
table-bordered>thead>tr>th, .table-bordered>thead>tr>th, table-bordered>tbody>tr>th, .table-bordered>tbody>tr>th, table-bordered>tfoot>tr>th, .table-bordered>tfoot>tr>th, table-bordered>thead>tr>td, .table-bordered>thead>tr>td, table-bordered>tbody>tr>td, .table-bordered>tbody>tr>td, table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #e0e0e0;
}
table.statistics{ text-align:right; direction:rtl; font-size:12px;width:100%;}

table.statistics *{text-align: center;}

.table.statistics .bg{background:#ecf0f1;}
table.statistics th{font-size:15px; font-weight: bold;background:#ecf0f1;    vertical-align: middle;}

.firstRight{ float:right; width:50%; text-align: center;height:auto; border-left:1px solid #e0e0e0; padding-top:7px;padding-bottom: 7px;}
.secR{ width:50%; float:right; border-left:1px solid #e0e0e0;}
.secL{width:50%; float:right;}
.firstLeft{ float:right; width:50%;text-align: center; height:auto; padding-top:7px;padding-bottom: 7px;}
table.statistics td{padding: 0 !important;    vertical-align: middle !important;}
</style>
<div class="col-xs-12 stickTopContainer">
<div class="jumbotron stickTop">

  <ul class="nav nav-pills" role="tablist">
      <li role="presentation"><a href="/stats/print" target="_blank">הדפסה <span class="glyphicon glyphicon-print"></span></a></li>
  </ul>
</div>
</div>

<table class="statistics table table-bordered" border="1" align="center" cellpadding="0" cellspacing="0">
<tr>

<th style="width:5%;">#</th>
<th style="width:15%;"><?=$fieldlabel;?></th>
<th style="width:5%;">כמות</th>
<th style="width:15%;">מין</th>
<th style="width:15%;">שייך לרשימה</th>
<th style="width:15%;">הצביע</th>
<th style="width:15%;">שייך שהצביע</th>

</tr>


<tr>


<td  class="bg">#</td>
<td class="bg"><?=$fieldlabel;?></td>
<td  class="bg">כמות</td>
<td  class="bg">
<div class="firstRight bg">זכר </div>
<div class="firstLeft bg">נקבה </div>
</td>
<td width="120" class="bg">
<div class="firstRight">כן </div>
<div class="firstLeft">לא </div>
</td>
<td width="120" class="bg">
<div class="firstRight">כן </div>
<div class="firstLeft">לא </div>
</td>

<td width="120" class="bg">
<div class="firstRight">כן </div>
<div class="firstLeft">לא </div>
</td>

</tr>


<tr>

<td style="width:5%" class="bg">#</td>
<td style="width:15%" class="bg"><?=$fieldlabel;?></td>
<td style="width:5%" class="bg">כמות</td>
<td style="width:15%" class="bg">
<div class="firstRight">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
<div class="firstLeft">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
</td>
<td width="120" class="bg">
<div class="firstRight">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
<div class="firstLeft">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
</td>
<td width="120" class="bg">
<div class="firstRight">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
<div class="firstLeft">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
</td>


<td width="120" class="bg">
<div class="firstRight">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
<div class="firstLeft">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
</td>
</tr>
<?php
$TheCount=0;
$i=0;
?>
@foreach($list as $row)
<?php

$filter=json_decode(Request::get('filter'),true);
$stats=GF::buildElectorsQuery($filter);
$stats=$stats->where($field,$row->$field);


$stats=$stats->select(DB::raw('COUNT(`id`) as total'),DB::raw('SUM(if(`gender`=1,1,0)) as `male`'),DB::raw('SUM(if(`voted`=1,1,0)) as `voted`'),DB::raw('sum(if(`voted`=1 AND `list`>0,1,0)) as `votedfriend`'),DB::raw('SUM(if(`list`>0,1,0)) as `friend`'));
$stats=$stats->first();


$row->toshow=$row->toshow ? $row->toshow:"ללא ".$fieldlabel;
$malePer = $row->total==0 ? 0:number_format(($stats->male / $row->total) * 100);
$female = $stats->total - $stats->male;
$femalePer = $row->total==0 ? 0:number_format(($female / $row->total) * 100);
$friendPer = $row->total==0 ? 0:number_format(($stats->friend / $row->total) * 100);
$notfriend = $stats->total - $stats->friend;
$notfriendPer=$row->total==0 ? 0:number_format(($notfriend / $row->total) * 100);
$votedPer=$row->total==0 ? 0:number_format(($stats->voted / $row->total) * 100);
$notvoted=$stats->total - $stats->voted;
$notvotedPer=$row->total==0 ? 0:number_format(($notvoted / $row->total) * 100);
$votedfriendper=$row->total==0 ? 0:number_format(($stats->votedfriend / $row->total) * 100);
$notvotedfriend=$stats->friend - $stats->votedfriend;
$notvotedfriendper=$row->total==0 ? 0:number_format(($notvotedfriend / $row->total) * 100);
$TheCount++;
$i++;


$totAll += $stats->total;
$totMale += $stats->male;
$totFemale += $female;
$totVoted += $stats->voted;
$totNotvoted += $notvoted;
$totFriends += $stats->friend;
$totNotfriends += $notfriend;
$totNotvotedFriend+=$notvotedfriend;
$totVotedFriend+=$stats->votedfriend;


?>
<tr>
<td width="25"><?=$i;?></td>
<td width="95"><?=$row->toshow?></td>
<td width="25"><?=$stats->total;?></td>
<td width="120">
<div class="firstRight">
<div class="secR"><?=$stats->male;?></div>
<div class="secL"><?=$malePer;?>%</div>
</div>
<div class="firstLeft">
<div class="secR"><?=$female;?></div>
<div class="secL"><?=$femalePer;?>%</div>
</div>
</td>
<td width="120">
<div class="firstRight">
<div class="secR"><?=$stats->friend;?></div>
<div class="secL"><?=$friendPer;?>%</div>
</div>
<div class="firstLeft">
<div class="secR"><?=$notfriend;?></div>
<div class="secL"><?=$notfriendPer;?>%</div>
</div>
</td>
<td width="120">
<div class="firstRight">
<div class="secR"><?=$stats->voted;?></div>
<div class="secL"><?=$votedPer;?>%</div>
</div>
<div class="firstLeft">
<div class="secR"><?=$notvoted;?></div>
<div class="secL"><?=$notvotedPer;?>%</div>
</div>
</td>

<td width="120">
<div class="firstRight">
<div class="secR"><?=$stats->votedfriend;?></div>
<div class="secL"><?=$votedfriendper;?>%</div>
</div>
<div class="firstLeft">
<div class="secR"><?=$notvotedfriend;?></div>
<div class="secL"><?=$notvotedfriendper;?>%</div>
</div>
</td>
</tr>



@endforeach
<?php

$totMalePer = $totAll==0 ? $totAll:number_format(($totMale / $totAll) * 100,2);
$totFemalePer = $totAll==0 ? $totAll:number_format(($totFemale / $totAll) * 100,2);
$totVotedPer = $totAll==0 ? $totAll:number_format(($totVoted / $totAll) * 100,2);
$totNotvotedPer = $totAll==0 ? $totAll:number_format(($totNotvoted / $totAll) * 100,2);
$totFriendPer = $totAll==0 ? $totAll:number_format(($totFriends / $totAll) * 100,2);
$totNotfriendPer = $totAll==0 ? $totAll:number_format(($totNotfriends / $totAll) * 100,2);

$totVotedFriendPer = $totFriends==0 ? 0: number_format(($totVotedFriend / $totFriends) * 100,2);
$totNotVotedFriendPer = $totFriends==0 ? 0:number_format(($totNotvotedFriend/$totFriends)*100,1);
?>

<tr>

<td width="25" class="bg">#</td>
<td width="95" class="bg"><?=$fieldlabel;?></td>
<td width="25" class="bg">כמות</td>
<td width="120" class="bg">
<div class="firstRight">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
<div class="firstLeft">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
</td>
<td width="120" class="bg">
<div class="firstRight">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
<div class="firstLeft">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
</td>
<td width="120" class="bg">
<div class="firstRight">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
<div class="firstLeft">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
</td>
<td width="120" class="bg">
<div class="firstRight">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
<div class="firstLeft">
<div class="secR"> כמות</div>
<div class="secL">אחוז</div>
</div>
</td>
</tr>
<tr>
  <td width="25">#</td>
  <td width="95"><?=$TheCount;?></td>
  <td width="25"><?=$totAll;?></td>
  <td width="120">
  <div class="firstRight">
  <div class="secR"><?=$totMale;?></div>
  <div class="secL"><?=$totMalePer;?></div>
  </div>
  <div class="firstLeft">
  <div class="secR"><?=$totFemale;?></div>
  <div class="secL"><?=$totFemalePer;?></div>
  </div>
  </td>
  <td width="120">
  <div class="firstRight">
  <div class="secR"><?=$totFriends;?></div>
  <div class="secL"><?=$totFriendPer;?></div>
  </div>
  <div class="firstLeft">
  <div class="secR"><?=$totNotfriends;?></div>
  <div class="secL"><?=$totNotfriendPer;?></div>
  </div>
  </td>

  <td width="120">
  <div class="firstRight">
  <div class="secR"><?=$totVoted;?></div>
  <div class="secL"><?=$totVotedPer;?></div>
  </div>
  <div class="firstLeft">
  <div class="secR"><?=$totNotvoted;?></div>
  <div class="secL"><?=$totNotvotedPer;?></div>
  </div>
  </td>



  <td width="120">
  <div class="firstRight">
  <div class="secR"><?=$totVotedFriend;?></div>
  <div class="secL"><?=$totVotedFriendPer;?></div>
  </div>
  <div class="firstLeft">
  <div class="secR"><?=$totNotvotedFriend;?></div>
  <div class="secL"><?=$totNotVotedFriendPer;?></div>
  </div>
  </td>
</tr>
<tr>


<td  class="bg">#</td>
<td class="bg"><?=$fieldlabel;?></td>
<td  class="bg">כמות</td>
<td  class="bg">
<div class="firstRight bg">זכר </div>
<div class="firstLeft bg">נקבה </div>
</td>
<td width="120" class="bg">
<div class="firstRight">כן </div>
<div class="firstLeft">לא </div>
</td>
<td width="120" class="bg">
<div class="firstRight">כן </div>
<div class="firstLeft">לא </div>
</td>

<td width="120" class="bg">
<div class="firstRight">כן </div>
<div class="firstLeft">לא </div>
</td>

</tr>

<tr>

<th style="width:5%;">#</th>
<th style="width:15%;"><?=$fieldlabel;?></th>
<th style="width:5%;">כמות</th>
<th style="width:15%;">מין</th>
<th style="width:15%;">שייך לרשימה</th>
<th style="width:15%;">הצביע</th>
<th style="width:15%;">שייך שהצביע</th>

</tr>


</table>
