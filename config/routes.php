<?php
use Slim\App;
return function (App $app) {
    //ROTAS DO PAINEL ADMINISTRATIVO
    $app->get('/admin', '\App\Controller\AdminController:index');
    $app->get('/login', '\App\Controller\AdminController:login');
    $app->get('/logout', '\App\Controller\AdminController:logout');

    $app->post('/login', '\App\Controller\AdminController:verifica_login');


    //PROJETOS
    $app->get('/admin-projetos', '\App\Controller\ProjetoController:index');
    $app->get('/admin-projetos-create', '\App\Controller\ProjetoController:create');
    $app->get('/admin-projetos-edit/{id}', '\App\Controller\ProjetoController:edit');
    $app->get('/admin-projetos-delete/{id}', '\App\Controller\ProjetoController:delete');

    $app->post('/admin-projetos-create', '\App\Controller\ProjetoController:insert');
    $app->post('/admin-projetos-edit/{id}', '\App\Controller\ProjetoController:update');


    //NOTICIAS
    $app->get('/admin-noticias', '\App\Controller\NoticiaController:index');
    $app->get('/admin-noticias-create', '\App\Controller\NoticiaController:create');
    $app->get('/admin-noticias-edit/{id}', '\App\Controller\NoticiaController:edit');
    $app->get('/admin-noticias-delete/{id}', '\App\Controller\NoticiaController:delete');

    $app->post('/admin-noticias-create', '\App\Controller\NoticiaController:insert');
    $app->post('/admin-noticias-edit/{id}', '\App\Controller\NoticiaController:update');


    //VIDEOS
    $app->get('/admin-videos', '\App\Controller\VideoController:index');
    $app->get('/admin-videos-create', '\App\Controller\VideoController:create');
    $app->get('/admin-videos-edit/{id}', '\App\Controller\VideoController:edit');
    $app->get('/admin-videos-delete/{id}', '\App\Controller\VideoController:delete');

    $app->post('/admin-videos-create', '\App\Controller\VideoController:insert');
    $app->post('/admin-videos-edit/{id}', '\App\Controller\VideoController:update');



    //ROTAS DO WEB SITE
    $app->get('/', '\App\Controller\HomeController:home');
    $app->get('/quem-somos', '\App\Controller\HomeController:quem_somos');
    $app->get('/noticias', '\App\Controller\HomeController:noticias');
    $app->get('/donate', '\App\Controller\HomeController:donate');
    $app->get('/projetos', '\App\Controller\HomeController:projetos');
    $app->get('/midias', '\App\Controller\HomeController:midias');
    $app->get('/fale-conosco', '\App\Controller\HomeController:fale_conosco');
    $app->get('/{any}', '\App\Controller\HomeController:projeto_detalhe');
};

