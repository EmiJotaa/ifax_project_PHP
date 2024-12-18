<section class="videos">
	<div class="container">	
		<div class="conteudo">
			<div class="texto">
				<h2 class="titulo center">Videos</h2>
			</div>
			<div class="itens">
				<?php if (isset($data['informacoes']['listaVideos'])): ?>
					<?php foreach ($data['informacoes']['listaVideos'] as $video): ?>
						<div class="item">
							<a class="swipebox-video" rel="youtube" href="<?=URL_BASE.$video['link_youtube']?>">
								<div class="img">
									<img src="<?=URL_BASE.$video['imagem_principal']?>">
								</div>
							</a>
						</div>
					<?php endforeach ?>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>