<table class="table table-bordered">
  <thead>
    <tr>
      <th>שם</th>
      <th>מס' קולות</th>
    </tr>
  </thead>
  <tbody>


    @foreach($rows as $row)
    <tr>
      <td><a href="/electors/final-pop/{{$table}}/{{$row->linkId}}" data-title="ספירת קולות לפי קלפי" data-size="mid" data-type="POP">{{$row->name}}</a></td>
      <td>{{$row->total}}</td>
    </tr>
    @endforeach
  </tbody>



</table>
