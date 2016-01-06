/* ========================================================================
 * FastHelp #Inicializador do sistema
 * ========================================================================*/
var server;
var api_key;
var token;
var user = null;
	var lat;
	var lng;
	var rua = "Via Verde";
	var vcidade = "Rio Branco";
	var vestado = "AC";
var strStatus = "Definindo...";
var orgaos = null;
var thread;
var chamado = null;
	var chamadoId = 0;
	var quantidade = 0;
	var thLNM = null;
var persiste = false;
/* ========================================================================
 * FastHelp #Init
 * ========================================================================*/
var onDeviceReady = function() {
	document.addEventListener("backbutton", onBackKeyDown, false);
	//~ server = "http://fasthelp.nutag.info/?/Comunicator";
	//~ server = "http://10.0.0.103/fH/?/Comunicator";
	server = "http://10.0.0.103/fH/?/Comunicator";
	api_key = "AIzaSyCqEGoCA91G6qaORsYq7hSuYStuVhK4Jfo";
	//~ navigator.notification.prompt("Servidor de comunicação", 
								  //~ function(results) {
									  //~ server = results.input1;
								   //~ }, 
								  //~ "Configuração", 
								  //~ ["Definir"], 
								  //~ server);
	if ((window.localStorage.getItem("mail") != null) && (window.localStorage.getItem("pass") != null)) {
		persiste = true;
		login();
	}
};

var isLogged = function() {
	if(user == null) {
		return false;
	} else {
		return true;
	}
};
var initUser = function() {
	//~ alert(token);
	$.ajax({
		method: "POST",
		url: server+"/userInfos",
		data: {token: token}
	}).done(function(msg) {
		var response = $.parseJSON(msg);
		if (response.error != null) {
			alert(response.error);
			throwPush("index", "slide-out");
		} else {
			user = response;
		}
	}).fail(function() {
		navigator.notification.alert(
			'O servidor não está respondendo!',  // message
			function() {navigator.app.exitApp();},         // callback
			'Error!',            // title
			'Sair'                  // buttonName
		);
	});
};
/* ========================================================================
 * FastHelp #Cadastro do usuário
 * ========================================================================*/
var criarUser = function() {
	var nome = $("#cadastro-nome").val();
	var sobrenome = $("#cadastro-sobrenome").val();
	var email = $("#cadastro-email").val();
	var senha = $("#cadastro-senha").val();
	var senha_r = $("#cadastro-senha-r").val();
	
	$.ajax({
		method: "POST",
		url: server+"/cadastrar",
		data: {nome: nome, sobrenome: sobrenome, email: email, senha:senha, senha_r: senha_r}
	}).done(function(msg) {
		var response = $.parseJSON(msg);
		if (response.error != null) {
			alert(response.error);
		} else {
			if(response.msg == "success") {
				alert("Bem vindo ao Fasthelp");
				throwPush("index", "slide-in");
			}
		}
	}).fail(function() {
		navigator.notification.alert(
			'O servidor não está respondendo!',  // message
			function() {navigator.app.exitApp();},         // callback
			'Error!',            // title
			'Sair'                  // buttonName
		);
	});
};
/* ========================================================================
 * FastHelp #Login do usuário
 * ========================================================================*/
var login = function() {
	var mail;
	var pass;
	if (persiste) {
		mail = window.localStorage.getItem("mail");
		pass = window.localStorage.getItem("pass");
	} else {
		mail = $("#index-mail").val();
		pass = $("#index-pass").val();
	}
	$.ajax({
		method: "POST",
		url: server+"/auth",
		data: {usr: mail, pss: pass}
	}).done(function(msg) {
		var response = $.parseJSON(msg);
		if (response.error != null) {
			$("#error-panel").html('<div class="card"><div class="content-padded">Erro: conta não existe</div></div>');
		} else {
			token = response.token;
			//Persistencia do login
			window.localStorage.clear();
			window.localStorage.setItem("mail", mail);
			window.localStorage.setItem("pass", pass);
			
			initUser();
			//Initial
			throwPush("home", "slide-in");
			setTimeout(function() {
				navigator.geolocation.getCurrentPosition(geoOnSuccess, geoError, { maximumAge: 3000, timeout: 25000, enableHighAccuracy: true});
			}, 3000);
			thread = setInterval(function() {navigator.geolocation.getCurrentPosition(onlyTracker, geoError, { maximumAge: 3000, timeout: 25000, enableHighAccuracy: true});}, 15000);
			
		}
	}).fail(function() {
		navigator.notification.alert(
			'O servidor não está respondendo!',  // message
			function() {navigator.app.exitApp();},         // callback
			'Error!',            // title
			'Sair'                  // buttonName
		);
	});
};
/* ========================================================================
 * FastHelp #Logout do usuário
 * ========================================================================*/
