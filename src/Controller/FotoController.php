<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Model\Usuario;
use App\Model\Foto;

final class FotoController
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

        $foto = new Foto();

        if (isset($_GET['search']) && $_GET['search'] !== '') {
            $listaFotos = $foto->selectFotosPesquisa($_GET['search']);
            $paginaAtual = 1;
            $proximaPagina = false;
            $paginaAnterior = false;
        }else{
            $limit = 10;
            $paginaAtual = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($paginaAtual*$limit) - $limit;
 
            $qntTotal = count($foto->selectFoto('*', false));
 
            $proximaPagina = ($qntTotal > ($paginaAtual*$limit)) ? URL_BASE."admin-fotos?page=".($paginaAtual+1) : false;
            $paginaAnterior = ($paginaAtual > 1) ? URL_BASE."admin-fotos?page=".($paginaAtual-1) : false;
 
            $listaFotos = $foto->selectFotosPage($limit, $offset);
        }
 
        $data['informacoes'] = array(
            'titleHeader' => 'Fotos - Painel Administrativo - Instituto da família do Alto Xingu',
            'menuActive' => 'fotos',
            'listagem' => $listaFotos,
            'paginaAtual' => $paginaAtual,
            'proximaPagina' => $proximaPagina,
            'paginaAnterior' => $paginaAnterior
        );


        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "foto/index.php", $data);
    }

    public function create(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $data['informacoes'] = array(
            'titleHeader' => 'Nova Foto - Painel Administrativo - Instituto da família do Alto Xingu',
            'menuActive' => 'fotos'
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "foto/create.php", $data);
    }
    public function edit(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $foto =new Foto();

        $fotoSelecionado = $foto->selectFoto('*', array('id' => $args['id']));

        $data['informacoes'] = array(
            'titleHeader' => 'Editar Foto - Painel Administrativo - Instituto da família do Alto Xingu',
            'menuActive' => 'fotos',
            'foto' => $fotoSelecionado,
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "foto/edit.php", $data);
    }
    public function delete(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $foto =new Foto();

        $fotoSelecionado = $foto->selectFoto('*', array('id' => $args['id']));


        if (isset($fotoSelecionado[0]['imagem_principal']) && $fotoSelecionado[0]['imagem_principal'] !== '') {
            unlink($fotoSelecionado[0]['imagem_principal']);
        }

        $foto->deleteFoto('id', $args['id']);

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Foto foi deletada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-fotos');
        exit();
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
                $nome_imagem_principal = "resources/imagens/fotos/" . $nome;
                $imagem_principal->moveTo($nome_imagem_principal);
            }
        }
     
        $campos = array(
            'titulo' => $posts['titulo'],
            'imagem_principal' => $nome_imagem_principal,
            'data_cadastro' => $posts['data'],
            'status' => $posts['ativo']
        );
     
        $fotos = new Foto();
        $fotos->insertFoto($campos);

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Foto foi adicionada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-fotos');
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
                    $nome_imagem_principal = "resources/imagens/fotos/" . $nome;
                    $imagem_principal->moveTo($nome_imagem_principal);

                    if (isset($posts['excluir_imagem_principal']) && $posts['excluir_imagem_principal'] !== "") {
                        unlink($posts['excluir_imagem_principal']);
                    }else{
                        $foto =new Foto();

                        $fotoSelecionado = $foto->selectFoto('imagem_principal', array('id' => $args['id']));
                        unlink($fotoSelecionado[0]['imagem_principal']);
                    }
                    
                }else{
                    $_SESSION['alerta_mensagem'] = array(
                        'titulo' => 'Erro :(',
                        'mensagem' => 'Ops, não foi possivel atualizar a foto, porque você tentou excluir a imagem principal e a nova imagem que tentou enviar, aconteceu um erro. Por favor tente novamente com outra imagem!',
                        'classe' => 'erro'
                    );
                    header('Location: '.URL_BASE.'admin-fotos');
                    exit();  
                }
            }else{
                $_SESSION['alerta_mensagem'] = array(
                    'titulo' => 'Erro :(',
                    'mensagem' => 'Ops, não foi possivel atualizar a foto, porque você tentou excluir a imagem principal porém não enviou nenhuma nova imagem para ser exibida no site! Por favor tente novamente.',
                    'classe' => 'erro'
                );

                header('Location: '.URL_BASE.'admin-fotos');
                exit();  
            }
        }
     
        $valores = array(
            'titulo' => $posts['titulo'],
            'data_cadastro' => $posts['data'],
            'status' => $posts['ativo']
        );

        if ($nome_imagem_principal !== "") {
            $valores['imagem_principal'] = $nome_imagem_principal;
        }

        $where = array(
            'id' => $args['id'],
        );

        $fotos = new Foto();

        $fotos->updateFoto($valores, $where);

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Foto foi atualizada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-fotos');
        exit();
    }
}

