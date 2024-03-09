<?php
namespace App\Helpers;

use GuzzleHttp\Client;

class PredictionService
{
    protected $httpClient;

    public function __construct()
    {
        // set endpoint and token
        $endpoint=config('predict.endpoint');
        $token=config('predict.token');
        
        $this->httpClient = new Client([
            'base_uri' => $endpoint,
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function predict($model='', $input='')
    {
        if ($model=='') $model=config('predict.model');
        if ($input=='') $input=config('predict.input');
        
        $response = $this->httpClient->post($model, [
            'json' => [
                'inputs' => $input,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
