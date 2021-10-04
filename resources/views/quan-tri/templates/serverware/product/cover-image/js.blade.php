$("#choose-image-cover").click(function() {
        selectFileWithCKFinder('#image-cover', '#image-url-cover');
});
function selectFileWithCKFinder(elementId, elementUrlID) {
    CKFinder.popup({
        chooseFiles: true,
        width: 800,
        height: 800,
        onInit: function(finder) {
            finder.on('files:choose', function(evt) {
                var file = evt.data.files.first();
                var url = file.getUrl();
                $(elementId).attr("src", url); // Hiển thị hình được chọn lên thẻ img
                $(elementId).show();
                $(elementUrlID).val(url); // gán đường dẫn hình vào input
                $(elementId+"-base").attr("src", url); //Hiển thị hình được chọn lên HP Base
            });

            finder.on('file:choose:resizedImage', function(evt) {
                $(elementId).attr("src", evt.data.resizedUrl);
                $(elementId).show();
                $(elementUrlID).val(evt.data.resizedUrl); // gán đường dẫn hình vào input
            });
        }
    });
}

$("#image-cover").ready(function(){
    var url_default = $("#image-cover").data('src');
    $("#remove_cover_image").click(function(){
        $("#image-url-cover").val('');
        $("#image-cover").attr("src",url_default);
    });
});