<?php
session_start(); // Inicia a sessão para acessar os dados
$erros = $_SESSION['erros'] ?? [];
$dados = $_SESSION['dados'] ?? [];
unset($_SESSION['erros'], $_SESSION['dados']); // Limpa os dados da sessão após exibição
?>
<section class="fale-conosco">
	<div class="container">
		<div class=" conteudo">
			<?php if (!empty($erros)): ?>
		        <div style="color: red;">
		            <ul>
		                <?php foreach ($erros as $erro): ?>
		                    <li><?= htmlspecialchars($erro) ?></li>
		                <?php endforeach; ?>
		            </ul>
		        </div>
		    <?php endif; ?>
			<div class="form">
				<h2 class="titulo">Nos envie uma mensagem...</h2>
				<p>Preencha o formulário:</p>
				<form action="postModelo.php" class="form-ajax" method="POST" enctype="multipart/form-data">
					<div class="campo nome">
						<input type="text" name="Nome" placeholder="Nome" required>
					</div>
					<div class="campo telefone">
						<input type="text" name="Telefone" placeholder="Telefone" required>
					</div>
					<div class="campo email">
						<input type="text" name="Email" placeholder="E-mail" required>
					</div>
					<div class="campo assunto">
						<input type="text" name="Assunto" placeholder="Assunto" required>
					</div>
					<div class="campo mensagem">
						<p>Descreva abaixo:</p>
						<textarea name="Message" placeholder="Mensagem" required></textarea>
					</div>
					<div class="newsletter">
				        <label>
				            <input type="checkbox" name="salvar_email_newsletter" value="1">
				            Desejo receber novidades no meu e-mail.
				        </label>
				    </div>
				    <?php if (isset($_GET['erro']) && $_GET['erro'] == 'email_ja_cadastrado'): ?>
					    <p style="color: red;">Este E-mail já está cadastrado! Desmarque e prossiga com a mensagem.</p>
					<?php endif; ?>
				    <?php if (isset($_GET['erro']) && $_GET['erro'] == 'campos_vazios'): ?>
					    <p style="color: red;">Por favor, preencha todos os campos com dados válidos!</p>
					<?php endif; ?>
					<div class="campo botao">
						<button type="submit" name="enviar" class="btn">
							<h3>Enviar Mensagem</h3>
							<div class="loader"></div>
						</button>
					</div>
				</form>
				<!-- <script>
					grecaptcha.ready(function() {
				    	grecaptcha.execute('6Lc2ZqAqAAAAAMMZzHehIFA4elAOxPpgXErL4VGr', { action: 'submit' }).then(function(token) {
				    	document.getElementById('recaptcha_token').value = token;
				    });
				  });
				</script> -->

				<?php
					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					    $recaptcha_secret = '';  // Substitua pela sua chave secreta
					    $recaptcha_token = $_POST['recaptcha_token'];

					    // Verifica o token com a API do Google
					    $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $recaptcha_secret . '&response=' . $recaptcha_token);
					    $response_keys = json_decode($response, true);

					    if (intval($response_keys['success']) !== 1) {
					        echo 'Verificação do reCAPTCHA falhou, tente novamente.';
					    } else {
					        echo 'ReCAPTCHA validado com sucesso!';
					    }
					}
				?>
			</div>			
		</div>
	</div>
</section>