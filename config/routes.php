<?php
use Slim\App;
return function (App $app) {

    //ROTAS DO WEB SITE
    $app->get('/', '\App\Controller\HomeController:home');
    $app->get('/donate', '\App\Controller\HomeController:donate');
    $app->get('/{any}', '\App\Controller\HomeController:page');
};
