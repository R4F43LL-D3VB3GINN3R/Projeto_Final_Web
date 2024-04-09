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
    //Conexão com a base de dados.
    include 'conexao.php';
    //Se o método for post...
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Recupera dados do formulário.
        $nome_ = $_POST['nome'];
        $login_ = $_POST['login'];
        $senha_ = $_POST['senha'];
        //Executa a Query SQL.
        $stmt = $conn->prepare("INSERT INTO tab_admin (nome, login, pass) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $nome_, $login_, $senha_);
        $stmt->execute();
        //Se alguma linha for afetada...
        if ($stmt->affected_rows > 0) {

    ?>
        <?php // Apresenta caixa de diálogo. ?>
        <div id="message_div"> 
            <h1>Novo Administrador Cadastrado</h1>
            <button onclick="redirect1()" id="buttonmessage">Ok</button>
        </div>  
        <script>
            //Função para redirecionar.
            function redirect1() {

                window.location.href = "admins.php";

            }
        </script>
        <?php // Do contrário...?>
    <?php

        } else {

    ?>
        <?php  //Exibe caixa de diálogo. ?>
        <div id="message_div">
            <h1>Não foi possível adicionar o Administrador</h1>
            <button onclick="redirect2()">Ok</button>        
        </div>
        
        <script>
            //Função para redirecionar.
            function redirect2() {

                window.location.href = "admins_insert.html";

            }
        </script>

    <?php

        }
        //Encerra a conexão.
        $conn->close();

    }

    ?>
</body>
</html>
