<?=$this->fetch('commons/header.php', $data)?>
<main>
	<section class="dashboard">
		<div class="container">
			<div class="conteudo">
				<h2 class="titulo">
					<i class="fas fa-users"></i>Newsletter - Nova Assinatura
				</h2>
				<div class="form">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="campo title">
							<label>Nome*</label>
							<input type="text" name="nome" required>
						</div>
						<div class="campo data">
							<label>Data*</label>
							<input type="date" name="data" required>
						</div>
						<div class="campo">
							<label>Email*</label>
							<input type="email" name="email" required>
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