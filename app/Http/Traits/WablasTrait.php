<?php

namespace App\Http\Traits;

trait WablasTrait
{
    public static function sendMessage($noHP, $message)
    {
        if (is_array($noHP)){
            $result = [];
            $isError = false;
            foreach($noHP as $e){
                $res = WablasTrait::sendMessage($e, $message);
                $result[] = $res['result'];
                if ($res['error']) $isError = true;
            }
            return ['error'=>$isError,'result'=>$result];
        }
        if (strlen($noHP) < 10) return ['error'=>true];
        $curl = curl_init();
        $token = env('WABLAS_API_KEY');
        $payload = [
            "data" => [[
                'phone' => $noHP,
                'message' => $message,
                'secret' => false,
                'retry' => false,
                'isGroup' => false,
            ]]
        ];
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
                "Content-Type: application/json"
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($curl, CURLOPT_URL,  env('WABLAS_DOMAIN') . "/api/v2/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        return ['error'=>str_contains($result,'phone_invalid'), 'result'=>$result];
    }
}
