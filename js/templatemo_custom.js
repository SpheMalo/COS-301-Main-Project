"use strict";
var menuDisabled = false;
jQuery(document).ready(function($){

	/************** Menu Content Opening *********************/
	$(".main_menu a").click(function(){
		var id =  $(this).attr('class');
		id = id.split('-');
		//$("#menu-container .content").hide();
		//$("#menu-container #menu-"+id[1]).show();
		//$("#menu-container .homepage").hide();
		return false;
	});
	
	
	$(".main_menu a.templatemo_homeservice").click(function(){
		$("#menu-container .portfolio").hide();
		$('#menu-container .services').fadeOut(1000, function(){
        $('#menu-container .homepage').fadeIn(1000);
	    });
		return false;
	});
	
	$(".main_menu a.templatemo_page2").click(function( ){
    $('#menu-container .homepage').fadeOut(1000, function(){
	window.location.href="content.html";
        //$('#menu-container .services').fadeIn(1000);
	    });
	return false;
	});
	
	$(".main_menu a.templatemo_homeportfolio").click(function(){
		$('#menu-container .portfolio').fadeOut(1000, function(){
        $('#menu-container .homepage').fadeIn(1000);
	    });
		return false;
	});

	$(".main_menu a.templatemo_page3").click(function(){    
    $('#menu-container .homepage').fadeOut(1000, function(){
        $('#menu-container .portfolio').fadeIn(1000);
	    
	    });
		return false;
	});
	
	$(".main_menu a.templatemo_hometestimonial").click(function(){
		$('#menu-container .testimonial').fadeOut(1000, function(){
        $('#menu-container .homepage').fadeIn(1000);
			
	    });
		return false;
	});
	
	$(".main_menu a.templatemo_page4").click(function(){    
    $('#menu-container .homepage').fadeOut(1000, function(){
        $('#profileContainer').fadeIn(1000);
        $('.templatemo_frame').fadeIn(1000);
			$('#cmt').fadeIn(1000);	    
	    });
		return false
	});
	$(".main_menu button.templatemo_homeabout").click(function(){
		$('#menu-container .about').fadeOut(1000, function(){
			
			$('#profileContainer').fadeOut(1000,function(){
				$('#menu-6').fadeOut(1000,function(){
					$('#menu-container .homepage').fadeIn(1000);
				});
			});
        
	    });
		return false;
	});	

	
	$(".main_menu a.templatemo_page5").click(function(){    
    $('#menu-container .homepage').fadeOut(1000, function(){
        $('#menu-container .about').fadeIn(1000);
	    });
		return false;
	});
	
	$(".main_menu a.templatemo_homecontact").click(function(){
		$('#menu-container .contact').fadeOut(1000, function(){
        $('#menu-container .homepage').fadeIn(1000);
	    });
		return false;
	});
	
	$(".main_menu a.templatemo_page6").click(function(){    
    $('#menu-container .homepage').fadeOut(1000, function(){
        $('#menu-container .contact').fadeIn(1000);
		loadScript();		
	    });
	});
	
	
	/************** Gallery Hover Effect *********************/
	$(".overlay").hide();

	$('.gallery-item').hover(
	  function() {
	    $(this).find('.overlay').addClass('animated fadeIn').show();
	  },
	  function() {
	    $(this).find('.overlay').removeClass('animated fadeIn').hide();
	  }
	);


	/************** LightBox *********************/
	$(function(){
		$('[data-rel="lightbox"]').lightbox();
	});


	$("a.menu-toggle-btn").click(function() {
	  $(".responsive_menu").stop(true,true).slideToggle();
	  return false;
	});
 
    $(".responsive_menu a").click(function(){
		$('.responsive_menu').hide();
	});

});

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
      'callback=initialize';
  document.body.appendChild(script);
}

function initialize() {
    var mapOptions = {
      zoom: 18,
      center: new google.maps.LatLng(-26.120681,28.053737)
    };
    var map = new google.maps.Map(document.getElementById('templatemo_map'),  mapOptions);
}