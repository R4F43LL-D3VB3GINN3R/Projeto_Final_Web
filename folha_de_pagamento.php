<?php
//Funcao para calcular salario;
function get_pagamento_data($selected_id, $hostname, $username, $password, $database) {
    // Estabelece a conexão com o banco de dados
    $conn = new mysqli($hostname, $username, $password, $database);

    // Verifica se a conexão foi bem-sucedida
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Consulta SQL para obter os dados da tabela tab_pagamento com base no ID selecionado da tabela tab_funcionario
    $sql = "SELECT * FROM tab_pagamento WHERE id_funcionario = $selected_id";

    // Executa a consulta SQL
    $result = $conn->query($sql);

    // Verifica se há resultados retornados pela consulta
    if ($result->num_rows > 0) {
        // Loop através dos resultados e armazena os dados em um array associativo
        $data = $result->fetch_assoc();
    } else {
        // Se nenhum resultado for encontrado, define $data como vazio
        $data = array();
        echo "Nenhum pagamento encontrado para o funcionário selecionado.";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();

    // Retorna os dados obtidos da tabela tab_pagamento
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/folha_de_pagamento.css">
    <title>DevSync-Admin</title>
    <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
</head>
<body>

<section class="layout">
  <div class="name1">
    <label for="nome">Selecione</label>

    <form method="post" action="">
    <select name="selected_id" id="selected_id">

        <?php
            $hostname = "localhost";
            $username = "root";
            $pass = "";
            $database = "db_devsync";

            $conn = new mysqli($hostname, $username, $pass, $database);

            $sql = "SELECT * FROM tab_funcionario WHERE estado = 'Ativo'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['nome_completo'] . '</option>';
                }
            }
            $conn->close();
        ?>
    </select>

    <label for="salario" id="label_salario">Salário</label>
    <input type="text" name="salario" id="salario" ReadOnly="true">
    <button type="submit" id="botao_salario">Procurar</button>
    </form>
  </div>
  <div class="name2">
    <form method="post" id="form_salario" action="folha_de_pagamento2.php">
        <label for="id">Id:</label>
        <input type="text" name="id" id="id" ReadOnly="true">
        <label for="turno">Turno:</label>
        <select name="turno" id="turno_select">
            <option value="Manhã">Manhã</option>
            <option value="Noite">Noite</option>
        </select>
        <label for="salario_bruto">Salário Bruto:</label>
        <input type="text" name="salario_bruto" id="salario_bruto">
        <label for="salario_liquido">Salário Líquido:</label>
        <input type="text" name="salario_liquido" id="salario_liquido">
        <label for="plano_saude">Plano de Saúde:</label>
        <select name="plano_saude" id="plano_saude">
            <option value="Sim">Sim</option>
            <option value="Não">Não</option>
        </select>
        <label for="contribuicao_sindical">Contribuição Sindical:</label>
        <select name="contribuicao_sindical" id="contribuicao_sindical">
            <option value="Sim">Sim</option>
            <option value="Não">Não</option>
        </select>
        <label for="ticket_transporte">Ticket Transporte:</label>
        <select name="ticket_transporte" id="ticket_transporte">
            <option value="Sim">Sim</option>
            <option value="Não">Não</option>
        </select>
        <label for="hora_extra2">Quantidade Horas Extras:</label>
        <input type="text" name="hora_extra2" id="hora_extra2">
        <label for="hora_extra">Valor Horas Extras:</label>
        <input type="text" name="hora_extra" id="hora_extra">
        <label for="hora_falta2">Quantidade Horas Faltas:</label>
        <input type="text" name="hora_falta2" id="hora_falta2">
        <label for="hora_falta">Valor Horas Faltas:</label>
        <input type="text" name="hora_falta" id="hora_falta">
        <label for="deducoes">Deduções Salariais:</label>
        <input type="text" name="deducoes" id="deducoes">
        <label for="seguranca_social">Segurança Social:</label>
        <input type="text" name="seguranca_social" id="seguranca_social">
        <label for="irs">IRS:</label>
        <input type="text" name="irs" id="irs">
        <label for="bonus_salarial">Bônus Salarial:</label>
        <input type="text" name="bonus_salarial" id="bonus_salarial">
        <label for="subsidio">Subsídio:</label>
        <input type="text" name="subsidio" id="subsidio">
        <label for="atualizacao">Última Atualização:</label>
        <input type="text" name="atualizacao" id="atualizacao" ReadOnly="true">
        <input type="hidden" name="salariobase" id="salariobase">
        <input type="hidden" name="selected_id" value="<?php echo $selected_id; ?>">
        <input type="submit" value="Gerar Pagamento" id="gerar_bt">
    </form>
