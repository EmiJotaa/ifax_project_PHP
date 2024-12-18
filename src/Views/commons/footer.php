	<footer>
		<div class="principal">
			<div class="container">
				<div class="conteudo">
					<div class="logo">
						<a href="<?=URL_BASE?>">
                        	<img src="<?=URL_BASE?>resources/imagens/logo.png">
                    	</a>
                    	<p class="descricao">Desde 2020, a IFAX atua no apoio de formação dos brigadistas indígenas e na conscientização das aldeias xinguanas quanto ao manejo do fogo e prevenção de incêndios.</p>
                    	<div class="redes-sociais">
                        	<?php if ($data['config']['rede_social_facebook']): ?>
	                            <a href="<?=$data['config']['rede_social_facebook']?>" target="_blank">
	                                <i class="fab fa-facebook-f"></i>
	                            </a>      
	                        <?php endif ?>
	                        <?php if ($data['config']['rede_social_instagram']): ?>
	                            <a href="<?=$data['config']['rede_social_instagram']?>" target="_blank">
	                                <i class="fab fa-instagram"></i>
	                            </a>
	                        <?php endif ?>
	                        <?php if ($data['config']['rede_social_youtube']): ?>
	                            <a href="<?=$data['config']['rede_social_youtube']?>" target="_blank">
	                                <i class="fab fa-youtube"></i>
	                            </a>
	                        <?php endif ?> 
                    	</div>
                    </div>
                    <div class="menu">
                    	<h3 class="titulo">Institucional</h3>
                    	<nav>
                    		<a href="<?=URL_BASE?>">
                    			<i class="fas fa-chevron-right"></i>Home               				
                    		</a>
                    		<a href="<?=URL_BASE?>quem-somos">
                    			<i class="fas fa-chevron-right"></i>Quem Somos  				
                    		</a>
                    		<a href="<?=URL_BASE?>noticias">
                    			<i class="fas fa-chevron-right"></i>Notícias  				
                    		</a>
                    		<a href="<?=URL_BASE?>donate">
                    			<i class="fas fa-chevron-right"></i>Fazer uma Doação     			
                    		</a>
                    		<a href="<?=URL_BASE?>projetos">
                    			<i class="fas fa-chevron-right"></i>Projetos     			
                    		</a>
                    		<a href="<?=URL_BASE?>midias">
                    			<i class="fas fa-chevron-right"></i>Galeria          				
                    		</a>
                    		<a href="<?=URL_BASE?>fale-conosco">
                    			<i class="fas fa-chevron-right"></i>Fale Conosco	
                    		</a>
                    		
                    	</nav>
                    </div>
                    <div class="contatos">
                    	<h3 class="titulo">Contatos</h3>
                    	<?php if ($data['config']['contato_telefone']): ?>
	                    	<div class="item">
	                    		<div class="icone">
	                    			<i class="fas fa-mobile-screen"></i>
	                    		</div>
	                    		<div class="info">
	                    			<h4>Telefone:</h4>
	                    			<a href="tel:<?=$data['config']['contato_telefone']?>"><?=$data['config']['contato_telefone']?></a>
	                    		</div>
	                    	</div>
	                    <?php endif ?> 
	                    <?php if ($data['config']['contato_email']): ?>
	                    	<div class="item">
	                    		<div class="icone">
	                    			<i class="far fa-envelope"></i>
	                    		</div>
	                    		<div class="info">
	                    			<h4>E-mail</h4>
	                    			<a href="mailto:<?=$data['config']['contato_email']?>"><?=$data['config']['contato_email']?></a>
	                    		</div>
	                    	</div>
                    	<?php endif ?>
                    	<?php if ($data['config']['contato_endereco']): ?>
	                    	<div class="item">
	                    		<div class="icone">
	                    			<i class="fas fa-location-dot"></i>
	                    		</div>
	                    		<div class="info">
	                    			<h4>Endereço</h4>
	                    			<a><?=$data['config']['contato_endereco']?></a>
	                    		</div>
	                    	</div>
                    	<?php endif ?>
                    </div>
                </div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<div class="conteudo">
					<p>Todos direitos reservados © 2024</p>
					<p>Desenvolvido por <a href="https://www.instagram.com/marquin.do.som/" target="_blank">Marquin.Do.Som<a href="https://www.instagram.com/marquin.do.som/" target="_blank"><i class="fab fa-instagram"></i></a></p>
				</div>
			</div>
		</div>
	</footer>
    <script src="<?=URL_BASE?>resources/js/jquery/jquery.min.js"></script>
    <script src="<?=URL_BASE?>resources/js/slick.min.js"></script>
    <script src="<?=URL_BASE?>resources/js/jquery.swipebox.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LfIgZ8qAAAAABbnHbfvf96QDqB0RfsbsgoLx_sm"></script>
	<script src="<?=URL_BASE?>resources/js/js.js"></script>
</body>
</html>