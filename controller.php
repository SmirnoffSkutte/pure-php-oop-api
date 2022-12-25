<?php

class Controller{
    public function getJsonBodyRequest(){
        $input = file_get_contents("php://input");
        return $input;
    }
    public function getArrayedJsonBodyRequest(){
        $data = json_decode(file_get_contents('php://input'), true);
        return $data;
    }

    public function getAuthBearerToken():string
    {
        try{
            $reqHeaders=getallheaders();
            $bearerTokenHeader=$reqHeaders['Authorization'];
            if (!isset($bearerTokenHeader)){
                throw new Exception('Отсутствует Authorization Header');
            }
            $bearerToken ='';
            if (substr($bearerTokenHeader, 0, 7) !== 'Bearer ') {
                throw new Exception('Отсутствует токен авторизации внутри заголовка');
            } else {
                $bearerToken=trim(substr($bearerTokenHeader, 7));
            }
        } catch (Exception $e){
            http_response_code(401);
            return $e->getMessage();
        }
        return $bearerToken;
    }

    /*Возвращает 0,если нет токена,другое целое число,если есть*/
    public function identifyUsersRoleId(){
            $token = $this->getAuthBearerToken();
            $jwt = new JwtService();
            $userRole = $jwt->identifyUsersRoleId($token);
        return $userRole;
    }
}