<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>fastHelp - Renub</title>

<link href="public/res/css/bootstrap.min.css" rel="stylesheet">
<link href="public/res/css/datepicker3.css" rel="stylesheet">
<link href="public/res/css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<script>
	function carregar(url) {
		window.location.href=encodeURI(url);
	}
</script>
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>FASTHELP</span>ADMIN</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $user['nome']." ".$user['sobrenome']; ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
							<li><a href="?/Renub/sair"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
	
	<!--Side bar-->
	<?php include("sidebar.php"); ?>
	<!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="?/Renub/"><span class="glyphicon glyphicon-home"></span></a></li>
				<li><a href="?/Renub/orgaos">Órgãos</a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Órgãos <?php if ($cidade!="all" && count($orgaos)>0) {echo " - ".$cidade;} echo " (".count($orgaos).")"; ?></h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<select onchange="carregar('?/Renub/orgaos/'+encodeURI(this.value));">
							<option>Cidades</option>
							<option value="">Ver todos</option>
							<?php
							foreach ($listCidades as $row) {
								echo '<option value="'.$row['value'].'">'.$row['cidade'].'</option>';
							}
							?>
						</select>
					</div>
					<div class="panel-body">
						<table class="table">
							<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>Razão social</th>
								<th></th>
								<th>Tipo</th>
								<th>Cidade</th>
								<th>Estado</th>
								<th>Endereço</th>
								<th>Telefone</th>
								
							</tr>
							<?php
							function tipoToString($tipo) {
								switch($tipo) {
									case "1":
										return "Bombeiros";
										break;
									case "2":
										return "Defesa Civil";
										break;
									case "3":
										return "Polícia";
										break;
									case "4":
										return "SAMU";
										break;
									default:
										return "!ERROR!";
										break;
								}
							}
							foreach($orgaos as $row) {
								echo "<tr>";
								echo "<td>".$row['id']."</td>";								
								echo "<td>".$row['nome']."</td>";								
								echo "<td>".$row['razao']."</td>";								
								echo '<td><a href="?/Renub/orgao/'.$row['id'].'" class="label label-primary"><span class="glyphicon glyphicon-cog"></span> preferências</a></td>';							
								echo "<td>".tipoToString($row['tipo'])."</td>";								
								echo "<td>".$row['cidade']."</td>";								
								echo "<td>".$row['estado']."</td>";								
								echo "<td>".$row['endereco']."</td>";								
								echo "<td>".$row['telefone']."</td>";	
								echo "</tr>";
							}
							?>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->			
	</div>	<!--/.main-->

	<script src="public/res/js/jquery-1.11.1.min.js"></script>
	<script src="public/res/js/bootstrap.min.js"></script>
	<script src="public/res/js/chart.min.js"></script>
	<script src="public/res/js/chart-data.js"></script>
	<script src="public/res/js/easypiechart.js"></script>
	<script src="public/res/js/easypiechart-data.js"></script>
	<script src="public/res/js/bootstrap-datepicker.js"></script>	
</body>

</html>
