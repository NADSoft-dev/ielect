<style>
body {
  background: rgb(204,204,204);
}
page[size="A4"] {
  background: white;
  width: 21cm;
  height: 29.7cm;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
@media print {
  body, page[size="A4"] {
    margin: 20px;
    box-shadow: 0;
  }
}
.Tr td:first-of-type, .Tr th:first-of-type{border-right:1px solid #000 !important;}
</style>
@include('print.header')
<table style="width:100%;text-align:cemter;padding-top:20px;" Cellpadding="0" cellspacing="0" dir="rtl">
  <thead class="Tr">
    <th style="border:1px solid #000;padding:10px;border-right:0;">שם</th>
    <th style="border:1px solid #000;padding:10px;border-right:0;">ת.ז</th>
    <th style="border:1px solid #000;padding:10px;border-right:0;">מס' טלפון</th>
    <th style="border:1px solid #000;padding:10px;border-right:0;">מס' נייד</th>
    <th style="border:1px solid #000;padding:10px;border-right:0;">פעילים</th>
    <th style="border:1px solid #000;padding:10px;border-right:0;">בוחרים</th>


  </thead>
<tbody>
<h2 style="text-align:right;">{{$title}}</h2>

    @foreach($rows as $row)
    <?php
    $list=DB::table('personal_list')->where('under',$row->id)->count();
    $electors=DB::table('electors')->where('manid',$row->id)->count();
    ?>
    <tr class="Tr" >
    <td style="border:1px solid #000;border-right:0;border-top:0;padding:5px;font-size:12px;" align="center">{{$row->full_name}}</td>
    <td style="border:1px solid #000;border-right:0;border-top:0;padding:5px;font-size:12px;" align="center">{{$row->iden}}</td>
    <td style="border:1px solid #000;border-right:0;border-top:0;padding:5px;font-size:12px;" align="center">{{$row->phone}}</td>
    <td style="border:1px solid #000;border-right:0;border-top:0;padding:5px;font-size:12px;" align="center">{{$row->cell}}</td>
    <td style="border:1px solid #000;border-right:0;border-top:0;padding:5px;font-size:12px;" align="center">{{$list}}</td>
    <td style="border:1px solid #000;border-right:0;border-top:0;padding:5px;font-size:12px;" align="center">{{$electors}}</td>
</tr>
    @endforeach




</tbody>
</table>
<script>
window.print();
    setTimeout(function () {
      //alert('dd');
        close();
    }, 500);
</script>
