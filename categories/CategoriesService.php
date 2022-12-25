<?php

class CategoriesService{
    private array $config = [
        'db' => [
            'host'=>'localhost',
            'dbname'=>'shop',
            'user'=>'root',
            'password'=>'123',
            'charset'=>'utf8'
        ]
    ];
    public function getCategories(){
        $db=new Database($this->config['db']);
        $query=$db->query("SELECT * FROM 'categories'");
        return $query;
    }

    public function getCategory(int $id){
        $db=new Database($this->config['db']);
        $query=$db->query("SELECT * FROM 'categories' WHERE 'id'=$id");
        return $query;
    }

//    Admin section

    public function addCategory($bodyJson){
        $db=new Database($this->config['db']);
        $body=json_decode($bodyJson);
        $query=$db->query("INSERT INTO categories (name) VALUES (
        :name)",[
            'name'=>$body['name']
        ]);
        return $query;
    }

    public function updateCategory(int $id,$bodyJson){
        $db=new Database($this->config['db']);
        $body=json_decode($bodyJson);
        $name=$body['name'];
        $query=$db->query("UPDATE categories 
        SET name='$name' WHERE id=$id");
        return $query;
    }

    public function deleteCategory(int $id){
        $db=new Database($this->config['db']);
        $query=$db->query("DELETE * FROM categories WHERE id=$id");
        return $query;
    }
}