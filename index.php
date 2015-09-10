<!DOCTYPE html>
 <html>
  <head>
   <title>Figbook</title>
	   <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
	   
	   <!--Javascript links here-->
	   <script src="js/jquery-1.10.2.min.js"></script> 
	   <script src="scripts/authentication.js" type="text/javascript"></script>
	   
	    <!--CSS links here-->
	   <link rel="stylesheet" type="text/css" href="css/index.css"/>
	   <link rel="stylesheet" href="css/style.css">
	   
  </head>
  <body>
   
   <!--This is the Login window that will popup START-->
   <div class="wrapper">
		<div class="container"  id="logDiv">
			<h1>Welcome</h1>
			
			<form class="form" method="POST">
				<input id="LoginUsername" type="text" placeholder="Username">
				<input id="LoginPassword" type="password" placeholder="Password">
				<button id="login-button">Login</button>
			</form>
	</div>
		
		<ul class="bg-bubbles">
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
	</div>
   <!--This is the Login window that will popup END-->
   
   <!--This is the register window that will popup START-->
   <div class="wrapperReg">
	   <div id = "regDiv" class="container">
		   <h1 class="welcome">Welcome</h1>
		   
		   <form class="form" method="POST">
			   <input id="username" type="text" placeholder="Username">
									   <input id="email" type="email" placeholder="Email Address">
			   <input id="password" type="password" name="pass" placeholder="Password" >
									   <input id="confirmpassword" type="password" name="confirmpass" placeholder="Confirm Password" >
									   <select placeholder="Select Role" id="roleSelect">
										  <option value="" disabled selected>Select your user role<span class="carrot"></span></option>
										  <option>Author</option>
										  <option>Agent</option>
										  <option>Designer</option>
										  <option>Editor</option>
										  <option>Proof Reader</option>
									   </select>
			   <button id="register-button">Register</button>
		   </form>
	   </div>
	
		<ul class="bg-bubbles">
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
   </div>
   <!--This is the register window that will popup END-->
   
	   <header id="header">
		<img id="figbookLogo" src="images/figbooklogo.png" alt="Figbook"/>
		<h1 id="figbookHeading">FIGBOOK</h1>
		 <div id="menu">
		  <div id="log">Login</div>
		  <div id="reg">Register</div>
		 </div>
	   </header>
	   
	   <div id="background"> <!--Background START-->
		 <div id="container"> <!--Container START-->
		   <!--About START-->		 
		     <div id="whatWorks">
			 <h2 class="text-color h2">What makes it work?</h2>
			 <p class="text-color p">It's the seamless combination of MediaWiki API's, CKE's Rich-Text-Editor,
			 an endless amount of coffee and then a dash of the magic our team produces by working together. 
			 </p>
			 <p class="text-color p">
			  Let's also not to forget about:<br>
			  The sleepless nights<br>
			  The innovation<br>
			  Commitment<br>
			  And finally<br>
			  Our<br>
			  Passion
			 <p>
		   </div>
			 
		   <div id="whyFigbook">
			 <h2 class="text-color h2">Why Figbook?</h2>
			 <!--These links must link to a page explaining all these rolls-->
			 <p class="text-color p">Why should you use Figbook? The answer is simple, figbook is the only service
			 that will allow you to collaboratively create, edit, review and share your soon to be novel.
			 This is achieved by joining together all the critically important roles together through our interface.
			 </p>
			 <p class="text-color p">These roles include the:<br> <a href="">Author</a> <br> <a href="">Editor</a> <br> <a href="">Agent</a>
			 <br> <a href="">Designer</a> 
			 <br>and more.
			 <p>
		   </div>
		   
		   <div id="figtoryWho">
			 <h2 class="text-color h2">Who is Figtory?</h2>
			 <p class="text-color p">"Figtory is a digital design company that <br>
			 specialize in the design and development <br>of technology solutions, 
			 creative and<br> engineering content. Figtory was founded in 2011; its primary focus was using open source
				and cloud based infrastructures <br>to enrich the digital experience."<br> -Figtory Animation
			 </p>
			 <p class="text-color p">
				Please<br>
				Visit Us<br>
				For More<br>
				Info<br>
				At:<br>
				<a href="http://www.figtory.com/">Figtory<a>
			 <p>  
		   </div>
		   <!--About END-->
		   
		 </div> <!--Container END-->
	   </div> <!--Background END-->
		
		
		
		<footer id="footer">
		 <div id="footList">
		  <span>Figtory Animation</span><br>
		  <span>Figbook on Facebook</span><br>
		  <span>Figbook Examples</span><br>
		  <span>Figbook Tutorial</span><br>
		  <span>More on us</span><br>
		 </div>
		 <div id="footDiv">
		  <h2 class="text-shadow" style="float:left;">Powered By</h2><img id="footLogo" src="images/logo.png"  width="200px" height="70px"/>
		 </div>
	    </footer>
		
  </body>
  
  
 </html>