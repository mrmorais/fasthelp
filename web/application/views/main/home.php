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

  <body>
	<div id="sound"></div>
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
            <a href="?/Main" class="logo"><b><img src="public/assets-dg/img/logo.png" width="200px"></b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <li class="dropdown" id="notify-field"></li>
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
                  <div class="col-lg-9 main-chart">
                  
                  	<div class="row mtbox">
                  		<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                  			<div class="box1">
					  			<i class="fa fa-wifi fa-5x"></i>
					  			<h3><?php echo $infos['connected_users']; ?></h3>
                  			</div>
					  			<p><?php echo $infos['connected_users']; ?> usuários estão conectados, nas proximidades, atualmente!</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<i class="fa fa-bullhorn fa-5x"></i>
					  			<h3><?php echo $infos['atendimentos_mes']; ?></h3>
                  			</div>
					  			<p><?php echo $infos['atendimentos_mes']; ?> atendimento(s) realizado(s) neste mês.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<i class="fa fa-envelope-o fa-5x"></i>
					  			<h3>5</h3>
                  			</div>
					  			<p>Você tem 5 mensagens não lidas.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<i class="fa fa-mouse-pointer fa-5x"></i>
					  			<h3><?php echo $infos['page_access']; ?></h3>
                  			</div>
					  			<p>A página do órgão tem <?php echo $infos['page_access']; ?> acessos.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<i class="fa fa-star-o fa-5x"></i>
					  			<h3>5</h3>
                  			</div>
					  			<p>O publico avalia o órgão com nota 5</p>
                  		</div>
                  	
                  	</div><!-- /row mt -->	
					
					<div class="row mt">
                      <!--CUSTOM CHART START -->
                      
					</div><!-- /row -->	
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<h4>CHAMADOS REGISTRADOS NA CIDADE NOS ÚLTIMOS 15 DIAS</h4>
											<div id="chart_calls">
											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /row -->
					
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                  <!--ultimos chamados-->
<!--
                  <div class="col-lg-3 ds">
						<h3>ÚLTIMOS CHAMADOS</h3>
                                        
                      <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p><muted>2 Minutes Ago</muted><br/>
                      		   <a href="#">James Brown</a> subscribed to your newsletter.<br/>
                      		</p>
                      	</div>
                      </div>
                      <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p><muted>3 Hours Ago</muted><br/>
                      		   <a href="#">Diana Kennedy</a> purchased a year subscription.<br/>
                      		</p>
                      	</div>
                      </div>
                      <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p><muted>7 Hours Ago</muted><br/>
                      		   <a href="#">Brandon Page</a> purchased a year subscription.<br/>
                      		</p>
                      	</div>
                      </div>
                      <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p><muted>11 Hours Ago</muted><br/>
                      		   <a href="#">Mark Twain</a> commented your post.<br/>
                      		</p>
                      	</div>
                      </div>
                      <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p><muted>18 Hours Ago</muted><br/>
                      		   <a href="#">Daniel Pratt</a> purchased a wallet in your store.<br/>
                      		</p>
                      	</div>
                      </div>
                      
                  </div>
				  <!--/ultimos chamados-->
              </div><!--/row -->
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
    
    <!---->
	<script src="public/highchart/js/highcharts.js"></script>
	<script src="public/highchart/js/modules/exporting.js"></script>
	<script src="public/sys/chart.js"></script>

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
