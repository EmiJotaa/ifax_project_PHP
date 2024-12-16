<?=$this->fetch('commons/header.php', $data)?>
<main>
	<section class="dashboard">
		<div class="container">
			<div class="conteudo">
				<h2 class="titulo">
					<i class="fas fa-gears"></i>Configurações - Novo
				</h2>
				<div class="form">
					<form action="#" method="POST" enctype="multipart/form-data">
						<div class="campo">
							<label>Nome*</label>
							<input type="text" name="nome" required>
						</div>
						<div class="campo">
							<label>Valor</label>
							<input type="text" name="valor">
						</div>
						<p>Ou</p>
						<div class="campo">
							<label>Imagem</label>
							<input type="file" name="valor" accept="image/*">
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