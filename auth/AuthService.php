<?php

require_once 'jwt/JwtService.php';

class AuthService{

    public function login(string $email,string $password){
        $user=$this->validateUser($email,$password);
        $jwt=new JwtService();
        $token=$jwt->issueAccessToken($user);
        $userFields=$this->getUserFields($user);
        $userInfo=[
            'user'=>$userFields,
            'token'=>$token
        ];
        return json_encode($userInfo);
        return $user;
    }

    public function registration(string $email,string $password){
        try {
            $db=new Database();
            $jwt=new JwtService();
            $oldUser=$db->query("SELECT * FROM users WHERE email='$email'");
            if ($oldUser){
                throw new Exception('Пользователь с таким email уже есть');
            }
            $hashPassword=password_hash($password,PASSWORD_DEFAULT);
//            Creating new user
            $db->query("INSERT INTO users (email,password,roleId) VALUES (:email,:password,:roleId)",[
                'email'=>$email,
                'password'=>$hashPassword,
                'roleId'=>2,
            ]);
            $newUser=$db->query("SELECT * FROM users WHERE email='$email'");
            $token=$jwt->issueAccessToken($newUser[0]);
            if ($token==='Ошибка создания токена'){
                throw new Exception('При регистрации произошла ошибка генерации токена');
            }
            $newUserFields=$this->getUserFields($newUser);
            $userInfo=[
                'user'=>$newUserFields,
                'token'=>$token
            ];
            return json_encode($userInfo);
            return $newUser;
        } catch (Exception $e){
            http_response_code(400);
            return $e->getMessage();
        }

    }

    private function validateUser(string $email,string $password){
        try{
            $db=new Database();
            $isValidPassword=false;
            $userQuery=$db->query("SELECT * FROM users WHERE email='$email'");
            $user=$userQuery[0];
            if (!$user){
                http_response_code(400);
                throw new Exception('Пользователя с таким email нет');
            }
            if (password_verify($password,$user['password'])){
                $isValidPassword=true;
            } else {
                http_response_code(400);
                throw new Exception('Пароли не совпадают');
            }
            return $user;

        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    private function getUserFields(array $userInfo):array{
        unset($userInfo['password']);
        return $userInfo;
    }
}