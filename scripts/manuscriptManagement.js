$(document).ready(function()
{
	//$('#bookDiv').fadeOut( "fast", function() {});
	$('#serviceImg').fadeOut( "fast", function() {});
	$('#sidePicDiv').fadeOut( "fast", function() {});
	
	$('.service:nth-child(1)').click(function()
	{
		$('#sidePicDiv').fadeOut( "slow", function() {
    		// Animation complete.
 		 });
		$('#serviceBackground').fadeOut( "slow", function() {});
		
		$('#bookDiv').fadeOut( "slow", function() {});	
		
			
			$('#goBackService').fadeOut( "slow", function() {
				$('#leftCol').append($('#serviceBackground')).append($('#goBackService').css('width','240px'));	
				$('#serviceBackground').fadeIn( "slow", function() {});
				$('#goBackService').fadeIn( "slow", function() {});
				$('#bookDiv').css('float','left').fadeIn( "slow", function() {});
				});
			
			
		//$('html').css('overflow-y','auto');
		
		
	});
	
	
	//$('#serviceBackground').append($('#goBackService'));
});