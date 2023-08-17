var postDataXHR=null;


function PostData(url, alldata, callback,callback2,method,headers) {
    if(!method) method="POST";

   postDataXHR=$.ajax({
        type: method,
        async: true,
        url: url.replace('http://','https://'),
        data: alldata,
        beforeSend: function(xhr){
          if(headers){
            for (var key in headers) {

                xhr.setRequestHeader(key, headers[key]);
}

          }


        },

        success: function (html) {
            if (callback != undefined) {
                callback(html);
            }
        },
       error: function (xhr, status) {

           if (callback2 != undefined) {
               callback2(xhr.status);
           }else{
               $('#CenterContent').append('<script>' + xhr.responseJSON.callback + '</script>');
           }

       }
    });
    return postDataXHR;
}



function CreateModal(options){


  var id=options.id;
  var type=options.size;
  var title=options.title;
  var container=options.container;
  var close=options.close;
  var modalClass=options.modalClass;
  if(!modalClass) modalClass="";


    var css="modal-sm";
    if(type=='lg'){
        css="modal-lg";
    }else if(type=='big'){

        css="modal-big";

    }else if(type=='mid'){
        css='modal-mid';

    }else if(type=="xlg"){
        css="modal-xlg"
    }else{

        css="modal-sm";
    }

    var strVar="";
    strVar += "<div class=\"modal ModAl fade is_loading "+modalClass+"\" id=\"POPWindow"+id+"\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">";
    strVar += "  <div class=\"modal-dialog "+css+"\">";
    strVar += "    <div class=\"modal-content\">";
    strVar += "      <div class=\"modal-header\">";
    if(close){
   strVar += " <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>";
 }
    strVar += "<div class=\"modal-title\">";
if(title){
  strVar +="<i class=\"icon-Artboard27\"></i>&nbsp;"+title+"";
}


  strVar +="<i class=\"icon-Artboard42 modalClose\" data-dismiss='modal'></i>";
    strVar +="</div>";

    strVar += "      <\/div>";
    strVar += "      <div class=\"modal-body "+container+"\">";
    strVar += "      ";
    strVar += "      <\/div>";
    strVar += "     ";
    strVar += "    <\/div>";
    strVar += "  <\/div>";
    strVar += "<\/div>";
    $('#dModals').append(strVar);

}




function openModal(url,size,title,modalClass){
    window.CurrModal=window.CurrModal+1;
  var options={
    'id':window.CurrModal,
    'size':size,
    'title':title,
    'modalClass':modalClass,

  };
  CreateModal(options);
    //var loader=getLoadMore('ModalLoading');
//  $('#POPWindow'+window.CurrModal+' .modal-body').html(loader);
//  $('#POPWindow'+window.CurrModal).modal({
//      backdrop: true,
//        show: true
//    });

$('body').addClass('modal-loading');

$.ajax({
       url: url,
       type: "GET",
       async: true,
       beforeSend: function(xhr){xhr.setRequestHeader('X-Request-Type', 'PopWindow');},
       success: function(data) {





  try {
      data = JSON.parse(data);
  } catch (e) {

  }
  if(data['callback']) {
      //$('#POPWindow'+window.CurrModal).modal('hide');
      $('#CenterContent').append('<script>' + data['callback'] + '</script>');
      return(false);
  }

$('#POPWindow'+window.CurrModal).removeClass('is_loading');



     // LoadModal(1);





      $('#POPWindow'+window.CurrModal+' .modal-body').html(data).delay(500).slideDown('fast',function(){
          //initLazyLoad();
          var height=($(window).height()*50)/100;
          $('#POPWindow'+window.CurrModal).find('aside').css('height',height);
fireEvent('modal:end',{id:'#POPWindow'+window.CurrModal});

$('body').removeClass('modal-loading');


          //$('.slimScrollDiv').remove();

          $('#POPWindow'+window.CurrModal).modal({
              backdrop: true,
              show: true
          });



      });







} });

}






