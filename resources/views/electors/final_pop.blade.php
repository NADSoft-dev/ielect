<table class="table table-bordered">
  <thead>
    <tr>
      <th>קלפי</th>
      <th>מס' קולות</th>
    </tr>
  </thead>
  <tbody>


    @foreach($rows as $row)
    <tr>
      <td>{{$row->kalfy}}</td>
      <td>{{$row->total}}</td>
    </tr>
    @endforeach
  </tbody>



</table>
<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">סגירה</button>