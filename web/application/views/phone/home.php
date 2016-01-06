<html>
	<head>
		<meta charset="utf-8">
		<title>Phone tester</title>
	</head>
	<body>
		<h2>Simulador de Terminal FH</h2>
		<h3>Fazer Login</h3>
		Email: <input id="email" type="text"> Senha: <input type="password" id="senha"><button onclick="logar();">Logar</button>
		<h3 id="infos"></h3>
		<h3 id="tok"></h3>
		<hr>Conexão<br>
			<a onclick="logout();"><button>Desconectado</button></a>
		<hr>Status<br>
			<a onclick="status(1);"><button>Nenhum (1)</button></a>
			<a onclick="status(2);"><button>Automóvel (2)</button></a>
			<a onclick="status(3);"><button>Motocicleta (3)</button></a>
			<a onclick="status(4);"><button>Casa (4)</button></a>
			<a onclick="status(5);"><button>Estabelecimento (5)</button></a>
		<hr>Chamar<br>
			<button onclick="call('atl');">Acidente com lesões (atl)</button>
			<button onclick="call('ats');">Acidente sem lesoes (ats)</button>
			<button onclick="call('ama');">Assalto (ama)</button>
			<button onclick="call('agr');">Agressão (agr)</button>
			<button onclick="call('asa');">Ataque de saúde (asa)</button>
			<button onclick="call('inc');">Incêndio (inc)</button>
			<button onclick="call('atp');">Acidente pessoal (atp)</button>
		<hr>
			<button onclick="rua(1);">Rua Reis Magos</button>
			<button onclick="rua(2);">IFRN</button>
		
		<script src="public/assets-dg/js/jquery-1.8.3.min.js"></script>
		<script src="public/sys/phone.js"></script>
		<?php
			$limit = mktime(date("H"), date("i")-2, date("s"));
			echo date("Y-m-d H:i:s",$limit);
		?>
	</body>
</html>
