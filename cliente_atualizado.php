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
    //Conecta à base de dados
    include 'conexao.php';
    //Se o método for post...
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Recupera dados do formulário.
        $cliente = $_POST['cliente'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $aplicacao = $_POST['aplicacao'];
        $id = $_POST['id'];
        $estado = $_POST['estado'];
        $mensagem = $_POST['obs'];
        $orcamento = $_POST['orcamento'];
        //Executa a Query SQL.
        $stmt = $conn->prepare("UPDATE tab_pedidos_aceitos 
                                SET cliente = ?, email = ?, phone = ?, aplicacao = ?, orcamento = ?, observacoes = ?, estado = ?, atualizacao = NOW()
                                WHERE id = ?");
        $stmt->bind_param('ssssdssi', $cliente, $email, $phone, $aplicacao, $orcamento, $mensagem, $estado, $id);
        $stmt->execute();
        //Se alguma linha for afetada...
        if ($stmt->affected_rows > 0) {
    ?>
        <?php // Exibe a caixa de mensagem.?>
        <div id="message_div">
            <h1>Cliente Atualizado</h1>
            <button onclick="redirect1()" id="buttonmessage">Ok</button>
        </div>  
        <script>
            //Função para redirecionar.
            function redirect1() {
                window.location.href = "cliente_comercial.php";
            }
        </script>

        <?php
        // Do contrário...
        } else {

        ?>

        <?php // Exibe a caixa de mensagem.?>
        <div id="message_div">
            <h1>Não foi possível adicionar o Administrador</h1>
            <button onclick="redirect2()">Ok</button>        
        </div>
        <script>
            //Função para redirecionar.
            function redirect2() {
                window.location.href = "cliente_comercial.php";
            }
        </script>

        <?php
        }
        //Encerra a conexão
        $conn->close();
    }
    ?>
    
</body>
</html>
