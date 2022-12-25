<?php
require_once 'controller.php';

class BrandsController extends Controller{
    public function addBrand(){
        try {
            $userRoleId=$this->identifyUsersRoleId();
            if($userRoleId===1){
                $body=$this->getJsonBodyRequest();
                $BrandsService=new BrandsService();
                $addedRows=$BrandsService->addCategory($body);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }
    public function deleteBrand(){
        try {
            $userRoleId=$this->identifyUsersRoleId();
            if($userRoleId===1){
                $body=$this->getJsonBodyRequest();
                $BrandsService=new BrandsService();
                $addedRows=$BrandsService->deleteCategory($body['id']);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }
    public function updateBrand(){
        try {
            $userRoleId=$this->identifyUsersRoleId();
            if($userRoleId===1){
                $bodyJson=$this->getJsonBodyRequest();
                $body=$this->getArrayedJsonBodyRequest();
                $BrandsService=new BrandsService();
                $addedRows=$BrandsService->updateCategory($body['id'],$bodyJson);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }
    public function getBrand($id){
        $BrandsService=new BrandsService();
        return $BrandsService->getBrand($id);
    }
    public function getBrands(){
        $BrandsService=new BrandsService();
        return $BrandsService->getBrands();
    }
}