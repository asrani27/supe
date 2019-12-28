<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use App\Token;
use App\Endpoint;

class FeederRepo extends TokenRepo{

    protected $type;
    protected $client;
    protected $endpoint;
    protected $token = null;
    protected $body = null;

    public function __construct()
    {
        $this->type = 'POST';
        $this->client = new Client();
        $this->endpoint = Endpoint::where('is_aktif', 'Y')->first()->url;
        $this->token = Token::token();
        $this->parameter = ['token' => $this->token];
    }

    public static function parameter(array $data)
    {
        $self = new self;

        $self->parameter = array_merge($self->parameter, $data);

        return $self;
    }

    public function process()
    {
        $response = $this->client->request($this->type, $this->endpoint,[
            'body' => json_encode($this->parameter)
        ]);

        $body = json_decode(
            (string) $response->getBody(), true
        );
        
        return $this->body = $body;
    }

    public function get()
    {
        $data = $this->process();
        
        if($data['error_code'] == '100') {
            $this->setToken();
            
            $data = $this->process();
        }

        return $data;
    }
    
    public function setToken()
    {
        parent::refreshToken();
        $this->token = Token::token();    
        
        $this->parameter['token'] = $this->token;
    }
}