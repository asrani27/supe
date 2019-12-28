<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use App\Token;
use App\Endpoint;

class TokenRepo{

    public function newToken()
    {
        $client = new Client();
        $base_uri = Endpoint::where('is_aktif', 'Y')->first()->url; 
        $response = $client->request('POST', $base_uri, [
            'body' => json_encode([
                'act' => 'GetToken',
                'username' => env('FEEDER_U'),                
                'password' => env('FEEDER_P')              
            ])
        ]);
        return (string) $response->getBody();
    }

    public function saveToken()
    {
        $data = json_decode($this->newToken(), true);
        if($data['error_code'] != 0) {
            return false;
        }
        
        $check = Token::first();
        
        if($check) {
            $check->token = $data['data']['token'];
            $check->save();
        } else {
            $s = new Token;
            $s->token = $data['data']['token'];
            $s->save();
        }
        return true;
    }

    public function refreshToken()
    {
        return $this->saveToken();
    }
}