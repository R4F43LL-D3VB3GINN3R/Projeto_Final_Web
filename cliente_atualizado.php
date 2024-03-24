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

    $cliente = $_POST['cliente'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $aplicacao = $_POST['aplicacao'];
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    $mensagem = $_POST['obs'];
    $orcamento = $_POST['orcamento'];

    $stmt = $conn->prepare("UPDATE tab_pedidos_aceitos 
                            SET cliente = ?, email = ?, phone = ?, aplicacao = ?, orcamento = ?, observacoes = ?, estado = ?, atualizacao = NOW()
                            WHERE id = ?");
    $stmt->bind_param('ssssdssi', $cliente, $email, $phone, $aplicacao, $orcamento, $mensagem, $estado, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {

    ?>

          <div id="message_div">
            <h1>Cliente Atualizado</h1>
            <button onclick="redirect1()" id="buttonmessage">Ok</button>
          </div>  
          <script>
            function redirect1() {

                window.location.href = "cliente_comercial.php";

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

                window.location.href = "cliente_comercial.php";

            }
        </script>
    <?php

    }

    $conn->close();

}

?>
</body>
</html>
