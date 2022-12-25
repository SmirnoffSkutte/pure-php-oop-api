<?php
require_once 'controller.php';

class RolesController extends Controller{
    public function addRole(){
        try {
            $userRoleId=$this->identifyUsersRoleId();
            if($userRoleId===1){
                $body=$this->getJsonBodyRequest();
                $RolesService=new RolesService();
                $addedRows=$RolesService->addCategory($body);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }
    public function deleteRole(){
        try {
            $userRoleId=$this->identifyUsersRoleId();
            if($userRoleId===1){
                $body=$this->getJsonBodyRequest();
                $RolesService=new RolesService();
                $addedRows=$RolesService->deleteCategory($body['id']);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }
    public function updateRole(){
        try {
            $userRoleId=$this->identifyUsersRoleId();
            if($userRoleId===1){
                $bodyJson=$this->getJsonBodyRequest();
                $body=$this->getArrayedJsonBodyRequest();
                $RolesService=new RolesService();
                $addedRows=$RolesService->updateCategory($body['id'],$bodyJson);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }
    public function getRole(){
        $RolesService=new RolesService();
        $body=$this->getArrayedJsonBodyRequest();
        return $RolesService->getCategory($body['id']);
    }
    public function getRoles(){
        $RolesService=new RolesService();
        return $RolesService->getRoles();
    }
}