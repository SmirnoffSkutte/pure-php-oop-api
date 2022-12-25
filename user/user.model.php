<?php

class UserModel{
    public int $id;
    public string $email;
    public string $password;
    public string $role;
    public string $avatar;
    function setId($id):int{
        $this->id=$id;
        return $this->id;
    }
    function setEmail($email):string{
        $this->email=$email;
        return $this->email;
    }
    function setPassword($password):string{
        $this->password=$password;
        return $this->password;
    }
    function setRole($role):string{
        $this->role=$role;
        return $this->id;
    }
    function setAvatar($avatar):string{
        $this->avatar=$avatar;
        return $this->id;
    }
}