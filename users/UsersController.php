<?php
require_once 'controller.php';

class UsersController extends Controller{
    public function addUser(){
        try {
            $userUserId=$this->identifyUsersUserId();
            if($userUserId===1){
                $body=$this->getJsonBodyRequest();
                $UsersService=new UsersService();
                $addedRows=$UsersService->addCategory($body);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }
    public function deleteUser(){
        try {
            $userUserId=$this->identifyUsersUserId();
            if($userUserId===1){
                $body=$this->getJsonBodyRequest();
                $UsersService=new UsersService();
                $addedRows=$UsersService->deleteCategory($body['id']);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }
    public function updateUser(){
        try {
            $userUserId=$this->identifyUsersUserId();
            if($userUserId===1){
                $bodyJson=$this->getJsonBodyRequest();
                $body=$this->getArrayedJsonBodyRequest();
                $UsersService=new UsersService();
                $addedRows=$UsersService->updateCategory($body['id'],$bodyJson);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }
    public function getUser(){
        $UsersService=new UsersService();
        $body=$this->getArrayedJsonBodyRequest();
        return $UsersService->getCategory($body['id']);
    }
    public function getUsers(){
        $UsersService=new UsersService();
        return $UsersService->getUsers();
    }
}