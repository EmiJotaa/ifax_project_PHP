<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Model\Usuario;

final class AdminController
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

        $data['informacoes'] = array(
            'titleHeader' => 'Painel Administrativo - Instituto da Família do Alto Xingu',
            'menuActive' => 'dashboard'
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "index.php", $data);
    }

    public function login(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        Usuario::verifica_login(true);
        
        $data['informacoes'] = array(
            'titleHeader' => 'Login - Instituto da Família do Alto Xingu',
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "login.php", $data);
    }

    public function logout(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
       $_SESSION['usuario_logado'] = null;
       unset($_SESSION['usuario_logado']);

        header('Location:'.URL_BASE.'login');
        exit();
    }

    public function verifica_login(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {

        $posts = $request -> getParsedBody();

        $usuario = new Usuario();

        $result = $usuario->selectUsuario('*', array('email' => $posts['usuario']));

        if($result){
            if (!password_verify($posts['senha'], $result[0]['senha'])) {
                header('Location:'.URL_BASE.'login');
                exit();
            }

            $_SESSION['usuario_logado'] = $result[0];

            header('Location:'.URL_BASE.'admin');
            exit();

        }else{
            header('Location:'.URL_BASE.'login');
            exit();
        }
    }

     public function usuarios(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $usuario = new Usuario();

        if (isset($_GET['search']) && $_GET['search'] !== '') {
            $listaUsuarios = $usuario->selectUsuariosPesquisa($_GET['search']);
            $paginaAtual = 1;
            $proximaPagina = false;
            $paginaAnterior = false;
        }else{
            $limit = 10;
            $paginaAtual = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($paginaAtual*$limit) - $limit;
 
            $qntTotal = count($usuario->selectUsuario('*', false));
 
            $proximaPagina = ($qntTotal > ($paginaAtual*$limit)) ? URL_BASE."admin-usuarios?page=".($paginaAtual+1) : false;
            $paginaAnterior = ($paginaAtual > 1) ? URL_BASE."admin-usuarios?page=".($paginaAtual-1) : false;
 
            $listaUsuarios = $usuario->selectUsuariosPage($limit, $offset);
        }
 
        $data['informacoes'] = array(
            'titleHeader' => 'Usuarios - Painel Administrativo - Instituto da Família do Alto Xingu',
            'menuActive' => 'usuarios',
            'listagem' => $listaUsuarios,
            'paginaAtual' => $paginaAtual,
            'proximaPagina' => $proximaPagina,
            'paginaAnterior' => $paginaAnterior
        );


        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "usuario/index.php", $data);
    }

    public function usuarios_create(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $data['informacoes'] = array(
            'titleHeader' => 'Novo Usuario - Painel Administrativo - Instituto da Família do Alto Xingu',
            'menuActive' => 'usuarios'
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "usuario/create.php", $data);
    }
    public function usuarios_edit(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $usuario =new Usuario();

        $usuarioSelecionado = $usuario->selectUsuario('*', array('id' => $args['id']));

        $galeriaFotos = $usuario->selectGaleriaUsuario('*', array('id_usuario' => $args['id']));

        $data['informacoes'] = array(
            'titleHeader' => 'Editar Usuario - Painel Administrativo - Instituto da Família do Alto Xingu',
            'menuActive' => 'usuarios',
            'usuario' => $usuarioSelecionado,
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "usuario/edit.php", $data);
    }
    public function usuarios_delete(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $usuario =new Usuario();

        $usuarioSelecionado = $usuario->selectUsuario('*', array('id' => $args['id']));

        if (isset($usuarioSelecionado[0]['foto']) && $usuarioSelecionado[0]['foto'] !== '') {
            unlink($usuarioSelecionado[0]['foto']);
        }

        $usuario->deleteUsuario('id', $args['id']);

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'O Usuario foi deletado corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-usuarios');
        exit();
    }

    public function usuarios_insert(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $posts = $request->getParsedBody();

        if($request->getUploadedFiles()['foto']){
            $foto = $request->getUploadedFiles()['foto'];
        }else{
            $foto = false;
        }

        $nome_foto = "";
        if ($foto) {
            if ($foto->getError() === UPLOAD_ERR_OK) {
                $extensao = pathinfo($foto->getClientFilename(), PATHINFO_EXTENSION);
                $nome = md5(uniqid(rand(), true)).pathinfo($foto->getClientFilename(), PATHINFO_FILENAME).".".$extensao;
                $nome_foto = "resources/imagens/usuarios/" . $nome;
                $foto->moveTo($nome_foto);
            }
        }
     
        $campos = array(
            'nome' => $posts['nome'],
            'email' => $posts['email'],
            'senha' => password_hash($posts['senha'], PASSWORD_DEFAULT, array('cost' => 12)),
            'foto' => $nome_foto,
            'data_cadastro' => $posts['data'],
            'status' => $posts['ativo']
        );
     
        $usuarios = new Usuario();
        $usuarios->insertUsuario($campos);

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'O Usuario foi adicionado corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-usuarios');
        exit();
    }

    public function usuarios_update(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        $posts = $request->getParsedBody();

        if($request->getUploadedFiles()['foto']){
            $foto = $request->getUploadedFiles()['foto'];
        }else{
            $foto = false;
        }

        $nome_foto = "";

        if (
            (isset($posts['excluir_foto']) && $posts['excluir_foto'] !== "")
            || ($foto && $foto->getClientFilename() !== "")
        ) {
            if ($foto && $foto->getClientFilename() !== "") {
                if ($foto->getError() === UPLOAD_ERR_OK) {

                    $extensao = pathinfo($foto->getClientFilename(), PATHINFO_EXTENSION);
                    $nome = md5(uniqid(rand(), true)).pathinfo($foto->getClientFilename(), PATHINFO_FILENAME).".".$extensao;
                    $nome_foto = "resources/imagens/usuarios/" . $nome;
                    $foto->moveTo($nome_foto);

                    if (isset($posts['excluir_foto']) && $posts['excluir_foto'] !== "") {
                        unlink($posts['excluir_foto']);
                    }else{
                        $usuario =new Usuario();

                        $usuarioSelecionado = $usuario->selectUsuario('foto', array('id' => $args['id']));
                        unlink($usuarioSelecionado[0]['foto']);
                    }
                    
                }else{
                    $_SESSION['alerta_mensagem'] = array(
                        'titulo' => 'Erro :(',
                        'mensagem' => 'Ops, não foi possivel atualizar o usuario, porque você tentou excluir a foto e a nova imagem que tentou enviar, aconteceu um erro. Por favor tente novamente com outra imagem!',
                        'classe' => 'erro'
                    );
                    header('Location: '.URL_BASE.'admin-usuarios');
                    exit();  
                }
            }else{
                $_SESSION['alerta_mensagem'] = array(
                    'titulo' => 'Erro :(',
                    'mensagem' => 'Ops, não foi possivel atualizar o usuario, porque você tentou excluir a foto porém não enviou nenhuma nova imagem para ser exibida no site! Por favor tente novamente.',
                    'classe' => 'erro'
                );

                header('Location: '.URL_BASE.'admin-usuarios');
                exit();  
            }
        }
     
        $valores = array(
            'nome' => $posts['nome'],
            'email' => $posts['email'],
            'senha' => password_hash($posts['senha'], PASSWORD_DEFAULT, array('cost' => 12)),
            'data_cadastro' => $posts['data'],
            'status' => $posts['ativo']
        );

        if ($nome_foto !== "") {
            $valores['foto'] = $nome_foto;
        }

        $where = array(
            'id' => $args['id'],
        );

        $usuarios = new Usuario();
        $usuarios->updateUsuario($valores, $where);

        if ($_SESSION['usuario_logado']['id'] === (int)$args['id']) {
            $result = $usuarios->selectUsuario('*', array('id' => (int)$args['id']));
            $_SESSION['usuario_logado'] = $result[0];
        }

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'O Usuario foi atualizado corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-usuarios');
        exit();
    }
}