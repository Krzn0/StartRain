<?php
$id_usuario = $_SESSION['id'];
$host = "172.106.0.118";
$user = "guiadmin";
$password = "GuilhermeAbreu0909*";
$dbname = "startrain";

$conn = mysqli_connect($host, $user, $password, $dbname);
// Verificação de conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

class Cliente {
    public $id;
    public $name;
    public $senha;
    public $nick;
    public $permissao;
    public $permissao_email;

    public function __construct($id, $name, $senha, $nick, $permissao, $permissao_email) {
        $this->id = $id;
        $this->name = $name;
        $this->senha = $senha;
        $this->nick = $nick;
        $this->permissao = $permissao;
        $this->permissao_email = $permissao_email;
    }
}

$sql = "SELECT id, name_user, password_user, nick_name, permissao, permissao_email FROM users_clients WHERE id = $id_usuario";
$result = mysqli_query($conn, $sql);

$cliente = array();
while ($row = mysqli_fetch_assoc($result)) {
    $client = new Cliente($row['id'], $row['name_user'], $row['password_user'], $row['nick_name'], $row['permissao'], $row['permissao_email']);
    $cliente[] = $client;
}

