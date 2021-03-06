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
				<li><a href="?/Renub/precadastros">Pré-cadastros</a></li>
				<li class="active"><?php echo $precadastro[0]['orgao_nome'];  ?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pré-cadastros</h1>
			</div>
		</div><!--/.row-->
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
		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo "<strong>".$precadastro[0]['orgao_nome']."</strong>"; 
					if ($precadastro[0]['status']=="avaliando") {
						echo ' <span class="label label-info">Em avaliação </span>';
					}
					?></div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<p><strong>Razão social</strong>: <?php echo $precadastro[0]['orgao_razao']; ?></p>
								<p><strong>Tipo</strong>: <?php echo tipoToString($precadastro[0]['tipo']); ?></p>
								<p><strong>Responsável</strong>: <?php echo $precadastro[0]['resp_nome']; ?></p>
								<p><strong>Telefone</strong>: <?php echo $precadastro[0]['telefone']; ?></p>
								<p><strong>E-mail</strong>: <?php echo $precadastro[0]['email']; ?></p>
								<p><strong>Localização</strong>: <?php echo $precadastro[0]['cidade']."-".$precadastro[0]['estado']; ?></p>
								<p><strong>Endereço</strong>: <?php echo $precadastro[0]['endereco']; ?></p>
							</div>
							<div class="col-md-6">
								<?php 
									if ($precadastro[0]['status']=="avaliando") {
								?>
								<a href="?/Renub/precadastro/<?php echo $precadastro[0]['id']; ?>/navaliacao" class="btn btn-default btn-block">Desmarcar "Em avaliação"</a>
								<?php
									} else {
								?>
								<a href="?/Renub/precadastro/<?php echo $precadastro[0]['id']; ?>/avaliacao" class="btn btn-default btn-block">Marcar "Em avaliação"</a>
								<?php } ?>
								<a href="" class="btn btn-info btn-block">Enviar e-mail personalizado</a>
								<a href="?/Renub/precadastro/<?php echo $precadastro[0]['id']; ?>/delete" class="btn btn-danger btn-block">Recusar cadastro</a>
								<a href="?/Renub/precadastro/<?php echo $precadastro[0]['id']; ?>/criar" class="btn btn-success btn-block">Criar conta</a>
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
</body>

</html>
