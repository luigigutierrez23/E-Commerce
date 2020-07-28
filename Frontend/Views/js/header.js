/*=============================================
HEADER
=============================================*/

$("#btnCategorias").click(function(){

	if(window.matchMedia("(max-width:767px)").matches){

		$("#btnCategorias").after($("#categorias").slideToggle("fast"))

	}else{

		$("#header").after($("#categorias").slideToggle("fast"))
		
	}	
})