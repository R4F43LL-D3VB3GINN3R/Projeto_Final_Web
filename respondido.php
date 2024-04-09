<?php
    //Conexão com base de dados.
    include 'conexao.php';
    //Recebe o email com o método Get.
    $email = $_GET['email'];
    //Executa a Query.
    $stmt = $conn->prepare("UPDATE tab_contato SET RESPOSTA = 'RESPONDIDO' WHERE EMAIL = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    //Enccerra a conexão.
    $conn->close();
    //Redireciona de volta à mesma página.
    header("Location: caixa_de_mensagens.php");
?>
