var xhr=null;
function Loading(type){
if(type==1){
$('.Loading').fadeIn(0);
}else{
$('.Loading').fadeOut(0);
}
}


$.urlParam = function(name){
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
  if(!results) return false;
	return results[1] || 0;
}


function LoadPage(url,script,page){
	Loading(1);
	clearInterval(window.widgetsInterval)
	$('.popover').popover('destroy');
$('#MainContent').fadeIn();
     if(xhr!=null){
     	xhr.abort();
     	xhr=null;
     }

					xhr=$.ajax({
                    type: "GET",
                    url: url,
                    success: function (result) {
                       $("html, body").animate({ scrollTop: 0 }, "slow");
                    	$('#MainContent').fadeOut('fast',function(){
                    	     $('#MainContent').html(result).fadeIn('fast');
                   if(script){
                   	$.getScript(script);
                   }

                   Loading(0);
                          //  initPage();
                    	});

                    }
                });

}

$.routes.add('/{module}', function() {

var page=$.urlParam('page');

if(page){
  LoadPage(this.module+'?page='+page);
}else{
	LoadPage(this.module);
}
//	$.getScript('/js/station.js');
	//alert('df');
});

$.routes.add('/{module}/{action}', function() {

var page=$.urlParam('page');

if(page){
  LoadPage(this.module+'/'+this.action+'?page='+page);
}else{
	LoadPage(this.module+'/'+this.action);
}
//	$.getScript('/js/station.js');
	//alert('df');
});

$.routes.add('/{module}/{action}/{id}', function() {
  var page=$.urlParam('page');


if (this.id.indexOf('?') !== -1) this.id="";
  if(page){
LoadPage(this.module+'/'+this.action+'/'+this.id+'?page='+page);

  }else{
    LoadPage(this.module+'/'+this.action+'/'+this.id);
  }

//	$.getScript('/js/station.js');
	//alert('df');
});




$.routes.add('/{module}/{action}/{filter}/{id}', function() {
  var page=$.urlParam('page');


if (this.id.indexOf('?') !== -1) this.id="";
  if(page){
		LoadPage(this.module+'/'+this.action+'/'+this.filter+'/'+this.id+'?page='+page);

  }else{
		LoadPage(this.module+'/'+this.action+'/'+this.filter+'/'+this.id);
  }

//	$.getScript('/js/station.js');
	//alert('df');
});
