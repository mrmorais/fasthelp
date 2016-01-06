$(function () {
	var eixo_x = new Array();
	var eixo_y = new Array();
	$.ajax({
	  type: "POST",
	  url: "http://localhost/fH/?/Main/chart_chamados",
	  success: function(data) {
		  var obj = $.parseJSON(data);
		  for(var i = 0; i < obj.length; i++) {
			   eixo_x[i] = obj[i].date;
			   eixo_y[i] = obj[i].count;
		  }
		  
		  $('#chart_calls').highcharts({
			title: {
				text: 'Gráfico de chamados registrados',
				x: -20 //center
			},
			subtitle: {
				text: 'Fonte: fasthelp.nutag.info',
				x: -20
			},
			xAxis: {
				categories: eixo_x
			},
			yAxis: {
				title: {
					text: 'Registros'
				},
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}]
			},
			tooltip: {
				valueSuffix: " chamado(s)"
			},
			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle',
				borderWidth: 0
			},
			series: [{
				name: 'Registro',
				data: eixo_y
			}]
		});
		  
	  }
	});
    
});
