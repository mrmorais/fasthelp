<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>fastHelp</title>

    <link href="public/res/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/res/css/maradona.css" rel="stylesheet">
    <link href="public/assets-dg/font-awesome/css/font-awesome.css" rel="stylesheet" />
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			<div class="navbar-header">
				<a class="navbar-brand" href="?/Page">
					<img src="public/res/img/hp.png" width="200px">
				</a>
			</div>
			
		</div>
    </nav>
    <div class="jumbotron" id="header_panel">
		<div class="container">
			<div class="col-md-6">
				<h2>Resultados da busca</h2>
				<p><a class="btn btn-success" href="?/Page">Voltar</a></p>
			</div>
			<div class="col-md-6">
				<h1><?php echo $orgao[0]["cidade"].", ".$orgao[0]["estado"]; ?></h1>
			</div>
		</div>
    </div>
    <div class="container">
		<?php
		foreach($orgao as $row) {
		?>
		<div class="row panel panel-default">
			<div class="panel-heading"><strong><?php echo $row['nome']." ".$orgao[0]["cidade"].", ".$orgao[0]["estado"];?></strong>
			<?php if ($row['nick'] != null) { ?> <a href="?/Profile/o/<?php echo $row['nick'] ?>" class="label label-primary"><i class="fa fa-share"></i>Acessar perfil público</a><?php } ?></div>
			<div class="panel-body">
			Endereço: <?php echo $row['endereco']; ?><br>
			Telefone: <?php echo $row['telefone']; ?>
			</div>
		</div>
		<?php } ?>
    </div>
