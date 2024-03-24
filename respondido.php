<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_devsync";

$conn = new mysqli($hostname, $username, $password, $database);

$email = $_GET['email'];

$stmt = $conn->prepare("UPDATE tab_contato SET RESPOSTA = 'RESPONDIDO' WHERE EMAIL = ?");
$stmt->bind_param('s', $email);
$stmt->execute();

$conn->close();
header("Location: caixa_de_mensagens.php");

?>
