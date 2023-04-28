<?php
    session_start();
    if (!isset($_SESSION['username']) || $_SESSION['permissao']!="admin") {
        header("Location:login.php");
        exit();
    }

    $host = "172.106.0.118";
    $user = "guiadmin";
    $password = "GuilhermeAbreu0909*";
    $dbname = "startrain";

    $conn = mysqli_connect($host, $user, $password, $dbname);

    // Selecionar todos os dados da tabela "cadEmpresas"
    $query = "
    SELECT nameEmpresa,instagram_link,facebook_link,id_client,page_name 
    FROM cadEmpresa
    WHERE ativo=1
    ";
    $result = mysqli_query($conn, $query);

    $query = "
    SELECT nameEmpresa,instagram_link,facebook_link,id_client,page_name 
    FROM cadEmpresa
    WHERE ativo=1
    ";
    $results = mysqli_query($conn, $query);

    $query2 = "
    SELECT us.id, us.name_user, us.nick_name, ce.nameEmpresa, us.permissao FROM users_clients us JOIN cadEmpresa ce on ce.id_client = us.id
    ";
    $results2 = mysqli_query($conn, $query2);

    $query3 = "
    SELECT id, name_user, nick_name, permissao FROM users_clients 
    ";
    $results3 = mysqli_query($conn, $query3);
    // Loop through the tables
foreach ($results as $table) {
    $content = "";
    $filename = $table['page_name'].".php";
    file_put_contents($filename,"");
    $content = "<?php include('panelAdmin.php')?>";
    file_put_contents($filename, $content, FILE_APPEND);
  }
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
    <link href="assets/cssStyle/login.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="assets/images/Design sem nome.png">
    <title>Bem vindo, <?php echo $_SESSION['nickname']?>!</title>
</head>
<body>
    
<div class="container" style="margin-top: 100px;">
    <div class="row" style="margin-bottom: 100px;">
        <div class="col-xl-6 col-lg-12 col-sm-12">
          <img id="logoimg" width="300xp" height="75px" src="/assets/images/StartRainFundo.png" alt="">
        </div>
        <div class="col-xl-6 col-lg-12 col-sm-12" style="text-align: center; margin-top: 20px;">
            <a href="addEmpresa.php"><button type="button" class="btn btn-secondary"><img src="/assets/icons/addEmpresaWhiteV2.png"/></button></a>
            <a href="addUser.php"><button type="button" class="btn btn-secondary"><img src="/assets/icons/addUserWhite.png"/></button></a>
        </div>
    </div>
    <h1 id="textBv" style="font-size: 1.7rem;">Olá <span class="spanNick"><?php echo $_SESSION['nickname']?></span>, esperamos que esteja bem, fique a vontade! Que empresa você pretende analisar hoje?</h1><br>
    <!-- <h2><?php echo $_SESSION['id'];?></h2> -->
<br><br>
<div class="accordion" id="accordionPanelsStayOpenExample">
  <div class="accordion-item" style="background-color: #101728; border-color: #A306A3;">
    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne" style="background-color: #101728; color: white; font-size: 1.5rem">
        Empresas Ativas
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
      <div class="accordion-body">
        <?php echo "<ul style='margin-bottom:40px'>";
        // Fazer um loop nos dados retornados
        while ($row = mysqli_fetch_assoc($result)) {
            // Exibir o nome da empresa em uma lista
            echo "<br><li><span style='color:white;font-size:23px'>" . $row['nameEmpresa'] . ":</span>
            <span>&nbsp; <a target='_blank' href='".$row['instagram_link']."'>
            <img class='iconEmpresas'src='https://img.icons8.com/nolan/32/1A6DFF/C822FF/instagram-new.png'/></a></span>
            <span>&nbsp; <img class='iconEmpresas' src='https://img.icons8.com/nolan/32/1A6DFF/C822FF/facebook.png'/></span>
            <span>&nbsp; <a href='".$row['page_name'].".php'><img class='iconEmpresas' src='https://img.icons8.com/nolan/32/1A6DFF/C822FF/wrench.png'/></a></span></li>";
        }
        // Fechar a lista
        echo "</ul><br>";
        ?>
      </div>
    </div>
  </div>
  <div class="accordion-item" style="background-color: #101728; border-color: #A306A3;">
    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo" style="background-color: #101728; color: white; font-size: 1.5rem">
        Usuários Donos
      </button>
    </h2>
    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
      <div class="accordion-body">
        <table class="table table-bordered table-dark table-striped" style="font-size: 1rem;">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Apelido</th>
                <th scope="col">Empresa</th>
                <th scope="col">Permissão</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($results2)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name_user']; ?></td>
                        <td><?php echo $row['nick_name']; ?></td>
                        <td><?php echo $row['nameEmpresa']; ?></td>
                        <td><?php echo $row['permissao']; ?></td>
                    </tr>
                <?php endwhile;?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="accordion-item" style="background-color: #101728; border-color: #A306A3;">
    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree" style="background-color: #101728; color: white; font-size: 1.5rem">
        Usuários Ativos
      </button>
    </h2>
    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
      <div class="accordion-body">
      <table class="table table-bordered table-dark table-striped" style="font-size: 1rem;">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Apelido</th>
                <th scope="col">Permissão</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($results3)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name_user']; ?></td>
                        <td><?php echo $row['nick_name']; ?></td>
                        <td><?php echo $row['permissao']; ?></td>
                    </tr>
                <?php endwhile;?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>




<!-- 
    <p style="margin-top: 50px; font-size: 1.2rem;">Empresas Ativas:</p>
    <?php echo "<ul style='margin-bottom:40px'>";
    // Fazer um loop nos dados retornados
    while ($row = mysqli_fetch_assoc($result)) {
        // Exibir o nome da empresa em uma lista
        echo "<br><li><span style='color:white;font-size:23px'>" . $row['nameEmpresa'] . ":</span>
        <span>&nbsp; <a target='_blank' href='".$row['instagram_link']."'>
        <img class='iconEmpresas'src='https://img.icons8.com/nolan/32/1A6DFF/C822FF/instagram-new.png'/></a></span>
        <span>&nbsp; <img class='iconEmpresas' src='https://img.icons8.com/nolan/32/1A6DFF/C822FF/facebook.png'/></span>
        <span>&nbsp; <a href='".$row['page_name'].".php'><img class='iconEmpresas' src='https://img.icons8.com/nolan/32/1A6DFF/C822FF/wrench.png'/></a></span></li>";
    }
    // Fechar a lista
    echo "</ul><br>";
    ?>
    <p style="margin-top: 50px; font-size: 1.2rem;">Usuários Ativos:</p><br>
    <table class="table table-bordered table-dark table-striped" style="font-size: 1rem;">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Apelido</th>
                <th scope="col">Permissão</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($results2)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name_user']; ?></td>
                        <td><?php echo $row['nick_name']; ?></td>
                        <td><?php echo $row['permissao']; ?></td>
                    </tr>
                <?php endwhile;?>
            </tbody>
        </table>  
</div>
    
</form> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script>

</script>
</html>