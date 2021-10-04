$('.maketing-img').tooltip({
     items: 'a.maketing-img',
     content: 'Hello welcome…',
     show: "slideDown", // show immediately
     open: function(event, ui) {
        ui.tooltip.hover(
        function () {
           $(this).fadeTo("slow", 0.5);
        });
     }
  });