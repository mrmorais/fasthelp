<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>fastHelp - cadastro</title>

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
				<a class="navbar-brand" href="?/">
					<img src="public/res/img/hp.png" width="200px">
				</a>
			</div>
			<div style="" aria-expanded="false" id="navbar" class="navbar-collapse collapse">
				<form class="navbar-form navbar-right">
				<div class="form-group">
					<p class="navbar-text">Veja se estamos em sua cidade</p>
				</div>
				<div class="form-group">
					<input placeholder="Apodi, RN" class="form-control" type="text">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default glyphicon glyphicon-search"></button>
				</div>
            
				</form>
			</div>
		</div>
    </nav>
    <div class="jumbotron" id="header_panel">
		<div class="container">
			<div class="col-md-6">
				<h2>Queremos você aqui!</h2>
				<p>Junte-se ao <strong>fastHelp</strong> e ajude na construção de cidades conectadas.</p>
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
				<a class="btn btn-block btn-default" href="#">Saiba mais sobre o fastHelp</a>
			</div>
		</div>
    </div>
    
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
				  <li><a href="?/">Home</a></li>
				  <li class="active">Pré-cadastro</li>
				</ol>
				<div class="page-header">
					<h1>Pré-cadastro <small>órgão público</small></h1>
				</div>
				<div class="text-justify">
					<p>Os cadastros de órgãos de assistência pública passará por uma validação. Após o pré-cadastro, a conta será avaliada
				e em alguns casos entraremos em contato para requisição de documentos que comprovem a existência e o interesse do órgão
				em se cadastrar no <strong>fastHelp</strong>. Ao clicar em <code>Enviar formulário</code> você aceita essa condição.</p>
				</div><hr>
				<div class="col-md-6">
					<form class="form-horizontal" role="form" id="cad-form-orgao" method="post" action="?/Page/cadastro/orgao">
						<h4>Dados do órgão</h4><hr>
						<div class="form-group">
							<label class="control-label col-sm-6" for="nome">Nome do órgão protetor:</label>
							<div class="col-sm-6">
								<input type="text" name="nome" id="cad-form-orgao-nome" value="<?php echo set_value('nome'); ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-6" for="razao">Razão social:</label>
							<div class="col-sm-6">
								<input type="text" name="razao" id="cad-form-orgao-razao" value="<?php echo set_value('razao'); ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-6" for="tipo">Tipo:</label>
							<div class="col-sm-6">
								<select name="tipo">
									<option value="1">Bombeiros</option>
									<option value="2">Defesa Civil</option>
									<option value="3">Polícia</option>
									<option value="4">SAMU</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-6" for="telefone">Telefone:</label>
							<div class="col-sm-6">
								<input type="text" name="telefone" id="cad-telefone" value="<?php echo set_value('telefone'); ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-6" for="cep">CEP:<br><small>ex: 59700-000<br><a href="http://www.buscacep.correios.com.br/" target="_blank">buscar cep</a></small></label>
							<div class="col-sm-6">
								<input type="text" name="cep" id="cad-form-cep" value="<?php echo set_value('cep'); ?>" autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-6" for="estado">Estado:</label>
							<div class="col-sm-6">
								<input type="text" name="estado" id="cad-form-estado" value="<?php echo set_value('estado'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-6" for="cidade">Cidade:</label>
							<div class="col-sm-6">
								<input type="text" name="cidade" id="cad-form-cidade" value="<?php echo set_value('cidade'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-6" for="endereco">Endereço:</label>
							<div class="col-sm-6">
								<input type="text" name="endereco" id="cad-form-endereco" value="<?php echo set_value('endereco'); ?>" autocomplete="off">
							</div>
						</div>
						<h4>Dados do responsável</h4><hr>
						<div class="form-group">
							<label class="control-label col-sm-6" for="responsavel">Responsável:</label>
							<div class="col-sm-6">
								<input type="text" name="responsavel" id="cad-form-resp-nome" value="<?php echo set_value('responsavel'); ?>" autocomplete="off">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-6" for="email">Email:</label>
							<div class="col-sm-6">
								<input type="email" name="email" id="cad-form-resp-email" value="<?php echo set_value('email'); ?>" autocomplete="off">
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<img src="public/res/img/organizacao.png" width="100%">
								</div>
								<div class="col-md-9">
									<span id="cad-org-title"><strong></strong></span><br>
									<span id="cad-org-razao"></span><br>
									<span id="cad-resp-tel"></span><br>
									<span id="cad-org-cidade-estado"></span><br>
									<span id="cad-org-endereco"></span><hr>
									<span id="cad-resp-title"><strong></strong></span><br>
									<span id="cad-resp-email"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<a class="btn btn-default fh-btn btn-block" onclick="enviar('cad-form-orgao');">Enviar formulário</a>
						</div>
						<div id="msg-box" class="col-md-12">
							<?php echo validation_errors(); ?>
						</div>
						<div id="obj"></div>
						
					</div>
				</div>
			</div>
		</div>
    </div>
