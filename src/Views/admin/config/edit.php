<?=$this->fetch('commons/header.php', $data)?>
<main>
	<section class="dashboard">
		<div class="container">
			<div class="conteudo">
				<h2 class="titulo">
					<i class="fas fa-gears"></i>Configurações - Editar
				</h2>
				<div class="form">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="campo">
							<label>Nome*</label>
							<input type="text" name="nome" value="<?=$data['informacoes']['config'][0]['nome']?>" required>
						</div>
						<div class="campo">
							<label>Valor*</label>
							<input type="text" name="valor" value="<?= (file_exists($data['informacoes']['config'][0]['valor'])) ? '' : $data['informacoes']['config'][0]['valor']?>">
						</div>
						<p>Ou</p>
						<div class="campo">
							<label>Imagem</label>
							<input type="file" name="valor" accept="image/*">
						</div>
						<?php if (file_exists($data['informacoes']['config'][0]['valor'])): ?>
							<div class="campo imagens">
								<div class="item">
									<img src="<?=URL_BASE?><?=$data['informacoes']['config'][0]['valor']?>">
									<label>
										<input type="checkbox" name="excluir_valor" value="<?=$data['informacoes']['config'][0]['valor']?>">
										Excluir Imagem
									</label>
								</div>
							</div>
						<?php endif ?>
						<div class="campo">
							<input type="submit" value="Salvar" class="btn">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</main>
<?=$this->fetch('commons/footer.php', $data)?>