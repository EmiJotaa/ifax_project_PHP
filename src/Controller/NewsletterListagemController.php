<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Model\Usuario;
use App\Model\Newsletter;
use App\Model\NewsletterListagem;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

final class NewsletterListagemController
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

        $newsletter = new NewsletterListagem();

        if (isset($_GET['search']) && $_GET['search'] !== '') {
            $listaNewsletterListagems = $newsletter->selectNewsletterListagemsPesquisa($_GET['search']);
            $paginaAtual = 1;
            $proximaPagina = false;
            $paginaAnterior = false;
        }else{
            $limit = 10;
            $paginaAtual = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($paginaAtual*$limit) - $limit;
 
            $qntTotal = count($newsletter->selectNewsletterListagem('*', false));
 
            $proximaPagina = ($qntTotal > ($paginaAtual*$limit)) ? URL_BASE."admin-newsletter?page=".($paginaAtual+1) : false;
            $paginaAnterior = ($paginaAtual > 1) ? URL_BASE."admin-newsletter?page=".($paginaAtual-1) : false;
 
            $listaNewsletterListagems = $newsletter->selectNewsletterListagemsPage($limit, $offset);
        }
 
        $data['informacoes'] = array(
            'titleHeader' => 'Newsletter - Painel Administrativo - Instituto da Família do Alto Xingu',
            'menuActive' => 'newsletter',
            'listagem' => $listaNewsletterListagems,
            'paginaAtual' => $paginaAtual,
            'proximaPagina' => $proximaPagina,
            'paginaAnterior' => $paginaAnterior
        );


        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "newsletter/index.php", $data);
    }

    public function create(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $data['informacoes'] = array(
            'titleHeader' => 'Nova Newsletter - Painel Administrativo - Instituto da Família do Alto Xingu',
            'menuActive' => 'newsletter'
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "newsletter/create.php", $data);
    }
    public function edit(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $newsletter =new NewsletterListagem();

        $newsletterSelecionado = $newsletter->selectNewsletterListagem('*', array('id' => $args['id']));

        $data['informacoes'] = array(
            'titleHeader' => 'Editar Newsletter - Painel Administrativo - Instituto da Família do Alto Xingu',
            'menuActive' => 'newsletter',
            'newsletter' => $newsletterSelecionado,
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "newsletter/edit.php", $data);
    }
    public function delete(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $newsletter =new NewsletterListagem();

        $newsletterSelecionado = $newsletter->selectNewsletterListagem('*', array('id' => $args['id']));

        if (isset($newsletterSelecionado[0]['imagem_principal']) && $newsletterSelecionado[0]['imagem_principal'] !== '') {
            unlink($newsletterSelecionado[0]['imagem_principal']);
        }

        $newsletter->deleteNewsletterListagem('id', $args['id']);

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Newsletter foi deletada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-newsletter');
        exit();
    }
        public function enviar(
    ServerRequestInterface $request, 
    ResponseInterface $response,
    $args
) {
    Usuario::verifica_login();

    // Instancia a classe para manipulação da newsletter
    $newsletter = new NewsletterListagem();

    // Recupera a newsletter que foi selecionada
    $newsletterSelecionado = $newsletter->selectNewsletterListagem('*', array('id' => $args['id']));

    // Instancia a classe para manipulação da lista de e-mails
    $newsletterEmail = new Newsletter();

    // Recupera os e-mails de todos os inscritos
    $assinantes = $newsletterEmail->selectNewsletter('*', []); // sem filtro para pegar todos os registros

    // Instancia o PHPMailer
    $mail = new PHPMailer(true);

    // Configuração do servidor SMTP (exemplo usando Gmail, ajuste conforme sua necessidade)
    try {
        // Configurações do servidor SMTP
        $mail->CharSet = 'UTF-8';                    
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.hostinger.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'contato@ifax.com.br';                     
        $mail->Password   = 'Mayupi10@';                               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;

        // De quem está enviando
        $mail->setFrom('contato@ifax.com.br', 'Instituto da Família do Alto Xingu');

        // Assunto do e-mail
        $assunto = $newsletterSelecionado[0]['titulo'];
        $autor = $newsletterSelecionado[0]['autor'];
        $corpoEmail = $newsletterSelecionado[0]['descricao'];
        $imagemPrincipal = $newsletterSelecionado[0]['imagem_principal'];
        $data = $newsletterSelecionado[0]['data_cadastro'];
        $dataFormatada = date("d/m/Y", strtotime($data));

        $mail->addEmbeddedImage($imagemPrincipal, 'imagem_principal', 'imagem_principal.jpg');
        // Enviar o e-mail para cada destinatário
        foreach ($assinantes as $assinante) {
            try {
                // Adicionar o destinatário
                $mail->addAddress($assinante['email']); 



                // Conteúdo do e-mail (HTML)
                $mail->isHTML(true);
                $mail->Subject = $assunto;
                $mail->Body    = "
                <html>
                <head>
                    <title>{$assunto}</title>
                    <style>
                        /* Reset básico para garantir que o layout fique consistente em todos os dispositivos */
                        body, h1, h4, p, img {
                            margin: 0;
                            padding: 0;
                            font-family: Arial, sans-serif;
                        }

                        /* Container principal do e-mail */
                        .email-container {
                            width: 100%;
                            max-width: 600px;
                            margin: 0 auto;
                            padding: 20px;
                            background-color: #f4f4f4;
                            border-radius: 8px;
                        }

                        /* Cabeçalho do e-mail */
                        .email-header {
                            text-align: center;
                            margin-bottom: 20px;
                        }

                        .email-header h1 {
                            color: #333;
                            font-size: 24px;
                        }

                        .email-header h4 {
                            color: #777;
                            font-size: 16px;
                            margin-top: 5px;
                        }

                        /* Estilo da imagem */
                        .email-body img {
                            width: 100%; /* A imagem irá ocupar 100% da largura do seu container */
                            max-width: 600px; /* Limite máximo da imagem */
                            height: auto; /* A altura será ajustada automaticamente */
                            border-radius: 8px;
                            margin-bottom: 20px;
                        }

                        /* Corpo do e-mail */
                        .email-body {
                            background-color: #ffffff;
                            padding: 20px;
                            border-radius: 8px;
                        }

                        /* Estilo do texto do corpo */
                        .email-body p {
                            color: #333;
                            font-size: 16px;
                            line-height: 1.5;
                        }

                        /* Rodapé do e-mail */
                        .email-footer {
                            text-align: center;
                            margin-top: 20px;
                            font-size: 12px;
                            color: #888;
                        }
                    </style>
                </head>
                <body>
                    <div class='email-container'>
                        <!-- Cabeçalho -->
                        <div class='email-header'>
                            <h1>{$assunto}</h1>
                            <h4>Autor: {$autor}</h4>
                            <h4>Data: {$dataFormatada}</h4>
                        </div>

                        <!-- Corpo do e-mail -->
                        <div class='email-body'>
                            <img src='cid:imagem_principal' alt='Imagem Principal' />
                            <p>{$corpoEmail}</p>
                        </div>

                        <!-- Rodapé -->
                        <div class='email-footer'>
                            <p>Instituto da Família do Alto Xingu</p>
                            <p>Este é um e-mail automático, por favor, não responda.</p>
                        </div>
                    </div>
                </body>
                </html>
                ";

                // Envia o e-mail
                $mail->send();
                
                // Limpar os destinatários para o próximo e-mail
                $mail->clearAddresses();
            } catch (Exception $e) {
                // Caso haja erro no envio de um e-mail, registra a falha
                // Você pode armazenar a falha ou apenas interromper o processo.
                $data['informacoes']['erro'] = "Erro ao enviar e-mail para {$email['email']}. Erro: {$mail->ErrorInfo}";
                return $response->withStatus(500); // Retorna erro 500 se falhar o envio
            }
        }

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Newsletter foi enviada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-newsletter');
        exit();

    } catch (Exception $e) {
        // Se o PHPMailer não conseguir se conectar ao servidor SMTP
        $data['informacoes']['erro'] = "Erro ao configurar o envio de e-mail: {$mail->ErrorInfo}";
        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "newsletter/enviar.php", $data);
    }
}

    public function insert(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $posts = $request->getParsedBody();

        if($request->getUploadedFiles()['imagem_principal']){
            $imagem_principal = $request->getUploadedFiles()['imagem_principal'];
        }else{
            $imagem_principal = false;
        }

        $nome_imagem_principal = "";
        if ($imagem_principal) {
            if ($imagem_principal->getError() === UPLOAD_ERR_OK) {
                $extensao = pathinfo($imagem_principal->getClientFilename(), PATHINFO_EXTENSION);
                $nome = md5(uniqid(rand(), true)).pathinfo($imagem_principal->getClientFilename(), PATHINFO_FILENAME).".".$extensao;
                $nome_imagem_principal = "resources/imagens/newsletter/" . $nome;
                $imagem_principal->moveTo($nome_imagem_principal);
            }
        }
     
        $campos = array(
            'titulo' => $posts['titulo'],
            'autor' => $posts['autor'],
            'descricao' => $posts['descricao'],
            'imagem_principal' => $nome_imagem_principal,
            'data_cadastro' => $posts['data'],
        );
     
        $newsletter = new NewsletterListagem();
        $newsletter->insertNewsletterListagem($campos);
        $id_newsletter = $newsletter->getUltimoNewsletterListagem()['id'];

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Newsletter foi adicionada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-newsletter');
        exit();
    }

    public function update(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $posts = $request->getParsedBody();

        if($request->getUploadedFiles()['imagem_principal']){
            $imagem_principal = $request->getUploadedFiles()['imagem_principal'];
        }else{
            $imagem_principal = false;
        }

        $nome_imagem_principal = "";

        if (
            (isset($posts['excluir_imagem_principal']) && $posts['excluir_imagem_principal'] !== "")
            || ($imagem_principal && $imagem_principal->getClientFilename() !== "")
        ) {
            if ($imagem_principal && $imagem_principal->getClientFilename() !== "") {
                if ($imagem_principal->getError() === UPLOAD_ERR_OK) {

                    $extensao = pathinfo($imagem_principal->getClientFilename(), PATHINFO_EXTENSION);
                    $nome = md5(uniqid(rand(), true)).pathinfo($imagem_principal->getClientFilename(), PATHINFO_FILENAME).".".$extensao;
                    $nome_imagem_principal = "resources/imagens/newsletter/" . $nome;
                    $imagem_principal->moveTo($nome_imagem_principal);

                    if (isset($posts['excluir_imagem_principal']) && $posts['excluir_imagem_principal'] !== "") {
                        unlink($posts['excluir_imagem_principal']);
                    }else{
                        $newsletter =new NewsletterListagem();

                        $newsletterSelecionado = $newsletter->selectNewsletterListagem('imagem_principal', array('id' => $args['id']));
                        unlink($newsletterSelecionado[0]['imagem_principal']);
                    }
                    
                }else{
                    $_SESSION['alerta_mensagem'] = array(
                        'titulo' => 'Erro :(',
                        'mensagem' => 'Ops, não foi possivel atualizar a newsletter, porque você tentou excluir a imagem principal e a nova imagem que tentou enviar, aconteceu um erro. Por favor tente novamente com outra imagem!',
                        'classe' => 'erro'
                    );
                    header('Location: '.URL_BASE.'admin-newsletter');
                    exit();  
                }
            }else{
                $_SESSION['alerta_mensagem'] = array(
                    'titulo' => 'Erro :(',
                    'mensagem' => 'Ops, não foi possivel atualizar a newsletter, porque você tentou excluir a imagem principal porém não enviou nenhuma nova imagem! Por favor tente novamente.',
                    'classe' => 'erro'
                );

                header('Location: '.URL_BASE.'admin-newsletter');
                exit();  
            }
        }
     
        $valores = array(
            'titulo' => $posts['titulo'],
            'autor' => $posts['autor'],
            'descricao' => $posts['descricao'],
            'data_cadastro' => $posts['data'],
        );

        if ($nome_imagem_principal !== "") {
            $valores['imagem_principal'] = $nome_imagem_principal;
        }

        $where = array(
            'id' => $args['id'],
        );

        $newsletter = new NewsletterListagem();
        $newsletter->updateNewsletterListagem($valores, $where);

        $id_newsletter = $args['id'];

        if (isset($posts['excluir_imagem_galeria'])) {
            foreach ($posts['excluir_imagem_galeria'] as $imagem) {
                $newsletter->deleteImagemGaleria('caminho', $imagem);
                unlink($imagem);                
            }
        }

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Newsletter foi atualizada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-newsletter');
        exit();
    }

}

