<aside>
  <div id="sidebar"  class="nav-collapse " style="z-index:10;">
	  <!-- sidebar menu start-->
	  <ul class="sidebar-menu" id="nav-accordion">
	  
		  <p class="centered">Usuário</p>
		  <h5 class="centered"><?php echo $user['nome']." ".$user['sobrenome']; ?></h5>
		  <h5 class="centered">@ <?php echo $orgao['nome']; ?></h5>
			
		  <li class="mt">
			  <a <?php if($actived=="dashboard") { ?>class="active"<?php } ?> href="?/Main/">
				  <i class="fa fa-dashboard"></i>
				  <span>Dashboard</span>
			  </a>
		  </li>
		  
		  <li class="sub-menu">
			  <a <?php if($actived=="mapa") { ?>class="active"<?php } ?> href="?/Main/mapa">
				  <i class="fa fa-map"></i>
				  <span>Mapa</span>
			  </a>
		  </li>
		  
		  <li class="sub-menu">
			  <a <?php if($actived=="terminal") { ?>class="active"<?php } ?> href="?/Main/terminal">
				  <i class="fa fa-list"></i>
				  <span>Terminal de Chamados</span>
			  </a>
		  </li>
		  
		  <li class="sub-menu just-idea">
			  <a <?php if($actived=="central_dados") { ?>class="active"<?php } ?> href="?/Main/ideia/central_dados" style="color: #666C7C;">
				  <i class="fa fa-database"></i>
				  <span>Central de dados</span>
			  </a>
		  </li>
		  
		  <li class="sub-menu">
			  <a <?php if($actived=="pagina_orgao") { ?>class="active"<?php } ?> href="?/Main/ideia/pagina_orgao" style="color: #666C7C;">
				  <i class="fa fa-paper-plane"></i>
				  <span>Página do órgão</span>
			  </a>
		  </li>
		  
		  <li class="sub-menu">
			  <a <?php if($actived=="gerentes") { ?>class="active"<?php } ?> href="?/Main/gerentes">
				  <i class="fa fa-group"></i>
				  <span>Gerentes</span>
			  </a>
		  </li>
		  
		  <li class="sub-menu">
			  <a href="javascript:;" >
				  <i class="fa fa-cogs"></i>
				  <span>Cofigurações do usuário</span>
			  </a>
			  <ul class="sub">
				  <li><a  href="?/Main/configura_gerente/dados">Dados pessoais</a></li>
				  <li><a  href="?/Main/configura_gerente/senha">Alterar senha</a></li>
				  <li><a  href="?/Main/configura_gerente/encerrar">Encerrar conta</a></li>
			  </ul>
		  </li>
		  
		  <li class="sub-menu">
			  <a href="javascript:;" <?php if($actived=="c_orgao") { ?>class="active"<?php } ?> >
				  <i class="fa fa-cogs"></i>
				  <span>Cofigurações do órgão</span>
			  </a>
			  <ul class="sub">
				  <li><a  href="?/Main/configura_orgao/dados">Dados do órgão</a></li>
				  <li><a  href="?/Main/configura_orgao/funcoes">Funções</a></li>
				  <li><a  href="?/Main/configura_orgao/encerrar">Encerrar conta</a></li>
			  </ul>
		  </li>
		  
<!--
		  <li class="sub-menu">
			  <a href="index.html">
				  <i class="fa fa-comment"></i>
				  <span>Mensagens</span>
			  </a>
		  </li>
-->
		  <li class="sub-menu">
			  <a href="?/Main/lock">
				  <i class="fa fa-unlock-alt"></i>
				  <span>Bloquear tela</span>
			  </a>
		  </li>

	  </ul>
	  <!-- sidebar menu end-->
  </div>
</aside>
      
