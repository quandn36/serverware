
function changeFormElements(ac) 
{
	var control = document.getElementById("theForm").elements;
	
	for(var i=0; i<control.length; i++) 
	{
		if(control[i].type.match(/select/i) || control[i].type.match(/radio/i) || control[i].type.match(/checkbox/i)) 
		{
			control[i].disabled = ac;
		}
	}
}


if(typeof view_mode === "undefined") {
	view_mode = "list";	
}

function switch_view(view)
{
	view_mode = view;	
	showit("", "", "");
}



// show it using jquery instead
function showit(attribute, attribute_value, action)
{
	changeFormElements(1);
	$.get(
		"/inc/ajax/search/all-bootstrap.php",
		{view_mode: view_mode, attribute: attribute, attribute_value: attribute_value, action: action, system_type_id: "1", this_defining_attribute_value: "11"},
		function(data) {
			
			// IE8 wont change content unless fully compliant with .html()
			//document.getElementById("change_results").innerHTML=data;
			$('#change_results').html(data);
			//$('#change_results').html("test resulkt");

			$("tbody#change_systems_tbody > tr").fadeOut(200, function() {
				 
				$("#change_systems_tbody > tr").fadeIn(500, function() {
					// Animation complete
				});
			});
			
			var sticky_offset = $("#close_sticky_top_anchor").offset().top;
			
			//alert(sticky_offset);
			//alert("search_grey outerHeight: "+ $('#search_grey').outerHeight() );
			
			stop_offset_top = $("#close_sticky_top_anchor").offset().top - $("#search_grey").outerHeight();
			check_filter_scroll();

			//var search_grey_outer_height = $("#search_grey").outerHeight() + 60;
			//alert(search_grey_outer_height);
			//$("#search_grey_noJump").height(search_grey_outer_height+"px");
			
			
			//Check if were scrolled past last system
			var end_of_systems = $("#close_sticky_top_anchor").offset().top;
			var windows_scroll_top = $(window).scrollTop();
			//alert("End of Systems: "+end_of_systems+" \r Windows Scroll Top: "+windows_scroll_top);
			
			if(end_of_systems < windows_scroll_top)
			{
				scroll_to("#change_results")
			}
			
			valign_to_parent();
			
		}, "html"
	);
}

