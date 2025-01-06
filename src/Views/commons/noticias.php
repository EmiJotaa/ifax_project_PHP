<section class="noticias">
	<div class="container">	
		<div class="conteudo">
			<div class="texto">
				<h2 class="titulo center">Notícias</h2>
			</div>
			<div class="itens">
				<?php if (isset($data['informacoes']['listaNoticias'])): ?>
					<?php
					    usort($data['informacoes']['listaNoticias'], function($a, $b) {
					        return strtotime($b['data_cadastro']) - strtotime($a['data_cadastro']);
					    });
					?>
					<?php foreach ($data['informacoes']['listaNoticias'] as $noticia): ?>
						<div class="item">
							<a href="<?=URL_BASE.'noticia/'.$noticia['url_amigavel']?>">
								<div class="img">
									<img src="<?=URL_BASE.$noticia['imagem_principal']?>">
								</div>
								<div class="informacoes">
									<p class="data"><?= date('d/m/Y', strtotime($noticia['data_cadastro']))?></p>						
									<h3 class="titulo"><?=$noticia['titulo']?></h3>
									<div class="descricao"><?=substr(strip_tags($noticia['descricao']), 0, 120) ?></div>
									<p class="btn">Ver Notícia</p>
								</div>
							</a>
						</div> 
					<?php endforeach ?> 
				<?php endif ?>				 
			</div>
		</div>
	</div>
</section>