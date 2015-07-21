/*

*/

function editSection(section){
	var editTimeStamp;
	var title = $("#pageSelect :selected").html();
	var content = document.getElementById("editor").value;
	var sectionHeading = $("#pageEditTitle").html();
	var actualContent = "="+sectionHeading+"= \n"+content;
	 $.post("scripts/mediawiki/api.php?action=query&prop=revisions&titles="+title+"&rvprop=timestamp|content&rvsection="+section+"&format=json", function(data){
		//alert(JSON.stringify(data));
		
		var string = JSON.stringify(data);
        var tokens = string.split("\"");
        var index = tokens[5];
       editTimeStamp = data.query.pages[index].revisions[0].timestamp;
	   
	localStorage.setItem("tStamp", editTimeStamp);
	

	 });
	$("#viewPage").hide(900);
	$("#pageList").hide(700);
	$("#createPage").hide(500);
	$("#Dummy").hide(400);
	$("#Page").hide(400);
	$("#editSection").css("visibility", "visible");
	$("#pageEditTitle").html($("#"+section+" .mw-headline").html());
	$("#editor").html("");

	/*var page = document.getElementById("Page").nextSibling;
		var links = page.(childNodes);
		
		var num_links =1;
		for(var i=0; i<links.length; i++) {
			if(links[i].innerHTML == "edit")
			{
				links[i].setAttribute('href', "#");
				links[i].setAttribute('onclick', "editSection("+num_links+")");
				num_links++;
			}
		}*/

	//alert(document.getElementById(""+section).nextSibling);
	var arr = $("#"+section).nextUntil("h1");
	str = "";
	for(var i = 0; i < arr.length; i++){
		if (arr[i].nodeName == "P") {
			
			str+= arr[i].innerHTML+"\n";
		}
	}
	
	var res = str.replace("<br>", "\n");
	
	//alert($("#"+section).nextUnitl().html());
	$("#editor").html(res);
	$("#saveBtn").attr("name","" + section);
	
}