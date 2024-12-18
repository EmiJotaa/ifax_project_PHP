<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Model\Config;
use App\Model\Noticia;
use App\Model\Projeto;
use App\Model\Foto;
use App\Model\Video;
use App\Model\Galeria;
use App\Model\Galeria1;

final class HomeController
{
    public function home(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {

        $noticia = new Noticia();
        $listaNoticias = $noticia->selectNoticia('*', array('status' => 's'));

        $projeto = new Projeto();
        $listaProjetos = $projeto->selectProjeto('*', array('status' => 's'));

        $foto = new Foto();
        $listaFotos = $foto->selectFoto('*', array('status' => 's'));

        $video = new Video();
        $listaVideos = $video->selectVideo('*', array('status' => 's'));

        $data['informacoes'] = array(
            'titleHeader' => 'Instituto da família do Alto Xingu',
            'listaNoticias' => $listaNoticias,
            'listaProjetos' => $listaProjetos,
            'listaFotos' => $listaFotos,
            'listaVideos' => $listaVideos
        );

        $data['config'] = array(
            'logo' => Config::getConfig('logo'),
            'nome_site' => Config::getConfig('nome_site'),
            'rede_social_youtube' => Config::getConfig('rede_social_youtube'),
            'rede_social_instagram' => Config::getConfig('rede_social_instagram'),
            'rede_social_facebook' => Config::getConfig('rede_social_facebook'),
            'contato_endereco' => Config::getConfig('contato_endereco'),
            'contato_email' => Config::getConfig('contato_email'),
            'contato_telefone' => Config::getConfig('contato_telefone'),
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "home.php", $data);
    }

    public function quem_somos(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $data['informacoes'] = array(
            'titleHeader' => 'Quem Somos - Instituto da família do Alto Xingu',
            'title' => 'Quem Somos - Instituto da família do Alto Xingu',
            'caminho' => array(
                [
                    'link' => 'quem-somos',
                    'nome' => '- Quem Somos'
                ]
            )
        );
        $data['config'] = array(
            'logo' => Config::getConfig('logo'),
            'nome_site' => Config::getConfig('nome_site'),
            'rede_social_youtube' => Config::getConfig('rede_social_youtube'),
            'rede_social_instagram' => Config::getConfig('rede_social_instagram'),
            'rede_social_facebook' => Config::getConfig('rede_social_facebook'),
            'contato_endereco' => Config::getConfig('contato_endereco'),
            'contato_email' => Config::getConfig('contato_email'),
            'contato_telefone' => Config::getConfig('contato_telefone'),
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "quem_somos2.php", $data);
    }

    public function noticias(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $noticia = new Noticia();
        $listaNoticias = $noticia->selectNoticia('*', array('status' => 's'));

        $data['informacoes'] = array(
            'titleHeader' => 'Notícias - Instituto da família do Alto Xingu',
            'listaNoticias' => $listaNoticias,
            'title' => 'Notícias - Instituto da família do Alto Xingu',
            'caminho' => array(
                [
                    'link' => 'noticias',
                    'nome' => '- Notícias'
                ]
            )
        );
        $data['config'] = array(
            'logo' => Config::getConfig('logo'),
            'nome_site' => Config::getConfig('nome_site'),
            'rede_social_youtube' => Config::getConfig('rede_social_youtube'),
            'rede_social_instagram' => Config::getConfig('rede_social_instagram'),
            'rede_social_facebook' => Config::getConfig('rede_social_facebook'),
            'contato_endereco' => Config::getConfig('contato_endereco'),
            'contato_email' => Config::getConfig('contato_email'),
            'contato_telefone' => Config::getConfig('contato_telefone'),
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "noticias.php", $data);
    }

    public function donate(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $data['informacoes'] = array(
            'titleHeader' => 'Faça uma doação - Instituto da família do Alto Xingu',
            'title' => 'Faça uma doação - Instituto da família do Alto Xingu',
            'caminho' => array(
                [
                    'link' => 'donate',
                    'nome' => '- Faça uma doação'
                ]
            )
        );
        $data['config'] = array(
            'logo' => Config::getConfig('logo'),
            'nome_site' => Config::getConfig('nome_site'),
            'rede_social_youtube' => Config::getConfig('rede_social_youtube'),
            'rede_social_instagram' => Config::getConfig('rede_social_instagram'),
            'rede_social_facebook' => Config::getConfig('rede_social_facebook'),
            'contato_endereco' => Config::getConfig('contato_endereco'),
            'contato_email' => Config::getConfig('contato_email'),
            'contato_telefone' => Config::getConfig('contato_telefone'),
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "donate.php", $data);
    }

    public function projetos(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $projeto = new Projeto();
        $listaProjetos = $projeto->selectProjeto('*', array('status' => 's'));

        $data['informacoes'] = array(
            'titleHeader' => 'Projetos - Instituto da família do Alto Xingu',
            'listaProjetos' => $listaProjetos,
            'title' => 'Projetos - Instituto da família do Alto Xingu',
            'caminho' => array(
                [
                    'link' => 'projetos',
                    'nome' => '- Projetos'
                ]
            )
        );
        $data['config'] = array(
            'logo' => Config::getConfig('logo'),
            'nome_site' => Config::getConfig('nome_site'),
            'rede_social_youtube' => Config::getConfig('rede_social_youtube'),
            'rede_social_instagram' => Config::getConfig('rede_social_instagram'),
            'rede_social_facebook' => Config::getConfig('rede_social_facebook'),
            'contato_endereco' => Config::getConfig('contato_endereco'),
            'contato_email' => Config::getConfig('contato_email'),
            'contato_telefone' => Config::getConfig('contato_telefone'),
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "projetos.php", $data);
    }

    public function midias(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $foto = new Foto();
        $listaFotos = $foto->selectFoto('*', array('status' => 's'));

        $video = new Video();
        $listaVideos = $video->selectVideo('*', array('status' => 's'));

        $data['informacoes'] = array(
            'titleHeader' => 'Galeria - Instituto da família do Alto Xingu ',
            'listaFotos' => $listaFotos,
            'listaVideos' => $listaVideos,
            'title' => 'Galeria - Instituto da família do Alto Xingu',
            'caminho' => array(
                [
                    'link' => 'galeria',
                    'nome' => '- Galeria'
                ]
            )
        );
        $data['config'] = array(
            'logo' => Config::getConfig('logo'),
            'nome_site' => Config::getConfig('nome_site'),
            'rede_social_youtube' => Config::getConfig('rede_social_youtube'),
            'rede_social_instagram' => Config::getConfig('rede_social_instagram'),
            'rede_social_facebook' => Config::getConfig('rede_social_facebook'),
            'contato_endereco' => Config::getConfig('contato_endereco'),
            'contato_email' => Config::getConfig('contato_email'),
            'contato_telefone' => Config::getConfig('contato_telefone'),
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "midias.php", $data);
    }

    public function fale_conosco(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $data['informacoes'] = array(
            'titleHeader' => 'Fale Conosco - Instituto da família do Alto Xingu',
            'title' => 'Fale Conosco - Instituto da família do Alto Xingu',
            'caminho' => array(
                [
                    'link' => 'fale-conosco',
                    'nome' => '- Fale Conosco'
                ]
            )
        );
        $data['config'] = array(
            'logo' => Config::getConfig('logo'),
            'nome_site' => Config::getConfig('nome_site'),
            'rede_social_youtube' => Config::getConfig('rede_social_youtube'),
            'rede_social_instagram' => Config::getConfig('rede_social_instagram'),
            'rede_social_facebook' => Config::getConfig('rede_social_facebook'),
            'contato_endereco' => Config::getConfig('contato_endereco'),
            'contato_email' => Config::getConfig('contato_email'),
            'contato_telefone' => Config::getConfig('contato_telefone'),
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "fale_conosco.php", $data);
    }

        public function noticia_detalhe(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $slug = $args['any'];
        $noticia = new Noticia();
        $listaNoticias = $noticia->selectNoticia('*', array('status' => 's'));

        $noticiaDetalhe = null;
        foreach ($listaNoticias as $noticiaItem) {
            if ($noticiaItem['url_amigavel'] == $slug) {
                $noticiaDetalhe = $noticiaItem;
                break; 
            }
        }
        if ($noticiaDetalhe === null) {
            return $response->withHeader('Location', '/ifax/noticias')->withStatus(302);
        }

        $galeria = new Galeria1();
        $listaGaleria = $galeria->selectGaleria('*', array('id_noticia' => $noticiaDetalhe['id']));
        
        $data['informacoes'] = array(
            'titleHeader' => 'Noticias - Instituto da família do Alto Xingu',
            'listaNoticias' => $listaNoticias,
            'listaGaleria' => $listaGaleria,
            'noticiaDetalhe' => $noticiaDetalhe,            
            'title' => $noticiaDetalhe['titulo'] . ' - Instituto da família do Alto Xingu',
            'caminho' => array(
                [
                    'link' => 'noticias',
                    'nome' => '- Noticia'
                ],
                [
                    'link' => 'noticia/' . urlencode($noticiaDetalhe['url_amigavel']),
                    'nome' => ' - ' .$noticiaDetalhe['titulo']
                ]
            )
        );
        $data['config'] = array(
            'logo' => Config::getConfig('logo'),
            'nome_site' => Config::getConfig('nome_site'),
            'rede_social_youtube' => Config::getConfig('rede_social_youtube'),
            'rede_social_instagram' => Config::getConfig('rede_social_instagram'),
            'rede_social_facebook' => Config::getConfig('rede_social_facebook'),
            'contato_endereco' => Config::getConfig('contato_endereco'),
            'contato_email' => Config::getConfig('contato_email'),
            'contato_telefone' => Config::getConfig('contato_telefone'),
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "noticia.php", $data);
    }

    public function projeto_detalhe(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $slug = $args['any'];
        $projeto = new Projeto();
        $listaProjetos = $projeto->selectProjeto('*', array('status' => 's'));

        $projetoDetalhe = null;
        foreach ($listaProjetos as $projetoItem) {
            if ($projetoItem['url_amigavel'] == $slug) {
                $projetoDetalhe = $projetoItem;
                break; 
            }
        }

        if ($projetoDetalhe === null) {
            return $response->withHeader('Location', '/ifax/projetos')->withStatus(302);
        }   

        $galeria = new Galeria();
        $listaGaleria = $galeria->selectGaleria('*', array('id_projeto' => $projetoDetalhe['id'])); 

        $data['informacoes'] = array(
            'titleHeader' => 'Projetos - Instituto da família do Alto Xingu',
            'listaProjetos' => $listaProjetos,
            'listaGaleria' => $listaGaleria,
            'projetoDetalhe' => $projetoDetalhe,
            'title' => $projetoDetalhe['titulo'] .' - Instituto da família do Alto Xingu',
            'caminho' => array(
                [
                    'link' => 'projetos',
                    'nome' => '- Projetos'
                ],
                [
                    'link' => 'projeto/' . urlencode($projetoDetalhe['url_amigavel']),
                    'nome' => ' - ' . $projetoDetalhe['titulo']
                ]
            )
        );
        $data['config'] = array(
            'logo' => Config::getConfig('logo'),
            'nome_site' => Config::getConfig('nome_site'),
            'rede_social_youtube' => Config::getConfig('rede_social_youtube'),
            'rede_social_instagram' => Config::getConfig('rede_social_instagram'),
            'rede_social_facebook' => Config::getConfig('rede_social_facebook'),
            'contato_endereco' => Config::getConfig('contato_endereco'),
            'contato_email' => Config::getConfig('contato_email'),
            'contato_telefone' => Config::getConfig('contato_telefone'),
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "projeto.php", $data);
    }

    public function mensagem_recebida(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {

        $data['informacoes'] = array(
            'titleHeader' => 'Mensagem Recebida - Instituto da família do Alto Xingu',
            'title' => 'Mensagem Recebida - Instituto da família do Alto Xingu',
            'caminho' => array(
                [
                    'link' => 'mensagem-recebida',
                    'nome' => '- Mensagem Recebida'
                ]
            )
        );
        $data['config'] = array(
            'logo' => Config::getConfig('logo'),
            'nome_site' => Config::getConfig('nome_site'),
            'rede_social_youtube' => Config::getConfig('rede_social_youtube'),
            'rede_social_instagram' => Config::getConfig('rede_social_instagram'),
            'rede_social_facebook' => Config::getConfig('rede_social_facebook'),
            'contato_endereco' => Config::getConfig('contato_endereco'),
            'contato_email' => Config::getConfig('contato_email'),
            'contato_telefone' => Config::getConfig('contato_telefone'),
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "mensagem_recebida.php", $data);
    }
}