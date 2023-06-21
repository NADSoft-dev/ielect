<table class="table table-bordered">
  <thead>
    <tr>
      <th>מס' קלפי</th>
      <th>מס' בוחרים</th>
      <th>הצביעו</th>
      <th>אחוז הצבעה</th>
    </tr>
  </thead>
  <tbody>


    @foreach($rows as $row)
    <tr>
      <td>{{$row['ballot_id']}}</td>
      <td>{{$row['total']}}</td>
      <td>{{$row['voted']}}</td>
      <td>{{$row['votedPer']}} %</td>
    </tr>
    @endforeach
  </tbody>



</table>
