var lstSelected=null;
var selectedIds=[];
var familyMerge=[];
var widgetsInterval=null;
var has_focus=true;
var arrarIDNumber=[];

function cancelVoters(){
  
  if(window.selectedIds.length){
  var ids=window.selectedIds.join();
  PostData('/electors/unvote','ids='+ids,function(){},function(){});
  }
  
  }
  
window.onblur = function(){  
  has_focus=false;  
}  
window.onfocus = function(){  
  has_focus=true;  
}
function updateWorkerList(){
  console.log('sdfsdfsdf');
$('.theBallot').each(function(){
  var len=$(this).find('tr').length;

  if(len<=1) $(this).fadeOut(0);
  else $(this).fadeIn('fast');
});
}


function runWidgets(){
  window.widgetsInterval=setInterval(function(){
   if(has_focus) updateWidgets();
 }, 60000);
}


function updateWidgets(){
  //var len=$('.widget').length;
  //if(len==0) clearInterval(window.widgetsInterval);
  $('.widget').each(function(){
    var url=$(this).attr('data-url');
    var div=$(this);
    if(url){
      PostData(url,'',function(data){
        $(div).html(data);
      },function(){},'GET')
    }
  });
}

$(document).ready(function(){




$('body').on('change','.changePagesCount',function(){
  var val=$(this).val();
  val=parseFloat(val);
  if(val>1){
  PostData('/electors/page-count','count='+val,function(data){
  $('.filterElectors').click();
  });
}

});
$('body').on('keyup','.msgText',function(){
  var text=$(this).val();
  var len=text.length;
  var smsCount=0;
  var charsCount=len;
  smsCount=charsCount/70;
  smsCount=Math.ceil(smsCount);
  $('.smsCount').html(smsCount);
  $('.charsCount').html(charsCount);
});
$('body').on('change','.run-rselect',function(){
  var val=$(this).val();
  if(val){
    var id=$(this).attr('data-rselectid');
    var url=$(this).attr('data-rselect');
    var name=$(this).attr('name');
    PostData(url,'field='+name+'&val='+val,function(data){
      $('#'+id).empty();
      $('#'+id).append(data);
      $('#'+id).removeAttr('disabled').selectpicker('render').selectpicker('refresh');



    });
  }
});

$('body').on('keyup','#filterForm input',function(e){
  var code = e.which; 
  if(code==13){
    e.preventDefault();
    $('.filterElectors').click();

  }
});
$('body').on('click','.gofullscreen',function(){
  var element=$(this).closest('.divContainer');
  element = $(element).get(0);
    if (element.requestFullscreen) {
      element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
      element.mozRequestFullScreen();
    } else if (element.webkitRequestFullscreen) {
      element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    } else if (element.msRequestFullscreen) {
      element.msRequestFullscreen();
    }

});
$('body').on('click','.prepareSms',function(){
  var text=$('.msgText').val();
  var len=text.length;
  if(len<1){
    ShowAlert(' יש להקליד תוכן הודעה!');
    return false;
  }

  var len=$('.activeSwitch.active').length;
  if(len<1){
    ShowAlert('יש לבחור יעד !');
    return false;
  }
  var groups=[];
  var lists=[];
  var delegates=[];

  $('.activeSwitch.active.groups').each(function(){
    var id=$(this).attr('data-id');
    groups.push(id);
  });


  $('.activeSwitch.active.lists').each(function(){
    var id=$(this).attr('data-id');
    lists.push(id);
  });

  $('.activeSwitch.active.delegates').each(function(){
    var id=$(this).attr('data-id');
    delegates.push(id);
  });

  var allFilters={
    'groups':groups,
    'lists':lists,
    'delegates':delegates,

  };
Loading(1);

  allFilters=JSON.stringify(allFilters);
  var msg=$('.msgText').val();
  PostData('/sms/prepare','filter='+allFilters+'&msg='+msg,function(data){
  Loading(0);
  window.location.href="/#/sms/prepared/";
},function(){},'POST');





});



$('body').on('click','.prepareModuleSms',function(){
  var text=$('.msgText').val();
  var len=text.length;
  if(len<1){
    ShowAlert(' יש להקליד תוכן הודעה!');
    return false;
  }


Loading(1);
  var msg=$('.msgText').val();
  PostData('/sms/prepare-module/2','msg='+msg,function(data){
  Loading(0);
  window.location.href="/#/sms/prepared-module/";
},function(){},'POST');





});

$('body').on('click','.sendSms',function(){
  Loading(1);
  PostData('/sms/send','',function(){
    Loading(0);
    ShowAlert('ההודעה נשלחה בהצלחה');
    window.location.href="/#/page/send-sms/";
  });
});



$('body').on('click','.sendPreparedModuleSms',function(){
  Loading(1);
  PostData('/sms/send-module','',function(){
    Loading(0);
    ShowAlert('ההודעה נשלחה בהצלחה');
    window.location.href="/#/main/";
  });
});
$('body').on('click','.fieldUpdate',function(){
  $(this).select();
});
$('body').on('keyup','.fieldUpdate',function(e){
var code = e.which;
if(code==13){
  e.preventDefault();
  var id=$(this).attr('data-id');
  var val=$(this).val();
  var field=$(this).attr('data-field');
  Loading(1);
  var url=$(this).attr('data-url');
  if(!url) url='/electors/update-field/'+id;
  PostData(url,'val='+val+'&field='+field,function(data){
Loading(0);
  });
}
});
  $(document).on('click', '.panel-heading span.clickable', function(e){
    $(this).closest('.panel').toggleClass('panel-collapsed');
  })
$('body').on('click','.activeSwitch',function(){
  $(this).toggleClass('active');
});


$('body').on('click','.activeRadio',function(){
  $(this).closest('.fields_select').find('.activeRadio').removeClass('active');
  $(this).addClass('active');
});


$('body').on('click','.selectAllFields',function(){
  $('.fields_select .label').addClass('active');
});




$('body').on('click','.deleteRow',function(){

  var controller=$(this).attr('data-controller');
  var id=$(this).attr('data-id');
  openModal('/delete/'+controller+'/'+id,'mid','מחיקת רשומה','deleteModal');
});



$('body').on('click','.resetPassword',function(){

  var controller=$(this).attr('data-controller');
  var id=$(this).attr('data-id');
  var url='/page/reset-password/'+controller+'/'+id;
  ShowConfirm('האם אתה מאשר איפוס סיסמה ?',function(){
    Loading(1);
    PostData(url,'',function(data){
      Loading(0);
      $.routes.reload();
    })
  }); 
});

$('body').on('click','.resetFields',function(){
  $('.fields_select .label[data-default=false]').removeClass('active');
});

$('body').on('click','.disableList',function(){
  // alert(arrarIDNumber.length);
  // $('.selectedIDS').val(arrarIDNumber);
  // alert($('.selectedIds').length);
  var type=$(this).attr('data-type');

  if(window.selectedIds.length){
    // if($('.selectedIDS').length){
    // alert(arrarIDNumber);
    // console.log(arrarIDNumber);
    ShowConfirm('האם אתה מאשר ביטול שיוכים לרשימת הבוחרים ?',function(){
    var join=window.selectedIds.join();
    PostData('/'+type+'/cancel','ids='+join,function(){
      if(type=='list'){
      $('.selected').removeClass('selected hasList');
      $('.filterElectors').click();
      }else{
        $('.selected').removeClass('selected');
      $('.filterElectors').click();
      }
    },function(){},'POST')
  });
  }
  else if((arrarIDNumber.length)!=0){
 // console.log(arrarIDNumber);
 ShowConfirm('האם אתה מאשר ביטול שיוכים לרשימת הבוחרים ?',function(){
  var join=window.selectedIds.join();
  PostData('/'+type+'/cancel','ids='+join,function(){
    if(type=='list'){
    $('.selected').removeClass('selected hasList');
    $('.filterElectors').click();
    }else{
      $('.selected').removeClass('selected');
    $('.filterElectors').click();
    }
  },function(){},'POST')
});

  }
  else{
      ShowAlert('עליך לבחור מרשימת הבוחרים');
  }
  
 
});

$(document).ajaxComplete(function(response,options) {
  var callback=options.getResponseHeader('x-callback');
   if(callback) eval(callback);
  setTimeout(function(){

    $('.selectpicker').selectpicker({
      dropupAuto: false,
      liveSearch: true
    });


  },500);



});
$('body').on('click','.ajaxPOP',function(){
getSelectedIds();
    var pop=$(this);
    var hasPop=$(this).attr('aria-describedby');
  if (hasPop){
$(pop).popover('destroy');
}else{

  var title=$(this).attr('data-title');
    var content_id = "content-id-" + $.now();

  $(pop).popover({
      html: true,
      trigger: 'manual',
      title:title,
      placement:'bottom',
       container: "body",
      content:  '<div style="width:300px;" id="' + content_id + '">נא המתן</div>'



  });
$(pop).popover('show');

  setTimeout(function(){
    $.ajax({
        type: 'GET',
        url: $(pop).attr('data-href'),
        cache: false,
    }).done(function(d){

        $('#' + content_id).html(d);

          //  $(pop).popover('show');
    });
  },1000);



}
});




$(window).scroll(function(e) {
    // Get the position of the location where the scroller starts.
    if(!$(".stickTopContainer").length) return false;
    var scroller_anchor = $(".stickTopContainer").offset().top;

    // Check if the user has scrolled and the current position is after the scroller start location and if its not already fixed at the top
    if ($(this).scrollTop() >= scroller_anchor && $('.stickTop').css('position') != 'fixed')
    {    // Change the CSS of the scroller to hilight it and fix it at the top of the screen.
        $('.stickTop').css({
            'position': 'fixed',
            'top': '0px',
            'z-index':100,
        });
        // Changing the height of the scroller anchor to that of scroller so that there is no change in the overall height of the page.

    }
    else if ($(this).scrollTop() < scroller_anchor && $('.scroller').css('position') != 'relative')
    {    // If the user has scrolled back to the location above the scroller anchor place it back into the content.

        // Change the height of the scroller anchor to 0 and now we will be adding the scroller back to the content.


        // Change the CSS and put it back to its original position.
        $('.stickTop').css({
            'position': 'relative'
        });
    }
});




function getSelectedIds(){
  selectedIds=[];
  $('tr.selected').each(function(){
    var id=$(this).attr('data-id');
    selectedIds.push(id);
  });
}


$('body').on('click','.resetFamilyJoin',function(){
  var oldf=$(this).attr('data-original');
  var newf=$(this).attr('data-new');

ShowConfirm("האם ברוצנך לבצע פעולת איפוס למשפחת "+oldf+' ?',function(){
  PostData('/page/family-join-reset','old='+oldf,function(data){
   $.routes.reload();
  },function(){})
});

});
$('body').on('click','.rowSelect',function(evt){

  var start=0;
  var end=0;
  var toCheck=$(lstSelected).hasClass('selected');
  var childrens=$(this).closest('table').find('.rowSelect');
  var container=$(this).closest('table');

  if(evt.shiftKey){
  if($(childrens).index(this)>=$(childrens).index(lstSelected)){
     start=$(childrens).index(lstSelected);
     end=$(childrens).index(this);
  }else{
     start=$(childrens).index(this);
     end=$(childrens).index(lstSelected);
   }
   for(i=start; i<=end; i++){
      if(toCheck) $(container).find('.rowSelect').eq(i).addClass('selected');
      else $(container).find('.rowSelect').eq(i).removeClass('selected');
   }
  }else{
    $(this).toggleClass('selected');
  }
  lstSelected=$(this);
  getSelectedIds();
  
  $('.printSelected').each(function(){
    var href=$(this).attr('data-url');
      if(window.selectedIds.length){
        $(this).attr('href',href+'?ids='+window.selectedIds.join());
      }else{
        $(this).attr('href',href);
      }
  });
  //$(this).toggleClass('selected');
});



$('body').on('click','.TabLoad',function(){
var href=$(this).attr('href');
Loading(1);
PostData(href,'',function(data){
$('.load-in-tab').html(data);
Loading(0);
},function(){},'GET');
return(false);
});


$('body').on('change','.uploadImage',function(){
  var input=$(this);
  var imageType = /image.*/;
  if (!$(this).get(0).files[0].type.match(imageType)) {
         ShowAlert(' ניתן לבחור תמונה בלבד מסוג JPG , PNG');
         return(false);

     }

      var reader = new FileReader();

      reader.onload = function (e) {
          $(input).closest('.uploadContainer').find('.prevImage').attr('src', e.target.result);
          var fd = new FormData();
          $(input).get(0).files[0].name;
          fd.append("image", $(input).get(0).files[0]);
          //fd.append('photo',e.target.result,$(input).get(0).files[0].name);
          var request = new XMLHttpRequest();
          request.open("POST", '/page/upload',true);
          request.onreadystatechange = function(e) {

                if(request.readyState == 4 && request.status == 200) {
                  var res=JSON.parse(request.response);
                  $(input).closest('.uploadContainer').find('.imageFile').val(res.image);
                }
            }
            request.send(fd);


      };

      reader.readAsDataURL($(this).get(0).files[0]);


});

$('body').on('dblclick','.elector',function(){
  var id=$(this).attr('data-id');
  $('.electorCard').modal('hide');
  setTimeout(function(){
    $(this).removeClass('selected');
    getSelectedIds();
  },1000);
 openModal('/electors/view/'+id,'lg','כרטסת בוחר','electorCard');
});

$('body').on('click','.checkboxSelect ',function(){
  var id=$(this).attr('data-id');
  // $('.table').css('color', 'red');
  // document.getElementById('tableHidden').style.visibility = 'hidden';
  // $("#tableHidden").css("display","none");
  // alert(document.getElementById("inputTest").val());
  $('.electorCard').modal('hide');
  setTimeout(function(){
    $(this).removeClass('selected');
    getSelectedIds();
  },1000);
 openModal('/electors/view2/'+id,'lg','כרטסת בוחר','electorCard');
});
$('body').on('click','.filterElectors',function(){
   lstSelected=null;
   selectedIds=[];
var filter=$('#filterForm').serializeArray();
var allFilters=[];
$.each(filter, function( index, value ) {

  var val=value['value'];
  if(val&&val!=0&&val!='0'){

    allFilters.push(value);
  }


});



allFilters=JSON.stringify(allFilters);
var listFields=[];
$('.fields_select .label.active').each(function(){
listFields.push($(this).attr('data-name'));
});
listFields=JSON.stringify(listFields);
Loading(1);
PostData('/electors/list','filter='+allFilters+'&listFields='+listFields,function(data){
$('.electorsTable').html(data);
Loading(0);
},function(){},'GET');

});







$('body').on('click','.statsElectors',function(){
   lstSelected=null;
   selectedIds=[];
   var type=$(this).attr('data-type');
var filter=$('#filterForm').serializeArray();
var allFilters=[];
$.each(filter, function( index, value ) {

  var val=value['value'];
  if(val&&val!=0&&val!='0'){

    allFilters.push(value);
  }


});
var url="";
if(type=="graph"){
  url='/stats/graph';
}else{
 url='/stats/all';
}

allFilters=JSON.stringify(allFilters);
var listFields=$('.fields_select .label.active').attr('data-name');
Loading(1);
PostData(url,'filter='+allFilters+'&statsBy='+listFields+'&type='+type,function(data){
$('.electorsTable').html(data);
Loading(0);
},function(){},'GET');

});


$('body').click(function(evt){

       if($(evt.target).closest('.searchResults').length)
          return;
$('.searchResults').empty();
});

$('body').on('click','.goFamily2',function(){
$(this).blur()
var val=$(this).attr('data-step');
 val=parseFloat(val);
if(val==3){
  var newFamily=$('.newFamily').text();
  var oldFamily=$('.oldFamily').text();
  newFamily=encodeURIComponent(newFamily);
  oldFamily=encodeURIComponent(oldFamily);
  Loading(1);
  PostData('/page/family-join','old='+oldFamily+'&new='+newFamily,function(data){
  Loading(0);
  LoadPage('/page/family-join');
  ShowAlert('פעולת האיחוד בוצעה בהצלחה !');
},function(){},'POST');

}else{

  $('.familyStep'+val+' .familyTable tbody tr').each(function(){
    var text=$(this).find('td:first').text();
    familyMerge.push(text);
  });
  $('.familyStep'+val).fadeOut('normal',function(){
    val++;
    $('.familyStep'+val).fadeIn();

    if(val==3){
      $('.goFamily2').attr('data-step',val).removeClass('btn-primary').addClass('btn-success').html('איחוד');
      var newFamily=familyMerge[familyMerge.length-1];
      familyMerge.splice(-1,1);
      var oldFamily=familyMerge;
      oldFamily=oldFamily.join(',');
      $('.oldFamily').html(oldFamily);
      $('.newFamily').html(newFamily);

    }else{
      $('.goFamily2').attr('data-step',val).attr('disabled','disabled');
    }
  });

}

});

$('body').on('click','.addFamily',function(){
  var empty=$(this).attr('data-empty');
  if(empty=='true') empty=true;
  else empty=false;
  var input=$(this).closest('.familyStep').find('input:first');
  var container=$(this).closest('.familyStep');
  var val=$(input).val();
  if(val.length>2){
  var html='<tr><td>'+val+'</td><td><button class="btn btn-sm btn-danger removeFamily"><i class="glyphicon glyphicon-remove"></i></button></td></tr>';
  if(empty){
    $(container).find('.familyTable').find('tbody').empty().append(html);
  }else{
  $(container).find('.familyTable').find('tbody').append(html);
}
  $(input).val('');
  checkFamilyTable(container);
}
});
function checkFamilyTable(container){
  var len=$(container).find('.familyTable').find('tbody').find('tr').length;

  if(len){
     $(container).find('.familyTable').fadeIn();
     $('.familyNext').removeAttr('disabled');
   }
  else{
     $(container).find('.familyTable').fadeOut();
     $('.familyNext').attr('disabled','disabled');
   }
}

$('body').on('click','.supportMayor',function(){
  var val=$(this).val();
Loading(1);
PostData('/mayor/support/'+val,'',function(data){
Loading(0);

},function(){});
});
$('body').on('click','.sendSmsAjax',function(){
var type=$(this).attr('data-type');
var id=$(this).attr('data-id');
Loading(1);
PostData('/sms/prepare-module/1','type='+type+'&id='+id,function(data){
Loading(0);
window.location.href="/#/sms/by-module/";
},function(){});
});



$('body').on('click','.sendSmsAjaxEelectors',function(){
var type=$(this).attr('data-type');
getSelectedIds();
// alert(arrarIDNumber);
var id=selectedIds;

if(window.selectedIds.length){


}
else{
  ShowAlert('עליך לבחור מרשימת הבוחרים');
  return false;
}

Loading(1);

PostData('/sms/prepare-module/1','type='+type+'&id='+id,function(data){
Loading(0);
var url="/#/sms/by-module/";
if(type=="ballot-location") url="/#/sms/prepared-module/";
window.location.href=url;
},function(){});
});


$('body').on('click','.removeFamily',function(){
  $(this).closest('tr').remove();
  var container=$(this).closest('.familyStep');

  checkFamilyTable(container);
});

$('body').on('click','.searchResults li',function(){
  var val=$(this).text();
  $(this).closest('.inputContainer').find('input').val(val);
  $('.searchResults').empty();
});
$('body').on('keyup','.autocomplete',function(){
var val=$(this).val();
var element=$(this);
console.log(val.length);
if(val.length>1){
var url=$(this).attr('data-complete');
PostData(url,'q='+val,function(data){
var arr=data.data;
var html="";
$.each(arr, function(i, item) {
   html+="<li>"+item+"</li>";
});
html="<ul class='completeUl'>"+html+"</ul>";
$(element).closest('.inputContainer').find('.searchResults').html(html);
},function(){},'POST');
}else{
$(element).closest('.inputContainer').find('.searchResults').empty();
}
});




});