var logout = function() {
	$.ajax({
		method: "POST",
		url: server+"/logout",
		data: {token: token}
	}).done(function(msg) {
		var response = $.parseJSON(msg);
		if (response.error != null) {
			alert(response.error);
		} else {
			clearInterval(thread);
			window.localStorage.clear();
			user = null;
			throwPush("index", "slide-out");
		}
		
	}).fail(function() {
		navigator.notification.alert(
			'O servidor não está respondendo!',  // message
			function() {navigator.app.exitApp();},         // callback
			'Error!',            // title
			'Sair'                  // buttonName
		);
	});
};
/* ========================================================================
 * FastHelp #Home page
 * ========================================================================*/
var home = function() {
	if(!isLogged()) {
		throwPush("index", "slide-out");
	}
	//~ setTimeout(function() {
		//~ $("#home-nome-campo").html(user.nome+" "+user.sobrenome);
	//~ }, 500);
	
	if ($("#home-nome-campo")) {
		$("#home-nome-campo").html('<h4>'+user.nome+" "+user.sobrenome+'</h4>'+
		'<button class="btn btn-primary" id="home-status">Status: '+strStatus+'</button> '+
		'<button class="btn btn-primary" id="home-cidade">Cidade: '+vcidade+' '+vestado+'</button>');
		if (orgaos == null) {
			$("#home-num-orgaos").html("..");
		} else {
			$("#home-num-orgaos").html(orgaos.length);
		}
	}
	
	//Carregar os chamados do Comunicator
	$.ajax({
		method: "POST",
		url: server+"/getCalls",
		data: {token: token}
	}).done(function(msg) {
		var response = $.parseJSON(msg);
		if (response.error != null) {
			$("#home-calls").html("<center><img src='img/no-calls.png' width='90%'></center>");
		} else {
			var html = '<div class="card"><ul class="table-view">';
			for (var n = 0; n< response.length; n++) {
				tmp_chamado = response[n];
				html += '<li class="table-view-cell">'+
							'<a class="navigate-right" onclick="loadChamado('+tmp_chamado['id']+')">'+
								'<img class="media-object pull-left" src="img/fuc/'+tmp_chamado['codigo']+'.png" width="100px">'+
								'<div class="media-body"><h3>'+tmp_chamado['titulo']+'</h3>'+
									'<p>'+tmp_chamado['endereco']+'</p>'+
								'</div>'+
							'</a>'+
						'</li>';
			}
			html += '</ul></div>';
			
			$("#home-calls").html(html);
		}
	});
		
};
/* ========================================================================
 * FastHelp #Página de órgãos disponíveis
 * ========================================================================*/
var DoOrgaos = function() {
	if (orgaos == null) {
		//nenhum
	} else {
		var html = "";
		for (var n = 0; n < orgaos.length; n++) {
			var one = orgaos[n];
			html+= '<li class="table-view-cell media">'+
					  '<img class="media-object pull-left" src="img/orgao/'+one.tipo+'.png" width="100px">'+
					  '<div class="media-body"><h3>'+one.nome+'</h3>'+
						'<p>Endereço: '+one.endereco+' em '+one.cidade+' '+one.estado+'</p>'+
					  '</div>'+
				  '</li>';
		}
		$("#orgaos-list").html(html);
		$("#loader").html("");
	}
};
/* ========================================================================
 * FastHelp #Página de status
 * ========================================================================*/
var DoStatus = function() {
	if (user.status != null) {
		$("#sts-"+user.status).attr("class", "btn active");
	} else {
		$("#sts-1").attr("class", "btn active");
	}
};
/* ========================================================================
 * FastHelp #Mudar status action
 * ========================================================================*/
