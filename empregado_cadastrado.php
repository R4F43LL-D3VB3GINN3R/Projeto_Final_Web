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
    //Se o método for post...
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Recupera os dados do formulário.
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
        //Executa a Query SQL
        //Insere o funcionário na base de dados
        $stmt = $conn->prepare("INSERT INTO tab_funcionario (nif, nome, apelido, nome_completo, data_nascimento, sexo, telefone, email, endereco, estado_civil, dependentes, departamento, cargo, tipo_contrato, salario, data_contratacao, estado, atualizacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param('ssssssssssssssiss', $nif, $nome, $apelido, $nome_completo, $data_nascimento, $sexo, $telefone, $email, $endereco, $estado_civil, $dependentes, $departamento, $cargo, $contrato, $salario, $data_contratacao, $estado);
        $stmt->execute();
        //Executa a Query
        //Seleciona o funcionário por nome.
        $sql = "SELECT * FROM tab_funcionario WHERE nome = '$nome'";
        //Guarda os resultados da consulta na variável.
        $result = $conn->query($sql);
        //Se o número de linhas em result for maior do que zero...
        if ($result->num_rows > 0) {
            //Enquanto houver dados encontrados...
            while ($row = $result->fetch_assoc()) {
                //Vari´vel recebe o id do funcionário.
                $id = $row['id'];           
            }
        }
        //Cria variáveis com valores pre-definidos para inserir na tabela.
        $turno = "Manhã";
        $salario_bruto = 0;
        $salario_liquido = 0;
        $plano_saude = "Sim";
        $contribuicao_sindical = "Sim";
        $transporte = "Sim";
        $quant_horaextra = 0;
        $valor_horaextra = 0;
        $quant_horasfaltas = 0;
        $valor_horasfaltas = 0;
        $deducoes = 0;
        $seg_social = 0;
        $irs = 0;
        $bonus_salarial = 0;
        $subsidio = 0;
        //Executa a Query.
        //Insere o id do funcionário na coluna id_funcionário da tabela de pagamento.
        $stmt = $conn->prepare("INSERT INTO tab_pagamento (id_funcionario) VALUES (?)");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        //Executa a Query.
        //Insere o resto das variáveis pre-definidas na tabela de pagamento.
        $stmt = $conn->prepare("INSERT INTO tab_pagamento (id_funcionario, turno, salario_bruto, salario_liquido, plano_saude, contr_sindical, transporte, quant_horaextra, valor_horaextra, quant_horasfaltas, valor_horasfaltas, deducoes, seg_social, irs, bonus_salarial, subsidio, atualizacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param('isiisssiiiiiiiii', $id, $turno, $salario_bruto, $salario_liquido, $plano_saude, $contribuicao_sindical, $transporte, $quant_horaextra, $valor_horaextra, $quant_horasfaltas, $valor_horasfaltas, $deducoes, $seg_social, $irs, $bonus_salarial, $subsidio);
        $stmt->execute();
        //Se o número de linhas em result for maior do que zero...
        if ($stmt->affected_rows > 0) {

        ?>

          <div id="message_div">
            <h1>Novo Funcionário Cadastrado</h1>
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
            <h1>Não há autorização para este Cadastro</h1>
            <button onclick="redirect2()">Ok</button>        
        </div>
        <script>
            function redirect2() {

                window.location.href = "novo_empregado.php";

            }
        </script>
    <?php

    }

    $conn->close();

}

?>
</body>
</html>
