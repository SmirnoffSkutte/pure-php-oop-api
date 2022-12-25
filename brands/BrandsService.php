<?php

class BrandsService{
    private array $config = [
        'db' => [
            'host'=>'localhost',
            'dbname'=>'shop',
            'user'=>'root',
            'password'=>'123',
            'charset'=>'utf8'
        ]
    ];
    public function getBrands(){
        $db=new Database($this->config['db']);
        $query=$db->query("SELECT * FROM 'brands'");
        return $query;
    }

    public function getBrand(int $id){
        $db=new Database($this->config['db']);
        $query=$db->query("SELECT * FROM 'brands' WHERE 'id'=$id");
        return $query;
    }

//    Admin section

    public function addBrand($bodyJson){
        $db=new Database($this->config['db']);
        $body=json_decode($bodyJson);
        $query=$db->query("INSERT INTO brands (name) VALUES (
        :name)",[
            'name'=>$body['name']
        ]);
        return $query;
    }

    public function updateBrand(int $id,$bodyJson){
        $db=new Database($this->config['db']);
        $body=json_decode($bodyJson);
        $name=$body['name'];
        $query=$db->query("UPDATE brands 
        SET name='$name' WHERE id=$id");
        return $query;
    }

    public function deleteBrand(int $id){
        $db=new Database($this->config['db']);
        $query=$db->query("DELETE * FROM brands WHERE id=$id");
        return $query;
    }
}