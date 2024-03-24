<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_devsync";

$conn = new mysqli($hostname, $username, $password, $database);

$cliente = $_GET['cliente'];

$stmt = $conn->prepare("DELETE FROM tab_pedido WHERE CLIENTE = ?");
$stmt->bind_param('s', $cliente);
$stmt->execute();

$conn->close();
header("Location: pedidos.php");

?>
