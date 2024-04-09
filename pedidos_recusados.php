<?php
//Conexão com a base de dados.
include 'conexao.php';
//Método Get para recuperar o nome do cliente.
$cliente = $_GET['cliente'];
//Excecuta a Query.
//Remove o pedido da tabela de cliente.
$stmt = $conn->prepare("DELETE FROM tab_pedido WHERE CLIENTE = ?");
$stmt->bind_param('s', $cliente);
$stmt->execute();
//Encerra a conexão.
$conn->close();
//Redireciona para o url.
header("Location: pedidos.php");
?>
