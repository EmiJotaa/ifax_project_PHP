<?=$this->fetch('commons/header.php', $data)?>
<section class="slider_banner">
	<div class="conteudo">
		<div class="itens">
			<div class="item">
				<a href="">
					<img src="<?=URL_BASE?>resources/imagens/banner.png">
				</a>
			</div>
			<div class="item">
				<a href="https://www.google.com/maps/place/Parque+Indígena+do+Xingu/@-11.6627729,-52.8679238,8z/data=!4m6!3m5!1s0x930fbd3a77425f3f:0x91369ea8e1ff4631!8m2!3d-11.2468098!4d-53.2070192!16s%2Fm%2F027wmyf?entry=ttu&g_ep=EgoyMDI0MTIwOC4wIKXMDSoASAFQAw%3D%3D" target="_blank">
					<img src="<?=URL_BASE?>resources/imagens/banner1.png">
				</a>
			</div>
			<div class="item">
				<a href="">
					<img src="<?=URL_BASE?>resources/imagens/banner3.png">
				</a>
			</div>
		</div>
	</div>
</section>
<section class="quem_somos">
	<div class="container">
		<div class="conteudo">
			<div class="texto">
				<h2 class="titulo">Quem somos</h2>
				<div class="descricao">
					<p>Com as mudanças climáticas e a seca extrema, o Território Indígena do Xingu tem sofrido com diversos focos de incêndio no ano de 2024. Sem o combate efetivo e rápido, os incêndios se espalham pela vegetação seca e alcançam enormes proporções, ameaçando a biodiversidade da fauna e flora e, até mesmo, as aldeias dos povos indígenas que vivem na região.</p>
						<p>Recentemente, incêndios avançaram descontroladamente e atingiram aldeias dos povos Kalapalo, Aweti e Yawalapíti, na região do Alto Xingu. Por sorte, não houve vítimas, mas os prejuízos são grandes, já que além das casas tradicionais de sapê, roças foram destruídas, prejudicando a subsistência alimentar de diversas famílias.</p>
				</div>
				<a href="<?=URL_BASE?>quem-somos" class="btn">Continue lendo</a>
			</div>
			<div class="video">
				<a href="https://www.instagram.com/reel/C-Yj2J7Smy7/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==">
					<img src="<?=URL_BASE?>resources/imagens/quem-somos.png">
					<i class="fas fa-play"></i>
				</a>				
			</div>
		</div>
	</div>
</section>
<section class="call_to_action">
	<video autoplay muted loop>
		<source src="<?=URL_BASE?>resources/imagens/video-background.mp4" type="video/mp4">
	</video>
	<div class="container">
		<div class="conteudo">
			<h1>Somos uma instituição da família do xingu</h1>
			<a href="<?=URL_BASE?>donate" class="btn">Fazer Doação</a>
		</div>
	</div>
</section>
<section class="videos">
	<div class="container">	
		<div class="conteudo">
			<div class="texto">
				<h2 class="titulo center">Videos</h2>
				<div class="descricao center">
					<p>ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
				</div>
			</div>
			<div class="itens">
				<div class="item">
					<a href="#">
						<div class="img">
							<img src="<?=URL_BASE?>resources/imagens/videos.png">
						</div>
						<div class="informacoes">
							<h3 class="titulo">Ar condicionado</h3>
							<p class="btn">Saiba mais</p>
						</div>
					</a>
				</div>
				<div class="item">
					<a href="#">
						<div class="img">
							<img src="<?=URL_BASE?>resources/imagens/videos.png">
						</div>
						<div class="informacoes">
							<h3 class="titulo">Balanceamento</h3>
							<p class="btn">Saiba mais</p>
						</div>
					</a>
				</div>
				<div class="item">
					<a href="#">
						<div class="img">
							<img src="<?=URL_BASE?>resources/imagens/videos.png">
						</div>
						<div class="informacoes">
							<h3 class="titulo">Diagnostico de Motor</h3>
							<p class="btn">Saiba mais</p>
						</div>
					</a>
				</div>
				<div class="item">
					<a href="#">
						<div class="img">
							<img src="<?=URL_BASE?>resources/imagens/videos.png">
						</div>
						<div class="informacoes">
							<h3 class="titulo">Manutenção de Freios</h3>
							<p class="btn">Saiba mais</p>
						</div>
					</a>
				</div>
				<div class="item">
					<a href="#">
						<div class="img">
							<img src="<?=URL_BASE?>resources/imagens/videos.png">
						</div>
						<div class="informacoes">
							<h3 class="titulo">Lubrificação de Filtros</h3>
							<p class="btn">Saiba mais</p>
						</div>
					</a>
				</div>
				<div class="item">
					<a href="#">
						<div class="img">
							<img src="<?=URL_BASE?>resources/imagens/videos.png">
						</div>
						<div class="informacoes">
							<h3 class="titulo">Corrreias e Mangueiras</h3>
							<p class="btn">Saiba mais</p>
						</div>
					</a>
				</div>
				<div class="item">
					<a href="#">
						<div class="img">
							<img src="<?=URL_BASE?>resources/imagens/videos.png">
						</div>
						<div class="informacoes">
							<h3 class="titulo">Manutenção Preventiva</h3>
							<p class="btn">Saiba mais</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="contatoss" id="fale-comigo">
		<div class="container">
			<div class="conteudo">
				<div class="form">
					<h2 class="titulo center">Fale Conosco</h2>
					<form method="POST" action="<?=URL_BASE?>enviar-formulario">
						<input type="text" placeholder="Nome:" name="nome">
						<input type="text" placeholder="Telefone:(99) 99999-9999" name="telefone">
						<textarea name="mensagem" placeholder="Mensagem..."></textarea>
						<a href="#" class="btn">ENVIAR MENSAGEM</a>
				</div>
			</div>
		</div>
	</section>
<?=$this->fetch('commons/footer.php', $data)?>