var setStatus = function(sts) {
	user.status = sts;
	strStatus = num2Status(sts);
	var request = $.post(server+"/status", {token: token, status: sts});
	throwPush("home", "slide-out");
};
//Converte número do status para nome
var num2Status = function(sts) {
	switch(sts) {
		case "1":
			return "Nenhum";
			break;
		case "2":
			return "Automóvel";
			break;
		case "3":
			return "Motocicleta";
			break;
		case "4":
			return "Residência";
			break;
		case "5":
			return "Estabelecimento";
			break;
		default:
			return "Nenhum";
	}
}
/* ========================================================================
 * FastHelp #Mudar chamado action
 * ========================================================================*/
var actionChamado = function(codigo) {
	$.ajax({
		method: "POST",
		url: server+"/call",
		data: {token: token, endereco: rua, codigo:codigo}
	}).done(function(msg) {
		navigator.notification.alert(
			'O chamado foi aberto!',  // message
			function() {throwPush("home", "slide-out");},         // callback
			'Sucesso!',            // title
			'Ir para o início'                  // buttonName
		);
	});
}
/* ========================================================================
 * FastHelp #Chamado
 * ========================================================================*/
//Função que lança o PUSH
var loadChamado = function(id) {
	chamadoId = id;
	$.ajax({
		method: "POST",
		url: server+"/getCall",
		data: {token: token, cid: id}
	}).done(function(msg) {
		var response = $.parseJSON(msg);
		if (response.error != null) {
			//erro
			navigator.notification.alert(
				'Ops!',  // message
				function() { },         // callback
				'Este chamado não existe!',            // title
				'Ok'                  // buttonName
			);
		} else {
			chamado = response;
			throwPush("chamado", "slide-in");
		}
		
		
	});
};
//seta a página com as informações
var DoChamado = function() {
	$("#chamado-img").html('<img class="media-object pull-left" src="img/fuc/'+chamado.codigo+'.png" width="45px">');
	$("#chamado-titulo").html(chamado.titulo);
	$("#chamado-local").html(chamado.cidade+" "+chamado.estado+" em "+chamado.endereco);
	DoMessenger();
};
//carrega as mensagens
var DoMessenger = function() {
	//load all
	$.ajax({
		type: "POST",
		url: server+"/messenger",
		data: {token: token, cid:chamadoId},
		success: function(data) {
			var msgs = $.parseJSON(data);
			var container = $("#talkie-cont");
			if (msgs.length > 0) {
				container.html("");
				for (var n = 0; n < msgs.length; n++) {
					if(msgs[n].autor=="user") {
						if (msgs[n].type == "image") {
							var html = '<div class="card">'+
										'<div class="content-padded">'+
											'<b>'+msgs[n].user_nome+' '+msgs[n].user_sobrenome+': </b> <br>'+
											'<img src="data:image/jpeg;base64,'+msgs[n].texto+'" width="350">'+
										'</div>'+
									'</div>';
						} else {
							var html = '<div class="card">'+
											'<div class="content-padded">'+
											'<b>'+msgs[n].user_nome+' '+msgs[n].user_sobrenome+': </b> '+msgs[n].texto+
											'</div>'+
										'</div>';
						}
					} else {
						var html = '<div class="card">'+
										'<div class="content-padded">'+
										'<b>'+msgs[n].orgao_nome+': </b> '+msgs[n].texto+
										'</div>'+
									'</div>';
					}
					container.append(html);
				}
			}
			quantidade = msgs.length;
			loadNewMsgs();
		}
	});
};

var loadNewMsgs = function() {
	thLNM = setInterval(function() {
		$.ajax({
			type:"POST",
			url: server+"/messenger/news",
			data: {token: token, cid:chamadoId, qnt: quantidade},
			success: function(data) {
				var msgs = $.parseJSON(data);
				var container = $("#talkie-cont");
				
				for (var n = 0; n < msgs.length; n++) {
					if(msgs[n].autor=="user") {
						if (msgs[n].type == "image") {
							var html = '<div class="card">'+
										'<div class="content-padded">'+
											'<b>'+msgs[n].user_nome+' '+msgs[n].user_sobrenome+': </b> <br>'+
											'<img src="data:image/jpeg;base64,'+msgs[n].texto+'" width="350">'+
										'</div>'+
									'</div>';
						} else {
							var html = '<div class="card">'+
											'<div class="content-padded">'+
											'<b>'+msgs[n].user_nome+' '+msgs[n].user_sobrenome+': </b> '+msgs[n].texto+
											'</div>'+
										'</div>';
						}
					} else {
						var html = '<div class="card">'+
										'<div class="content-padded">'+
										'<b>'+msgs[n].orgao_nome+': </b> '+msgs[n].texto+
										'</div>'+
									'</div>';
					}
					container.append(html);
					$(document).animate({ scrollTop: quantidade*100 }, 1000);
				}
				quantidade += msgs.length;
			}
		});
	}, 1000);
};
//Send msg
var sendmsg = function() {
	var msg = $("#msg-value");
	if (msg.val() != "") {
		$.post(server+"/sendmsg", {msg: msg.val(), idc: chamadoId, token: token, type: "text"});
	}
	msg.val("");
};
//Send image
var sendimg = function(imgdata) {
	$.post(server+"/sendmsg", {msg: imgdata, idc: chamadoId, token: token, type: "image"});
};
/* ========================================================================
 * FastHelp #Tracker and Geocoder
 * ========================================================================*/
