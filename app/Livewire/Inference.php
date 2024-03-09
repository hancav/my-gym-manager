<?php

namespace App\Livewire;

use Livewire\Component;
use App\Helpers\PredictionService;

class Inference extends Component
{
    public $question = '';
    public $answer = '';
 
    public function predict()
    {
        $predictionService = new PredictionService();
        //$input = ['The goal of life is [MASK]'];
        $response = $predictionService->predict('gpt2',$this->question);
        $this->answer= substr($response[0]['generated_text'], 0, 100);
    }
       

    public function render()
    {
        return view('livewire.inference');
    }
}
