<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Maradona Morais">

    <title>fastHelp</title>

    <!-- Bootstrap core CSS -->
    <link href="public/assets-dg/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="public/assets-dg/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="public/assets-dg/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="public/assets-dg/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="public/assets-dg/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="public/assets-dg/css/style.css" rel="stylesheet">
    <link href="public/assets-dg/css/style-responsive.css" rel="stylesheet">

    <script src="public/assets-dg/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
 <!--main content start-->
      <section id="main-content">
		  <section class="wrapper">
			  <div class="row">
                  <div class="col-lg-12">
					  <div class="panel">
						<div class="panel-body">
							<div class="col-md-4 text-center">
							<?php
								switch($tipo) {
									case "error":
										echo '<i style="font-size:190pt;" class="fa fa-exclamation-circle fa-5x"></i>';
										break;
									case "success":
										echo '<i style="font-size:190pt;" class="fa fa-check fa-5x"></i>';
										break;
								}
							?>
							
							</div>
							<div class="col-md-8">
								<?php
									switch($msg) {
										case "email_ja_existe":
											$titulo = "O email cadastrado já existe!";
											$desc = "Este email que está tentando utilizar já está sendo utilizado em uma
													outra conta no nosso sitema. Por favor, verifique o email e tente
													novamente.";
											$retorno = "?/Main/gerentes";
											break;
										case "sucesso_cadastro_gerente":
											$titulo = "Sucesso!";
											$desc = "<h4>O gerente foi cadastrado com sucesso! Um email com a senha provisória
											foi enviado para o endereço informado.</h4>";
											$retorno = "?/Main/gerentes";
											break;
										case "sucesso_deletar_gerente":
											$titulo = "A conta foi deletada com sucesso!";
											$desc = "Lembre-se, este processo é inreversível; não se pode reativar uma conta. Para
											que o utilizador volte ao sistema você deve recadastra-lo tal como no primeiro cadastro.";
											$retorno = "?/Main/gerentes";
											break;
										case "erro_deletar_gerente":
											$titulo = "Você não pode deletar este gerente";
											$desc = "Talvez você não tenha o privilégio necessário ou o gerente em questão não existe";
											$retorno = "?/Main/gerentes";
											break;
										case "gerente_n_existe":
											$titulo = "O gerente não existe";
											$desc = "Não existe nenhum gerente cadastrado com as informações informadas";
											$retorno = "?/Main/gerentes";
											break;
										case "mysql_erro":
											$titulo = "D'oh! Temos um problema";
											$desc = "Algum erro não esperado foi capturado! Tente novamente mais tarde.";
											$retorno = "?/Main";
											break;
										case "sucesso_gerente_encerrar":
											$titulo = "Até logo! Foi bom ter você aqui";
											$desc = "Sua conta foi encerrada com sucesso. Conte-nos o que houve! Entre em contato
											com nossa equipe através do email: neep.dev@gmail.com";
											$retorno = "?/Page";
											break;
										case "sucesso_orgao_encerrar":
											$titulo = "Sucesso! Todas contas encerradas";
											$desc = "Não existe mais o perfil do órgão nem as contas de gerentes do órgão.";
											$retorno = "?/Page";
											break;
										case "gerente_encerrar_senha_errada":
											$titulo = "Senha incorreta!";
											$desc = "Esta não é a senha. Se você for realmente o dono desta conta verifique corretamente
											sua senha ou peça uma nova senha na área de login.";
											$retorno = "?/Main/configura_gerente/encerrar";
											break;
										case "sucesso_alterar_dados":
											$titulo = "Dados alterados com sucesso!";
											$desc = "Os seus dados foram atualizados no nosso banco de dados";
											$retorno = "?/Main/configura_gerente/dados";
											break;
										case "email_ja_existe_dados":
											$titulo = "O email inserido já existe!";
											$desc = "Este email que está tentando utilizar já está sendo utilizado em uma
													outra conta no nosso sitema. Por favor, verifique o email e tente
													novamente.";
											$retorno = "?/Main/configura_gerente/dados";
											break;
										case "senha_incorreta_alt_senha":
											$titulo = "A senha inserida não é correta!";
											$desc = "Verifique a senha, caso tenha esquecido sua senha solicite uma nova
													 na área de login.";
											$retorno = "?/Main/configura_gerente/senha";
											break;
										case "senhas_nao_sao_iguais":
											$titulo = "'Nova senha' e 'Nova senha novamente' não são iguais!";
											$desc = "Tente novamente.";
											$retorno = "?/Main/configura_gerente/senha";
											break;
										case "sucesso_alterar_senha":
											$titulo = "Senha alterada com sucesso!";
											$desc = "Já pode utilizar a nova senha nos próximos acessos.";
											$retorno = "?/Main";
											break;
										default:
											$titulo = "Ops!";
											$desc = $msg;
											$retorno = "?/Main";
											break;
									}
								?>
								
								<h2><?php echo $titulo; ?></h2>
								<p class="text-justify">
									<?php echo $desc; ?>
								</p>
								<a href="<?php echo $retorno; ?>"><button class="btn btn-info">Retornar</button></a>
							</div>
							
						</div>
					  </div>
 				  </div>
 			  </div>
          </section>
      </section>

  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="public/assets-dg/js/jquery.js"></script>
    <script src="public/assets-dg/js/jquery-1.8.3.min.js"></script>
    <script src="public/assets-dg/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="public/assets-dg/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="public/assets-dg/js/jquery.scrollTo.min.js"></script>
    <script src="public/assets-dg/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="public/assets-dg/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="public/assets-dg/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="public/assets-dg/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="public/assets-dg/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="public/assets-dg/js/sparkline-chart.js"></script>    
	<script src="public/assets-dg/js/zabuto_calendar.js"></script>	

  </body>
</html>