</div>
  <div class="name3">
  <button onclick="redirect()" id="botao_voltar">Voltar</button>
  </div>
</section>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['selected_id'])) {
            $selected_id = $_POST['selected_id'];

            // Realize uma consulta para obter o salário do funcionário selecionado
            $conn = new mysqli($hostname, $username, $pass, $database);
            $sql = "SELECT nome_completo, salario FROM tab_funcionario WHERE id = $selected_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                $salario = $row['salario'];
                $nome_completo = $row['nome_completo'];

                 // Exemplo de uso da função
                 $selected_id = $_POST['selected_id']; // Obtém o ID selecionado da tabela tab_funcionario
                 $data = get_pagamento_data($selected_id, "localhost", "root", "", "db_devsync");

                //dados retirados da consulta e do vetor.
                //separado cada elemento em uma variável.
                $turno = $data['turno'];
                $salario_bruto = $data['salario_bruto'];
                $salario_liquido = $data['salario_liquido'];
                $plano_saude = $data['plano_saude'];
                $contr_sindical = $data['contr_sindical'];
                $transporte = $data['transporte'];
                $quant_horaextra = $data['quant_horaextra'];
                $valor_horaextra = $data['valor_horaextra'];
                $quant_horasfaltas = $data['quant_horasfaltas'];
                $valor_horasfaltas = $data['valor_horasfaltas'];
                $deducoes = $data['deducoes'];
                $seg_social = $data['seg_social'];
                $irs = $data['irs'];
                $bonus_salarial = $data['bonus_salarial'];
                $subsidio = $data['subsidio'];
                $atualizacao = $data['atualizacao'];

                //inputs recebem o valores...
                echo "<script>document.getElementById('id').value = '$selected_id';</script>";
                echo "<script>document.getElementById('salario').value = '$salario';</script>";
                echo "<script>document.querySelector('select[name=\"selected_id\"] [value=\"$selected_id\"]').setAttribute('selected', 'selected');</script>";
                echo "<script>document.getElementById('turno_select').value = '$turno';</script>";
                echo "<script>document.getElementById('salario_bruto').value = '$salario_bruto';</script>";
                echo "<script>document.getElementById('salario_liquido').value = '$salario_liquido';</script>";
                echo "<script>document.getElementById('plano_saude').value = '$plano_saude';</script>";
                echo "<script>document.getElementById('contribuicao_sindical').value = '$contr_sindical';</script>";
                echo "<script>document.getElementById('ticket_transporte').value = '$transporte';</script>";
                echo "<script>document.getElementById('hora_extra2').value = '$quant_horaextra';</script>";
                echo "<script>document.getElementById('hora_extra').value = '$valor_horaextra';</script>";
                echo "<script>document.getElementById('hora_falta2').value = '$quant_horasfaltas';</script>";
                echo "<script>document.getElementById('hora_falta').value = '$valor_horasfaltas';</script>";
                echo "<script>document.getElementById('deducoes').value = '$deducoes';</script>";
                echo "<script>document.getElementById('seguranca_social').value = '$seg_social';</script>";
                echo "<script>document.getElementById('irs').value = '$irs';</script>";
                echo "<script>document.getElementById('bonus_salarial').value = '$bonus_salarial';</script>";
                echo "<script>document.getElementById('subsidio').value = '$subsidio';</script>";
                echo "<script>document.getElementById('atualizacao').value = '$atualizacao';</script>";
                echo "<script>document.getElementById('salariobase').value = '$salario';</script>";
                

            } else {
                echo "<script>alert('Funcionário não encontrado.');</script>";
            }
            $conn->close();
        }
    }

?>

</body>
<script>
    function redirect() {
        window.location.href = "rh.html";
    }
</script>
</html>
