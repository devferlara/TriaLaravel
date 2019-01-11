$(function() {
	CKEDITOR.replace('concepto');
	var text = $("#body_concepto").val();
	if(text.length > 0){

		CKEDITOR.instances['concepto'].setData(text);
	}
});
