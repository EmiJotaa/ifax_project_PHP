<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Model\Usuario;
use App\Model\Config;

final class ConfigController
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

        $config = new Config();

        if (isset($_GET['search']) && $_GET['search'] !== '') {
            $listaConfigs = $config->selectConfigsPesquisa($_GET['search']);
            $paginaAtual = 1;
            $proximaPagina = false;
            $paginaAnterior = false;
        }else{
            $limit = 10;
            $paginaAtual = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($paginaAtual*$limit) - $limit;
 
            $qntTotal = count($config->selectConfig('*', false));
 
            $proximaPagina = ($qntTotal > ($paginaAtual*$limit)) ? URL_BASE."admin-config?page=".($paginaAtual+1) : false;
            $paginaAnterior = ($paginaAtual > 1) ? URL_BASE."admin-config?page=".($paginaAtual-1) : false;
 
            $listaConfigs = $config->selectConfigsPage($limit, $offset);
        }
 
        $data['informacoes'] = array(
            'titleHeader' => 'Configuração - Painel Administrativo - Instituto da família do Alto Xingu',
            'menuActive' => 'site',
            'listagem' => $listaConfigs,
            'paginaAtual' => $paginaAtual,
            'proximaPagina' => $proximaPagina,
            'paginaAnterior' => $paginaAnterior
        );


        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "config/index.php", $data);
    }

    public function create(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $data['informacoes'] = array(
            'titleHeader' => 'Nova Configuração - Painel Administrativo - Instituto da família do Alto Xingu',
            'menuActive' => 'site'
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "config/create.php", $data);
    }
    public function edit(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $config =new Config();

        $configSelecionado = $config->selectConfig('*', array('id' => $args['id']));

        $data['informacoes'] = array(
            'titleHeader' => 'Editar Configuração - Painel Administrativo - Instituto da família do Alto Xingu',
            'menuActive' => 'site',
            'config' => $configSelecionado,
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "config/edit.php", $data);
    }
    public function delete(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $config =new Config();

        $configSelecionado = $config->selectConfig('*', array('id' => $args['id']));


        if (isset($configSelecionado[0]['valor']) && $configSelecionado[0]['valor'] !== '' && file_exists($configSelecionado[0]['valor'])) {
            unlink($configSelecionado[0]['valor']);
        }

        $config->deleteConfig('id', $args['id']);

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Configuração foi deletada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-config');
        exit();
    }

    public function insert(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $posts = $request->getParsedBody();

        if (isset($posts['valor']) && $posts['valor'] !== '') {
            $valor = $posts['valor'];
        }else{
            if($request->getUploadedFiles()['valor']){
                $valor = $request->getUploadedFiles()['valor'];
            }else{
                $valor = false;
            }

            $nome_valor = "";

            if ($valor) {
                if ($valor->getError() === UPLOAD_ERR_OK) {
                    $extensao = pathinfo($valor->getClientFilename(), PATHINFO_EXTENSION);
                    $nome = md5(uniqid(rand(), true)).pathinfo($valor->getClientFilename(), PATHINFO_FILENAME).".".$extensao;
                    $nome_valor = "resources/imagens/configs/" . $nome;
                    $valor->moveTo($nome_valor);
                    $valor = $nome_valor;
                }else{

                     $_SESSION['alerta_mensagem'] = array(
                        'titulo' => 'Erro :(',
                        'mensagem' => 'Ops, não foi possivel criar a configuração, porque você não informou nenhum valor para a configuração.',
                        'classe' => 'erro'
                    );

                    header('Location: '.URL_BASE.'admin-config');
                    exit();
                }
            }
        }       
     
        $campos = array(
            'nome' => $posts['nome'],
            'valor' => $valor,
        ); 
     
        $configs = new Config();
        $configs->insertConfig($campos);

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Configuração foi cadastrada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-config');
        exit();
    }

    public function update(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $posts = $request->getParsedBody();

        if($request->getUploadedFiles()['valor']){
            $valor = $request->getUploadedFiles()['valor'];
        }else{
            $valor = false;
        }

        $nome_valor = "";

        if (
            (isset($posts['excluir_valor']) && $posts['excluir_valor'] !== "")
            || ($valor && $valor->getClientFilename() !== "")
        ) {
            if ($valor && $valor->getClientFilename() !== "") {
                if ($valor->getError() === UPLOAD_ERR_OK) {

                    $extensao = pathinfo($valor->getClientFilename(), PATHINFO_EXTENSION);
                    $nome = md5(uniqid(rand(), true)).pathinfo($valor->getClientFilename(), PATHINFO_FILENAME).".".$extensao;
                    $nome_valor = "resources/imagens/configs/" . $nome;
                    $valor->moveTo($nome_valor);
                    $valor = $nome_valor;

                    if (isset($posts['excluir_valor']) && $posts['excluir_valor'] !== "") {
                        unlink($posts['excluir_valor']);
                    }else{
                        $config =new Config();

                        $configSelecionado = $config->selectConfig('valor', array('id' => $args['id']));
                        unlink($configSelecionado[0]['valor']);
                    }
                    
                }else{
                    $_SESSION['alerta_mensagem'] = array(
                        'titulo' => 'Erro :(',
                        'mensagem' => 'Ops, não foi possivel atualizar a configuração, porque você tentou excluir a imagem porem não enviou nenhuma uma nova imagem para ser exibida no site! Por favor tente novamente.',
                        'classe' => 'erro'
                    );
                    header('Location: '.URL_BASE.'admin-config');
                    exit();  
                }
            }else{
                if ($posts['valor'] !== '') {
                    $config =new Config();
                    $configSelecionado = $config->selectConfig('valor', array('id' => $args['id']));
                    unlink($configSelecionado[0]['valor']);
                    $valor = $posts['valor'];
                }else{
                    $_SESSION['alerta_mensagem'] = array(
                        'titulo' => 'Erro :(',
                        'mensagem' => 'Ops, não foi possivel atualizar a configuração, porque você tentou excluir a imagem porém não enviou nenhuma nova imagem para ser exibida no site! Por favor tente novamente.',
                        'classe' => 'erro'
                    );

                    header('Location: '.URL_BASE.'admin-config');
                    exit();  
                }
            }
        }else{
            if ($posts['valor'] !== '') {
                 $valor = $posts['valor'];
            }else{
                $_SESSION['alerta_mensagem'] = array(
                    'titulo' => 'Erro :(',
                    'mensagem' => 'Ops, não foi possivel atualizar a configuração, porque você não enviou nenhuma informação para ser atualizada no valor. Por favor tente novamente.',
                    'classe' => 'erro'
                );

                header('Location: '.URL_BASE.'admin-config');
                exit();
            }
        }
     
        $valores = array(
            'nome' => $posts['nome'],
            'valor' => $valor
        );

        if ($nome_valor !== "") {
            $valores['valor'] = $nome_valor;
        }

        $where = array(
            'id' => $args['id'],
        );

        $configs = new Config();

        $configs->updateConfig($valores, $where);

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Configurações foi atualizada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-config');
        exit();
    }
}

