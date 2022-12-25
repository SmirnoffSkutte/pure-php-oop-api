<?php

class UsersService{
    private array $config = [
        'db' => [
            'host'=>'localhost',
            'dbname'=>'shop',
            'user'=>'root',
            'password'=>'123',
            'charset'=>'utf8'
        ]
    ];
    public function getUsers(){
        $db=new Database($this->config['db']);
        $query=$db->query("SELECT * FROM 'Users'");
        return $query;
    }

    public function getUser(int $id){
        $db=new Database($this->config['db']);
        $query=$db->query("SELECT * FROM 'Users' WHERE 'id'=$id");
        return $query;
    }

//    Admin section

    public function addUser($bodyJson){
        $db=new Database($this->config['db']);
        $body=json_decode($bodyJson);
        $query=$db->query("INSERT INTO Users (name) VALUES (
        :name)",[
            'name'=>$body['name']
        ]);
        return $query;
    }

    public function updateUser(int $id,$bodyJson){
        $db=new Database($this->config['db']);
        $body=json_decode($bodyJson);
        $name=$body['name'];
        $query=$db->query("UPDATE Users 
        SET name='$name' WHERE id=$id");
        return $query;
    }

    public function deleteUser(int $id){
        $db=new Database($this->config['db']);
        $query=$db->query("DELETE * FROM Users WHERE id=$id");
        return $query;
    }
}