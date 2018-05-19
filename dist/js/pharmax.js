$(function() {
    $('#side-menu').metisMenu();
	theme = Cookies.get('theme');
	$("#appTheme").attr("href",theme);
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

	// ADD ACTIVE CLASS TO OPEN TAB (LI)
    var url = window.location;
    url = String(url).split('#')[0];
    
    var element = $('ul.nav a').filter(function() {
        return this.href == url && $(this).attr('id') != "profile-li";
    }).addClass('active').parent();
	
	if (element.is('li')){
		if(element.parent().parent().is("li")){
			element.parent().parent().addClass("active");
		}
	}
    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
	// HIDE 0 NOTIFICATION
	var notif_list = $(".notification-val");
	var count_notif = notif_list.length;
	notif_list.each(function(idx){
		if($(this).text()==0){
			$(this).closest("li").css({"display":"none"});
			$(this).closest("li").prev("li").css({"display":"none"});
			count_notif--;
		}
	});
	if(count_notif == 0){
		$(".dropdown-alerts").html(
			'<li style="text-align: center;"> No notifications. </li> 	\
			<li class="divider"></li>									\
			<li>														\
				<a class="text-center" href="notifications">			\
					<strong>See All Alerts</strong>						\
					<i class="fa fa-angle-right"></i>					\
				</a>													\
			</li>														\
			'
		);
	}
	else{
		$("#notif-count").css({"display":"inline"});
		$("#notif-count").html(count_notif);
	}
});

function Send(url, method, data, post = null) {
	$.ajax({
		url: url,
		
		type: method,
		data: post,
		cache: false,
		contentType: false,
        processData: false,
		datatype:'json',
		success: function (result) {
			data(result);
		},
		error: function (e) {
			console.log(e);
		}
	});
}

$( "#login" ).on( "submit", function( event ) {
  event.preventDefault();
  Send("./php/Login.php?action=login","POST",function(data){
	  logindiv=$(".login-div");
	  logindiv.removeClass("alert-success");
	  logindiv.removeClass("alert-danger");
	  logindiv.css({"display":"none"});
	  logindiv.html(data.msg);
	  logindiv.addClass(data.type);
	  if(data.type=="alert-success"){
		$(".login-header").hide();
		$(".login-panel").hide();
		logindiv.css({"margin-top":"50px"});
		setTimeout(function(){ window.location = "./home"; }, 2000);

	  }
	  
	logindiv.css({"display":"block"});
  },$( this ).serialize());
});

function formAddBox(page,type,value="",id="phoneBoxList",name="addPhone"){
	if(page=="pharmacy" && type=="phone"){
		$("#"+id).append('<span><input class="form-control phoneBox" value="'+value+'" name="'+name+'[]" placeholder="Ex: 1003004000, 555-111-999"><i class="fa fa-remove" onclick="$(this).closest(\'span\').remove()"></i></span>');
		
	}
}

function changeTheme(newTheme){
	
	theme = "dist/css/"+newTheme;
	$("#appTheme").attr("href",theme);
	Cookies.set('theme',theme);
}

function popUp(F,msg="",type=""){
	if(F){
		if(msg=="") msg="SUCCESSFUL OPERATION!";
		if(type=="") type="ALERT";
		$("body").append('<div class="popUp success"><i class="fa fa-check-circle" style="font-size: 58px; margin-bottom: 4px;"></i><br><strong>'+type+' : </strong>'+msg+'<br><span class="btn btn-success btn-md popUpButton" style="margin-top:4px;" onclick="closePopUp();">CLOSE</span></div><div class="disable"></div>');
	}
	else{
		if(msg=="") msg="OPERATION UNSUCCESSFUL!";
		if(type=="") type="ERROR";
		$("body").append('<div class="popUp error"><i class="fa fa-exclamation-triangle" style="font-size: 58px; margin-bottom: 4px;"></i><br><strong>'+type+' : </strong>'+msg+'<br><span class="btn btn-danger btn-md popUpButton" style="margin-top:4px;" onclick="closePopUp();">CLOSE</span></div><div class="disable"></div>');
	}
}
	
function closePopUp(){
	$(".popUp").remove();
	$(".disable").remove();
}

