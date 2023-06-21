<div class="row">
  <div class="col-xs-12">
      <h5>האם ברצונך למחוק רשומה</h5>
  </div>

<div class="col-xs-12 mrg-tp-15">

<form method="delete" action="{{Request::path()}}">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<button type="button" class="btn btn-sm btn-danger ajaxSubmit">מחיקה</button>

<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">ביטול</button>
</form>

</div>
</div>
