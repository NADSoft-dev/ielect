<style>
   .jumbotron{margin-bottom:0;}
</style>

<div class="panel panel-default mrg-tp-20">
  <div class="panel-body">
  <div class="card">
   <div class="card-body">
      <ul class="nav nav-tabs" role="tablist">
         <li role="presentation" class="active" onclick="$('.ajaxSubmit').click();"><a href="#parties" aria-controls="home" role="tab" data-toggle="tab">מפלגות</a></li>
         <li role="presentation" onclick="$('.ajaxSubmit').click();" ><a href="#mayors"  aria-controls="profile" role="tab" data-toggle="tab">ראשי רשויות</a></li>
      </ul>
   </div>
</div>
      <!-- Tab panes -->
      <div class="tab-content">
         <div role="tabpanel" class="tab-pane active" id="parties">
 
         <form class="form-horizontal"  action="./save-votes">
 <style>
  .increaseBtn{height:0;padding-bottom:33%;position:relative;}
  .increaseBtn .btn{position:absolute;top:5px;left:5px;bottom:5px;right:5px;font-size:16px;padding: 1px;
    padding-top: 10px;white-space: normal;}
  .increaseBtn .totalCount{font-size:18px;}
  .floatbTN{position:fixed;bottom:0;left:0;width:100%;font-size:25px;}
 </style>
 <input type="hidden" name="link_table" value="parties">
<input type="hidden" name="kalfy" value="{{Session::get('memberMobile')->kalfy}}">
<?php
  $parties=DB::table('parties')->select('*')->get();
  ?>
  <div class="row mrg-tp-15">
@foreach($parties as $row)

  <div class="col-xs-4 increaseBtn parties-{{$row->id}}">
  <div class="btn  btn-primary increaseUp">
  {{$row->name}}
  <br>
  <input type="hidden" class="totalCountInput" name="{{$row->id}}">
  <span class="totalCount">0</span>
  </div>
  
  </div>

  

@endforeach
</div>

       <button type="submit" class="btn btn-success ajaxSubmit mrg-tp-15 floatbTN" style="width:100%;">שליחה</button>
      
      </form>

         </div>

  <div role="tabpanel" class="tab-pane" id="mayors">
 
 <form class="form-horizontal"  action="./save-votes">
 <div class="form-group">
<label for="inputEmail3" class="col-sm-3 control-label">שם ראש רשות</label>
<input type="hidden" name="link_table" value="mayors">
<input type="hidden" name="kalfy" value="{{Session::get('memberMobile')->kalfy}}">

</div>
<?php
$parties=DB::table('mayors')->select('*')->get();
?>
@foreach($parties as $row)

<div class="col-xs-4 increaseBtn mayors-{{$row->id}}">
<div class="btn  btn-primary increaseUp">
{{$row->full_name}}
<br>
<input type="hidden" class="totalCountInput" name="{{$row->id}}">
<span class="totalCount">0</span>
</div>

</div>



@endforeach

 <button type="submit" class="btn btn-success ajaxSubmit mrg-tp-15 floatbTN" style="width:100%;">שליחה</button>

</form>

 </div>


</div>
   </div>
</div>
@push('scripts')
<script>
$(document).ready(function(){
  $('body').on('click','.increaseUp',function(){
    var span = $(this).closest('.increaseBtn').find('.totalCount');

    var count = $(span).text();
    count=parseFloat(count);
    count++;
    $(span).html(count);
    var span = $(this).closest('.increaseBtn').find('.totalCountInput').val(count);



  });
Loading(1);
PostData('./get-votes','',function(data){
        Loading(0);
        data.forEach(function(row){
          $('.'+row.link_table+'-'+row.linkId).find('.totalCountInput').val(row.votes);
          $('.'+row.link_table+'-'+row.linkId).find('.totalCount').html(row.votes);
          
        });
        
      
      });
});
</script>  
@endpush