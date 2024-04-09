<?php
//Conexão com a base de dados.
include 'conexao.php';
//Se as variáveis foram declaradas e diferentes de nulo...
//Usamos o método get para buscá-las.
if(isset($_GET['cliente']) && isset($_GET['email']) && isset($_GET['phone']) && isset($_GET['aplicacao']) && isset($_GET['atualizacao'])) {
    //Guarda as variáveis em variáveis PHP.
    $cliente = $_GET['cliente'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    $aplicacao = $_GET['aplicacao'];
    $atualizacao = $_GET['atualizacao'];
    //Executa a Query.
    //Mode o pedido para a tabela de pedidos aceitos.
    $stmt = $conn->prepare("INSERT INTO tab_pedidos_aceitos (cliente, email, phone, aplicacao, atualizacao) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $cliente, $email, $phone, $aplicacao, $atualizacao);
    $stmt->execute();
    //Executa a Query.
    //Remove o pedido da tabela de pedidos.
    $stmt = $conn->prepare("DELETE FROM tab_pedido WHERE CLIENTE = ?");
    $stmt->bind_param('s', $cliente);
    $stmt->execute();
    //Encerra a conexão.
    $conn->close();
    //Redireciona para o url.
    header("Location: pedidos.php");
    //Do contrário...
    } else {
        //Exibe a mensagem.
        echo "Parâmetros ausentes.<br>";
    }
?>
