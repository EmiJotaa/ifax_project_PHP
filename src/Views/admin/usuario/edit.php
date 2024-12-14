<?=$this->fetch('commons/header.php', $data)?>
<main>
	<section class="dashboard">
		<div class="container">
			<div class="conteudo">
				<h2 class="titulo">
					<i class="fas fa-user"></i>Usuarios - Editar
				</h2>
				<div class="form">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="campo title">
							<label>Nome*</label>
							<input type="text" name="nome" value="<?=$data['informacoes']['usuario'][0]['nome']?>" required>
						</div>
						<div class="campo data">
							<label>Data*</label>
							<input type="date" name="data" value="<?=explode(" ", $data['informacoes']['usuario'][0]['data_cadastro'])[0]?>" required>
						</div>
						<div class="campo">
							<label>Email*</label>
							<input type="email" name="email" value="<?=$data['informacoes']['usuario'][0]['email']?>" required>
						</div>
						<div class="campo">
							<label>Senha*</label>
							<input type="password" name="senha" required>
						</div>
						<div class="campo">
							<label>Foto</label>
							<input type="file" name="foto" accept="image/*">
						</div>
						<div class="campo imagens">
							<div class="item">
								<img src="<?=URL_BASE?><?=$data['informacoes']['usuario'][0]['foto']?>">
								<label>
									<input type="checkbox" name="excluir_foto" value="<?=$data['informacoes']['usuario'][0]['foto']?>">
									Excluir Imagem
								</label>
							</div>
						</div>
						<div class="campo">
							<label>Ativo*</label>
							<select name="ativo" required>
								<option value="s" <?=($data['informacoes']['usuario'][0]['status'] === 's') ? 'selected' : '' ?> >Sim</option>
								<option value="n" <?=($data['informacoes']['usuario'][0]['status'] === 'n') ? 'selected' : '' ?> >Não</option>
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