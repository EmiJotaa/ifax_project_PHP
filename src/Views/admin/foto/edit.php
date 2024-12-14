<?=$this->fetch('commons/header.php', $data)?>
<main>
	<section class="dashboard">
		<div class="container">
			<div class="conteudo">
				<h2 class="titulo">
					<i class="far fa-image"></i>Fotos - Editar
				</h2>
				<div class="form">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="campo title">
							<label>Título*</label>
							<input type="text" name="titulo" value="<?=$data['informacoes']['foto'][0]['titulo']?>" required>
						</div>
						<div class="campo data">
							<label>Data*</label>
							<input type="date" name="data" value="<?=explode(" ", $data['informacoes']['foto'][0]['data_cadastro'])[0]?>" required>
						</div>
						<div class="campo">
							<label>Imagem Principal</label>
							<input type="file" name="imagem_principal" accept="image/*">
						</div>
						<div class="campo imagens">
							<div class="item">
								<img src="<?=URL_BASE?><?=$data['informacoes']['foto'][0]['imagem_principal']?>">
								<label>
									<input type="checkbox" name="excluir_imagem_principal" value="<?=$data['informacoes']['foto'][0]['imagem_principal']?>">
									Excluir Imagem
								</label>
							</div>
						</div>
						<div class="campo">
							<label>Ativo*</label>
							<select name="ativo" required>
								<option value="s" <?=($data['informacoes']['foto'][0]['status'] === 's') ? 'selected' : '' ?> >Sim</option>
								<option value="n" <?=($data['informacoes']['foto'][0]['status'] === 'n') ? 'selected' : '' ?> >Não</option>
							</select>
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
<?=$this->fetch('commons/footer.php', $data)?>