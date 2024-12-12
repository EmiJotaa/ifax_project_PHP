<?=$this->fetch('commons/header.php', $data)?>
<section class="donate">
	<div class="container">
		<div class="conteudo">
			<h1>Doar via PayPal para</h1> 
			<h1>Instituto da família do Alto Xingu</h1>
			<p>Fortalecimento do brigadista Indígena</p>
			<div class="qrcode">
				<img src="<?=URL_BASE?>resources/imagens/qrcode.jpg">
			</div>
			<div class="btn-donate">
				<form action="https://www.paypal.com/donate" method="post" target="_blank">
					<input type="hidden" name="hosted_button_id" value="SZ6BTQLKWT9WL" />
					<input type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Faça doações com o botão do PayPal" />
					<img alt="" border="0" src="https://www.paypal.com/pt_BR/i/scr/pixel.gif" width="1" height="1" />
				</form>
			</div>
		</div>
	</div>
</section>
<?=$this->fetch('commons/footer.php', $data)?>