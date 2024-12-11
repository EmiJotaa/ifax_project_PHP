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

    public function page(
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
            'title' => 'Instituto da família do Alto Xingu',
            'caminho' => array(
                [
                    'link' => 'quem-somos',
                    'nome' => 'Instituto da família do Alto Xingu'
                ]
            )
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "quem_somos.php", $data);
    }

    public function donate(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $data['informacoes'] = array(
            'titleHeader' => 'Faça uma doação - Instituto ',
            'title' => 'Faça uma doação',
            'caminho' => array(
                [
                    'link' => 'donate',
                    'nome' => 'Faça uma doação'
                ]
            )
        );
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES);
        return $renderer->render($response, "donate.php", $data);
    }

}