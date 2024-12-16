<section class="projetos">
	<div class="container">	
		<div class="conteudo">
			<div class="texto">
				<h2 class="titulo center">Projetos</h2>
				<div class="descricao center">
					<p>ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</p>
				</div>
			</div>
			<div class="itens">
				<?php if (isset($data['informacoes']['listaProjetos'])): ?>
					<?php foreach ($data['informacoes']['listaProjetos'] as $projeto): ?>
						<div class="item">
							<a href="<?=URL_BASE.$projeto['url_amigavel']?>">
								<div class="img">
									<img src="<?=URL_BASE.$projeto['imagem_principal']?>">
								</div>
								<div class="informacoes">
									<p class="data"><?= date('d/m/Y', strtotime($projeto['data_cadastro']))?></p>						
									<h3 class="titulo"><?=$projeto['titulo']?></h3>
									<div class="descricao"><?=substr(strip_tags($projeto['descricao']), 0, 120) ?></div>
									<p class="btn">Ver Projeto</p>
								</div>
							</a>
						</div>
					<?php endforeach ?>
				<?php endif ?>
								
			</div>
		</div>
	</div>
</section>