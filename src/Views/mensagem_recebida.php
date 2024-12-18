<?=$this->fetch('commons/header.php', $data)?>
<?=$this->fetch('commons/caminho.php', $data)?>
<section class="mensagem-recebida">
	<div class="container">
		<div class="conteudo">
			<h1>Mensagem recebida!</h1>
			<p>Sua mensagem foi recebida com sucesso, em breve nosso time entrará em contato com você. Obrigado!</p>
			<a class="btn" href="<?=URL_BASE?>">VOLTAR PARA HOME</a>
		</div>
	</div>
</section>
<?=$this->fetch('commons/footer.php', $data)?>