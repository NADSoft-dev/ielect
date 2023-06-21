<div>
    <canvas id="myChart" height="40vh" width="80vw"></canvas>
</div>
<?
$stats=DB::table('electors')->select(DB::raw('COUNT(`id`) as total'),DB::raw('SUM(if(`voted`=1,1,0)) as `voted`'),DB::raw('sum(if(`voted`=1 AND `list`>0,1,0)) as `votedfriend`'),DB::raw('SUM(if(`list`>0,1,0)) as `friend`'))->first();
$notfriend = $stats->total - $stats->friend;
$notvoted=$stats->total - $stats->voted;
$notvotedfriend=$stats->friend - $stats->votedfriend;
$notfriendVoted=$stats->voted-$stats->votedfriend;

$notfriendNotVoted = $notfriend - $notfriendVoted;
?>

<script>

new Chart(document.getElementById("myChart"), {
"type": "pie",
"data": {
    "labels": ["שייך שהצביע","שייך שלא הצביע",'לא שייך שהצביע','לא שייך שלא הצביע'],
    "datasets": [{

        "data": [{{$stats->votedfriend}}, {{$notvotedfriend}}, {{$notfriendVoted}}, {{$notfriendNotVoted}}],
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


<div class="col-xs-12">
<table class="table table-bordered mrg-tp-15">
<tr>
  <th>שייך שהצביע</th>
  <th>שייך שלא הצביע</th>
  <th>לא שייך שהצביע</th>
  <th>לא שייך לא הצביע</th>
</tr>
<tbody>
  <tr>
    <td>{{$stats->votedfriend}}</td>
    <td>{{$notvotedfriend}}</td>
    <td>{{$notfriendVoted}}</td>
    <td>{{$notfriendNotVoted}}</td>
  </tr>
</tbody>
</table>
</div>
