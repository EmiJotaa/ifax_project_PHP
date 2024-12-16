<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>

    <meta name="title" content="">
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="robots" content="index, follow">
    <meta name="url" content="<?=URL_BASE?>" />
    
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:site_name" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?=URL_BASE?>" />
    <meta property="og:image" content="" />
    <meta property="og:image:alt" content="" />

    <link rel="icon" href="" type="image/x-icon">
    <link rel="shortcut icon" href="" type="image/x-icon" />

    <title>Instituto da família do Alto Xingu</title>

    <link href="<?=URL_BASE?>resources/css/slick.css?" rel="stylesheet"/>
    <link href="<?=URL_BASE?>resources/css/swipebox.css?" rel="stylesheet"/>
    <link href="<?=URL_BASE?>resources/css/slick-theme.css?" rel="stylesheet"/>
    <link href="<?=URL_BASE?>resources/css/css.css?v=<?=time()?>" rel="stylesheet"/>
<body>
	<header>
        <div class="container">
            <div class="conteudo">
                <div class="topo">
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
                    <div class="contatos">
                        <?php if ($data['config']['contato_telefone']): ?>
                            <a href="tel:<?=$data['config']['contato_telefone']?>">
                                <i class="fas fa-mobile-screen-button"></i>
                                <?=$data['config']['contato_telefone']?>
                            </a>
                        <?php endif ?>
                        <?php if ($data['config']['contato_email']): ?>
                            <a href="mailto:<?=$data['config']['contato_email']?>">
                                <i class="far fa-envelope"></i>
                                <?=$data['config']['contato_email']?>
                            </a>
                        <?php endif ?>
                    </div>
                </div>
                <div class="logo">
                    <a href="<?=URL_BASE?>">
                        <img src="<?=URL_BASE.$data['config']['logo']?>">
                    </a>
                </div>
                <div class="menu">
                    <nav>
                        <a href="<?=URL_BASE?>">Home</a>
                        <a href="<?=URL_BASE?>quem-somos">Quem Somos</a>
                        <a href="<?=URL_BASE?>noticias">Notícias</a>
                        <a href="<?=URL_BASE?>donate">Doação</a>
                        <a href="<?=URL_BASE?>projetos">Projetos</a>
                        <a href="<?=URL_BASE?>midias">Galeria</a>
                        <a href="<?=URL_BASE?>fale-conosco">Fale Conosco</a>
                    </nav>
                    <a href="#" class="btn-nav">
                        <i class="fas fa-bars-staggered"></i>
                    </a>
                </div>
            </div>
        </div>
	</header>