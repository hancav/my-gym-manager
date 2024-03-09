<?php
namespace App\Http\Controllers\Inference;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\PredictionService;

class InferenceController extends Controller
{
    // i need the method main to be able to use the route
    public function predict()
    {
        $predictionService = new PredictionService();
        $model = 'google-bert/bert-base-uncased';
        $input = ['The goal of life is [MASK]'];
        $prediction = $predictionService->predict($model,$input);
        return collect($prediction)->toJson();
    }

}
