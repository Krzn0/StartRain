<?php

//Inicio da sessão
session_start();

//Verifica se a sessão "form_submitted" foi definida
if(!isset($_SESSION['form_submitted'])){
    //Redireciona o usuário de volta para a página do formulário
    header("Location: sorteio.php");
    exit;
}

$servername = "172.106.0.118";
$username = "guiadmin";
$password = "GuilhermeAbreu0909*";
$database_name = "startrain";
$conn = mysqli_connect($servername, $username, $password, $database_name);
        
// Check connection
if($conn === false){
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT su.name, su.codeSort, su.empresa, su.phone, ce.nameEmpresa FROM sorteioUser su JOIN cadEmpresa ce on su.empresa = ce.id");

while($row = mysqli_fetch_assoc($result)) {
   $name = $row['name'];
   $codeSort = $row['codeSort'];
   $empresa = $row['nameEmpresa'];
   $telefone = $row['phone'];
   // agora você pode usar as variáveis $name e $codeSort para armazenar os dados
   // ...
}

$query = "SELECT codeSorteio FROM sorteioVerify";
$result = mysqli_query($conn, $query);
$array = mysqli_fetch_all($result, MYSQLI_ASSOC);
/* 
foreach ($array as $value) {
    foreach($value as $val){
        echo $val . "<br>";
    }
}

print_r($array); */

mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="assets/cssStyle/reset.css" rel="stylesheet">
    <link href="assets/cssStyle/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/Design sem nome.png">
    <title>Document</title>
</head>
<body>
    <div id="header" class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-sm-12" style="margin-bottom: 100px; text-align: center;">
                <h1 style="font-size: 50px;">Parabéns <span style="color: rgb(137, 9, 187);"><?php echo $name;?></span>, você entrou para o sorteio da <span style="color: rgb(137, 9, 187);"><?php echo $empresa;?></span>!</h1>
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <h1 style="text-align: center;">
                Seu código é "<?php echo $codeSort;?>" acompanhe o sorteio pelo nosso instagram
                <a href="https://www.instagram.com/startrain.agencia/">@startrain.agencia</a><?php if ($empresa <> 'StartRain') echo " ou pelo instagram da $empresa"?>, boa sorte!</h1>
                <br>
                <br>
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <h1 style="text-align: center;">
                    Você será notificado via <span style="color: green;">WhattsApp</span> caso ganhe o sorteio. <br><br><br>
                    O número cadastrado foi "<?php echo $telefone;?>". 
                    Certifique-se de que esteja correto, em caso de necessidade de alteração entre em contato com o 
                    email: contato@<span style="color: rgb(137, 9, 187);">startrain</span>.com.br
                </h1>
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <img id="astronautaSorteio" src="/assets/images/VetorSiteSorteio.png" alt="" width="500" height="500" draggable="false">
            </div>
        </div>
    </div>
</body>
</html>