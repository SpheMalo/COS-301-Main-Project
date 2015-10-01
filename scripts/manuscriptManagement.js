$(document).ready(function()
{
	
	$('#bookDiv').css('display','none');
	$('#serviceImg').css('display','none');
	$('#sidePicDiv').css('display','none');
	$('#inputs2').css('display','none');
	$('#pageView').css('display','none');
	$('#editSection').css('display','none');
	
	
	
	$("#goBackService").click(function(){
		window.location.href = "insideContent.php";	
	});
	
	$('.service').click(function()
	{
		//Make the comment area dissapear
		$("#commentSide").css('display','none');
		$("#commentHide").css('display','none');
		
		//hides the options menu
		$('.optionsSlide').removeClass('pullDown');
		$('.optionsSlide').css('visibility','hidden');
		//hides the options menu
		
		
		$('#sidePicDiv').fadeOut( "slow", function() {
    		// Animation complete.
 		 });
		$('#serviceBackground').fadeOut( "slow", function() {});
		$('#pageList').fadeOut('slow',function(){});
		
		$('#bookDiv').fadeOut( "slow", function() {});	
		
			$('#manuscriptArea').fadeOut("fast",function(){});
			$('#goBackService').fadeOut( "slow", function() {
				$('#serviceContainer').append($('#bookDiv'));	
				
				$('#goBackService').fadeIn( "slow", function() {});
				$('#bookDiv').fadeIn( "slow", function() {});
			});
			
			
		//$('html').css('overflow-y','auto');
		
		
	});
	
	$("#commentHide").click(function(){
			
                    if(!$('#commentSide').is(':hidden')){
						$(this).css('background-image','url("images/arrow-right.png")');
                        $(this).animate({
                    
                            left: '0px'
                    
                        },500)
						$('#commentSide').animate({
                    
                            left: '-320px'
                    
                        },500)
						$('#commentSide').slideToggle(500)
                    }else{
						$(this).css('background-image','url("images/arrow-left.png")');
						$('#commentSide').slideToggle(0)
                        $(this).animate({
                    
                            left: '320px'
							
                        },500)
						$('#commentSide').animate({
							
                            left: '0px'
                    
							},500)
						 
                    }
                    
                   
	});
	$("#messageHide").click(function(){
			 if(!$('#messageArea').is(':hidden')){						
							$(this).html("Messages");
							
							$('#messageContainer').animate({
	                    
	                            bottom: '-300px'
	                    
	                        },500)
							$('#messageArea').slideToggle(500)
							
	                    }else{
							$(this).html("Hide Messages");
							$('#messageArea').slideToggle(500)
	                        
							$('#messageContainer').animate({							
	                            bottom: '0px'                    
								},500)
							
	                    }
		});
	$("#letterHide").click(function(){
			
                    if(!$('#editorialLetter').is(':hidden')){
						$(this).css('background-image','url("images/arrow-left.png")');
                        $(this).animate({
                    
                            right: '0px'
                    
                        },500)
						$('#editorialLetter').animate({
                    
                            right: '-620px'
                    
                        },500)
						$('#editorialLetter').slideToggle(500)
						$("#serviceBackground").css('margin-left','auto');
                    }else{
						$(this).css('background-image','url("images/arrow-right.png")');
						$('#editorialLetter').slideToggle(0)
                        $(this).animate({
                    
                            right: '620px'
							
                        },500)
						$('#editorialLetter').animate({
							
                            right: '0px'
                    
							},500)
						 $("#serviceBackground").animate({
							
							marginLeft: '20px'
							
						 },500)
                    }
                    
                   
	});	
	
	$('#options').click(function(){
		if ($('.optionsSlide').css('visibility') == "hidden")
		{
			$('.optionsSlide').css('visibility','visible');
			$('.optionsSlide').addClass('pullDown');
		}
		else
		{
			$('.optionsSlide').removeClass('pullDown');
			$('.optionsSlide').css('visibility','hidden');			
		}
	});
	
	$('#addChapter').click(function(){
		$('#addChapterArea').css('display','block');
		addLightbox($('#addChapterArea'));	
	});
	$('#invitation').click(function(){
		$('#sendManuscriptContainer').css('display','block');
		addLightbox($('#sendManuscriptContainer'));	
	});
	
	
	//$('#serviceBackground').append($('#goBackService'));
});

function addLightbox(insertContent) {
	// add lightbox/shadow <div/>'s if not previously added
		if($('#lightbox').size() == 0){
			var theLightbox = $('<div id="lightbox"/>');
			var theShadow = $('<div id="lightbox-shadow"/>');
			$(theShadow).click(function(e){
				closeLightbox();
			});
			$('body').append(theShadow);
			$('body').append(theLightbox);
		}
		
		// remove any previously added content
		//$('#lightbox').empty();
		
		//center the lightbox
		//alert(window.innerWidth+" "+$('#lightbox').width());
		var val = (window.innerWidth-$('#lightbox').width())/2;
		$('#lightbox').css("left",val);
		
		// insert HTML content
		if(insertContent != null){
			$('#lightbox').append(insertContent);
		}
		
		$('#lightbox').css('top', $(window).scrollTop() + 100 + 'px');
		
		// display the lightbox
		$('#lightbox').show();
		$('#lightbox-shadow').show();
		
	}	

	// close the lightbox
	function closeLightbox(){
		
		// jQuery wrapper (optional, for compatibility only)
		(function($) {
			
			// hide lightbox/shadow <div/>'s
			$("#addChapterArea").fadeOut("slow",function(){});
			$("#sendManuscriptContainer").fadeOut("slow",function(){});
			$('#lightbox').hide();
			$('#lightbox-shadow').hide();
			
			// remove contents of lightbox in case a video or other content is actively playing
			//$('#lightbox').empty();
		
		})(jQuery); // end jQuery wrapper
		
	}
