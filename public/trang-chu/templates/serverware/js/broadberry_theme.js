// JavaScript Document
$(function () {
    $(window).scroll(function(){
        // add navbar opacity on scroll
        if ($(this).scrollTop() > 100) {
            $(".navbar.navbar-fixed-top").addClass("scroll");
        } else {
            $(".navbar.navbar-fixed-top").removeClass("scroll");
        }
    });
	
	 /*
	 
	 Dont Bother makign featured system panel full height (looks better non full-height)
	 
	 $(window).load(function(){
        $(".newNav .panel-body").each(function() {
			
			var table_padding = 20;
			var heading = 50;
			var holder_div_height = parseInt($(this).closest('div.newNav').innerHeight());
			var panel_body_padding = parseInt( $(this).css("padding-top") + $(this).css("padding-bottom") );
			//alert("heading: "+heading);
			//alert("holder_div_height: "+holder_div_height);
			//alert("panel_body_padding: "+panel_body_padding);
			
			var make_to_height = holder_div_height - table_padding - heading - panel_body_padding;
			//alert("make_to_height: "+make_to_height);
			
			$(this).outerHeight(make_to_height+"px");
		})
    });
	*/
	
});

function valign(id_to_align, id_of_parent)
{
	var parent_height = $("#"+id_of_parent).height();
	var obj_height = $("#"+id_to_align).height();
	
	if(obj_height < parent_height){	
		var half_spare = (parent_height - obj_height) / 2;
		//alert("Half Spare: "+half_spare);
		$("#"+id_to_align).css('margin-top', half_spare+"px");
	}
}


function valign_to_parent()
{
	// put in static function so can call manually (after ajax call?), and also on every page load below.
	$(".valign_to_parent").each(function(index) 
	{
		/*	Usage Note:
			Will vertically align an image to its parent. Best to Fix height of parent.
		*/
		
		var parent = $(this).parent();
		var parent_height = parent.innerHeight();
		var this_height = $(this).height();
		
		var half_spare = (parent_height - this_height) / 2;
		console.log("Parent Row Height: "+parent_height+"px | This Height: "+this_height+"px | Half Spare: "+half_spare+"px");
		
		$(this).css('padding-top', half_spare+"px");
	});
}


$(window).load(function(){
	$(".valign_to_row").each(function(index) 
	{
		/*	Usage Note:
			Images to be vertically aligned must be in a row on there own, so if doing products with price, image, name etc we need to do each on
			a new row, or atleast image in its own.*/
		
		//Apply valign class to vertical align to its .parent .row
		var parent = $(this).closest('.row');
		var parent_height = parent.innerHeight();
		var this_height = $(this).height();
		
		var half_spare = (parent_height - this_height) / 2;
		console.log("Parent Row Height: "+parent_height);
		
		$(this).css('margin-top', half_spare+"px");
	});
	
	valign_to_parent();
});

function scroll_to(target, custom_offset)
{
	custom_offset = typeof custom_offset !== 'undefined' ? custom_offset : -60;
	
	$.scrollTo(target, 600, {offset: custom_offset});
}

function open_tab(tabset_id, tab_id)
{
	$('#'+tabset_id+' a[href="#'+tab_id+'"]').tab('show') 
}

//Fade In on Scroll ---------------
(function($) {

  $.fn.visible = function(partial) {
    
      var $t            = $(this),
          $w            = $(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;
    
    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

  };
    
})(jQuery);


$(window).scroll(function(event) {
  
  $(".f_in").each(function(i, el) {
    var el = $(el);
    if (el.visible(true)) {
      el.addClass("come-in"); 
    } 
  });
});  


//Fade In on Scroll ---------------

$(document).on('click', '.yamm .dropdown-menu', function(e) {
  e.stopPropagation()
})

