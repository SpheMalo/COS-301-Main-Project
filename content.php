<?php
	if(!isset($_COOKIE['username']))
	{
		header('location: index.php');
	}
?>


<!DOCTYPE html>
	 
<!--CKEditor is open source-->
<!--
Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.md or http://ckeditor.com/license
-->
<html>
<head>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Book Editor</title>
	
    <!--CSS links here-->
   
    
    <link rel="stylesheet" href="css/content.css">
	<link rel="stylesheet" href="css/animate.css"> 
    <link rel="stylesheet" href="textarea/samples/css/samples.css">
	<link rel="stylesheet" href="textarea/samples/toolbarconfigurator/lib/codemirror/neo.css">
    <link href="css/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    
    
	<!--Links for textarea formmating-->
    
	<script src="textarea/ckeditor.js"></script>
	<script src="textarea/samples/js/sample.js"></script>
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="scripts/manuscriptManagement.js"></script> <!--The window.onload function is in here-->	
	 <script src="js/jquery-ui-1.9.2.custom.js"></script>
    <script src="scripts/manuscript.js" type="text/javascript"></script>
	<script src="scripts/saveTextToDB.js"></script>
        <script src="scripts/communication.js" type="text/javascript"></script>
	 
	
	
</head>
<body>
	<!--This is the book list, view and creator-->
	<!--services start -->
	
   <div class="content1 services" id="menu-2">
		<div id="serviceContainer" >
		  
		  <div id="commentSide">
			  
			  <div id="commentTop">
			   Comments
			   <span id="commentImage"></span>
			  </div> 	  
		      <div id="commentArea"><br><br><br>
					Choose a chapter to comment on:<br>
					<select id="chapterSelect"  onchange="populateComment();">
						 <option disabled="true">none</option>
					</select>
					<textarea id="commentText" cols="32" rows="30" ></textarea>
					<button id="saveComment" onclick="postComment();">Save Comment</button>
		  </div>
			  
			  
		  </div>
		  <div id="commentHide"></div>
		  
		  <div id="editorialLetter">
			  
			  <div id="letterTop">
			   Editorial Letter
			   <span id="letterImage"></span>
			  </div> 	  
		      <div id="letterArea">
					<textarea id="letterText" cols="66" rows="38" ></textarea>
					<button id="sendLetter">Send</button>
		       </div>  
			  
		  </div>
		   <div id="letterHide"></div>
		   
		  <div id="messageContainer">
				<div id="messageHide">Messages</div>
				<div id="contacts"></div>
				<div id="messageArea">
					
				</div>
			  </div>
          <div id="serviceBackground">
                       
					     
                         <div id="topService">
							  <div class="templatemo_mainservice templatemo_botgap" id="goBackService">
								    <a id="serviceGoBack" class="show-1 templatemo_homeservice" href="#">Main Menu</a>
							  </div>
							  
							  <div id="optionsContainer">
								   <div id="options">Options</div>
								   <div class="optionsSlide">
										<div class="service options">Create Book</div>
										<div class="options" id="loadbook" style="display:none;" onclick="loadBook()">Load Book</div>
										<div class="options" id="viewBooks">List Books</div>
										<div class="options" id="invitation" style="display:none;">Share Book</div>
										<div class="options" id="writeEditorial" style="display:none;">Editorial Letter</div>
										<div  class="options" id="addChapter" style="display:none;">Add Chapter</div>
                                        <div  class="options" id="delManuscript">Delete Book</div>
								   </div>
							  </div>

							  
								 
                         </div>
							
							<!--This is pop up boxes for adding chapters and linking users START-->
							<div id="addChapterArea" style="display:none;">
								   <h2>Please enter a chapter name:</h2><br>
								   <input type='text' id='sectionName' /><br>
								   <button id="addSectionButton">Add This Chapter</button>
							  </div>
										
							  <div id="sendManuscriptContainer" style="display:none;">
								  <!--input type="button" value="List users" onclick="sendManuscript()"></input><br>
								  <select id='users'>							  
								  </select><br-->
						      <input id="fuzzyText" name="fuzzyText" type="text" value placeholder="User to add"><br><br>
							  <input type="hidden" id="link_user_name" name="link_user_name" value="">
							  <input type="hidden" id="link_user_id" name="link_user_id" value="">
								  
								  <select id='access'>
									<option value="READ">READ</option>
									<option value="WRITE">WRITE</option>
								  </select><br>

								  <input id="sendManuButton" type="button" value="Send" onclick="link()"/>
							  </div>
                                                        
                                                               <div id="DelBookDiv" style="display:none;">
                                                                    <input id="fuzzyText_deleteTitle" name="fuzzyText_deleteTitle" type="text" value placeholder="Book to delete"><br><br>
                                                                    <input type="hidden" id="delete_book_title" name="delete_book_title" value="">
                                                                    <input type="hidden" id="delete_book_id" name="delete_book_id" value="">
                                                                    <button type="button" onclick="delete_page()">delete</button>
                                                                </div>
							  <!--This is pop up boxes for adding chapters and linking users END-->
							
                            <div id="scrollDiv">
                                <div id="bookList">
                                        
                                </div>
                                <div id="pageView">
            						<button id="refreshBook" style="visibility:hidden;" onclick="refreshBook()">Refresh</button>
            					</div>
                                 <div id="editSection">
                                      <div id="inputHeading"><span id="backToBook">Back-to-Book</span><input type="text" id="pageEditTitle"/></div><!--<hr/>-->
                                        <!--  <textarea id="editor" cols="93" rows="10">-->
					  						<!--This is the rich text editor-->
                                        <!-- Replace textarea-->
                                        <div class="adjoined-bottom">
                                            <div class="grid-container">
                                                <div class="grid-width-100">
                                                    <div id="editor">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Replace textarea-->
					
					
                                          
                                          <button id="saveBtn" onclick="saveText()" >Save</button>
                                          <button id="delBtn" >Delete</button>
                                  </div>
                            </div>
							
            </div>
            

                <div id="bookDiv">
            			<h2>Please enter a book title.</h2>                  	
                        <div id="pageList" style=" display:none;"></div>
                        
                        <div id="contentDiv">
                        	<div id="infoBox">
                                 <div id="labels">	
                                     <label>Book Title:</label><br/>                                   
                                 </div>
                                 <div id="inputs">
                                     <input id="title" type="text"/><br/><br/>                                     
                                 </div>
                             </div>                             
                             <button type="submit" id="next-button">Create Book</button>
                         </div>                  

                                                   	
                         
                                        
				   
			       
			   </div><!--bookDiv ends here-->
                  	
                  

                <div id="sidePicDiv" class="templatemo_col37 col-sm-12 templatemo_leftgap templatemo_topgap">
                	<div class="templatemo_mainimg templatemo_botgap"><img src="images/templatemo_service2.jpg" alt="service image"></div>
                </div>
                
            
            
            
			   
        </div><!--serviceContainer ends here-->
     </div><!--menu-2 ends here--> 
    <!-- services end -->	
	<!--Footer START-->

	<footer id="footer">
		 <div id="footList">
		  <span class="span">Figtory Animation</span><br>
		  <span class="span">Figbook Tutorial</span><br>
		  <span class="span">More on us</span><br>
		 </div>
		 <div id="footDiv">
		  <h2 class="text-shadow" id="powered" style="float:left;">Powered By</h2><img id="footLogo" src="images/logo.png"  width="200px" height="70px"/>
		 </div>
	</footer>

	<!--Footer END-->	

	

</body>
	 <script>
	initSample();
	 </script>

</html>
