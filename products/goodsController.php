<?php
require_once 'controller.php';
class GoodsController extends Controller {
    public function getById(int $id){
        $gS=new GoodsService();
        $query=$gS->getById($id);
        return $query;
    }

    public function getByName(){
        $gS=new GoodsService();
        $bodyJSONArray=$this->getArrayedJsonBodyRequest();
        $searchQuery=$bodyJSONArray['searchQuery'];
        $page=$bodyJSONArray['page'];
        $limit=$bodyJSONArray['limit'];
        $query=$gS->getByName($searchQuery,$page,$limit);
        return $query;
    }

    public function getAll(){
        $gS=new GoodsService();
        $bodyJSONArray=$this->getArrayedJsonBodyRequest();
        $page=$bodyJSONArray['page'];
        $limit=$bodyJSONArray['limit'];
        $orderBy=$bodyJSONArray['orderBy'];
        $query=$gS->getAll($page,$limit,$orderBy);
        return $query;
    }

    public function getByCatsBrandsPrice(){
        $gS=new GoodsService();
        $bodyJSONArray=$this->getArrayedJsonBodyRequest();
        $priceMin=$bodyJSONArray['priceMin'];
        $priceMax=$bodyJSONArray['priceMax'];
        $brands=$bodyJSONArray['brands'];
        $cats=$bodyJSONArray['categories'];
        $page=$bodyJSONArray['page'];
        $limit=$bodyJSONArray['limit'];
        $orderBy=$bodyJSONArray['orderBy'];
        $query=$gS->getByBrandsAndCategoriesAndPrice($brands,$cats,$priceMin,$priceMax,$page,$limit,$orderBy);
        return $query;
    }

    public function getByCatsAndPrice(){
        $gS=new GoodsService();
        $bodyJSONArray=$this->getArrayedJsonBodyRequest();
        $priceMin=$bodyJSONArray['priceMin'];
        $priceMax=$bodyJSONArray['priceMax'];
        $cats=$bodyJSONArray['categories'];
        $page=$bodyJSONArray['page'];
        $limit=$bodyJSONArray['limit'];
        $orderBy=$bodyJSONArray['orderBy'];
        $query=$gS->getByCategoriesAndPrice($cats,$priceMin,$priceMax,$page,$limit,$orderBy);
        return $query;
    }

    public function getByBrandsAndPrice(){
        $gS=new GoodsService();
        $bodyJSONArray=$this->getArrayedJsonBodyRequest();
        $priceMin=$bodyJSONArray['priceMin'];
        $priceMax=$bodyJSONArray['priceMax'];
        $brands=$bodyJSONArray['brands'];
        $page=$bodyJSONArray['page'];
        $limit=$bodyJSONArray['limit'];
        $orderBy=$bodyJSONArray['orderBy'];
        $query=$gS->getByBrandsAndPrice($brands,$priceMin,$priceMax,$page,$limit,$orderBy);
        return $query;
    }

    //Admin Section

    public function addGood(){
        try {
            $userRoleId=$this->identifyUsersRoleId();
            if($userRoleId===1){
                $gS=new GoodsService();
                $bodyJSON=$this->getJsonBodyRequest();
                $addedRows=$gS->addGood($bodyJSON);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }

    public function updateGood(int $id){
        try {
            $userRoleId=$this->identifyUsersRoleId();
            if($userRoleId===1){
                $gS=new GoodsService();
                $bodyJSON=$this->getJsonBodyRequest();
                $addedRows=$gS->updateGood($id,$bodyJSON);
                return $addedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
    }

    public function deleteGood(int $id){
        try {
            $userRoleId=$this->identifyUsersRoleId();
            if($userRoleId===1){
                $gS=new GoodsService();
                $deletedRows=$gS->deleteGood($id);
                if ($deletedRows==0){
                    throw new Exception('Удаление не произошло,нет такого id или что-то еще');
                }
                return $deletedRows;
            } else {
                throw new Exception('Вы не авторизованы как админ');
            }
        } catch (Exception $e){
            if ($e->getMessage()==='Удаление не произошло,нет такого id или что-то еще'){
                http_response_code(403);
                return $e->getMessage();
            } else {
                http_response_code(401);
                return $e->getMessage();
            }
        }
    }

}