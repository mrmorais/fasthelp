<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>fastHelp - Renub</title>

<link href="public/res/css/bootstrap.min.css" rel="stylesheet">
<link href="public/res/css/datepicker3.css" rel="stylesheet">
<link href="public/res/css/styles.css" rel="stylesheet">

<!--QWERTY EDITOR-->
<link href="public/qwerty/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="public/qwerty/css/froala_editor.min.css" rel="stylesheet" type="text/css" />
<link href="public/qwerty/css/froala_style.min.css" rel="stylesheet" type="text/css" />
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
				<li><a href="#">Central de e-mails</a></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Central de e-mails</h1>
			</div>
		</div><!--/.row-->
		
		<?php if ($area == "grupos") { ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><b>Enviar e-mail para grupos</b></div>
					<div class="panel-body">
						<div class="row">
							<form class="form" action="?/Renub/mail/send_group" method="post">
								<div class="col-md-6">
									<input type="text" name="assunto" class="form-control" placeholder="Assunto" required>
									<textarea id="edit" name="msg" required></textarea>
								</div>
								<div class="col-md-6">Selecione os grupos:<br>
									<label><input type="checkbox" name="cb_gerentes"> Gerentes</label>
									<label><input type="checkbox" name="cb_users"> Usuários</label>
									<label><input type="checkbox" name="cb_admins"> Administradores</label><br>
									<button type="submit" class="btn btn-primary form-control">Enviar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if ($area == "gerente") { ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><b>Enviar e-mail para um gerente</b></div>
					<div class="panel-body">
						<div class="row">
							<form class="form" action="?/Renub/mail/send_gerente/<?php echo $gerente['id']; ?>" method="post">
								<div class="col-md-6">
									<input type="text" name="assunto" class="form-control" placeholder="Assunto" required>
									<textarea id="edit" name="msg" required></textarea>
								</div>
								<div class="col-md-6">Informações do gerente:<br>
								Nome: <?php echo $gerente['nome']." ".$gerente['sobrenome']; ?>
								<br>E-mail: <?php echo $gerente['email']; ?>
								<br>Órgão: <?php echo $orgao['nome']; ?>
								<br>Cidade: <?php echo $orgao['cidade']." - ".$orgao['estado']; ?>
								<br><br><button type="submit" class="btn btn-primary form-control">Enviar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<!--/.row-->
		<!--<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><b>Gerentes</b></div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<table class="table">
									<tr>
										<th>ID</th>
										<th>Nome</th>
										<th>Sobrenome</th>
										<th>E-mail</th>
									</tr>
								</table>
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
	<!--QWERTY EDITOR-->
	<script src="public/qwerty/js/froala_editor.min.js"></script>
	<script>
		$(function() {
			$('#edit').editable({inlineMode: false})
		});
	</script>
</body>

</html>
