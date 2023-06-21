<div>
    <canvas id="myChart" height="40vh" width="80vw"></canvas>
</div>
<?php

$count=$el1->count();
$voted = $el3->where('voted',1)->count();
$connected = $el2->where('list','>',0)->count();
$connectedVoted = $el4->where('list','>',0)->where('voted',1)->count();
?>
<script>

new Chart(document.getElementById("myChart"), {
"type": "pie",
"data": {
    "labels": ["בוחרים", "בוחרים שהצביעו", "שייכים", "שייכים שהצביעו"],
    "datasets": [{

        "data": [{{$count}}, {{$voted}}, {{$connected}}, {{$connectedVoted}}],
        backgroundColor:['#cccccc','#eebbba','#bddeec','#c2ecc4'],
        hoverBackgroundColor:['#cccccc','#eebbba','#bddeec','#c2ecc4'],
    }]
},
options:{
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
  <th>בוחרים</th>
  <th>בוחרים שהצביעו</th>
  <th>שייכים</th>
  <th>שייכים שהצביעו</th>
</tr>
<tr>
  <td>{{$count}}</td>
  <td>{{$voted}} - {{number_format(($voted / $count) * 100,2)}}%</td>
  <td>{{$connected}} - {{number_format(($connected / $count) * 100,2)}}%</td>
  <td>{{$connectedVoted}} - {{number_format(($connected / $count) * 100,2)}}%</td>
</tr>
</table>
</div>
