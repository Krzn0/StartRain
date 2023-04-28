<?php
session_start();
require_once('classUser.php');
require_once('classEmpresa.php');
require_once('classRedeSocial.php');
require_once('classSorteio.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    foreach ($cliente as $cliente) {
        echo 'CLASSE DO USUÁRIO<br><br>';
        echo 'Id User: '.$cliente->id.'<br>';
        echo 'Nome: '.$cliente->name.'<br>';
        echo 'Senha: '.$cliente->senha.'<br>';
        echo 'Apelido: '.$cliente->nick.'<br>';
        echo 'Permissao: '.$cliente->permissao.'<br>';
        if ($cliente->permissao_email) {
            echo 'Permissão Email: Permitido<br><br><br>';
        }else {
            echo 'Permissão Email: Não Permitido<br><br><br>';
        }
        
    }

    foreach ($empresa as $empresa) {
        echo 'CLASSE DA EMPRESA<br><br>';
        echo 'Id Empresa: '.$empresa->id.'<br>';
        echo 'Nome Empresa: '.$empresa->name.'<br>';
        echo 'Instagram Link: '.$empresa->instagram_link.'<br>';
        echo 'Facebook Link: '.$empresa->facebook_link.'<br>';
        if ($cliente->ativo) {
            echo 'Status: Ativo<br>';
        }else {
            echo 'Status: Inativo<br>';
        }
        echo 'Nome Página: '.$empresa->page_name.'<br>';
        echo "Cor tema: <span style='color:".$empresa->corTema."'>".$empresa->corTema."</span><br><br><br>";
    }

    foreach ($RedeSocial as $RedeSocial) {
        echo 'CLASSE DAS REDES SOCIAIS<br><br>';
        echo 'Qtde Posts: '.$RedeSocial->Qtde_post.'<br>';
        echo 'Qtde Seguidores: '.$RedeSocial->quantidade_seguidores.'<br>';
        echo 'Meta Anual: '.$RedeSocial->meta_anual.'<br>';
        echo 'Total Ads: '.$RedeSocial->total_ads.'<br><br><br>';
    }

    echo 'CLASSE DO SORTEIO<br><br>';
    foreach ($sorteio as $sorteio) {
        echo 'Nome Cliente: '.mb_convert_encoding($sorteio->name, "UTF-8", "ISO-8859-1").'<br>';
        echo 'Código Sorteio: '.$sorteio->codeSort.'<br>';
        echo 'Telefone: '.$sorteio->phone.'<br>';
        echo 'Email: '.$sorteio->email.'<br>';
        echo 'Idade: '.$sorteio->idade.'<br><br>';
    }
    ?>


</body>
</html>