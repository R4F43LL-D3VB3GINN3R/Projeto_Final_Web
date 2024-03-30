<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevSync-Admin</title>
    <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="styles/insert_message.css">
</head>
<body>

<?php

$hostname = "localhost";
$database = "db_devsync";
$username = "root";
$password = "";

$conn = new mysqli($hostname, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nif = $_POST['nif'];
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $nome_completo = $_POST['nome_completo'];
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $estado_civil = $_POST['estado_civil'];
    $dependentes = $_POST['dependentes'];
    $departamento = $_POST['departamento'];
    $cargo = $_POST['cargo'];
    $contrato = $_POST['contrato'];
    $salario = $_POST['salario'];
    $data_contratacao = $_POST['data_contratacao'];
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("INSERT INTO tab_funcionario (nif, nome, apelido, nome_completo, data_nascimento, sexo, telefone, email, endereco, estado_civil, dependentes, departamento, cargo, tipo_contrato, salario, data_contratacao, estado, atualizacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param('ssssdsssssssssids', $nif, $nome, $apelido, $nome_completo, $data_nascimento, $sexo, $telefone, $email, $endereco, $estado_civil, $dependentes, $departamento, $cargo, $contrato, $salario, $data_contratacao, $estado);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {

    ?>

          <div id="message_div">
            <h1>Novo Funcionário Cadastrado</h1>
            <button onclick="redirect1()" id="buttonmessage">Ok</button>
          </div>  
          <script>
            function redirect1() {

                window.location.href = "novo_empregado.php";

            }
          </script>

    <?php

    } else {

    ?>
        <div id="message_div">
            <h1>Não há autorização para este Cadastro</h1>
            <button onclick="redirect2()">Ok</button>        
        </div>
        <script>
            function redirect2() {

                window.location.href = "novo_empregado.php";

            }
        </script>
    <?php

    }

    $conn->close();

}

?>
</body>
</html>
