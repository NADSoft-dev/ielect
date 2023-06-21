<table class="table table-bordered">
  <thead>
    <tr>
      <th>שם פעיל</th>
      <th>מס' בוחרים</th>
      <th>הצביעו</th>
      <th>אחוז הצבעה</th>
    </tr>
  </thead>
  <tbody>


    @foreach($rows as $row)
    <tr>
      <td>{{$row['full_name']}}</td>
      <td>{{$row['total']}}</td>
      <td>{{$row['voted']}}</td>
      <td>{{$row['votedPer']}} %</td>
    </tr>
    @endforeach
  </tbody>



</table>
