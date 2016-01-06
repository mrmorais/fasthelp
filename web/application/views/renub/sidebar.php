<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li <?php if($actived=="home") {echo "class='active'";} ?>><a href="?/Renub/"><span class="glyphicon glyphicon-dashboard"></span> Painel</a></li>
			<li <?php if($actived=="precadastros") {echo "class='active'";} ?>><a href="?/Renub/precadastros"><span class="glyphicon glyphicon-list-alt"></span> Pré-cadastros</a></li>
			<li <?php if($actived=="orgaos") {echo "class='active'";} ?>><a href="?/Renub/orgaos"><span class="glyphicon glyphicon-certificate"></span> Órgãos</a></li>
			<?php
			if ($user['tipo']=="master") {
				echo '<li ';
				if($actived=="admin") {
					echo 'class="active"';
				}
				echo '><a href="?/Renub/administradores"><span class="glyphicon glyphicon-user"></span> Administradores</a></li>';
			}
			?>
			<li <?php if($actived=="mail") {echo "class='active'";} ?>><a href="?/Renub/mail"><span class="glyphicon glyphicon-pencil"></span> Central de e-mails</a></li>
			<li <?php if($actived=="funcoes") {echo "class='active'";} ?>><a href="?/Renub/funcoes"><span class="glyphicon glyphicon-triangle-right"></span> Tipos de ocorrência</a></li>
			
			<!--<li><a href="panels.html"><span class="glyphicon glyphicon-info-sign"></span> Alerts &amp; Panels</a></li>-->
			
		</ul><hr>
		<div class="col-md-12">
		<h6>&copy; <?php echo date('Y'); ?> Neep Development. Todos os direitos reservados. <br><br>Feito com <span class="glyphicon glyphicon-heart"></span> por <a href="#">mrmorais</a></h6>
		</div>
	</div>

