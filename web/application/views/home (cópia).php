<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>fastHelp</title>
	<link href="public/favicon.ico" rel="shortcut icon" type="image/ico"/>
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
				<a class="navbar-brand" href="#">
					<img src="public/res/img/hp_str.png" width="200px">
				</a>
			</div>
			<div style="" aria-expanded="false" id="navbar" class="navbar-collapse collapse">
				<form class="navbar-form navbar-right" id="search" method="get" action="?/Page/">
				<div class="form-group">
					<p class="navbar-text">Veja se estamos em sua cidade</p>
				</div>
				<div class="form-group">
					<input placeholder="Apodi, RN" name="busca" class="form-control" type="text">
				</div>
				<div class="form-group">
					<button type="submit" onclick="enviar('search');" class="btn btn-default glyphicon glyphicon-search"></button>
				</div>
            
				</form>
			</div>
			
			
		</div>
    </nav>
    <div class="jumbotron" id="header_panel">
		<div class="container">
			<div class="col-md-6">
				<h2>Sistema de ajuda em situações críticas</h2>
				<p>Peça socorro aos órgãos de assistência pública</p>
				<div class="row black">
					<div class="panel panel-default col-md-3">
						<div class="panel-body">
							<span class="glyphicon glyphicon-heart-empty"></span>&nbsp;&nbsp;SAMU
						</div>
					</div>
					<div class="panel panel-default col-md-4">
						<div class="panel-body">
							<span class="glyphicon glyphicon-fire"></span>&nbsp;&nbsp;BOMBEIROS
						</div>
					</div>
					<div class="panel panel-default col-md-4">
						<div class="panel-body">
							<span class="glyphicon glyphicon-alert"></span>&nbsp;&nbsp;POLÍCIA CIVIL
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<h1>
					<i class="fa fa-car"></i>
					<i class="fa fa-medkit"></i>
					<i class="fa fa-user-secret"></i>
					<i class="fa fa-fire-extinguisher"></i>
					<i class="fa fa-hospital-o"></i>
					<i class="fa fa-ambulance"></i>
					<i class="fa fa-life-ring"></i>
				</h1><hr>
				<a class="btn btn-block btn-default" href="https://sway.com/FwRhWlqr6HVimNt3" target="_blank">Saiba mais sobre o fastHelp</a>
			</div>
		</div>
    </div>
    <div class="container">
		<div class="row panel panel-default">
			<div class="panel-body">
				<div class="col-md-6">
					<a href="?/Page/cadastro/orgao" class="btn btn-success btn-block">Sou representante de órgão público, quero me cadastrar!</a>
				</div>
				<div class="col-md-6">
					<a href="?/Page/login" class="btn btn-default btn-block">Acessar área restrita</a>
				</div>
			</div>
			
		</div>
    </div>
    <div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">Desenvolvendo um sociedade conectada</div>
					<div class="panel-body">
						<p class="text-justify">A iniciativa do <strong>fastHelp</strong> é criar conexões entre órgãos públicos e a população,
						aproveitando-se do mundo globalizado. Desenvolver conexões e promover agilidade nos serviços prestados, estes são os ideais do <strong>fastHelp</strong>.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">Proteção em todos os lugares</div>
					<div class="panel-body">
						<p class="text-justify">O <strong>fastHelp</strong> é um serviço baseado na geolocalização de usuários. Sua localização é rastreada e enviada para os órgãos de assistência quando
						você faz chamados de ajuda.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">Participe!</div>
					<div class="panel-body">
						Estamos em versão de teste. Contribua e seja tester do <b>fastHelp</b>:<hr>
						<div class="row">
							<div class="col-md-12">
								<a href="https://play.google.com/apps/testing/br.edu.ifrn.fh" target="_blank" class="btn btn-default fh-btn btn-block">Android</a>
							</div>
						</div><hr>
						Sugira melhorias clicando no ícone <img src="public/img/ideia.png">
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="container">
		<div class="well well-sm">fastHelp é um produto proveniente de projetos acadêmicos. Confira os papers do projeto: <a href="https://www.dropbox.com/sh/iflpe9ce91w36y1/AADh1kmwoHvJxs8dk_c1Hazwa?dl=0" target="_blank">clique aqui</a></div>
    </div>
