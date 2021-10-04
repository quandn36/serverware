$("#choose-image-banner").click(function() {
	selectFileWithCKFinder('#image_banner_category', '#url_banner_category');
});

$("#image_banner_category").ready(function(){
	var url_default = $("#image_banner_category").data('src');
	$("#remove_banner_image").click(function(){
		$("#url_banner_category").val('');
		$("#image_banner_category").attr("src",url_default);
	});
});