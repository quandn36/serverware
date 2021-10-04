$("#choose-image-cover").click(function() {
    selectFileWithCKFinder('#image-cover', '#image-url-cover');
});

$("#image-cover").ready(function(){
	var url_default = $("#image-cover").data('src');
	$("#remove_cover_image").click(function(){
		$("#image-url-cover").val('');
		$("#image-cover").attr("src",url_default);
	});
});
