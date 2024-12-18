<section class="fale-conosco">
	<div class="container">
		<div class=" conteudo">
			<div class="form">
				<h2 class="titulo">Nos envie uma mensagem...</h2>
				<p>Preencha o formulário:</p>
				<form action="https://formsubmit.co/mrcez4rr@gmail.com" class="form-ajax" method="POST" enctype="multpart/form-data">
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
					<input type="hidden" name="_captcha" value="false">
					<input type="hidden" name="_next" value="<?=URL_BASE?>mensagem-recebida">
					<div class="campo botao">
						<button type="submit" name="enviar" class="btn">Enviar Mensagem</button>
					</div>
				</form>
				<script>
					grecaptcha.ready(function() {
				    	grecaptcha.execute('6LfIgZ8qAAAAABbnHbfvf96QDqB0RfsbsgoLx_sm', { action: 'submit' }).then(function(token) {
				    	document.getElementById('recaptcha_token').value = token;
				    });
				  });
				</script>

				<?php
					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					    $recaptcha_secret = '6LfIgZ8qAAAAAOPCqjV9kvw9vFIDAkOT_FtYG_ll';  // Substitua pela sua chave secreta
					    $recaptcha_token = $_POST['recaptcha_token'];

					    // Verifica o token com a API do Google
					    $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $recaptcha_secret . '&response=' . $recaptcha_token);
					    $response_keys = json_decode($response, true);

					    if (intval($response_keys['success']) !== 1) {
					        echo 'Verificação do reCAPTCHA falhou, tente novamente.';
					    } else {
					        echo 'ReCAPTCHA validado com sucesso!';
					        // Aqui você pode continuar com o processamento do formulário
					    }
					}
				?>
			</div>			
		</div>
	</div>
</section>