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

    $nome_ = $_POST['nome'];
    $login_ = $_POST['login'];
    $senha_ = $_POST['senha'];

    $stmt = $conn->prepare("INSERT INTO tab_admin (nome, login, pass) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $nome_, $login_, $senha_);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {

    ?>

          <div id="message_div">
            <h1>Novo Administrador Cadastrado</h1>
            <button onclick="redirect1()" id="buttonmessage">Ok</button>
          </div>  
          <script>
            function redirect1() {

                window.location.href = "admins.php";

            }
          </script>

    <?php

    } else {

    ?>
        <div id="message_div">
            <h1>Não foi possível adicionar o Administrador</h1>
            <button onclick="redirect2()">Ok</button>        
        </div>
        <script>
            function redirect2() {

                window.location.href = "admins_insert.html";

            }
        </script>
    <?php

    }

    $conn->close();

}

?>
</body>
</html>
