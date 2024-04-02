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
    <form method="post" id="form_salario">
        <label for="turno">Turno:</label>
        <select name="turno" id="turno_select">
            <option value="Manhã">Manhã</option>
            <option value="Noite">Noite</option>
        </select>
        <input type="submit" value="Gerar" id="gerar_bt" name="gerar_bt">
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
                echo "<script>document.getElementById('salario').value = '$salario';</script>";
                echo "<script>document.querySelector('select[name=\"selected_id\"] [value=\"$selected_id\"]').setAttribute('selected', 'selected');</script>";

                // Exemplo de uso da função
                $selected_id = $_POST['selected_id']; // Obtém o ID selecionado da tabela tab_funcionario
                $data = get_pagamento_data($selected_id, "localhost", "root", "", "db_devsync");

                $turno = $data['turno'];
                $salario_bruto = $data['salario_bruto'];
                $salario_liquido = $data['salario_liquido'];
                $plano_saude = $data['plano_saude'];
                $contr_sindical = $data['contr_sindical'];
                $transporte = $data['transporte'];
                $valor_horaextra = $data['valor_horaextra'];
                $valor_horasfaltas = $data['valor_horasfaltas'];
                $deducoes = $data['deducoes'];
                $seg_social = $data['seg_social'];
                $irs = $data['irs'];
                $bonus_salarial = $data['bonus_salarial'];
                $subsidio = $data['subsidio'];
                $atualizacao = $data['atualizacao'];

                echo "Turno: " . $data['turno'] . "<br>";
                echo "Salário Bruto: " . $data['salario_bruto'] . "<br>";
                echo "Salário Líquido: " . $data['salario_liquido'] . "<br>";
                echo "Plano de Saúde: " . $data['plano_saude'] . "<br>";
                echo "Contribuição Sindical: " . $data['contr_sindical'] . "<br>";
                echo "Transporte: " . $data['transporte'] . "<br>";
                echo "Valor Hora Extra: " . $data['valor_horaextra'] . "<br>";
                echo "Valor Horas Faltas: " . $data['valor_horasfaltas'] . "<br>";
                echo "Deduções: " . $data['deducoes'] . "<br>";
                echo "Seguro Social: " . $data['seg_social'] . "<br>";
                echo "IRS: " . $data['irs'] . "<br>";
                echo "Bônus Salarial: " . $data['bonus_salarial'] . "<br>";
                echo "Subsídio: " . $data['subsidio'] . "<br>";
                echo "Última Atualização: " . $data['atualizacao'] . "<br>";

                // Agora, $data contém os dados da tabela tab_pagamento para o funcionário selecionado
                // Você pode acessar os valores individualmente usando $data['nome_do_campo']

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
