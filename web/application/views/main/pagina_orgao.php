<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Maradona Morais">

    <title><?php echo $orgao['nome']; ?> - fastHelp</title>

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

    <!--Sweet Alert-->
    <link href="public/sweet-alert/sweetalert.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body><div id="sound"></div>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Abrir/Fechar Menu"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b><img src="public/assets-dg/img/logo.png" width="200px"></b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-bell"></i>
                            <span class="badge bg-theme">+10</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">DashGum Admin Panel</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Database Update</div>
                                        <div class="percent">60%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Product Development</div>
                                        <div class="percent">80%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Payments Sent</div>
                                        <div class="percent">70%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            <span class="sr-only">70% Complete (Important)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme">5</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 5 new messages</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="public/assets-dg/img/ui-zac.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Zac Snider</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hi mate, how is everything?
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="public/assets-dg/img/ui-divya.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Divya Manian</span>
                                    <span class="time">40 mins.</span>
                                    </span>
                                    <span class="message">
                                     Hi, I need your help with this.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="public/assets-dg/img/ui-danro.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dan Rogers</span>
                                    <span class="time">2 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Love your new Dashboard.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="public/assets-dg/img/ui-sherman.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dj Sherman</span>
                                    <span class="time">4 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Please, answer asap.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="?/Main/sair">Sair</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <?php include("sidebar.php"); ?>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
		  <section class="wrapper">
			  <div class="row">
                  <div class="col-lg-12">
					  <h3><i class="fa fa-paper-plane"></i> Página do órgão</h3>
					  <div class="panel">
						<div class="panel-body">
							<?php if ($profile['id']==null) { ?>
								<h3>Etapa 1/3</h3><hr>
								<strong><?php echo $orgao['nome']; ?> ainda não possui um perfil público no fastHelp. Escolha o <i>nick</i> do seu órgão para acesso!</strong><hr>
								<form class="form" method="post" action="?/Main/pagina_orgao/criar">
									<div class="form-group col-md-12">
										<div class="col-md-6">
											<input type="text" class="form-control" placeholder="Nickname" name="nick">
										</div>
										<div class="col-md-6">
											<button class="btn btn-success form-control" type="submit">Enviar</button>
										</div>
									</div>
									<div class="form-group col-md-6">
										
									</div>
									<div class="col-md-12">
									A página será acessada em:<br><strong><?php echo base_url(); ?>?/Profile/o/<i>SEU-NICK</i></strong>
									</div>
								</form>
							<?php } else {
								if ($etapa==2) {
							?> 
								<h3>Etapa 2/3</h3><hr>
								<strong>As pessoas precisam entender o propósito da sua organização! Informe uma breve descrição sobre <?php echo $orgao['nome']; ?></strong><hr>
								<form class="form" method="post" action="?/Main/pagina_orgao/etapa_2_send">
									<div class="form-group col-md-12">
										<label>Descrição</label>
										<textarea name="descricao" class="form-control"></textarea>
									</div>
									<div class="form-group col-md-12">
										<button class="btn btn-success" type="submit">Enviar</button>
									</div>
								</form>
							<?php
								} elseif($etapa==3) {
							?>
								<h3>Etapa 3/3</h3><hr>
								<strong>Uma imagem cai bem! Selecione uma imagem no seu computador que identifique o seu órgão; uma logomarca, por exemplo.</strong>
								<form action="?/Main/pagina_orgao/etapa_3_send" enctype="multipart/form-data" method="post" accept-charset="utf-8">
									<div class="form-group col-md-12">
										<input type="file" name="userfile">
									</div>
									<div class="form-group col-md-12">
										<button class="btn btn-success" type="submit">Enviar</button>
									</div>
								</form>
							<?php
								} else {
							?>
								<h3>Mural de postagens</h3><hr>
							<?php
								}
								
						    }?>
						</div>
					  </div>
 				  </div>
 			  </div>
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              © 2015 Neep Development. Todos os direitos reservados. 
              <a href="index.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="public/assets-dg/js/jquery.js"></script>
    <script src="public/assets-dg/js/jquery-1.8.3.min.js"></script>
    <script src="public/assets-dg/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="public/assets-dg/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="public/assets-dg/js/jquery.scrollTo.min.js"></script>
    <script src="public/assets-dg/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="public/assets-dg/js/jquery.sparkline.js"></script>
    
    <!--Notificador do sistema-->
	<script src="public/sweet-alert/sweetalert.min.js"></script>
	<script src="public/sys/notificador.js"></script>

    <!--common script for all pages-->
    <script src="public/assets-dg/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="public/assets-dg/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="public/assets-dg/js/gritter-conf.js"></script> 

	<script type="text/javascript">
	var _urq = _urq || [];
	_urq.push(['initSite', '359e9fc7-f574-4164-b9b9-008079b324b7']);
	(function() {
	var ur = document.createElement('script'); ur.type = 'text/javascript'; ur.async = true;
	ur.src = ('https:' == document.location.protocol ? 'https://cdn.userreport.com/userreport.js' : 'http://cdn.userreport.com/userreport.js');
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ur, s);
	})();
	</script>
  </body>
</html>
