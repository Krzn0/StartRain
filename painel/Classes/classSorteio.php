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

class Sorteio {
    public $name;
    public $codeSort;
    public $phone;
    public $email;
    public $idade;

    public function __construct($name, $codeSort, $phone, $email, $idade) {
        $this->name = $name;
        $this->codeSort = $codeSort;
        $this->phone = $phone;
        $this->email = $email;
        $this->idade = $idade;
    }
}

$sql = "SELECT su.name, su.codeSort, su.phone, su.email, su.idade FROM sorteioUser su JOIN cadEmpresa ce ON ce.id = su.empresa WHERE ce.id_client = $id_usuario";
$result = mysqli_query($conn, $sql);

$sorteio = array();
while ($row = mysqli_fetch_assoc($result)) {
    $sort = new Sorteio($row['name'], $row['codeSort'], $row['phone'], $row['email'],$row['idade']);
    $sorteio[] = $sort;
}

