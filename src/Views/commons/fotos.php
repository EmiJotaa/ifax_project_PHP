<section class="fotos">
	<div class="container">	
		<div class="conteudo">
			<div class="texto">
				<h2 class="titulo center">Fotos</h2>
			</div>
			<div class="itens">
				<?php if (isset($data['informacoes']['listaFotos'])): ?>
					<?php foreach ($data['informacoes']['listaFotos'] as $foto): ?>
						<div class="item">
							<a href="<?=URL_BASE.$foto['imagem_principal']?>" class="swipebox" title="<?=$foto['titulo']?>">
								<div class="img">
									<img src="<?=URL_BASE.$foto['imagem_principal']?>">
								</div>
							</a>
						</div>
					<?php endforeach ?>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>