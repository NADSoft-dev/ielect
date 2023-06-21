<style>
.jumbotron{margin-bottom:0;}
</style>
<div class="card">
  <div class="card-header">
      <h4 class="card-title">סימון הצבעה</h4>
  </div>
  <div class="card-body">



    <form ajax-form action="./save-vote">
      <div class="form-group">
        <label for="exampleInputEmail1">מס' סידורי</label>
        <input required type="number" class="SerialinPUT form-control" name="serial"  placeholder="סידורי">

      </div>

<br />
      <button type="submit" class="btn btn-success ajaxSubmit">שליחה</button>
    </form>


  </div>
</div>
