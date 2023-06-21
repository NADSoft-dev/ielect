<div id="{{$table}}Container">

<div>
    <canvas id="{{$table}}chart" height="40vh" width="80vw"></canvas>
</div>
<?
$mayors=DB::table($table)->select('*')->get();
$labels=$voted=[];
foreach($mayors as $mayor){
  if($field=='mayor') $labels[]=$mayor->full_name;
  if($field=='group') $labels[]=$mayor->name;

  $voted[]=DB::table('electors')->where($field,$mayor->id)->where('voted',1)->count();
}
$labels[]="לא הצביע";
$voted[]=DB::table('electors')->where($field,'>',0)->where('voted',0)->count();
$voteds=json_encode($voted);
$labelss=json_encode($labels);

?>

<script>

new Chart(document.getElementById("{{$table}}chart"), {
"type": "pie",
"data": {
    "labels": {!! $labelss !!},
    "datasets": [{

        "data": {!! $voteds !!},
        backgroundColor:['#cccccc','#eebbba','#bddeec','#c2ecc4',"#d87092","#0bbc62","#ffbd03",'#363537',"#ed7d3a","#fffd82","#ffb770","#e84855","#b56b45","#1b1e47"],
    }]
},
options:{
  cutoutPercentage:50,
  legend:{
    position:'bottom',
  },

  tooltips: {
  callbacks: {
    label: function(tooltipItem, data) {
      //get the concerned dataset
      var dataset = data.datasets[tooltipItem.datasetIndex];
      //calculate the total of this data set
      var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
        return previousValue + currentValue;
      });
      //get the current items value
      var currentValue = dataset.data[tooltipItem.index];
      //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
      var precentage = Math.floor(((currentValue/total) * 100)+0.5);

      return currentValue+' - '+precentage + "%";
    }
  }
}
}

});
</script>


<div class="col-xs-12">
<table class="table table-bordered mrg-tp-15">
<tr>
  <th>שם</th>
  <th>בוחרים שהצביעו</th>
</tr>
@foreach($voted as $key=>$val)
<tr>
  <td>{{$labels[$key]}}</td>
  <td>{{$val}}</td>

</tr>
@endforeach
</table>
</div>
</div>
