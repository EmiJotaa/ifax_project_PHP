<section class="noticia">
	<div class="container">
		<div class="conteudo">
			<div class="noticia-detalhe">
				<?php if (isset($data['informacoes']['noticiaDetalhe'])): ?>
				<h2 class="titulo"><?= $informacoes['noticiaDetalhe']['titulo'] ?></h2>
				<p class="data"><?= date('d/m/Y', strtotime($informacoes['noticiaDetalhe']['data_cadastro'])) ?> - Por: <?= $informacoes['noticiaDetalhe']['autor'] ?></p>
				<img src="<?= URL_BASE . $informacoes['noticiaDetalhe']['imagem_principal'] ?>">
				<div class="descricao">
					<?= $informacoes['noticiaDetalhe']['descricao'] ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="listagem">
				<div class="itens"> 
					<h2 class="titulo center">Ultimas Notícias</h2>
					<?php if (isset($data['informacoes']['listaNoticias'])): ?>
					    <?php 
					        usort($data['informacoes']['listaNoticias'], function($a, $b) {
					            return strtotime($b['data_cadastro']) - strtotime($a['data_cadastro']);
					        });
					        $noticias = array_slice($data['informacoes']['listaNoticias'], 0, 3);
					    ?>
					    <?php foreach ($noticias as $noticia): ?>
					        <div class="item">
					            <a href="<?= URL_BASE .'noticia/'. $noticia['url_amigavel'] ?>">
					                <div class="img">
					                    <img src="<?= URL_BASE . $noticia['imagem_principal'] ?>">
					                </div>
					                <div class="informacoes">
					                    <p class="data"><?= date('d/m/Y', strtotime($noticia['data_cadastro'])) ?></p>
					                    <h3 class="titulo"><?= $noticia['titulo'] ?></h3>
					                    <div class="descricao"><?= substr(strip_tags($noticia['descricao']), 0, 120) ?></div>
					                    <p class="btn">Ver Notícia</p>
					                </div>
					            </a>
					        </div> 
					    <?php endforeach; ?> 
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
