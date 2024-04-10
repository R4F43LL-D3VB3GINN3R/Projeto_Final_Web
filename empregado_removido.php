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
            //Se a variável não for nula e tiver sido passada por url...
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                //Decodifica a string JSON para um array associativo
                $funcionario = json_decode($_GET['id'], true);
                // Verifica se 'id' está presente no array e se possui um valor válido
                if (isset($funcionario['id'])) {
                    // Guarda o elemento id na variável.
                    $id = $funcionario['id'];
                    //Conexão com Base de Dados.
                    include 'conexao.php';
                    //Os funcionários não são removidos.
                    //Esta variável foi criada apenas para mudar o seu status.
                    $status = "Inativo";
                    //Executa a Query e muda o status do funcionário.
                    $stmt = $conn->prepare("UPDATE tab_funcionario
                                            SET estado = ?
                                            WHERE id = ?");
                    $stmt->bind_param('si', $status, $id);
                    $stmt->execute();
                    //Se o número de linhas em result for maior do que zero...
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
        //Encerra a conexão
        $conn->close();
    }
}
?>