$('html').on('click','a',function(a){
    if($(this).attr('data-toggle')=="modal") return(true);
    if($(this).attr('role')=="tab") return(true);
    if($(this).attr('data-type')=="direct"){
    return(true);
    }
    var url=$(this).attr('href');
    var aa=$(this);


    if(!url){
        var url2=$(this).attr('data-href');
        if(url2!=undefined) url=url2;
    }
    if(url==undefined) return(true);
    var action=$(this).attr('data-type');
    var title=$(this).attr('data-title');
    var size=$(this).attr('data-size');
    var static=$(this).attr('data-static');
    var container=$(this).attr('data-container');
    var modalClass=$(this).attr('data-modal');


    if(container==undefined) container=$(this).attr('modal-container');
    var disabled=$(this).attr('data-disabled');
    if(disabled=='true') return(false);


     if((action!="POP" && ($(aa).closest('.modal').length>0) || url!="javascript:void(0);" )){

$(aa).closest('.modal').modal('hide');
     }



    if(action=='POP'){
      var close=$(this).data('close');
     if(!close) close=false;
        window.CurrModal=window.CurrModal+1;
        var options={
          'id':window.CurrModal,
          'size':size,
          'title':title,
          'container':container,
          'close':close,
          'hideHeader':false,
          'modalClass':modalClass,


        };
        CreateModal(options);



        var href=$(this).attr('href');
        if(!href){
            var href2=$(this).attr('data-href');
            if(href2!=undefined) href=href2;
        }
        a.stopImmediatePropagation();
        a.preventDefault();
        var url=href;
        $('body').addClass('modal-loading');


        $.ajax({
                 url: url,
                 type: "GET",
                 async: true,
                 beforeSend: function(xhr){xhr.setRequestHeader('X-Request-Type', 'PopWindow');xhr.setRequestHeader('X-Request-POP-ID', '#POPWindow'+window.CurrModal);},
                 error:function(){
                   $('#POPWindow'+window.CurrModal).remove();
                    window.CurrModal=window.CurrModal-1;
                   $('body').removeClass('modal-loading');
                   ShowAlert('Error!');
                 },
                 success: function(data) {

            try {
                data = JSON.parse(data);
            } catch (e) {

            }
            if(data['callback']) {
                $('#CenterContent').append('<script>' + data['callback'] + '</script>');
                return(false);
            }

$('#POPWindow'+window.CurrModal).removeClass('is_loading');


                $('#POPWindow'+window.CurrModal+' .modal-body').html(data).delay(500).slideDown('fast',function(){
                    //initLazyLoad();
                    var height=($(window).height()*50)/100;
                    $('#POPWindow'+window.CurrModal).find('aside').css('height',height);
fireEvent('modal:end',{id:'#POPWindow'+window.CurrModal});
$('body').removeClass('modal-loading');

                    $('#POPWindow'+window.CurrModal).modal({
                        backdrop: true,
                        show: true
                    });



                });







        } });


return(false);



    }

});



function fireEvent(type, props) {
    if (!props) props = {}

  $( document ).trigger( type, props );
  }

function ShowConfirm(message,callback){
  $('#ConfirmModalOk').unbind();
  var header="modal-header";
  var title="Alert";
    $('#confirm-modal').find('.modal-header').attr('class',header);
    $('#confirm-modal').find('.modal-title').html(title);
    $('#confirm-modal').find('.content').html(message);
    $('#confirm-modal').modal('show');
    $('#ConfirmModalOk').on('click',function(){
      callback();
    });
}
  function ShowAlert(message,type){

    var header="modal-header";
    var title="Alert";
    if(type=="success"){
      header="modal-header modal-header-success";
      title="<span class='icon icon-Artboard49copy3'></span> Success";
    }


    if(type=="info"){
      title="Info";
    }
      $('#message-modal').find('.modal-header').attr('class',header);
      $('#message-modal').find('.modal-title').html(title);
      $('#message-modal').find('.content').html(message);
      $('#message-modal').modal('show');
  }



  $("form").on("submit", function (event) {
      event.preventDefault();
     return false;
  });

  var WINDOW_IS_SAVING=false;
  $('body').on('click','.ajaxSubmit',function(e) {
   e.preventDefault();
     if($(this).hasClass('disabled')) return(false);
      var btn=$(this);
      $(btn).button('loading');
      var form = $(this).closest('form').serialize();
      var ff=$(this).closest('form');
      $(ff).find('input[type!="password"],textarea,select').attr('disabled','disabled');
      var url = $(this).closest('form').attr('action');

      var method = $(this).closest('form').attr('method');
      if(method) method=method.toUpperCase();
      else method="POST";
      var good = validateForm($(this).closest('form'));
      var beforeSubmit=$(this).attr('before-submit');
      var headers=false;
      if(beforeSubmit){
          var funcCall = beforeSubmit + "();";
          good3=eval(funcCall);
      }

      var clback=$(this).attr('data-callback');

      if ($(btn).parents('.ModAl').length) {
        var d=$(btn).parents('.ModAl').attr('id');
  var headers=[];
    headers['X-Request-Type']="PopWindow";
    headers['X-Request-POP-ID']=d;
  }

      if(good) {


          PostData(url, form, function (data) {
              clearTimeout(WINDOW_IS_SAVING);
              WINDOW_IS_SAVING=false;
              notSavedForm=false;
              $(btn).button('reset');
              $(ff).find('input[type!="password"],textarea,select').removeAttr('disabled');

              $('#MainContent').append('<script>' + data['callback'] + '</script>');
              if(clback){
                  $('#MainContent').append('<script>' + clback + '</script>');
              }

          },false,method,headers);
      }else{
          $(ff).find('input[type!="password"],textarea,select').removeAttr('disabled');
        $(btn).button('reset');
      }
  });


  function validateForm(form){
    var good=true;
  //  alert(good);
    $(form).find('.req').each(function(){

        var content=$(this).val();

        $(this).val(content.trim());
        if($(this).hasClass('bootstrap-select')){

        }else{
        if(content.length<1 || content.trim()=="" || content==0){
            good=false;
            $(this).addClass('missing');
            $(this).closest('.bootstrap-select').addClass('missing');
            console.log(this);
            var message=$(this).attr('data-message');
            if(message){

               $(this).next('.help-block').remove();
               $('<div class="help-block with-errors"><ul class="list-unstyled"><li>'+message+'</li></ul></div>').insertAfter(this);
            }
        }else{

            $(this).removeClass('missing');
            $(this).closest('.bootstrap-select').removeClass('missing');
            $(this).next('.help-block').remove();
        }
      }


    });
    console.log(good);
    return(good);
}
