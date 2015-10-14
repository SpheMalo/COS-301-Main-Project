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
		//hides the options menu
		$('.optionsSlide').removeClass('pullDown');
		$('.optionsSlide').css('visibility','hidden');
		//hides the options menu
		$('#bookDiv').css('display','block');
		addLightbox($("#bookDiv"));	
		
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
	
	$('.options').click(function(){
		    $('.optionsSlide').removeClass('pullDown');
			$('.optionsSlide').css('visibility','hidden');	
	});
	
	$('#options').click(function(){
            console.log(localStorage.bookTitle);
                if(localStorage.bookTitle !==""){
                    $('#loadbook').css('display','block');
                    $('#invitation').css('display','block');
                    $('#writeEditorial').css('display','block');
                    $('#addChapter').css('display','block');
                }
                else{
                    $('#loadbook').css('display','none');
                     $('#invitation').css('display','none');
                     $('#writeEditorial').css('display','none');
                     $('#addChapter').css('display','none');
                }
		if ($('.optionsSlide').css('visibility') == "hidden")
		{
			$('.optionsSlide').css('visibility','visible');
			$('.options').addClass('pullDown');
			
		}
		else
		{	
			$('.options').removeClass('pullDown');
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
        $('#delManuscript').click(function(){
		$('#DelBookDiv').css('display','block');
                if(localStorage.bookTitle !== ""){
                    $("#delete_book_title").val(localStorage.bookTitle);
                    $("#fuzzyText_deleteTitle" ).val(localStorage.bookTitle);
                }
		addLightbox($('#DelBookDiv'));	
	});
	
	
	//$('#serviceBackground').append($('#goBackService'));
});

function addLightbox(insertContent) {
	$('.options').removeClass('pullDown');
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
		
		$(insertContent).css('display','block');
		// remove any previously added content
		var copy = document.getElementById("lightbox").childNodes;
		if (copy.length >= 1) {
			for (var i = 1;i<=copy.length; i++) {
				$(copy[i]).css('display','none');
				$('body').append(copy[i]);
			}
			
		}
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
		//alert($('#lightbox-shadow').css('background-color'));
		
		
		
		$('#lightbox-shadow').show();
		$('#lightbox').show();
	}	

	// close the lightbox
	function closeLightbox(){
		
		// jQuery wrapper (optional, for compatibility only)
		(function($) {
			
			// hide lightbox/shadow <div/>'s
			$("#addChapterArea").fadeOut("slow",function(){});
			$("#sendManuscriptContainer").fadeOut("slow",function(){});
			$("#DelBookDiv").fadeOut("slow",function(){});
			$("#bookDiv").fadeOut("slow",function(){});
			$('#lightbox').hide();
			$('#lightbox-shadow').hide();
			
			// remove contents of lightbox in case a video or other content is actively playing
			//$('#lightbox').empty();
		
		})(jQuery); // end jQuery wrapper
		
	}
