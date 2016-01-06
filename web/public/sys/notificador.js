var server = "http://localhost/fH/?";

$(function() {
	setInterval(function() {
		$.post(server+"/Main/nextCall", function(data) {
			var obj = jQuery.parseJSON(data);
			if (obj.length > 1) {
				swal(obj.length+" novos chamados");
				playSound();
			} else {
				if(obj.length == 1) {
					swal({
					  title: codigoToTitle(obj[0].codigo),
					  text: "Localidade: "+obj[0].endereco,
					  imageUrl: codigoToImage(obj[0].codigo)
					});
					playSound();
				}
			}
			
		});
		$("#notify-field").load(server+"/Main/notify");
	}, 2000);
});

var codigoToTitle = function(codigo) {
	switch(codigo) {
		case "atl":
			return "Acidente de Trânsito (com lesões)";
			break;
		case "ats":
			return "Acidente de Trânsito (sem lesões)";
			break;
		case "ama":
			return "Assalto a Mão Armada";
			break;
		case "agr":
			return "Agressão";
			break;
		case "asa":
			return "Ataque de Saúde";
			break;
		case "inc":
			return "Incêndio";
			break;
		case "atp":
			return "Acidente Pessoal";
			break;
		case "mul":
			return "Violência Contra a Mulher";
			break;
	}
};

var codigoToImage = function(codigo) {
	switch(codigo) {
		case "atl":
			return "public/img/fuc-1.png";
			break;
		case "ats":
			return "public/img/fuc-2.png";
			break;
		case "ama":
			return "public/img/fuc-3.png";
			break;
		case "agr":
			return "public/img/fuc-4.png";
			break;
		case "asa":
			return "public/img/fuc-5.png";
			break;
		case "inc":
			return "public/img/fuc-6.png";
			break;
		case "atp":
			return "public/img/fuc-7.png";
			break;
		case "mul":
			return "public/img/fuc-8.png";
			break;
	}
}

var playSound = function() {
	$("#sound").html('<audio autoplay="autoplay"><source src="public/notify.mp3" type="audio/mpeg" /><embed hidden="true" autostart="true" loop="false" src="public/tdfw.mp3" /></audio>');
};
