<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Model\Usuario;
use App\Model\Newsletter;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

final class NewsletterUsuariosController
{
    function __construct(){
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function index(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $newsletter = new Newsletter();

        if (isset($_GET['search']) && $_GET['search'] !== '') {
            $listaNewsletters = $newsletter->selectNewslettersPesquisa($_GET['search']);
            $paginaAtual = 1;
            $proximaPagina = false;
            $paginaAnterior = false;
        }else{
            $limit = 10;
            $paginaAtual = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($paginaAtual*$limit) - $limit;
 
            $qntTotal = count($newsletter->selectNewsletter('*', false));
 
            $proximaPagina = ($qntTotal > ($paginaAtual*$limit)) ? URL_BASE."admin-newsletter-assinaturas-cadastradas?page=".($paginaAtual+1) : false;
            $paginaAnterior = ($paginaAtual > 1) ? URL_BASE."admin-newsletter-assinaturas-cadastradas?page=".($paginaAtual-1) : false;
 
            $listaNewsletters = $newsletter->selectNewslettersPage($limit, $offset);
        }
 
        $data['informacoes'] = array(
            'titleHeader' => 'Newsletter - Painel Administrativo - Instituto da Família do Alto Xingu',
            'menuActive' => 'assinaturas-cadastradas',
            'listagem' => $listaNewsletters,
            'paginaAtual' => $paginaAtual,
            'proximaPagina' => $proximaPagina,
            'paginaAnterior' => $paginaAnterior
        );


        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "newsletter_assinaturas/index.php", $data);
    }

    public function create(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $data['informacoes'] = array(
            'titleHeader' => 'Newsletter - Novo Usuário - Painel Administrativo - Instituto da Família do Alto Xingu',
            'menuActive' => 'assinaturas-cadastradas'
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "newsletter_assinaturas/create.php", $data);
    }

    public function edit(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $newsletter =new Newsletter();

        $newsletterSelecionado = $newsletter->selectNewsletter('*', array('id' => $args['id']));

        $data['informacoes'] = array(
            'titleHeader' => 'Newsletter - Editar Usuário - Painel Administrativo - Instituto da Família do Alto Xingu',
            'menuActive' => 'assinatura-cadastradas',
            'newsletter' => $newsletterSelecionado,
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "newsletter_assinaturas/edit.php", $data);
    }

    public function delete(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $newsletter =new Newsletter();

        $newsletterSelecionado = $newsletter->selectNewsletter('*', array('id' => $args['id']));

        $newsletter->deleteNewsletter('id', $args['id']);

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A assinatura foi encerrada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-newsletter-assinaturas-cadastradas');
        exit();
    }

    public function insert(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $posts = $request->getParsedBody();
     
        $campos = array(
            'nome' => $posts['nome'],
            'email' => $posts['email'],
            'data_cadastro' => $posts['data'],
        );
     
        $newsletter = new Newsletter();
        $newsletter->insertNewsletter($campos);

        $id_newsletter = $newsletter->getUltimoNewsletter()['id'];

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Assinatura foi adicionada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-newsletter-assinaturas-cadastradas');
        exit();
    }

    public function update(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $posts = $request->getParsedBody();
     
        $valores = array(
            'nome' => $posts['nome'],
            'email' => $posts['email'],
            'data_cadastro' => $posts['data'],
        );

        $where = array(
            'id' => $args['id'],
        );

        $newsletter = new Newsletter();
        $newsletter->updateNewsletter($valores, $where);

        $id_newsletter = $args['id'];

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Assinatura foi atualizada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-newsletter-assinaturas-cadastradas');
        exit();
    }

}

