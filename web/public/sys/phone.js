var token = null;
var lat= -5.6578847;
var lng = -37.7954813;
//~ $(function (){
	//~ setInterval(function() {
		//~ $.ajax({
			//~ type:"POST",
			//~ url: "http://localhost/fH/?/Comunicator/track",
			//~ data: {token: token, lat: lat, lng: lng}
		//~ });
	//~ }, 50);
//~ });
var logout = function() {
	$.ajax({
	  type: "POST",
	  url: "http://localhost/fH/?/Comunicator/logout",
	  data: {token: token},
	  success: function(data) {
			alert(data);
		  }
	});
};
function status(sts) {
	$.ajax({
	  type: "POST",
	  url: "http://localhost/fH/?/Comunicator/status",
	  data: {token: token, status: sts},
	  success: function(data) {
			alert(data);
		  }
	});
}
var logar = function() {
	var email = $("#email").val();
	var senha = $("#senha").val();
	$.ajax({
	  type: "POST",
	  url: "http://localhost/fH/?/Comunicator/auth",
	  data: {usr: email, pss: senha},
	  success: function(data) {
			var obj = jQuery.parseJSON(data);
			token = obj.token;
			$("#tok").html("Token: "+obj.token);
		  }
	});
};

var call = function(codigo) {
	$.ajax({
	  type: "POST",
	  url: "http://localhost/fH/?/Comunicator/call",
	  data: {token: token, codigo: codigo, endereco:"Rua tal"}
	});
}

var go = function(link) {
	$.ajax({
	  type: "POST",
	  url: link
	});
}

var rua = function(rua) {
	switch(rua) {
		case 1:
			lat = -5.6621486;
			lng = -37.7962335;
			break;
		case 2:
			lat = -5.6286211;
			lng = -37.805201;
			break;
	}
}
