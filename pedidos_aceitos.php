<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_devsync";

$conn = new mysqli($hostname, $username, $password, $database);

if(isset($_GET['cliente']) && isset($_GET['email']) && isset($_GET['phone']) && isset($_GET['aplicacao']) && isset($_GET['atualizacao'])) {

    $cliente = $_GET['cliente'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    $aplicacao = $_GET['aplicacao'];
    $atualizacao = $_GET['atualizacao'];

    $stmt = $conn->prepare("INSERT INTO tab_pedidos_aceitos (cliente, email, phone, aplicacao, atualizacao) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $cliente, $email, $phone, $aplicacao, $atualizacao);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM tab_pedido WHERE CLIENTE = ?");
    $stmt->bind_param('s', $cliente);
    $stmt->execute();

    $conn->close();
    header("Location: pedidos.php");

} else {
    echo "Parâmetros ausentes.<br>";
}

?>