//Geolocation on Success
var geoOnSuccess = function(position) {
	var lat = position.coords.latitude;
	var lng = position.coords.longitude;
	//~ alert("Lat: "+lat.toFixed(7)+" - Lng:"+lng.toFixed(7));
	//geoCoder(lat,lng); adp
	geoTracker({lat:-10.0077039, lng:-67.848211, rua:"Via Verde", cidade:"Rio Branco", estado:"AC"});
};
//Geocoder
var geoCoder = function(lat, lng) {
	var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lng+"&key="+api_key;
	var rua;
	var cidade;
	var estado;
	$.post(url, function( data ) {
		var local = data.results[0].address_components;
		for (var n = 0; n < local.length; n++) {
			if (local[n].types[0]=="administrative_area_level_1") {
				estado = local[n].short_name;
			}
			if (local[n].types[0]=="administrative_area_level_2") {
				cidade = local[n].long_name;
			}
			if (local[n].types[0]=="route") {
				rua = local[n].long_name;
			}
		}
		geoTracker({lat:lat, lng:lng, rua:rua, cidade:cidade, estado:estado});
	}).fail(function() {
		navigator.notification.alert(
			'Não é possível obter sua localização! Verifique sua conexão à internet',  // message
			function() {navigator.app.exitApp();},         // callback
			'Error!',            // title
			'Sair'                  // buttonName
		);
	});
};
var onlyTracker = function(position) {
	var lat = position.coords.latitude;
	var lng = position.coords.longitude;
	
	geoTracker({lat:lat, lng:lng, rua:rua, cidade:vcidade, estado:vestado});
};
//Tracker - As funções que merecem threads ocorrem aqui também
var geoTracker = function(geoinfo) {
	lat = geoinfo.lat;
	lng = geoinfo.lng;
	rua = geoinfo.rua;
	vcidade = geoinfo.cidade;
	vestado = geoinfo.estado;
	//outras funções
	
	$.ajax({
		method: "POST",
		url: server+"/orgaosNaArea",
		data: {cidade: vcidade, estado: vestado}
	}).done(function(msg) {
		var response = $.parseJSON(msg);
		if (response.error != null) {
			orgaos = null;
		} else {
			orgaos = response;
		}
	});
	
	if(page == "home") {
		strStatus = num2Status(user.status);
		$("#home-cidade").html("Cidade: "+vcidade+" "+vestado);
		$("#home-status").html("Status: "+strStatus);
		$("#home-num-orgaos").html(orgaos.length);
	}
	
	//Fim - outras funções
	var request = $.post(server+"/track", {token: token, lat: lat, lng: lng, cidade: vcidade, estado: vestado});
};

var geoError = function(error) {
	//navigator.notification.alert(
	//	'Houve um problema ao realizar a localização. '+error.message,
	//	function() {
	//navigator.app.exitApp();
	//},   
	//		'Error!',            
	//		'Sair'                 
	//	);
};
/* ========================================================================
 * FastHelp #Take a picture - 16 de Novembro de 2015
 * ========================================================================*/
var takepic = function() {
	 //Usar a camera de trás
	navigator.camera.getPicture(cameraSuccess, 
								cameraFail, 
								{ quality : 75,
								  destinationType : Camera.DestinationType.DATA_URL,
								  sourceType : Camera.PictureSourceType.CAMERA,
								  encodingType: Camera.EncodingType.JPEG,
								  saveToPhotoAlbum: false });
};
var cameraSuccess = function(imageData) {
	sendimg(imageData);
};
var cameraFail = function(msg) {
	alert("Erro! "+msg);
};
