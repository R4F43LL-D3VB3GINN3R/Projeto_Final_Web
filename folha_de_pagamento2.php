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

$hostname = "localhost";
$database = "db_devsync";
$username = "root";
$password = "";

$conn = new mysqli($hostname, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $selected_id = $_POST['id'];
    $turno = $_POST['turno'];
    $salario_bruto = $_POST['salario_bruto'];
    $salario_liquido = $_POST['salario_liquido'];
    $plano_saude = $_POST['plano_saude'];
    $contribuicao_sindical = $_POST['contribuicao_sindical'];
    $ticket_transporte = $_POST['ticket_transporte'];
    $hora_extra = $_POST['hora_extra'];
    $hora_falta = $_POST['hora_falta'];
    $deducoes = $_POST['deducoes'];
    $seguranca_social = $_POST['seguranca_social'];
    $irs = $_POST['irs'];
    $bonus_salarial = $_POST['bonus_salarial'];
    $subsidio = $_POST['subsidio'];

    $stmt = $conn->prepare("UPDATE tab_pagamento
                            SET turno = ?, salario_bruto = ?, salario_liquido = ?, plano_saude = ?, contr_sindical = ?, transporte = ?, valor_horaextra = ?, valor_horasfaltas = ?, deducoes = ?, seg_social = ?, irs = ?, bonus_salarial = ?, subsidio = ?, atualizacao = NOW()
                            WHERE id_funcionario = ?");
    $stmt->bind_param('siisssiiiiiiii', $turno, $salario_bruto, $salario_liquido, $plano_saude, $contribuicao_sindical, $ticket_transporte, $hora_extra, $hora_falta, $deducoes, $seguranca_social, $irs, $bonus_salarial, $subsidio, $selected_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {

    ?>

          <div id="message_div">
            <h1>Pagamento Efetuado Com Sucesso</h1>
            <button onclick="redirect1()" id="buttonmessage">Ok</button>
          </div>  
          <script>
            function redirect1() {

                window.location.href = "rh.php";

            }
          </script>

    <?php

    } else {

    ?>
        <div id="message_div">
            <h1>Não há autorização para efetuar Pagamento</h1>
            <button onclick="redirect2()">Ok</button>        
        </div>
        <script>
            function redirect2() {

                window.location.href = "rh.php";

            }
        </script>
    <?php

    }

    $conn->close();

}

?>
</body>
</html>
