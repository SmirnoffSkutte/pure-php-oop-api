<?php
require_once 'controller.php';

class CategoriesController extends Controller{
    public function addCategorie(){
        try {
            $userRoleId=$this->identifyUsersRoleId();
            if($userRoleId===1){
                $body=$this->getJsonBodyRequest();
                $categoriesService=new CategoriesService();
                $addedRows=$categoriesService->addCategory($body);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }
    public function deleteCategorie(){
        try {
            $userRoleId=$this->identifyUsersRoleId();
            if($userRoleId===1){
                $body=$this->getJsonBodyRequest();
                $categoriesService=new CategoriesService();
                $addedRows=$categoriesService->deleteCategory($body['id']);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }
    public function updateCategorie(){
        try {
            $userRoleId=$this->identifyUsersRoleId();
            if($userRoleId===1){
                $bodyJson=$this->getJsonBodyRequest();
                $body=$this->getArrayedJsonBodyRequest();
                $categoriesService=new CategoriesService();
                $addedRows=$categoriesService->updateCategory($body['id'],$bodyJson);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }
    public function getCategory($id){
        $categoriesService=new CategoriesService();
        return $categoriesService->getCategory($id);
    }
    public function getCategories(){
        $categoriesService=new CategoriesService();
        return $categoriesService->getCategories();
    }
}