<?php
use Slim\App;
return function (App $app) {
    //ROTAS DO PAINEL ADMINISTRATIVO
    $app->get('/admin', '\App\Controller\AdminController:index');
    $app->get('/login', '\App\Controller\AdminController:login');
    $app->get('/logout', '\App\Controller\AdminController:logout');

    $app->post('/login', '\App\Controller\AdminController:verifica_login');



    //ROTAS DO WEB SITE
    $app->get('/', '\App\Controller\HomeController:home');
    $app->get('/quem-somos', '\App\Controller\HomeController:quem_somos');
    $app->get('/noticias', '\App\Controller\HomeController:noticias');
    $app->get('/donate', '\App\Controller\HomeController:donate');
    $app->get('/projetos', '\App\Controller\HomeController:projetos');
    $app->get('/galeria', '\App\Controller\HomeController:galeria');
    $app->get('/fale-conosco', '\App\Controller\HomeController:fale_conosco');
    $app->get('/{any}', '\App\Controller\HomeController:projeto_detalhe');
};

