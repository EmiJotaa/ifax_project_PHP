<section class="projetos">
	<div class="container">	
		<div class="conteudo">
			<div class="texto">
				<h2 class="titulo center">Projetos</h2>
			</div>
			<div class="itens">
				<?php if (isset($data['informacoes']['listaProjetos'])): ?>
					<?php
					    usort($data['informacoes']['listaProjetos'], function($a, $b) {
					        return strtotime($b['data_cadastro']) - strtotime($a['data_cadastro']);
					    });
					?>
					<?php foreach ($data['informacoes']['listaProjetos'] as $projeto): ?>
						<div class="item">
							<a href="<?=URL_BASE.'projeto/'.$projeto['url_amigavel']?>">
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