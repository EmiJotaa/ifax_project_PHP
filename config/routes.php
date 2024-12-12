<?php
use Slim\App;
return function (App $app) {

    //ROTAS DO WEB SITE
    $app->get('/', '\App\Controller\HomeController:home');
    $app->get('/quem-somos', '\App\Controller\HomeController:quem_somos');
    $app->get('/donate', '\App\Controller\HomeController:donate');
    $app->get('/videos', '\App\Controller\HomeController:videos');
    $app->get('/fale-conosco', '\App\Controller\HomeController:fale_conosco');
    $app->get('/{any}', '\App\Controller\HomeController:page');
};

