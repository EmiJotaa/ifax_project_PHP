<section class="galery">
	<div class="container">	
		<div class="conteudo">
			<div class="texto">
				<h2 class="titulo center">Galeria da Notícia</h2>
			</div>
			<div class="itens">
				<?php if (isset($data['informacoes']['listaNoticias'])): ?>
					<?php foreach ($data['informacoes']['listaGaleria'] as $galeria): ?>
						<div class="item">
							<a href="<?=URL_BASE.$galeria['caminho']?>" class="swipebox" title="Galeria do Projeto">
								<div class="img">
									<img src="<?=URL_BASE.$galeria['caminho']?>">
								</div>
							</a>
						</div>
					<?php endforeach ?> 
				<?php endif ?>
			</div>
		</div>
	</div>
</section>