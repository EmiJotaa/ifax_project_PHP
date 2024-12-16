<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Model\Config;

final class HomeController
{
    public function home(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $data['informacoes'] = array(
            'titleHeader' => 'Instituto da família do Alto Xingu'
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
        $data['informacoes'] = array(
            'titleHeader' => 'Notícias - Instituto da família do Alto Xingu',
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
        $data['informacoes'] = array(
            'titleHeader' => 'Projetos - Instituto da família do Alto Xingu',
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
        $data['informacoes'] = array(
            'titleHeader' => 'Galeria - Instituto da família do Alto Xingu ',
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

    public function projeto_detalhe(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $data['informacoes'] = array(
            'titleHeader' => 'Projetos - Instituto da família do Alto Xingu',
            'title' => 'Nome projeto - Instituto da família do Alto Xingu',
            'caminho' => array(
                [
                    'link' => 'projetos',
                    'nome' => '- Projetos'
                ],
                [
                    'link' => 'projetado',
                    'nome' => '- Nome projeto'
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

        public function noticia_detalhe(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $data['informacoes'] = array(
            'titleHeader' => 'Noticias - Instituto da família do Alto Xingu',
            'title' => 'Nome noticia - Instituto da família do Alto Xingu',
            'caminho' => array(
                [
                    'link' => 'noticias',
                    'nome' => '- Noticias'
                ],
                [
                    'link' => 'projetado',
                    'nome' => '- Nome noticia'
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
}