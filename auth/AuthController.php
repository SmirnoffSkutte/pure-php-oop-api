<?php
require_once 'controller.php';

class AuthController extends Controller {
    public function login(){
        $body=$this->getArrayedJsonBodyRequest();
        $authService=new AuthService();
        $user=$authService->login($body['email'],$body['password']);
        return $user;
    }

    public function registration(){
        $body=$this->getArrayedJsonBodyRequest();
        $authService=new AuthService();
        $newUser=$authService->registration($body['email'],$body['password']);
        return $newUser;
    }
}