<div>
    <canvas id="groupchart" height="40vh" width="80vw"></canvas>
</div>
<?
$mayors=DB::table('groups')->select('*')->get();
$labels=$voted=[];
foreach($mayors as $mayor){
  $labels[]=$mayor->full_name;
  $voted[]=DB::table('electors')->where('group',$mayor->id)->where('voted',1)->count();
}
$labels[]="לא הצביע";
$voted[]=DB::table('electors')->where('voted',0)->count();
$voteds=json_encode($voted);
$labelss=json_encode($labels);

?>

<script>

new Chart(document.getElementById("groupchart"), {
"type": "pie",
"data": {
    "labels": {!! $labelss !!},
    "datasets": [{

        "data": {!! $voteds !!},
        backgroundColor:['#cccccc','#eebbba','#bddeec','#c2ecc4'],
        hoverBackgroundColor:['#cccccc','#eebbba','#bddeec','#c2ecc4'],
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
