var server = "http://localhost/fH/?";
$(function() {
	setInterval(function() {
		carregar();
		limpar();
	}, 8000);
});

var carregar = function() {
	$.ajax({
		type: "POST",
		url: server+"/Main/getMarkers",
		success: function(data) {
			var obj = jQuery.parseJSON(data);
			for (var n = 0; n < obj.length; n++) {
				var myLatlng = new google.maps.LatLng(obj[n].lat, obj[n].lng);
				var marker = new google.maps.Marker({
					position: myLatlng,
					map: map,
					title: obj[n].nome+" "+obj[n].sobrenome,
					icon: getStatusIcon(obj[n].status, obj[n].alert)
				});
				markers.push(marker);
			}
		}
	});
};

var getStatusIcon = function(status, alert) {
	if (alert == "1") {
		switch (status) {
			case '1':
				return "public/img/sts_c-1.png";
			break;
			case '2':
				return "public/img/sts_c-2.png";
			break;
			case '3':
				return "public/img/sts_c-3.png";
			break;
			case '4':
				return "public/img/sts_c-4.png";
			break;
			case '5':
				return "public/img/sts_c-5.png";
			break;
			default:
				return "public/img/sts_c-1.png";
			break;
		}
	} else {
		switch (status) {
			case '1':
				return "public/img/sts-1.png";
			break;
			case '2':
				return "public/img/sts-2.png";
			break;
			case '3':
				return "public/img/sts-3.png";
			break;
			case '4':
				return "public/img/sts-4.png";
			break;
			case '5':
				return "public/img/sts-5.png";
			break;
			default:
				return "public/img/sts-1.png";
			break;
		}
	}
}

var limpar = function() {
	setAllMap(null);
}

var setAllMap = function(map) {
  for (var i = 0; i < markers.length; i++) {
	markers[i].setMap(map);
  }
}
