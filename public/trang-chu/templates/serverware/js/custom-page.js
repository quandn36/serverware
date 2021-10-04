$("#btn-server").click(function($e){
		$("#storage").collapse("hide")
		$("#server").collapse("show")
	})
$("#btn-storage").click(function($e){
	$("#storage").collapse("show")
	$("#server").collapse("hide")
})
$("#divider-blank").mouseover(function(){
	$("#divider-blank .configure").css("background-color","#496473");
})
$("#divider-blank").mouseout(function(){
ư$("#divider-blank .configure").css("background-color","white");
})