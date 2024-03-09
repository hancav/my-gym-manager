<?php

return [
    'endpoint' => env('HUGGING_FACE_ENDPOINT','https://api-inference.huggingface.co/models/'),
    'token' => env('HUGGING_FACE_TOKEN'),
    'model' => env('HUGGING_FACE_MODEL',''),
    'input' => env('HUGGING_FACE_INPUT',''),
];