<html>
  <head>
		<!--Javascript links here-->
		<script src="js/jquery-1.10.2.min.js"></script>
		<script src="scripts/profile.js" type="text/javascript"></script>
		<script src="scripts/authentication.js" type="text/javascript"></script>


		 <!--CSS links here-->
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/pRecovery.css">
  </head>
  <body>
    <!--This is the header bar START-->
  	<header id="header">
  		<img id="figbookLogo" src="images/figbooklogo.png" alt="Figbook"/>
  		<h1 id="figbookHeading">FIGBOOK</h1>
  		 <div id="menu">
  			</div>
  		 </div>
  	 </header>
		 <br /><br /><br /><br /><br /><br /><br /><br /><br />


		 <div id="containerDiv">
			 <p>Enter the email address of your account below. We'll email you details on how to recover your password.</p>
			 <input id="emailInput" type="email" placeholder="example@email.com" required="true"><br/>
			 <button id="sendEmailBtn" autofocus="true" onclick="verifyAndSendRecoveryLink()">Send Email</button>
       <p>Received your email with the token? Go to <a href="newPassword.html">Change your password.</a> Don't forget to copy your token!</p>
		 </div>


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
  </body>
</html>
