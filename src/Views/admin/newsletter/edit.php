<?=$this->fetch('commons/header.php', $data)?>
<main>
	<section class="dashboard">
		<div class="container">
			<div class="conteudo">
				<h2 class="titulo">
					<i class="far fa-envelope"></i>Newsletter - Editar
				</h2>
				<div class="form">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="campo title">
							<label>Título*</label>
							<input type="text" name="titulo" value="<?=$data['informacoes']['newsletter'][0]['titulo']?>" required>
						</div>
						<div class="campo data">
							<label>Data*</label>
							<input type="date" name="data" value="<?=explode(" ", $data['informacoes']['newsletter'][0]['data_cadastro'])[0]?>" required>
						</div>
						<div class="campo">
							<label>Autor*</label>
							<input type="text" name="autor" value="<?=$data['informacoes']['newsletter'][0]['autor']?>" required>
						</div>
						<div class="campo">
							<label>Descrição*</label>
							<textarea name="descricao" id="descricao" required><?=$data['informacoes']['newsletter'][0]['descricao']?></textarea>
						</div>
						<div class="campo">
							<label>Imagem Principal</label>
							<input type="file" name="imagem_principal" accept="image/*">
						</div>
						<div class="campo imagens">
							<div class="item">
								<img src="<?=URL_BASE?><?=$data['informacoes']['newsletter'][0]['imagem_principal']?>">
								<label>
									<input type="checkbox" name="excluir_imagem_principal" value="<?=$data['informacoes']['newsletter'][0]['imagem_principal']?>">
									Excluir Imagem
								</label>
							</div>
						</div>
						<div class="campo">
							<input type="submit" value="Salvar" class="btn">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</main>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace('descricao')
</script>
<?=$this->fetch('commons/footer.php', $data)?>