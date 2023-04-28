<?php
// Conexão com o banco de dados

$host = "172.106.0.118";
$user = "guiadmin";
$password = "GuilhermeAbreu0909*";
$dbname = "startrain";

$conn = mysqli_connect($host, $user, $password, $dbname);

// Verificação de conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Recuperando informações do formulário
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta SQL para verificar se o usuário e senha existem no banco
$sql = "SELECT * FROM users_clients WHERE name_user = '$username' AND password_user = '$password'";
$result = mysqli_query($conn, $sql);

// Verificação de resultado
if (mysqli_num_rows($result) > 0) {
    // Usuário e senha existem no banco
    // Verifica se o usuário é administrador
    $row = mysqli_fetch_assoc($result);
    if($row['permissao']=="admin"){
      // Inicie a sessão e redirecione para a página de administrador
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['permissao'] = $row['permissao'];
      $_SESSION['id'] = $row['id'];
      $_SESSION['nickname'] = $row['nick_name'];
      $_SESSION['permissao_email'] = $row['permissao_email'];
      header("Location: ../painelAdm/visao_geral.php");
      exit();
    }else{
      // Inicie a sessão e redirecione para a página de usuário
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['permissao'] = $row['permissao'];
      $_SESSION['id'] = $row['id'];
      $_SESSION['nickname'] = $row['nick_name'];
      $_SESSION['permissao_email'] = $row['permissao_email'];
      header("Location: ../painel/dashboard.php");
      exit();
    }
} else {
    // Usuário e senha não existem no banco
    // Exibir mensagem de erro e redirecionar para a página de login
    echo "<script type='text/javascript'>alert('Usuário e/ou senha incorretos.'); window.location='../login.php'; </script>";
    /* echo "Usuário e/ou senha incorretos."; */
    header("Refresh: 3; url=../login.php");
}

// Fechando conexão
mysqli_close($conn);
?>