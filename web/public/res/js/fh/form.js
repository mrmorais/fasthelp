function enviar(id) {
	$("#"+id).submit();
	$("#msg-box").html("<div class='rigth'>Por favor, aguarde! <i class='fa fa-spinner fa-pulse'></i></div>");
}
$("#cad-form-orgao-nome").keyup(function(){
	$("#cad-org-title").html("<strong>"+$("#cad-form-orgao-nome").val()+"</strong>");
});
$("#cad-form-orgao-razao").keyup(function(){
	$("#cad-org-razao").html($("#cad-form-orgao-razao").val());
});
$("#cad-form-resp-nome").keyup(function(){
	$("#cad-resp-title").html($("#cad-form-resp-nome").val());
});
$("#cad-telefone").keyup(function(){
	$("#cad-resp-tel").html($("#cad-telefone").val());
});
$("#cad-form-resp-email").keyup(function(){
	$("#cad-resp-email").html($("#cad-form-resp-email").val());
});
$("#cad-form-endereco").keyup(function(){
	$("#cad-org-endereco").html($("#cad-form-endereco").val());
});
$(function() {
	$("#cad-org-title").html("<strong>"+$("#cad-form-orgao-nome").val()+"</strong>");
	$("#cad-org-razao").html($("#cad-form-orgao-razao").val());
	$("#cad-resp-title").html("<strong>"+$("#cad-form-resp-nome").val()+"</strong>");
	$("#cad-resp-tel").html($("#cad-telefone").val());
	$("#cad-resp-email").html($("#cad-form-resp-email").val());
	$("#cad-org-endereco").html($("#cad-form-endereco").val());
});
$("#cad-form-cep").keyup(function() {
	var cep = $("#cad-form-cep").val();
	if (cep.length == 9) {
		$("#cad-form-cep").val($("#cad-form-cep").val()+" ");
		var urlA = "http://apps.widenet.com.br/busca-cep/api/cep/"+cep+".json";
		var request = $.ajax({
		  url: urlA,
		  dataType: "html"
		});
		request.done(function(msg) {
			var obj = JSON.parse(msg);
			$("#cad-form-estado").val(obj.state);
			$("#cad-form-cidade").val(obj.city);
			$("#cad-form-endereco").val(obj.address);
			
			$("#cad-org-cidade-estado").html(obj.city+"-"+obj.state);
			$("#cad-form-cidade").val(obj.city);
			$("#cad-form-endereco").val(obj.address);
		});
	}
	if (cep.length<9) {
		$("#cad-form-estado").val("");
		$("#cad-form-cidade").val("");
		$("#cad-form-endereco").val("");
	}
});
