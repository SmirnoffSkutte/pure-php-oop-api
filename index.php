<?php
require_once 'user/services.php';
require_once 'products/goodsService.php';
require_once 'products/goodsController.php';
require_once 'db/db.php';
require_once 'auth/AuthService.php';
require_once 'auth/AuthController.php';
require_once 'jwt/JwtService.php';
require_once 'router.php';

require_once 'products/goodModel.php';
$goodService=new GoodsService();
$auth=new AuthService();
$uri = $_SERVER['REQUEST_URI'];
$router=new Router();

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin:*');
//Goods routes

$router->post('/goods',function (){
    $gC=new GoodsController();
    $goods=$gC->getAll();
    print_r($goods);
});

$router->get('/goods/by-id/{id}',function ($id){
    $gC=new GoodsController();
    $good=$gC->getById($id);
    print_r($good);
});

$router->post('/goods/by-name',function (){
    $gC=new GoodsController();
    $good=$gC->getByName();
    print_r($good);
});

$router->post('/goods/by-cats-price',function (){
    $gC=new GoodsController();
    $goods=$gC->getByCatsAndPrice();
    print_r($goods);
});

$router->post('/goods/by-brands-price',function (){
    $gC=new GoodsController();
    $goods=$gC->getByBrandsAndPrice();
    print_r($goods);
});

$router->post('/goods/by-brands-cats-price',function (){
    $gC=new GoodsController();
    $goods=$gC->getByCatsBrandsPrice();
    print_r($goods);
});

            //Goods protected routes

$router->delete('/goods/delete-good/{id}',function ($id){
    $gC=new GoodsController();
    $rows=$gC->deleteGood($id);
    print_r($rows);
});

$router->post('/goods/add-good',function (){
    $gC=new GoodsController();
    $rows=$gC->addGood();
    print_r($rows);
});

$router->put('/goods/update-good/{id}',function ($id){
    $gC=new GoodsController();
    $rows=$gC->updateGood($id);
    print_r($rows);
});

//Auth routers

$router->post('/registration',function (){
    $authController=new AuthController();
    $user=$authController->registration();
    print_r($user);
});

$router->post('/login',function (){
    $authController=new AuthController();
    $user=$authController->login();
    print_r($user);
});




$router->run();
