<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;

final class HomeController
{
    public function home(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $data['informacoes'] = array();
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
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "projetos.php", $data);
    }

    public function galeria(
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
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "galeria.php", $data);
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
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "projeto.php", $data);
    }
}