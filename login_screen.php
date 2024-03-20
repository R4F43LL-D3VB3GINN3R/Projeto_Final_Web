<?php
    $hostname = "localhost";
    $bancodedados = "db_devsync";
    $usuario = "root";
    $senha = "";

    $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

    // Verifica se houve falha na conexão
if ($mysqli->connect_errno) {
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    echo "Conectado ao banco de dados";
}

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os valores dos campos do formulário
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Prepara a consulta SQL para verificar a senha na tabela tab_admin
    $stmt = $mysqli->prepare("SELECT * FROM tab_admin WHERE login = ? AND pass = ?");
    $stmt->bind_param('ss', $login, $password);
    $stmt->execute();

    // Armazena o resultado da consulta
    $result = $stmt->get_result();

    // Verifica se encontrou algum registro na tabela
    if ($result->num_rows > 0) {
        // Se encontrou, redireciona para a página de sucesso
        header("Location: sucess.html");
        exit;
    } else {
        // Se não encontrou, redireciona para a página de erro
        header("Location: error.html");
        exit;
    }
}

// Fecha a conexão com o banco de dados
$mysqli->close();
?>
