<?php
	if(!isset($_COOKIE['username']))
	{
		header('location: index.php');
	}
?>


 <!DOCTYPE html>
<html>
	<head>
    <title>Figbook</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<!--stylesheets linked here-->
    <!--<link href="css/bootstrap.min.css" rel="stylesheet"/>-->
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/templatemo_misc.css"/>
   	<link type="text/css" rel="stylesheet" href="css/easy-responsive-tabs.css" />
    <link href="css/templatemo_style.css" rel="stylesheet"/> 
    <link rel="stylesheet" href="css/background.css"/>
	
	<!--Scripts linked here-->
	<!--<script language="Javascript" src="scripts/textarea/jquery-1.3.2.min.js" type="text/javascript"></script>-->
    <script src="js/jquery-1.10.2.min.js"></script> 
    <script src="js/jquery.lightbox.js"></script>
	<script src="js/templatemo_custom.js"></script>
    <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
    
	<script src="scripts/authentication.js" type="text/javascript"></script>
	<script src="scripts/profile.js"></script>
   
	
    
     <script>
     
    function showhide()
    {
        var div = document.getElementById("newpost");
		if (div.style.display !== "none") 
		{
			div.style.display = "none";
		}
		else 
		{
			div.style.display = "block";
		}
    }
	
	///$('.show7').click(function(){ alert("Clicking div"); wiki_logout(); });
	//this function will log the user out using the api.php and sending through the logout action.
		function wiki_logout() {
			$.post('scripts/mediawiki/api.php?action=logout'+'&format=json', function(data) {
						//alert(JSON.stringify(data));
						//alert(localStorage.lgusername);
						localStorage.removeItem("lgusername");
						//alert(document.cookie.valueOf("username"));
						delete_cookie('username');
						//document.cookie = "sessionLives" + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
						//alert(document.cookie.valueOf("username"));
						window.location.href="index.php"
					  });		
				   
		}
		var delete_cookie = function(name) {
		document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	};
	
  </script>

  </head>
  <body>
  	

	
	<!--This is the header bar START-->
	<header id="header">
		<img id="figbookLogo" src="images/figbooklogo.png" alt="Figbook"/>
		<h1 id="figbookHeading">FIGBOOK</h1>
		 <div id="menu">
			<div id="logoutDiv" class=" templatemo_logout ">
				<!-- <img src="images/templatemo_home4.jpg" alt="home img 04"> -->
				<a id="logoutText" href="#" onclick="wiki_logout()">Logout</a>
			</div>
		 </div>		 
	 </header>
	<!--This is the header bar END-->
   
   <div id="menu-container" class="main_menu"><!--All menus are inside this container-->
   <!-- homepage start -->
    <div class="content homepage " id="menu-1"> <!--contains the main menu tabs-->
          	
            	<div class="menuBox templatemo_mainservice ">					
                	<div class="templatemo_link"><a class="show-2 templatemo_page2 menuItem" href="#">Catalogue</a></div>
                    <p class="menuInfo">Start writing a manuscript.<br>
					Add collaborators to your manuscript.<br>
					Write editorial letters.<br>
					Create and view comments.<br>
					And more...
					</p>
                </div>
                
            	<div class="menuBox templatemo_maintesti ">
                	<div class="templatemo_link"><a class="show-4 templatemo_page4 menuItem" id="profileLink" href="#">Profile</a></div>
					<p class="menuInfo">
					Write a small biography.<br>
					Add/Edit contact details.<br>
					Edit personal details.<br>
					See a list of books you are linked to.					
					</p>
                </div>
                
                <div class="menuBox templatemo_mainabout">
                	<div class="templatemo_link"><a class="show-5 templatemo_page5 menuItem" href="#">About Us</a></div>
					<p class="menuInfo">Read More about:<br>
					Our Team.<br>
					Our History.<br>
					Our Vision.
					</p>
                </div>
                
                <div class="menuBox templatemo_maincontact">
                	<div class="templatemo_link"><a class="show-6 templatemo_page6 menuItem" href="#">Contact Us</a></div>
                    <p class="menuInfo">Write a small message to an admin.	<br>
					See our location on google maps.<br>
					Get our address.					
					</p>
                </div>
                
                
    	  
    
   </div> <!--contains the main menu tabs END-->
    <!-- homepage end -->
    
			<!-- this is the back button: <div class="templatemo_link"><a class="show-1 templatemo_hometestimonial" href="#">Go Back</a></div>-->
			<!-- profileContainer START -->
			<div id="profileContainer">
				
				<div id="topProfileBar">
					<button class="show-1 templatemo_homeabout">Go Back</button>
					<div style="width:370px;float:right;">								
						<button id="delete-button">Delete Account</button>
						<button id="suspend-button">Suspend Account</button>
						<button id="activate-button">Activate Account</button>
					</div>
				</div>
				<div id="portfolioContainer"><!--PortfolioContainer START-->
					<div id="portImageBack">
						<img id="editImage" src="images/edit.png" width='25px' height="25px">
						<img alt="testimonial image" id="portImage" >
						
					</div>
						<button type="button" id="profileEditButton"></button>
						<div id="uploadPictureDiv"><!--Upload for profile picture-->
							<form id="uploadForm" action="scripts/upload.php" method="post" enctype="multipart/form-data">
    						Select image to upload:
    						<input type="file" name="fileToUpload" id="fileToUpload">
    						<input id="submitFile" type="submit" value="Upload Image" name="submit">
							</form>
						</div>
						
						<div id="frame1"><!--Frame1 START-->
						
							<p>Username:</p>
							<input class="profileInfo" type="text" />
							<p>Firstname:</p>
							<input class="profileInfo" type="text" />
							<p>Surname:</p>
							<input class="profileInfo" type="text" />
								
						</div><!--Frame1 END-->
						
						
									
				</div><!--PortfolioContainer END-->
				
				
				<div id="aboutMeContainer">
					<!-- This is the Who are you image <img id="aboutImage" src="images/whoAreYou.png" alt="testimonial image">-->
					<div class="details">
						<h2>About me:</h2>
						<textarea class="aboutMeInfo" id="aboutme" rows="5" cols="33"></textarea>						
						
					</div>
										
					
				</div>
				
				<div id="frame2"><!--Frame2 START-->
							<h2>Genres of Interest:</h2>
							<textarea class="profileInfo" rows="5" cols="22"></textarea>							
				</div><!--Frame2 END-->
				<div id="authorOfList">				
						<h2>Author of:</h2>
						<ul id="booklist">
							<p style="font-size:8pt;">..This will be a dynamically loaded list..</p>
						</ul>
				</div>
				<div id="contactInfoContainer"><!--contactInfoContainer START-->
					
					<div id="contactInfoDiv">
						<h2>Contact Info:</h2>
						<p style="margin-top:2px;">Cellphone</p><input class="contactInfo" type="text" />
						<p style="margin-top:4px;">Home</p><input class="contactInfo" type="text" />
						<p style="margin-top:4px;">Work</p><input class="contactInfo" type="text" />
						<p style="margin-top:4px;">Email</p><input class="contactInfo" type="text" /><br>
											
						
					</div>
				</div><!--contactInfoContainer END-->
			</div><!--profileContainer END-->
		
		
	   <!-- About Us START -->
	   <div class="content about" id="menu-5">			
				<div class="topAboutBar">
						 <button class="show-1 templatemo_homeabout" href="#">Go Back</button>
				</div>

				<div class="aboutFrame">
					<h2>Our Team</h2>
					<p>Our team is made out of 5 members:<br><br>
					Armand : Project manager and frontend developer.<br>
					Sphe : Business analyst and backend developer.<br>
					Sito : Frontend and backend developer.<br>
					Jimmy : Unit testing and backend developer.<br>
					Ndivhuwo : Backend developer.<br>
					</p>						 
				</div>
				<div class="aboutFrame">
					<h2>Our History</h2>
					<p>
					We started working together in our final year of study.<br>
					Our main focus being Figbook for the year.<br><br>
					
					Area of study:<br>
					Armand : BSc IT software development.<br>
					Sito : BSc IT software development.<br>
					Sphe : BSc IT & Enterprise.<br>					
					Jimmy : BSc Computer science.<br>
					Ndivhuwo : BSc Computer science.<br>
					</p>					
				</div>
				<div class="aboutFrame">		
					<h2>Our Vision</h2>
					<p>
					Is to work towards a better future.<br>
					Providing companies and individuals with software<br> that doesn't just work, but looks and feels great to use.
					While using it should be seamlesly smooth, without the need of exstensive training.<br><br>
					Thus we aim to keep usibility as our key priority when designing and developing any software.
					</p>						
				</div>			
	   </div>
	   <!-- About Us END-->
	   
		<!-- Contact Us START -->
		<div class="content contact" id="menu-6">
					<div class="topContactBar">						
						<button class="show-1 templatemo_homeabout" href="#">Go Back</button>	
					</div>
					
					<div class="contactForm">
						
							<form id="contactUsForm">
								<h2>Contact Us</h2>
								<input name="fullname" type="text" class="form-control" id="fullname" placeholder="Your Name" maxlength="40"><br><br>
							 	<input name="email" type="text" class="form-control" id="email" placeholder="Your Email" maxlength="40"><br><br>
								<input name="subject" type="text" class="form-control" id="subject" placeholder="Subject" maxlength="60"><br><br>
								<textarea name="message" class="form-control" id="message" placeholder="Your Message..."></textarea> <br><br>
							    <button type="button" id="contactUsSend">Send</button>
							</form>
							<img id="contactBack" src="images/templatemo_contact1.jpg" alt="contact image">
					</div>
				  
					<div class="locationBack">
						
						<h2>Our Location</h2>
						<div class="clear"></div>
						<div class="templatemo_contactmap">
								<div id="templatemo_map"></div>                        
						</div>
						<div class="templatemo_address">
							4 Chaplin Road, <br>
							Illovo Boulevard ,<br> Johannesburg,<br> 
							2196, <br>
							South Africa <br> 
							Tel: +27 11 042 6509  Email: info@figtory.com 
						</div>
						
					</div>
		</div>



        <!-- Contact Us START -->
    
    </div> <!--Menu container END-->
	
	<!--Footer START-->

	<footer id="footer">
		 <div id="footList">
		  <span>Figtory Animation</span><br>
		  <span>Figbook on Facebook</span><br>
		  <span>Figbook Examples</span><br>
		  <span>Figbook Tutorial</span><br>
		  <span>More on us</span><br>
		 </div>
		 <div id="footDiv">
		  <h2 class="text-shadow" id="powered" style="float:left;">Powered By</h2><img id="footLogo" src="images/logo.png"  width="200px" height="70px"/>
		 </div>
	</footer>

	<!--Footer END-->
	
    <!-- logo end -->  
   <script type="text/javascript">


    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);

                $name.text($tab.text());

                $info.show();
				
            }
        });

        $('#ab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true,
        });
		

		$('#cmt').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true,
        });
    });
</script>
<!-- templatemo 405 matrix -->

  </body>
</html>