$("#choose-image-logo").click(function() {
    selectFileWithCKFinder('#brand_image_logo', '#url_image_logo');
});

$("#brand_image_logo").ready(function(){
	var url_default = $("#brand_image_logo").data('src');
	$("#remove_brand_image").click(function(){
		$("#url_image_logo").val('');
		$("#brand_image_logo").attr("src",url_default);
	});
});