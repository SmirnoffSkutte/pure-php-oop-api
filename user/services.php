<?php

require_once 'user.model.php';

class UserService {
    public function GetUsers():object {
        $connect=mysqli_connect('localhost','root','123','shop');
        return mysqli_query($connect,"SELECT * FROM `users`");
    }

    public function GetUser(int $id):object{
        $connect=mysqli_connect('localhost','root','123','shop');
        return mysqli_query($connect,"SELECT * FROM `users` WHERE `id`=`$id`");
    }

    public function  UpdateUser(int $id){
        return null;
    }

    public function DeleteUser(int $id){
        return null;
    }
}