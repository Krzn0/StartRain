<?php

function geradorIa($pedidoText){
    // URL of the DALL-E API
    $api_url = 'https://api.openai.com/v1/images/generations';

    // Your OpenAI API key
    $api_key = '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';

    // Text to generate image
    $text = $pedidoText;

    // Image generation options
    $options = [
        'prompt' => $text,
        'model' => 'image-alpha-001',
        'size' => '1024x1024'
    ];

    // Initialize cURL library
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Configure cURL request
    curl_setopt_array($ch, [
        CURLOPT_URL => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        ],
        CURLOPT_POSTFIELDS => json_encode($options)
    ]);

    // Execute cURL request
    $response = curl_exec($ch);

    // Close cURL library
    curl_close($ch);
    /* echo($response); */
    // Decode JSON response
    $data = json_decode($response, true);

    // Get the generated image URL
    $image_url = $data['data'][0]['url'];

    // Display the generated image on the page
    $resultadoIa = '<img src="' . $image_url . '" alt="' . $text . '" />';
    return $resultadoIa;
}
