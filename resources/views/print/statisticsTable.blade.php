<style>
body {
  background: #fff;
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
.stickTopContainer{display:none;}




</style>
@include('print.header')
{!! $html !!}

<style>

table-bordered>thead>tr>th, .table-bordered>thead>tr>th, table-bordered>tbody>tr>th, .table-bordered>tbody>tr>th, table-bordered>tfoot>tr>th, .table-bordered>tfoot>tr>th, table-bordered>thead>tr>td, .table-bordered>thead>tr>td, table-bordered>tbody>tr>td, .table-bordered>tbody>tr>td, table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #e0e0e0;
}
table.statistics{ text-align:right; direction:rtl; font-size:12px;width:100%;}

table.statistics *{text-align: center;}

.table.statistics .bg{background:#ecf0f1;}
table.statistics th{font-size:15px; font-weight: bold;background:#ecf0f1;    vertical-align: middle;}

.firstRight{ float:right; width:49%; text-align: center;height:auto; border-left:1px solid #e0e0e0; padding-top:7px;padding-bottom: 7px;}
.secR{ width:49%; float:right; border-left:1px solid #e0e0e0;}
.secL{width:49%; float:right;}
.firstLeft{ float:right; width:49%;text-align: center; height:auto; padding-top:7px;padding-bottom: 7px;}
table.statistics td{padding: 0 !important;    vertical-align: middle !important;}
</style>
<script>
window.print();
    setTimeout(function () {
      //alert('dd');
        close();
    }, 500);
</script>
