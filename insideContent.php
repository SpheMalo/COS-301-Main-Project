<?php
	if(!isset($_COOKIE['username']))
	{
		header('location: index.php');
	}
?>


 <!DOCTYPE html> 
  <head>
    <title>Figbook</title>
    <meta name="description" content="" />
    <meta name="author" content="templatemo">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 
    Matrix Template
    http://www.templatemo.com/preview/templatemo_405_matrix
    -->
	
	<!--stylesheets linked here-->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/templatemo_misc.css"/>
   	<link type="text/css" rel="stylesheet" href="css/easy-responsive-tabs.css" />
    <link href="css/templatemo_style.css" rel="stylesheet"/> 
    <link rel="stylesheet" href="css/background.css"/>
	
	<!--Scripts linked here-->
    <script src="js/jquery-1.10.2.min.js"></script> 
	<script src="scripts/authentication.js" type="text/javascript"></script>
	<script src="scripts/profile.js"></script>
     <script src="scripts/createPage.js" type="text/javascript"></script>
	<script src="scripts/saveTextToDB.js"></script>
    
	
	<script src="js/jquery.lightbox.js"></script>
	<script src="js/templatemo_custom.js"></script>
    <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
	<script src="scripts/services.js"></script>
    <script src="scripts/manuscriptManagement.js"></script>
   
    
	
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
  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	
	<div class="wrapper1">
	  <!--this div provides the floating blocks, using background.css-->
		<ul class="bgf-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
		
	
    	<!-- logo start -->
    <div class="logocontainer">
    	<div class="row">
        	<h1><a href="#"></a></h1>
            <div class="clear"></div>
            <div class="templatemo_smalltitle"></div>
       </div>
    </div>
    <!-- logo end -->    
   <div id="menu-container" class="main_menu">
   <!-- homepage start -->
    <div class="content homepage col-md-1" id="menu-1">
  	<div class="container">
    		
          	<div class="col-md-3 col-sm-6 templatemo_leftgap">
            	<div class="templatemo_mainservice templatemo_botgap">
                	<div class="templatemo_link"><a class="show-2 templatemo_page2 menuItem" href="#">Catalogue</a></div>
                	
			<script src="scripts/authentication.js" type="text/javascript"></script>
			<!--<button id="delete-button">Delete Account</button>  this is the delete account button for testing purposes-->
                </div>
                <div class="templatemo_mainimg"><img src="images/templatemo_home1.jpg" height="316px" alt="home img 01"></div>
            </div>
            <div class="col-md-3 col-sm-6 templatemo_leftgap">
            	<div class="templatemo_mainimg templatemo_botgap templatemo_portfotopgap"><img height="316px" src="images/templatemo_home2.jpg" alt="home img 02"></div>
                <div class="templatemo_mainportfolio">
                      <div class="templatemo_link"><a id="comLink" class="show-3 templatemo_page3 menuItem" href="#">Communication</a></div>
                	                   
                </div>
            </div>
            <div class="col-md-3 col-sm-6 templatemo_leftgap">
            	<div class="templatemo_maintesti templatemo_botgap templatemo_topgap">
                	<div class="templatemo_link"><a class="show-4 templatemo_page4 menuItem" id="profileLink" href="#">Profile</a></div>
                </div>
                <div class="templatemo_mainimg"><img src="images/templatemo_home3.jpg" height="316px" alt="home img 03"></div>
            </div>
            <div class="col-md-3 col-sm-6 templatemo_leftgap">
            	<div id="logoutDiv" class="templatemo_logout templatemo_botgap templatemo_topgap">
             	  <!-- <img src="images/templatemo_home4.jpg" alt="home img 04"> -->
				 <div class="templatemo_link"><a class="show-7 templatemo_page7 menuItem" href="#" onclick="wiki_logout()">Logout</a></div>
                </div>
                <div class="templatemo_mainabout templatemo_botgap">
                	<div class="templatemo_link"><a class="show-5 templatemo_page5 menuItem" href="#">About Us</a></div>
                </div>
                <div class="templatemo_maincontact">
                	<div class="templatemo_link"><a class="show-6 templatemo_page6 menuItem" href="#">Contact Us</a></div>
                </div>
				
            </div>
    </div>
    
   </div>
    <!-- homepage end -->
    <!--services start -->
   <div class="content services" id="menu-2">
		<div id="serviceContainer" >
          <div id="serviceBackground">
                       
                        	<div id="topService">
                                 <div id="services">
                                    <div id="viewBooks">List Books</div>
                                 </div>
                                 <div class="templatemo_mainservice templatemo_botgap" id="goBackService">
                                    <a id="serviceGoBack" class="show-1 templatemo_homeservice" href="#">Go Back</a>
                                 </div>
                        	</div>
                            <div id="scrollDiv">
                                <div id="bookList">
                                        
                                </div>
                                <div id="pageView">
            						<button id="refreshBook" style="visibility:hidden;" onclick="refreshBook()">Refresh</button>
            					</div>
                                 <div id="editSection">
                                      <div id="inputHeading"><input type="text" id="pageEditTitle"/></div><!--<hr/>-->
                                          <textarea id="editor" cols="93" rows="10">
                                          </textarea>
                                          <button id="saveBtn" onclick="saveText()" >Save</button>
                                  </div>
                            </div>
                            	
                        
            </div>
            
            
        	<div class="row templatemo_bordergapborder">
            	
            	<div class="col-md-3 col-sm-12 templatemo_leftgap" id="leftCol">
                	
                  
                </div>
                
                <div class="templatemo_col37 col-sm-12 templatemo_leftgap">
                	
                  <div id="bookDiv">
            			<div id="scriptMenuBar">Please fill in author details.</div>                  	
                        <div id="pageList"></div>
                        
                        <div id="contentDiv">
                        	<div id="infoBox">
                                 <div id="labels">	
                                     <label>Book Title:</label><br/>
                                     <label>Author's</label><br/>
                                     <label>Firstname:</label><br/>
                                     <label>Surname:</label>
                                 </div>
                                 <div id="inputs">
                                     <input id="title" type="text"/><br/><br/>
                                     <input id="firstname" type="text"/><br/>
                                     <input id="surname" type="text"/>
                                 </div>
                             </div>                             
                             <div id="inputs2">
                                 <textarea id="preface" cols="50" rows="14" ></textarea>
                             </div>
                            <textarea id="manuscriptArea" cols="96" rows="14" ></textarea>
                            
                            
                            <form class="form" id="saveBookForm">
                            	<button type="submit" id="back-button">Back</button>
                            	<button type="submit" id="next-button">Next</button>
                            </form>
                        </div>
                        <div id="Page">
                        	
                        </div>     
		</div>
                  	
                  
              </div>
                <div id="sidePicDiv" class="templatemo_col37 col-sm-12 templatemo_leftgap templatemo_topgap">
                	<div class="templatemo_mainimg templatemo_botgap"><img src="images/templatemo_service2.jpg" alt="service image"></div>
                </div>
                
            </div>
            
            
            
        </div>
     </div>
	    
    <!-- services end -->	

	<!-- portfilio start -->
    <div class="portfolio" id="menu-3" style="display: none;" >
    	<div class="container">
          	<div class="col-md-3 col-sm-6 templatemo_leftgap">
       	      <div class="templatemo_insideportfolio templatemo_botgap">
               	  <div class="templatemo_portfoliotext">
				<h2>Communication</h2>
			    <div class="clear"></div>
                    </div>
              </div>
            	<div class="templatemo_portfolioback">
                	<div class="templatemo_link"><a class="show-1 templatemo_homeportfolio" href="#">Go Back</a></div>
                </div>
                
            </div>
            <div class="col-md-3 col-sm-6 templatemo_leftgap">
                        <div class="templatemo_botgap templatemo_portfotopgap gallery-item">
							<img src="images/portfolio/templatemo_portfolio01.jpg" alt="gallery 1">
							<div class="overlay">
								<a href="images/portfolio/templatemo_portfolio01.jpg" data-rel="lightbox" class="fa fa-arrows-alt"></a>
							</div>
						</div>				
                <div class="templatemo_botgap templatemo_topgap gallery-item">
             	   <img src="images/portfolio/templatemo_portfolio02.jpg" alt="gallery 2">
                   <div class="overlay">
								<a href="images/portfolio/templatemo_portfolio02.jpg" data-rel="lightbox" class="fa fa-arrows-alt"></a>
							</div>
                </div>
                <div class="templatemo_botgap templatemo_topgap gallery-item">
             	   <img src="images/portfolio/templatemo_portfolio03.jpg" alt="gallery 3">
                   <div class="overlay">
								<a href="images/portfolio/templatemo_portfolio03.jpg" data-rel="lightbox" class="fa fa-arrows-alt"></a>
							</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 templatemo_leftgap">
				<div class="templatemo_botgap templatemo_topgap gallery-item">
             	  	 <img src="images/portfolio/templatemo_portfolio04.jpg" alt="gallery 4">
                     <div class="overlay">
								<a href="images/portfolio/templatemo_portfolio04.jpg" data-rel="lightbox" class="fa fa-arrows-alt"></a>
							</div>
                </div>
                <div class="templatemo_botgap templatemo_topgap gallery-item">
             	   <img src="images/portfolio/templatemo_portfolio05.jpg" alt="gallery 5">
                   <div class="overlay">
								<a href="images/portfolio/templatemo_portfolio05.jpg" data-rel="lightbox" class="fa fa-arrows-alt"></a>
							</div>
                </div>
                <div class="templatemo_botgap templatemo_topgap gallery-item">
             	   <img src="images/portfolio/templatemo_portfolio06.jpg" alt="gallery 6">
                   <div class="overlay">
								<a href="images/portfolio/templatemo_portfolio06.jpg" data-rel="lightbox" class="fa fa-arrows-alt"></a>
							</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 templatemo_leftgap">
				<div class="templatemo_botgap templatemo_topgap gallery-item">
             	  	 <img src="images/portfolio/templatemo_portfolio07.jpg" alt="gallery 7">
                     <div class="overlay">
								<a href="images/portfolio/templatemo_portfolio07.jpg" data-rel="lightbox" class="fa fa-arrows-alt"></a>
							</div>
                </div>
                <div class="templatemo_botgap templatemo_topgap gallery-item">
             	   <img src="images/portfolio/templatemo_portfolio08.jpg" alt="gallery 8">
                   <div class="overlay">
								<a href="images/portfolio/templatemo_portfolio08.jpg" data-rel="lightbox" class="fa fa-arrows-alt"></a>
							</div>
                </div>
                <div class="templatemo_botgap templatemo_topgap gallery-item">
             	   <img src="images/portfolio/templatemo_portfolio09.jpg" alt="gallery 9">
                   <div class="overlay">
								<a href="images/portfolio/templatemo_portfolio09.jpg" data-rel="lightbox" class="fa fa-arrows-alt"></a>
							</div>
                </div>
            </div>
    </div>
    </div>
	 <!-- portfolio end -->
	<!-- testimonial start -->
    <div class="content testimonial" id="menu-4">
    		    	<div class="container">
        	<div class="row templatemo_bordergapborder">
            <!--vertical Tabs-->
      		<div id="cmt" >
            <div class="col-md-3 col-sm-12 templatemo_leftgap_about">
            <ul class="resp-tabs-list templatemo_testitab">
                <li>About Me</li>
                <li>Portfolio</li>
                <li>Contact</li>
            </ul>
            <div class="templatemo_aboutlinkwrapper">
     		<div class="templatemo_link"><a class="show-1 templatemo_hometestimonial" href="index.html">Go Back</a></div>
            </div>
            </div>
            <div class="resp-tabs-container templatemo_testicontainer" >
                <div>
                	<div id="aboutLeftBack" class=" templatemo_rightgap_about">
                    	<div class="templatemo_graybg templatemo_botgap" id="aboutGrey">
                         <div id="profileFrame" class="templatemo_frame">
                           
						  <h2>About Me</h2>
						  <textarea readonly class="aboutMeInfo" id="aboutme" rows="5" cols="33"></textarea>
                          <h2 style="margin-top:12px;">Additional information</h2>
						  <textArea readonly class="aboutMeInfo" id="additional" rows="5" cols="33" ></textarea>
						  
                        </div>
                        <button id="editAboutMe">Edit Details</button>
					</div>
                    </div>
                    <div id="aboutMeImage" class=" templatemo_botgap"><img src="images/templatemo_testimonial1.jpg" alt="testimonial image"></div>
                </div>
                <div class="col-lg-7">
                	<div class="templatemo_col50 templatemo_rightgap_about">                    	
                        <div id="portfolioGray" class="templatemo_graybg templatemo_botgap">
                        <div class="templatemo_frame">
                    		<h2>Portfolio</h2>
                    		<p style="margin-top:2px;">Username</p><input class="profileInfo" readonly type="text" />
                            <p style="margin-top:4px;">Firstname</p><input class="profileInfo" readonly type="text" />
                        	<p style="margin-top:4px;">Surname</p><input class="profileInfo" readonly type="text" />
                        
                       		<p style="margin-top:4px;">Genres of Interest</p >
                        	<textarea class="profileInfo" rows="4" cols="22" readonly></textarea>
                        
                        
                        </div>
                        
                        <div id="frame2">
                        	<div id="portImageBack" class="templatemo_col50 templatemo_leftgap templatemo_botgap"><img src="images/templatemo_testimonial2.jpg" alt="testimonial image" id="portImage">
                            </div>
                            <div>
                        	<p style="margin-top:4px;">Author of:</p>
                            <ul id="booklist">
                            	<p style="font-size:8pt;">..This will be a list loaded dynamicly using javascript..</p>
                            </ul>
                                <button id="delete-button">Delete Account</button>
                                <button id="suspend-button">Suspend Account</button>
                                <button id="activate-button">Activate Account</button>
                            </div>
                            
                        </div>
                        
                        </div>
                        <button type="button" id="profileEditButton">Edit Details</button>
                    </div>
                    
                </div>
                <div>
                	<div class="templatemo_rightgap_about">
                    	<div class="templatemo_botgap" id="contactGray">
                        <div class="templatemo_frame">
                    	<h2>Contact</h2>
                    		<p style="margin-top:2px;">Cellphone</p><input class="contactInfo" readonly type="text" />
                            <p style="margin-top:4px;">Home</p><input class="contactInfo" readonly type="text" />
                        	<p style="margin-top:4px;">Work</p><input class="contactInfo" readonly type="text" />
                            <p style="margin-top:4px;">Email</p><input class="contactInfo" readonly type="text" />
                        </div>
                        <button id="editContactInfo">Edit Contact Info</button>
                        </div>
                    </div>
                    
                    <div class=" templatemo_botgap" id="contactImage"><img src="images/templatemo_testimonial3.jpg" alt="testimonial image" style="max-height:467px;" ></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 templatemo_leftgap templatemo_aboutlinkwrapper1">
                	<div class="templatemo_aboutback templatemo_botgap">
                	<div class="templatemo_link"><a class="show-1 templatemo_hometestimonial" href="#">Go Back</a></div>
                </div>
                </div>
    </div>
            </div>

    </div>
	 <!-- testimonial end -->
     <!-- about start -->
    <div class="content about" id="menu-5">
    	<div class="container">
        	<div class="row templatemo_bordergapborder">
            <!--vertical Tabs-->
      		<div id="ab">
            <div class="col-md-3 col-sm-12 templatemo_leftgap_about">
            <ul class="resp-tabs-list templatemo_tab">
                <li>Our Team</li>
                <li>Our History</li>
                <li>Our Vision</li>
            </ul>
            <div class="templatemo_aboutlinkwrapper">
     		<div class="templatemo_link"><a class="show-1 templatemo_homeabout" href="#">Go Back</a></div>
            </div>
            </div>
            <div class="resp-tabs-container templatemo_aboutcontainer">
                <div>
                	<div class="templatemo_col50 templatemo_rightgap_about">
                    	<div class="templatemo_graybg templatemo_botgap">
                         <div class="templatemo_frame">
                    	<h2>Our Team</h2>
                    	<p></p>
                        </div>
                        </div>
                    </div>
                    <div class="templatemo_col50 templatemo_leftgap templatemo_botgap"><img src="images/templatemo_about.jpg" alt="about image"></div>
                </div>
                <div>
                	<div class="templatemo_col50 templatemo_rightgap_about">
                    	<div class="templatemo_graybg templatemo_botgap">
                        <div class="templatemo_frame">
                    	<h2>Our History</h2>
                    	<p></p>
                        </div>
                        </div>
                    </div>
                    <div class="templatemo_col50 templatemo_leftgap templatemo_botgap"><img src="images/templatemo_team.jpg" alt="history image"></div>
                </div>
                <div>
                	<div class="templatemo_col50 templatemo_rightgap_about">
                    	<div class="templatemo_graybg templatemo_botgap">
                        <div class="templatemo_frame">
                    	<h2>Our Vision</h2>
                    	<p></p>
                        </div>
                        </div>
                    </div>
                    <div class="templatemo_col50 templatemo_leftgap templatemo_botgap"><img src="images/templatemo_vision.jpg" alt="vision image"></div>
                </div>
            </div>
        </div>
			<div class="col-sm-12 templatemo_leftgap templatemo_aboutlinkwrapper1">
                	<div class="templatemo_aboutback templatemo_botgap">
                	<div class="templatemo_link"><a class="show-1 templatemo_homeabout" href="#">Go Back</a></div>
                </div>
                </div>
    </div>
            </div>
    </div>
    <!-- about end -->
    <!-- contact start -->
    <div class="content contact" id="menu-6">
    	<div class="container">
        	<div class="row templatemo_bordergapborder">
            	<div class="col-md-3 col-sm-12 templatemo_leftgap">
                	<div class="templatemo_mainimg templatemo_botgap"><img src="images/templatemo_contact1.jpg" alt="contact image"></div>
                    <div class="templatemo_maincontact templatemo_botgap">
                	<div class="templatemo_linkcontact"><a class="show-1 templatemo_homecontact" href="#">Go Back</a></div>
                </div>
                </div>
                
                <div class="templatemo_col37 col-sm-12 templatemo_leftgap">
                	<div class="templatemo_graybg templatemo_paddinggap">
                	<h2>Contact Us</h2>
                    <div class="clear"></div>
                    	<form role="form">
                          <div class="templatemo_form">
                            <input name="fullname" type="text" class="form-control" id="fullname" placeholder="Your Name" maxlength="40">
                          </div>
                          <div class="templatemo_form">
                            <input name="email" type="text" class="form-control" id="email" placeholder="Your Email" maxlength="40">
                          </div>
                           <div class="templatemo_form">
                            <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject" maxlength="60">
                          </div>
                          <div class="templatemo_form">
                              <textarea name="message" class="form-control" id="message" placeholder="Your Message..."></textarea>
                          </div>
                          <div class="templatemo_form"><button type="button" class="btn btn-primary">Send</button></div>
            			</form>
               	  </div>
              </div>
                <div class="templatemo_col37 col-sm-12 templatemo_leftgap templatemo_topgap">
                	<div class="templatemo_graybg templatemo_paddinggap">
                    	<h2>Our Location</h2>
                        <div class="clear"></div>
                        <div class="templatemo_contactmap">
		    					<div id="templatemo_map"></div>                        
        		        </div>
                        <div class="templatemo_address">
                         	Rosebank ....(still to be added)<br>
                       	    Tel: 011 255 5454 Email: info@mockinfo.com
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
        <!-- contact end --> 
    
    </div>

    	<!-- logo start -->
    <div class="logocontainer">
    	<div class="row">
        	
            <!--<div class="templatemo_footer">Copyright © 2084 Company Name</div>-->
       </div>
    </div>
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
</div>
  </body>
</html>