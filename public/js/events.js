
$(document).on('update:success', function(e,options) {

ShowAlert('הרשומה עודכנה בהצלחה','success');
});



$(document).on('create:success', function(e,options) {

ShowAlert('הרשומה נשמרה בהצלחה','success');
});


$(document).on('max:worker', function(e,options) {
ShowAlert('ניתן להוסיף עד שני עובדים למשמרת אחת!','danger');
});



$(document).on('create:worker', function(e,options) {
$('#workerForm')[0].reset();
$("select option").prop("selected", false);
$('select').selectpicker('render').selectpicker('refresh');

$('.table-ballot-'+options.kalfy).find('.shift'+options.shift).append(options.html);
updateWorkerList();

});





$(document).on('delete:success', function(e,options) {

$('.deleteModal').modal('hide');
$('.Row-'+options.id).fadeOut('normal',function(){
  $(this).remove();
});
ShowAlert('הרשומה נמחקה בהצלחה','success');
});
