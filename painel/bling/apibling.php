

<?php
    $apiKey = 'ee5f7b5bfc3a34d3b218f7975ec68384935a4b4b03a4b89540042a0ae60e0a1b5f4cf514';
    $endpoint = 'https://bling.com.br/Api/v2/produtos/json/';
    $options = array(
        CURLOPT_URL => $endpoint . "?apikey=" . $apiKey,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "accept: application/json",
        ),
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt_array($curl, $options);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $produtos = json_decode($response);
        foreach ($produtos->retorno->produtos as $produto) {
            echo "Produto: " . $produto->produto->descricao . "<br>";
            echo "Preço: R$" . number_format($produto->produto->preco, 2, ",", ".") . "<br>";
            echo "Tipo: " . $produto->produto->tipo . "<br>";
            echo "Unidade: " . $produto->produto->unidade . "<br><br>";
            
        }
    }
?>
