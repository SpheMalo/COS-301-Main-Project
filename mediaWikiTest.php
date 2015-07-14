<?php 
	/*if(!isset($_COOKIE["sessionLives"]))
	{
		header('Location: ../FigbookHtml/');
		//header("Location: ../FigbookHtml/");
	}
	else
	{
		echo "Cookie set to  ".$_COOKIE["sessionLives"];
	}*/
?>
       <!DOCTYPE html>
<html>
<head> 
    <script src="scripts/createPage.js" type="text/javascript"></script>
    <script> 
    //$(function(){
     // $("#u377").load("insideContent.html"); 
    //});
    </script> 
     <script type="text/javascript">
   window.jQuery || document.write('\x3Cscript src="scripts/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  </head>
  <body>
      <br>
      <br>
      <div id="pageList"></div>
      <br>
      <br>
      <div id="createPage">
      <form class="form" >
			<input id="title" type="text" placeholder="title">
                        <br>
                        <textarea id="text"  cols="50" rows="10" ></textarea>
			
			<button type="submit" id="create-button">Create Page</button>
		</form>
          
          </div>
            <br>
            <br>
      <div id="viewPage">
          <form class="form" >
			<input id="gettitle" type="text" placeholder="title">
			<button type="submit" id="load-button">Load Page</button>
		</form>
      </div>
            <div id="Page"></div>
      
  </body>
</html>
