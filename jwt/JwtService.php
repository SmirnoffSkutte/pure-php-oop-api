<?php

class JwtService{
    public function issueAccessToken(array $userData):string{
        function base64url_encode($data):string {
            return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
        }

        function base64url_decode($data):string {
            return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
        }
//        $userData=json_decode($userDataJson,true);
        $userTokenInfo=[];
        try {
            if (isset($userData['id']) && isset($userData['email']) && isset($userData['roleId'])) {
                $userTokenInfo['userId'] = $userData['id'];
                $userTokenInfo['email'] = $userData['email'];
                $userTokenInfo['roleId'] = $userData['roleId'];
                $userTokenInfo['iat'] = time();
                $userTokenInfo['exp'] = time() + 7200;
                //build the headers
                $headers = ['alg' => 'HS256', 'typ' => 'JWT'];
                $headers_encoded = base64url_encode(json_encode($headers));

                //build the payload
                //$payload = ['sub'=>'1234567890','name'=>'John Doe', 'admin'=>true];
                $payload_encoded = base64url_encode(json_encode($userTokenInfo));

                //build the signature
                $key = 'wefjnnjwjef34230r0fewf';
                $signature = hash_hmac('sha256', "$headers_encoded.$payload_encoded", $key, true);
                $signature_encoded = base64url_encode($signature);

                //build and return the token
                $token = "$headers_encoded.$payload_encoded.$signature_encoded";
                return $token;
            } else {
                throw new Exception('Ошибка создания токена');
            }
        } catch (Exception $e){
            return $e->getMessage();
        }

    }

    public function verifyToken(string $token):bool{
        function base64url_encode($data):string {
            return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
        }

        try {
            $tokenParts=explode('.',$token);
            $headers_encoded=$tokenParts[0];
            $payload_encoded=$tokenParts[1];
            $userSignature=$tokenParts[2];
                //build the signature to verify
                $key = 'wefjnnjwjef34230r0fewf';
                $signature = hash_hmac('sha256', "$headers_encoded.$payload_encoded", $key, true);
                $signature_encoded = base64url_encode($signature);

                if ($signature_encoded===$userSignature){
                    return true;
                } else {
                    throw new Exception('Токен не валиден');
                    return false;
                }
        }
        catch (Exception $e){
            http_response_code(400);
            return $e->getMessage();
        }
    }

    public function identifyUsersRoleId(string $token){
        if ($token==null){
            return null;
        }
        function base64url_decode($data):string {
            return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
        }
        $tokenParts=explode('.',$token);
        $payload=$tokenParts[1];
        $decodedTokenPayload=json_decode(base64url_decode($payload),true);
        $roleId=$decodedTokenPayload['roleId'];
        return $roleId;
    }
}