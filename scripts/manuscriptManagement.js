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
	
	$('.service:nth-child(1)').click(function()
	{
		//Make the comment area dissapear
		$("#commentSide").css('display','none');
		$("#commentHide").css('display','none');
		
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
                    }else{
							$(this).css('background-image','url("images/arrow-right.png")');
							$('#editorialLetter').slideToggle(0)
                        $(this).animate({
                    
                            right: '620px'
							
                        },500)
						$('#editorialLetter').animate({
							
                            right: '0px'
                    
							},500)
						 
                    }
                    
                   
	});	
	
	//$('#serviceBackground').append($('#goBackService'));
});
