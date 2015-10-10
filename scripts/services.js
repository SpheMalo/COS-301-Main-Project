
		
			
		$(document).ready(function()
		{
			var xhttp;
			if (window.XMLHttpRequest)
			  {
			  xhttp = new XMLHttpRequest();
			  }
			else // code for IE5 and IE6
			  {
			  xhttp = new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xhttp.open("GET","scripts/services.xml",false);
			xhttp.send();
			var xmlDoc;
			xmlDoc = xhttp.responseXML;
			
			var y=xmlDoc.documentElement.childNodes;
			 // alert(y[1].nodeName);
			for (var i=0;i<y.length;i++)
			{
				if (y[i].nodeName === "role")
				{
					var role = y[i].getElementsByTagName("name")[0].childNodes[0].nodeValue;
					if(role === "Author")
					{	
						//alert(y[i].getElementsByTagName("name")[0].childNodes[0].nodeValue);
						var servList = y[i].childNodes;
						
						for (var k = 0;k<servList.length;k++)
						{
							//alert(servList[k].nodeName);
							if (servList[k].nodeName === "service")
							{
								//alert(servList[k].childNodes[0].nodeValue);
								$( "#services" ).append( "<div class='service'>"+servList[k]
								.childNodes[0].nodeValue+"</div>" );break;
								 // break for now lets only the first element load (create manuscript) in this case.
							}
						}
					}
				}
				
			}
			
						
		});
	
	
