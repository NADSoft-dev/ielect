<?php
$settings=DB::table('settings')->where('name','app')->select('data')->first();
if($settings){
$settings=json_decode($settings->data,true);
}
$settings['print_logo']=isset($settings['print_logo']) ? $settings['print_logo']:"";
?>
<style>
BODY {PADDING-RIGHT: 0px;PADDING-LEFT: 0px;PADDING-BOTTOM: 0px;direction:rtl;PADDING-TOP: 0px;}
BODY {FONT-SIZE: 12px;COLOR: #000000;FONT-FAMILY:Tahoma;TEXT-DECORATION: none;text-align:left;background:#ffffff;}
.report{width:710px;height:auto;overflow:hidden;position:relative;MARGIN: 10px;}
.header {width:700px;height:70px;float:right;margin:0 0 20px 0;text-align:left;}
.header .lines {width:300px;float:right;height:auto;margin:10px 0 0 0;font-weight:800;text-align:right;}
hr {width:100%;float:left;margin:0;padding:0;}
.reportTitle {width:690px;float:left;text-align:center;margin:10px 5px 10px 5px;font-size:20px;font-weight:800;}
.reportSubTitle {width:690px;float:left;text-align:right;margin:10px 0 10px 0;padding:5px;font-size:13px;font-weight:800;text-decoration: underline;background:#ebebeb;}
.inRow {width:630px;float:left;margin:5px 0 5px 50px;font-size:13px;border-bottom:1px #000 solid;}
.inRow .number {width:30px;float:right;}
.inRow .fullName {width:400px;float:right;font-size:14px;height: 18px;margin:0 0 0 10px;}
.inRow .Name2 {width:289px;float:right;font-size:14px;height: 18px;border-right:1px #000 solid;margin:0 0 0 10px;}
.inRow .Name3 {width:189px;float:right;font-size:14px;height: 18px;border-right:1px #000 solid;margin:0 0 0 10px;}
.inRow .Name4 {width:139px;float:right;font-size:14px;height: 18px;border-right:1px #000 solid;margin:0 0 0 10px;}

.date {width:230px;float:right;margin:10px 5px 5px 5px;text-align:right;}
.tbMain {direction:rtl;text-align:right;border:1px #000 solid;width:710px;}
.tbHeader {width:700px;height:auto;font-weight:800;font-size:12px;}
.tbHeader td {border:1px #000000 solid;padding:4px;background:#ebebeb;padding:5px;}
.tbItem td {border-left:1px #000000 solid;padding:2px;border-bottom:1px #000 solid;padding:3px;}

.stuHeader {width:688px;float:right;border:1px #000 solid;height:auto;padding:10px;margin:0 0 10px 0;}
.stuHeader .details {width:225px;float:right;height:auto;}
.stuHeader .details .Label {width:215px;padding:0px;height: auto;font-size:15px;font-weight: 800;font-family: Arial;float: right;}
.stuHeader .theLogo {width:216px;height: 80px;float:right;padding:5px;}

.docTitle {width:698px;float:right;border-top:2px #000 solid;height:auto;padding:5px;margin:0 0 10px 0;border-bottom:2px #000 solid;}
.docTitle .docType {width:265px;float:right;font-weight: 800;font-size:18px;font-weight: 800;font-family: Arial;text-align: right;}
.docTitle .docNum {width:200px;float:right;font-weight: 800;font-size:18px;font-weight: 800;font-family: Arial;text-align:center;}
.docTitle .print {width:150px;float:left;font-weight: 800;font-size:18px;font-weight: 800;font-family: Arial;text-align:center;}

.stuDetails {width:500px;float:right;height:auto;padding:5px;margin:0 0 10px 0;}
.stuDetails .Label {width:480px;padding:2px;height: auto;font-size:15px;font-weight: normal;font-family: Arial;text-align:right;float: right;}

.stuDates {width:150px;float:left;height:auto;padding:5px;margin:0 0 10px 0;}
.stuDates .Label {width:140px;padding:2px;height: auto;font-size:15px;font-weight: normal;font-family: Arial;text-align:right;float: right;}

.calcs {width:206px;float:left;padding:5px;border:1px #000 solid;height: auto;margin:10px 0 0 0;}
.calcs .Label {width:111px;padding:2px;height: 20px;font-size:13px;font-weight: 800;font-family: Arial;text-align:right;float: right;}
.calcs .Value {width:85px;float:right;height: 20px;padding:3px;font-size:13px;font-weight: normal;font-family: Arial;text-align:right;float: right;}

body{padding:0;margin:0;}
@page {    size: auto;   /* auto is the initial value */

    /* this affects the margin in the printer settings */
    margin: 0.1mm 0.1mm 0.1mm 0.1mm;}
.wrap{width:800px; height:auto; overflow:hidden;}
.wrap .header{width:800px; height:1px;}
.wrap .stick{width:225px; height:124px; float:right;  position:relative;margin-left:13px;margin-right:10px;margin-bottom:3px;}
.wrap .stick .row{width:190px; height:12px; line-height:12px; font-size:10px; direction:rtl; text-align:right; padding-right:8px;}
.wrap .stick .logo{ width:30px; height:30px; position:absolute; bottom:30px; left:30px;}
.page {page-break-after:always;width:0;height:0;}
</style>
<div class="report">


<div class="wrap">
<div class="header"></div>
<?PHP
$savedData=[];
$num=0;
				 foreach($electors as $elector){
           $row=(array)$elector;

				$num++;

				 $name='לכבוד: ' . $fname=$row['PersonalName'].' '.$row['FatherName'].' '.$row['FamilyName'];
				 $kalfy='מס קלפי: '.$row['AddCode'];
				$row['Address']=trim($row['Address']);
        if(!isset($savedData[$row['AddCode']])) $savedData[$row['AddCode']]=DB::table('ballot')->where('ballot_id',$row['AddCode'])->select('*')->first();
        $row['place_details']= $savedData[$row['AddCode']]->place_details ?? '';
        $row['street_name']=$savedData[$row['AddCode']]->street_name ?? '';
         $row['home_num']=$savedData[$row['AddCode']]->home_num ?? '';
				 $kalfyPlace="מקום קלפי: ".$row['place_details'];
				 $city="ישוב: ".$row['Address'].'&nbsp;&nbsp;&nbsp;&nbsp; מיקוד: '.$row['Zip'];
				 $street="רחוב: ".$row['street_name']."&nbsp;&nbsp;&nbsp;&nbsp; בית: ".$row['home_num'];
				 $Serial="סידורי: ".$row['Serial'];






?>

<div class="stick" >
<div class="logo">
  @if($settings['print_logo']!='')
  <img src="<?=$settings['print_logo'] ?? ''; ?>" width="30" height="30" />
  @endif
</div>
<div class="row" style="margin-top:10px;"> <?=$name;?> </div>
<div class="row"> <?=$kalfy;?> </div>
<div class="row"> <?=$kalfyPlace;?> </div>
<div class="row"> <?=$city;?> </div>
<div class="row"> <?=$street;?> </div>
<div class="row"> <?=$Serial;?> </div>
</div>

<?php
if ($num%24 == 0) echo "<div class=\"page\"></div><div class=\"header\"></div> ";
}


?>

</div>
</div>
<script>
window.print();
    setTimeout(function () {
      //alert('dd');
        close();
    }, 500);
</script>
