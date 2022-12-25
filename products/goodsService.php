<?php

class GoodsService{
    public function getById(int $id){
        $db=new Database();
        $query=json_encode($db->query("SELECT goods.id,goods.name,goods.price,categories.name AS categoryName,brands.name AS brandName
        FROM goods
        INNER JOIN categories ON goods.categoryId = categories.id
        INNER JOIN brands ON goods.brandId = brands.id
        WHERE goods.id=$id"));
        return $query;
    }

    public function getByName(string $searchString,int $page,int $limit){
        $db=new Database();
        $search=strtolower($searchString);
        $query=json_encode($db->query("SELECT * FROM `goods` 
        WHERE `name` LIKE '%$search%'"));
        return $query;
    }

    public function getAll(int $page,int $limit,string $orderBy){
        $skipValue=$page*$limit-$limit;
        $lastValue=$skipValue+$limit;
        $db=new Database();
        $query='';
        if($orderBy=='nothing'){
            $query="SELECT * FROM `goods` LIMIT $skipValue,$lastValue";
        } else if($orderBy=='priceDown'){
            $query="SELECT * FROM `goods` ORDER BY $orderBy DECS LIMIT $skipValue,$lastValue";
        } else if($orderBy=='priceUp'){
            $query="SELECT * FROM `goods` ORDER BY $orderBy LIMIT $skipValue,$lastValue";
        } else {
            $query="SELECT * FROM `goods` ORDER BY $orderBy LIMIT $skipValue,$lastValue";
        }
        return json_encode($db->query($query));
    }

    public function getByCategoriesAndPrice(array $categories,int $priceMin,int $priceMax,int $page,int $limit,string $orderBy){
        $offSet=$page*$limit-$limit;
        $db=new Database();
        $length=count($categories);
        $query='';
        $queryCats='';
        if($length<2){
            $query="SELECT * FROM `goods` WHERE categoryId=$categories[0]";
        }
        if ($length>=2){
            for ($i=0;$i<$length;$i++){
                $queryCats=$queryCats."categoryId"."="."$categories[$i]"." "."OR"." ";
            }
            $queryCats=substr($queryCats,null,-3);
//            $query="SELECT * FROM goods WHERE ".$queryCats;
        }
        $price=" AND price BETWEEN $priceMin AND $priceMax";
        if ($orderBy=='nothing'){
            $query="SELECT * FROM goods WHERE ".$queryCats.$price." LIMIT $limit OFFSET $offSet";
        } else if($orderBy=='priceDown'){
            $query="SELECT * FROM goods WHERE ".$queryCats.$price." ORDER BY $orderBy DESC"." LIMIT $limit OFFSET $offSet";
        } else if($orderBy=='priceUp'){
            $query="SELECT * FROM goods WHERE ".$queryCats.$price." ORDER BY $orderBy"." LIMIT $limit OFFSET $offSet";
        } else {
            $query="SELECT * FROM goods WHERE ".$queryCats.$price." ORDER BY $orderBy"." LIMIT $limit OFFSET $offSet";
        }
        return json_encode($db->query($query));
    }

    public function getByBrandsAndPrice(array $brands,int $priceMin,int $priceMax,int $page,int $limit,string $orderBy){
        $offSet=$page*$limit-$limit;
        $db=new Database();
        $length=count($brands);
        $query='';
        $queryBrands='';
        if($length<2){
            $query="SELECT * FROM `goods` WHERE brandId=$brands[0]";
        }
        if ($length>=2){
            for ($i=0;$i<$length;$i++){
                $queryBrands=$queryBrands."brandId"."="."$brands[$i]"." "."OR"." ";
            }
            $queryBrands=substr($queryBrands,null,-3);
//            $query="SELECT * FROM goods WHERE ".$queryCats;
        }
        $price=" AND price BETWEEN $priceMin AND $priceMax";
        if ($orderBy=='nothing'){
            $query="SELECT * FROM goods WHERE ".$queryBrands.$price." LIMIT $limit OFFSET $offSet";
        } else if($orderBy=='priceDown'){
            $query="SELECT * FROM goods WHERE ".$queryBrands.$price." ORDER BY $orderBy DESC"." LIMIT $limit OFFSET $offSet";
        } else if($orderBy=='priceUp'){
            $query="SELECT * FROM goods WHERE ".$queryBrands.$price." ORDER BY $orderBy"." LIMIT $limit OFFSET $offSet";
        } else {
            $query="SELECT * FROM goods WHERE ".$queryBrands.$price." ORDER BY $orderBy"." LIMIT $limit OFFSET $offSet";
        }
        return json_encode($db->query($query));
    }

    public function getByBrandsAndCategoriesAndPrice(array $brands,array $categories,int $priceMin,int $priceMax,int $page,int $limit,string $orderBy){
        $offSet=$page*$limit-$limit;
        $db=new Database();
        $lengthBrands=count($brands);
        $lengthCategories=count($categories);
        $query='';
        $queryCats='';
        $queryBrands='';
        if($lengthCategories<2){
            $queryCats="categoryId=$categories[0]";
        }
        if($lengthBrands<2){
            $queryBrands="brandId=$brands[0]";
        }
        if ($lengthBrands>=2){
            for ($i=0;$i<$lengthBrands;$i++){
                $queryBrands=$queryBrands."brandId"."="."$brands[$i]"." "."OR"." ";
            }
            $queryBrands=substr($queryBrands,null,-3);
        }
        if ($lengthCategories>=2){
            for ($i=0;$i<$lengthCategories;$i++){
                $queryCats=$queryCats." categoryId"."="."$categories[$i]"." "."OR"." ";
            }
            $queryCats=substr($queryCats,null,-3);
        }
        $price=" AND price BETWEEN $priceMin AND $priceMax";
        if ($orderBy=='nothing'){
            $query="SELECT * FROM goods WHERE ".$queryBrands." AND ".$queryCats.$price." LIMIT $limit OFFSET $offSet";
        } else if($orderBy=='priceDown'){
            $query="SELECT * FROM goods WHERE ".$queryBrands." AND ".$queryCats.$price." ORDER BY $orderBy DESC"." LIMIT $limit OFFSET $offSet";
        } else if($orderBy=='priceUp'){
            $query="SELECT * FROM goods WHERE ".$queryBrands." AND ".$queryCats.$price." ORDER BY $orderBy"." LIMIT $limit OFFSET $offSet";
        } else {
            $query="SELECT * FROM goods WHERE ".$queryBrands." AND ".$queryCats.$price." ORDER BY $orderBy"." LIMIT $limit OFFSET $offSet";
        }

        return json_encode($db->query($query));
//        return $query;
    }

//    Admin section

    public function addGood($bodyJson){
        $db=new Database();
        $body=json_decode($bodyJson,true);
        $insert=$db->query("INSERT INTO goods (name,price,categoryId,image,brandId,info) VALUES (
        :name,:price,:categoryId,:image,:brandId,:info)",[
        'name'=>$body['name'],
        'price'=>$body['price'],
        'categoryId'=>$body['categoryId'],
        'image'=>$body['image'],
            'brandId'=>$body['brandId'],
            'info'=>$body['info']
    ]);
        return $insert;
    }

    public function deleteGood(int $id){
        $db=new Database();
        return $db->query("DELETE FROM goods WHERE `id`=$id");
    }

    public function updateGood(int $id,$bodyJson){
        $db=new Database();
        $body=json_decode($bodyJson,true);
        $model=new GoodModel();
        $name=$model->name=$body['name'];
        $price=$model->price=$body['price'];
        $categoryId=$model->categoryId=$body['categoryId'];
        $image=$model->image=$body['image'];
        $brandId=$model->brandId=$body['brandId'];
        $info=$model->info=$body['info'];
        $updatedGood=json_encode($db->query("UPDATE goods 
        SET name='$name',price=$price,categoryId=$categoryId,image='$image',brandId=$brandId,info='$info'
        WHERE `id`=$id"));
        return $updatedGood;
    }


}