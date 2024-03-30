<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/insert_message.css">
        <title>DevSync-Admin</title>
        <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
    </head>
    <body>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Decodifica a string JSON para um array associativo
    $funcionario = json_decode($_GET['id'], true);
    
    // Verifica se 'id' está presente no array e se possui um valor válido
    if (isset($funcionario['id'])) {
        // Acessa o valor do 'id'
        $id = $funcionario['id'];

        $hostname = "localhost";
        $database = "db_devsync";
        $username = "root";
        $password = "";

        $conn = new mysqli($hostname, $username, $password, $database);

        $status = "Inativo";

        $stmt = $conn->prepare("UPDATE tab_funcionario
                                SET estado = ?
                                WHERE id = ?");
        $stmt->bind_param('si', $status, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
?>
            <div id="message_div">
                <h1>Funcionário Removido com Sucesso</h1>
                <button onclick="redirect1()" id="buttonmessage">Ok</button>
            </div>  
            <script>
                function redirect1() {
                    window.location.href = "cadastro_funcionarios.php";
                }
            </script>
<?php
        } else {
?>
            <div id="message_div">
                <h1>Não há autorização para estas Alterações</h1>
                <button onclick="redirect2()">Ok</button>        
            </div>
            <script>
                function redirect2() {
                    window.location.href = "cadastro_funcionarios.php";
                }
            </script>
<?php
        }
        $conn->close();
    }
}
?>
