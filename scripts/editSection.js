/*

*/

function editSection(section){
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
		str+= arr[0].innerHTML;
	}
	//alert($("#"+section).nextUnitl().html());
	$("#editor").html(str);
	$("#saveBtn").attr("name","" + section);
	
}