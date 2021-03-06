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
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $user['nome']." ".$user['sobrenome']; ?><span class="caret"></span></a>
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
				<li><a href="?/Renub"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active"><a href="#">Administradores</a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Tipos de ocorrências</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Cadastrados</div>
					<div class="panel-body">
						
						<table class="table">
							<tr>
								<th>ID</th>
								<th>Código</th>
								<th>Descrição</th>
								<th>Ícone</th>
								<th>Ação</th>
							</tr>
							<?php
								foreach($funcoes as $funcao) {
									echo "<tr>";
									echo "<td>".$funcao['id']."</td>";
									echo "<td>".$funcao['codigo']."</td>";
									echo "<td>".$funcao['descricao']."</td>";
									echo "<td><img src='".$funcao['icone']."'></td>";
									echo "<td><a class='btn btn-danger' href='?/Renub/funcoes/deletar/".$funcao['id']."'>Deletar</a></td>";
									echo "</tr>";
								}
							?>
						</table>
						
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Cadastrar novo tipo</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<form class="form-horizontal" method="post" action="?/Renub/funcoes/new" id="cadastro">
									<div class="form-group">
										<label class="col-md-6 control-label" for="codigo">Código:</label>
										<input class="col-md-6" type="text" name="codigo" value="" autocomplete="off">
									</div>
									<div class="form-group">
										<label class="col-md-6 control-label" for="descricao">Descrição:</label>
										<input class="col-md-6" type="text" name="descricao" autocomplete="off">
									</div>
									<div class="form-group">
										<label class="col-md-6 control-label" for="E-mail">Ícone:</label>
										<input class="col-md-6" type="text" name="icone" autocomplete="off">
									</div>
									<div class="col-md-6 control-label">
										<a onclick="enviar('cadastro')" class="btn btn-success">Cadastrar</a>
									</div>
								</form>
							</div>
						</div>
						
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
	<script src="public/res/js/fh/form.js"></script>
</body>

</html>
