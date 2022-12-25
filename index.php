<?php
require_once 'user/services.php';
require_once 'products/goodsService.php';
require_once 'products/goodsController.php';
require_once 'brands/BrandsController.php';
require_once 'categories/CategoriesController.php';
require_once 'roles/RolesController.php';
require_once 'users/UsersController.php';
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

        //Brands routes
$router->get('/brands',function (){
    $bC=new BrandsController();
    $brands=$bC->getBrands();
    print_r($brands);
});

$router->get('/brands/{id}',function ($id){
    $bC=new BrandsController();
    $brands=$bC->getBrand($id);
    print_r($brands);
});

        //Brands protected routes

$router->delete('/brands/delete-brand/{id}',function ($id){
    $bC=new BrandsController();
    $rows=$bC->deleteGood($id);
    print_r($rows);
});

$router->post('/brands/add-brand',function (){
    $bC=new BrandsController();
    $rows=$bC->addGood();
    print_r($rows);
});

$router->put('/brands/update-brand/{id}',function ($id){
    $bC=new BrandsController();
    $rows=$bC->updateGood($id);
    print_r($rows);
});

//Categories routes
$router->get('/Categories',function (){
    $bC=new CategoriesController();
    $Categories=$bC->getCategories();
    print_r($Categories);
});

$router->get('/Categories/{id}',function ($id){
    $bC=new CategoriesController();
    $Categories=$bC->getCategory($id);
    print_r($Categories);
});

//Categories protected routes

$router->delete('/Categories/delete-Category/{id}',function ($id){
    $bC=new CategoriesController();
    $rows=$bC->deleteGood($id);
    print_r($rows);
});

$router->post('/Categories/add-Category',function (){
    $bC=new CategoriesController();
    $rows=$bC->addGood();
    print_r($rows);
});

$router->put('/Categories/update-Category/{id}',function ($id){
    $bC=new CategoriesController();
    $rows=$bC->updateGood($id);
    print_r($rows);
});
//Roles routes
$router->get('/Roles',function (){
    $bC=new RolesController();
    $Roles=$bC->getRoles();
    print_r($Roles);
});

$router->get('/Roles/{id}',function ($id){
    $bC=new RolesController();
    $Roles=$bC->getRole($id);
    print_r($Roles);
});

//Roles protected routes

$router->delete('/Roles/delete-Role/{id}',function ($id){
    $bC=new RolesController();
    $rows=$bC->deleteGood($id);
    print_r($rows);
});

$router->post('/Roles/add-Role',function (){
    $bC=new RolesController();
    $rows=$bC->addGood();
    print_r($rows);
});

$router->put('/Roles/update-Role/{id}',function ($id){
    $bC=new RolesController();
    $rows=$bC->updateGood($id);
    print_r($rows);
});
//Users routes
$router->get('/Users',function (){
    $bC=new UsersController();
    $Users=$bC->getUsers();
    print_r($Users);
});

$router->get('/Users/{id}',function ($id){
    $bC=new UsersController();
    $Users=$bC->getUser($id);
    print_r($Users);
});

//Users protected routes

$router->delete('/Users/delete-User/{id}',function ($id){
    $bC=new UsersController();
    $rows=$bC->deleteGood($id);
    print_r($rows);
});

$router->post('/Users/add-User',function (){
    $bC=new UsersController();
    $rows=$bC->addGood();
    print_r($rows);
});

$router->put('/Users/update-User/{id}',function ($id){
    $bC=new UsersController();
    $rows=$bC->updateGood($id);
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
