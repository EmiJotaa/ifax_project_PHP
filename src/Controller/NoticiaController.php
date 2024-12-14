<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Model\Usuario;
use App\Model\Noticia;

final class NoticiaController
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

        $noticia = new Noticia();

        if (isset($_GET['search']) && $_GET['search'] !== '') {
            $listaNoticias = $noticia->selectNoticiasPesquisa($_GET['search']);
            $paginaAtual = 1;
            $proximaPagina = false;
            $paginaAnterior = false;
        }else{
            $limit = 10;
            $paginaAtual = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($paginaAtual*$limit) - $limit;
 
            $qntTotal = count($noticia->selectNoticia('*', false));
 
            $proximaPagina = ($qntTotal > ($paginaAtual*$limit)) ? URL_BASE."admin-noticias?page=".($paginaAtual+1) : false;
            $paginaAnterior = ($paginaAtual > 1) ? URL_BASE."admin-noticias?page=".($paginaAtual-1) : false;
 
            $listaNoticias = $noticia->selectNoticiasPage($limit, $offset);
        }
 
        $data['informacoes'] = array(
            'titleHeader' => 'Notícias - Painel Administrativo - Instituto da família do Alto Xingu',
            'menuActive' => 'noticias',
            'listagem' => $listaNoticias,
            'paginaAtual' => $paginaAtual,
            'proximaPagina' => $proximaPagina,
            'paginaAnterior' => $paginaAnterior
        );


        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "noticia/index.php", $data);
    }

    public function create(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $data['informacoes'] = array(
            'titleHeader' => 'Nova Notícia - Painel Administrativo - Instituto da família do Alto Xingu',
            'menuActive' => 'noticias'
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "noticia/create.php", $data);
    }
    public function edit(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $noticia =new Noticia();

        $noticiaSelecionado = $noticia->selectNoticia('*', array('id' => $args['id']));

        $galeriaFotos = $noticia->selectGaleriaNoticia('*', array('id_noticia' => $args['id']));

        $data['informacoes'] = array(
            'titleHeader' => 'Editar Noticia - Painel Administrativo - Instituto da família do Alto Xingu',
            'menuActive' => 'noticias',
            'noticia' => $noticiaSelecionado,
            'galeria' => $galeriaFotos
        );

        $renderer = new PhpRenderer(DIRETORIO_TEMPLATES_ADMIN);
        return $renderer->render($response, "noticia/edit.php", $data);
    }
    public function delete(
        ServerRequestInterface $request, 
        ResponseInterface $response,
        $args
    ) {
        
        Usuario::verifica_login();

        $noticia =new Noticia();

        $noticiaSelecionado = $noticia->selectNoticia('*', array('id' => $args['id']));

        $galeriaFotos = $noticia->selectGaleriaNoticia('*', array('id_noticia' => $args['id']));

        if (isset($noticiaSelecionado[0]['imagem_principal']) && $noticiaSelecionado[0]['imagem_principal'] !== '') {
            unlink($noticiaSelecionado[0]['imagem_principal']);
        }
        if (isset($galeriaFotos) && count($galeriaFotos) > 0) {
            foreach ($galeriaFotos as $imagem) {
                if (isset($imagem['caminho']) && $imagem['caminho'] !== '') {
                    unlink($imagem['caminho']);
                }
            }
        }

        $noticia->deleteNoticia('id', $args['id']);

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Noticia foi deletada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-noticias');
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
                $nome_imagem_principal = "resources/imagens/noticias/" . $nome;
                $imagem_principal->moveTo($nome_imagem_principal);
            }
        }
     
        $campos = array(
            'titulo' => $posts['titulo'],
            'url_amigavel' => $this->gerarUrlAmigavel($posts['titulo']),
            'descricao' => $posts['descricao'],
            'imagem_principal' => $nome_imagem_principal,
            'data_cadastro' => $posts['data'],
            'status' => $posts['ativo']
        );
     
        $noticias = new Noticia();
        $noticias->insertNoticia($campos);
        $id_noticia = $noticias->getUltimoNoticia()['id'];

        if($request->getUploadedFiles()['galeria_imagens']){
            $galeria = $request->getUploadedFiles()['galeria_imagens'];
        }else{
            $galeria = false;
        }
     
        if ($galeria) {
            foreach ($galeria as $imagem) {
                $foto = array();
                if ($imagem->getError() === UPLOAD_ERR_OK) {
                    $extensao = pathinfo($imagem->getClientFilename(), PATHINFO_EXTENSION);
                    $nome = md5(uniqid(rand(), true)).pathinfo($imagem->getClientFilename(), PATHINFO_FILENAME).".".$extensao;
                    $foto["caminho"] = "resources/imagens/noticias/" . $nome;
                    $imagem->moveTo($foto["caminho"]);
                    $foto['id_noticia'] = $id_noticia;
                    $noticias->insertFotoGaleria($foto);
                }
            }
        }

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Notícia foi adicionada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-noticias');
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
                    $nome_imagem_principal = "resources/imagens/noticias/" . $nome;
                    $imagem_principal->moveTo($nome_imagem_principal);

                    if (isset($posts['excluir_imagem_principal']) && $posts['excluir_imagem_principal'] !== "") {
                        unlink($posts['excluir_imagem_principal']);
                    }else{
                        $noticia =new Noticia();

                        $noticiaSelecionado = $noticia->selectNoticia('imagem_principal', array('id' => $args['id']));
                        unlink($noticiaSelecionado[0]['imagem_principal']);
                    }
                    
                }else{
                    $_SESSION['alerta_mensagem'] = array(
                        'titulo' => 'Erro :(',
                        'mensagem' => 'Ops, não foi possivel atualizar a notícia, porque você tentou excluir a imagem principal e a nova imagem que tentou enviar, aconteceu um erro. Por favor tente novamente com outra imagem!',
                        'classe' => 'erro'
                    );
                    header('Location: '.URL_BASE.'admin-noticias');
                    exit();  
                }
            }else{
                $_SESSION['alerta_mensagem'] = array(
                    'titulo' => 'Erro :(',
                    'mensagem' => 'Ops, não foi possivel atualizar a notícia, porque você tentou excluir a imagem principal porém não enviou nenhuma nova imagem para ser exibida no site! Por favor tente novamente.',
                    'classe' => 'erro'
                );

                header('Location: '.URL_BASE.'admin-noticias');
                exit();  
            }
        }
     
        $valores = array(
            'titulo' => $posts['titulo'],
            'url_amigavel' => $this->gerarUrlAmigavel($posts['titulo']),
            'descricao' => $posts['descricao'],
            'data_cadastro' => $posts['data'],
            'status' => $posts['ativo']
        );

        if ($nome_imagem_principal !== "") {
            $valores['imagem_principal'] = $nome_imagem_principal;
        }

        $where = array(
            'id' => $args['id'],
        );

        $noticias = new Noticia();
        $noticias->updateNoticia($valores, $where);

        $id_noticia = $args['id'];

        if($request->getUploadedFiles()['galeria_imagens']){
            $galeria = $request->getUploadedFiles()['galeria_imagens'];
        }else{
            $galeria = false;
        }

        if (isset($posts['excluir_imagem_galeria'])) {
            foreach ($posts['excluir_imagem_galeria'] as $imagem) {
                $noticias->deleteImagemGaleria('caminho', $imagem);
                unlink($imagem);                
            }
        }

        if ($galeria) {
            foreach ($galeria as $imagem) {
                $foto = array();
                if ($imagem->getError() === UPLOAD_ERR_OK) {
                    $extensao = pathinfo($imagem->getClientFilename(), PATHINFO_EXTENSION);
                    $nome = md5(uniqid(rand(), true)).pathinfo($imagem->getClientFilename(), PATHINFO_FILENAME).".".$extensao;
                    $foto["caminho"] = "resources/imagens/noticias/" . $nome;
                    $imagem->moveTo($foto["caminho"]);
                    $foto['id_noticia'] = $id_noticia;
                    $noticias->insertFotoGaleria($foto);
                }
            }
        }

        $_SESSION['alerta_mensagem'] = array(
            'titulo' => 'Sucesso!',
            'mensagem' => 'A Notícia foi atualizada corretamente.',
            'classe' => ''
        );

        header('Location: '.URL_BASE.'admin-noticias');
        exit();
    }
     
    private function gerarUrlAmigavel($url) {
        $search = ['@&lt;script[^>]*?>.*?&lt;/script>@si', '@&lt;style[^>]*?>.*?&lt;/style>@siU', '@&lt;[\/\!]*?[^&lt;>]*?>@si', '@&lt;![\s\S]*?--[ \t\n\r]*>@'];
        $string = preg_replace($search, '', $url);
        $table = ['Š'=>'S','š'=>'s','Đ'=>'Dj','đ'=>'dj','Ž'=>'Z','ž'=>'z','Č'=>'C','č'=>'c','Ć'=>'C','ć'=>'c','À'=>'A','Á'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','Å'=>'A','Æ'=>'A','Ç'=>'C','È'=>'E','É'=>'E','Ê'=>'E','Ë'=>'E','Ì'=>'I','Í'=>'I','Î'=>'I','Ï'=>'I','Ñ'=>'N','Ò'=>'O','Ó'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','Ø'=>'O','Ù'=>'U','Ú'=>'U','Û'=>'U','Ü'=>'U','Ý'=>'Y','Þ'=>'B','ß'=>'Ss','à'=>'a','á'=>'a','â'=>'a','ã'=>'a','ä'=>'a','å'=>'a','æ'=>'a','ç'=>'c','è'=>'e','é'=>'e','ê'=>'e','ë'=>'e','ì'=>'i','í'=>'i','î'=>'i','ï'=>'i','ð'=>'o','ñ'=>'n','ò'=>'o','ó'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','ø'=>'o','ù'=>'u','ú'=>'u','û'=>'u','ý'=>'y','ý'=>'y','þ'=>'b','ÿ'=>'y','Ŕ'=>'R','ŕ'=>'r'];
        $string = strtr($string, $table);
        $string = mb_strtolower($string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        $string = str_replace(" ", "-", $string);
        return $string;
    }

}
