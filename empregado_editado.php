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

    //Conexão com Base de Dados.
    include 'conexao.php';
    //Se o método for post.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Recupera os dados enviados do formulário.
        $nif = $_POST['nif'];
        $nome = $_POST['nome'];
        $apelido = $_POST['apelido'];
        $nome_completo = $_POST['nome_completo'];
        $data_nascimento = $_POST['data_nascimento'];
        $sexo = $_POST['sexo'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $endereco = $_POST['endereco'];
        $estado_civil = $_POST['estado_civil'];
        $dependentes = $_POST['dependentes'];
        $departamento = $_POST['departamento'];
        $cargo = $_POST['cargo'];
        $contrato = $_POST['contrato'];
        $salario = $_POST['salario'];
        $data_contratacao = $_POST['data_contratacao'];
        $estado = $_POST['estado'];
        //Executa a Quer SQL.
        //Atualiza a tabela de funcionários.
        $stmt = $conn->prepare("UPDATE tab_funcionario
                                SET nif = ?, nome = ?, apelido = ?, nome_completo = ?, data_nascimento = ?, sexo = ?, telefone = ?, email = ?, endereco = ?, estado_civil = ?, dependentes = ?, departamento = ?, cargo = ?, tipo_contrato = ?, salario = ?, data_contratacao = ?, estado = ?, atualizacao = NOW()
                                WHERE nome_completo = ?");
        $stmt->bind_param('ssssssssssssssisss', $nif, $nome, $apelido, $nome_completo, $data_nascimento, $sexo, $telefone, $email, $endereco, $estado_civil, $dependentes, $departamento, $cargo, $contrato, $salario, $data_contratacao, $estado, $nome_completo);
        $stmt->execute();
        //Se o número de linhas em result for maior do que zero...
        if ($stmt->affected_rows > 0) {
        ?>

          <div id="message_div">
            <h1>Dados Alterados com Sucesso</h1>
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
                    window.location.href = "editar_empregado.php";
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
