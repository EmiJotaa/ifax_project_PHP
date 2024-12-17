<section class="projeto">
	<div class="container">
		<div class="conteudo">
			<?php if (isset($data['informacoes']['projetoDetalhe'])): ?>

			<img src="<?= URL_BASE . $informacoes['projetoDetalhe']['imagem_principal'] ?>">
			<h2 class="titulo"><?= $informacoes['projetoDetalhe']['titulo'] ?></h2>
			<div class="descricao">
				<?= $informacoes['projetoDetalhe']['descricao'] ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
