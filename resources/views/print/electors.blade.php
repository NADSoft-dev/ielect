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
    <?
    $fields=config('electors.fields');

    ?>
    @foreach($listFields as $f)
    <th style="border:1px solid #000;padding:10px;border-right:0;">{{$fields[$f]['label']}}</th>
    @endforeach

  </thead>
<tbody>
  @foreach($electors as $elector)
  <?
   $css="";
   if($elector->list) $css="hasList";
  ?>
  <tr data-id="{{$elector->IDNumber}}" class="Tr" >
    @foreach($listFields as $f)

    <td style="border:1px solid #000;border-right:0;border-top:0;padding:5px;font-size:12px;" align="center">{{$elector->$f}}</td>
    @endforeach

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
