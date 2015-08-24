$(document).ready(function()
{
	
	$('#bookDiv').fadeOut( "fast", function() {});
	$('#serviceImg').fadeOut( "fast", function() {});
	$('#sidePicDiv').fadeOut( "fast", function() {});
	$('#inputs2').fadeOut("fast",function(){});
	$('#pageView').fadeOut("fast",function(){});
	$('#editSection').fadeOut("fast",function(){});
	
	$('.service:nth-child(1)').click(function()
	{
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
	
	
	//$('#serviceBackground').append($('#goBackService'));
});
