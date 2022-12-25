<?php

class rolesService{
    private array $config = [
        'db' => [
            'host'=>'localhost',
            'dbname'=>'shop',
            'user'=>'root',
            'password'=>'123',
            'charset'=>'utf8'
        ]
    ];
    public function getRoles(){
        $db=new Database($this->config['db']);
        $query=$db->query("SELECT * FROM 'roles'");
        return $query;
    }

    public function getRole(int $id){
        $db=new Database($this->config['db']);
        $query=$db->query("SELECT * FROM 'roles' WHERE 'id'=$id");
        return $query;
    }

//    Admin section

    public function addRole($bodyJson){
        $db=new Database($this->config['db']);
        $body=json_decode($bodyJson);
        $query=$db->query("INSERT INTO roles (name) VALUES (
        :name)",[
            'name'=>$body['name']
        ]);
        return $query;
    }

    public function updateRole(int $id,$bodyJson){
        $db=new Database($this->config['db']);
        $body=json_decode($bodyJson);
        $name=$body['name'];
        $query=$db->query("UPDATE roles 
        SET name='$name' WHERE id=$id");
        return $query;
    }

    public function deleteRole(int $id){
        $db=new Database($this->config['db']);
        $query=$db->query("DELETE * FROM roles WHERE id=$id");
        return $query;
    }
}