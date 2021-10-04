$("#choose-image-cover").click(function() {
    selectFileWithCKFinder('#cover_image', '#url_cover_image');
});

$("#cover_image").ready(function(){
	var url_default = $("#cover_image").data('src');
	$("#remove_cover_image").click(function(){
		$("#url_cover_image").val('');
		$("#cover_image").attr("src",url_default);
	});
});