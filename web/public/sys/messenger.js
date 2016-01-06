var quantidade = 0;
var id_c = 0;
var doMessenger = function(id) {
	id_c = id;
	$.ajax({
		type: "POST",
		url: "http://localhost/fH/?/Main/messenger",
		data: {id: id},
		success: function(data) {
			var msgs = $.parseJSON(data);
			var container = $("#talkie-cont");
			if (msgs.length > 0) {
				container.html("");
				for (var n = 0; n < msgs.length; n++) {
					if(msgs[n].autor=="user") {
						if (msgs[n].type=="image") {
							var html = '<div class="msg row user">'+
										'<div class="col-md-8">'+
											'<b>'+msgs[n].user_nome+' '+msgs[n].user_sobrenome+': </b> <br>'+
											'<img src="data:image/jpeg;base64,'+msgs[n].texto+'" width="350">'+
										'</div>'+
									'</div>';
						} else {
							var html = '<div class="msg row user">'+
										'<div class="col-md-8">'+
											'<b>'+msgs[n].user_nome+' '+msgs[n].user_sobrenome+': </b> '+msgs[n].texto+
										'</div>'+
									'</div>';
						}
					} else {
						var html = '<div class="msg row orgao">'+
									'<div class="col-md-8 pull-right">'+
										'<b>'+msgs[n].orgao_nome+': </b> '+msgs[n].texto+
									'</div>'+
								'</div>';
					}
					container.append(html);
				}
			}
			quantidade = msgs.length;
			loadNews();
		}
	});
};

var loadNews = function() {
	setInterval(function() {
		$.ajax({
			type:"POST",
			url:"http://localhost/fH/?/Main/messenger/news",
			data: {id: id_c, qnt:quantidade},
			success: function(data) {
				var msgs = $.parseJSON(data);
				var container = $("#talkie-cont");
				if (msgs.length == 0 ) {
					if (quantidade == 0) {
						container.html("");
						sendMsg("Estamos atendendo sua ocorrência! Dê-nos detalhes do ocorrido.");
					}
				}
				for (var n = 0; n < msgs.length; n++) {
					if(msgs[n].autor=="user") {
						if (msgs[n].type=="image") {
							var html = '<div class="msg row user">'+
										'<div class="col-md-8">'+
											'<b>'+msgs[n].user_nome+' '+msgs[n].user_sobrenome+': </b> <br>'+
											'<img src="data:image/jpeg;base64,'+msgs[n].texto+'" width="350">'+
										'</div>'+
									'</div>';
						} else {
							var html = '<div class="msg row user">'+
										'<div class="col-md-8">'+
											'<b>'+msgs[n].user_nome+' '+msgs[n].user_sobrenome+': </b> '+msgs[n].texto+
										'</div>'+
									'</div>';
						}
					} else {
						var html = '<div class="msg row orgao">'+
									'<div class="col-md-8 pull-right">'+
										'<b>'+msgs[n].orgao_nome+': </b> '+msgs[n].texto+
									'</div>'+
								'</div>';
					}
					container.append(html);
					container.animate({ scrollTop: quantidade*100 }, 1000);
				}
				quantidade += msgs.length;
			}
		});
	}, 1000);
};

$("#msg-input").submit(function (event) {
	event.preventDefault();
	var msg = $("#msg-value");
	if (msg.val() != "") {
		sendMsg(msg.val());
	}
	msg.val("");
});

var sendMsg = function(txt) {
	$.post("http://localhost/fH/?/Main/sendMsg", {msg: txt, id:id_c, type:"text"});
};















