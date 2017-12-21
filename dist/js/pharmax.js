$(function() {
    $('#side-menu').metisMenu();
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

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
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
});



function delRow(row,id){
	a=confirm("Do you want to delete this row?");
	if(a){
		$(row).closest('tr').remove();
		Send("./php/Delete_Product.php","POST",function(data){
			
		},"id="+id+"");
	}
	
}



function Send(url, method, data, post = null) {
	$.ajax({
		url: url,
		
		type: method,
		data: post,
		cache: false,
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
  Send("./php/login.php","POST",function(data){
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
