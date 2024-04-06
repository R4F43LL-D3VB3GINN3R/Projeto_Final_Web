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

function turnoTrabalho($turno, $salario, $bonus) {

    $bonus = 0;

    if ($turno == "Noite") {

        $bonus = $bonus + ( 0.25 * $salario);

    } else {

        $bonus = $bonus;

    }

    return $bonus;

};

function horasExtras($q_horasextras, $salario, &$v_horasextras, &$salariobruto, $turno) {

  $valor_hora = $salario / ( 8 * 22);
  $v_horasextras = 0;

    if ($q_horasextras != 0) {

        if ($turno == "Manhã") {

            $v_horasextras = $valor_hora + ($q_horasextras * (2 * $valor_hora));

        } else {

            $v_horasextras = $valor_hora + ($q_horasextras * (3 * $valor_hora));

        }

    }

  $salariobruto = $salario + $v_horasextras;

};

function calcSubsidio($salariobruto, &$subsidio, &$salarioliquido) {

    $subsidio = 0;
    $salarioliquido = 0;

    $subsidio = $salariobruto / 12;
    $salarioliquido = $subsidio;

};

function services($planosaude, $sindical, $transporte, $salario, &$bonus, &$deducts) {

    $deducts = 0;
    $deducoes2 = 0;
    $deducoes3 = 0;

    if ($planosaude == "Sim") {

        $deducoes2 = 0.05 * $salario; 

    }

    if ($sindical == "Sim") {

        $deducoes3 = 4;

    }

    if ($transporte == "Sim") {

        $bonus = $bonus + 100;

    }

    $deducts = $deducoes2 + $deducoes3;

};

function calcImpostos($salario, &$deducts, &$segsoc, &$imp_irs) {

    if ($salario < 886) {

        $deducts = $deducts + (0.11 * $salario);
        $segsoc = 0.11 * $salario;

    } elseif ($salario >= 886 && $salario < 932) {

        $deducts = $deducts + (0.11 * $salario) + (0.06 * $salario);
        $segsoc = 0.11 * $salario;
        $imp_irs = 0.06 * $salario;

    } elseif ($salario >= 932 && $salario < 999) {

        $deducts = $deducts + (0.11 * $salario) + (0.08 * $salario);
        $segsoc = 0.11 * $salario;
        $imp_irs = 0.08 * $salario;

    } elseif ($salario >= 999 && $salario < 1106) {

        $deducts = $deducts + (0.11 * $salario) + (0.09 * $salario);
        $segsoc = 0.11 * $salario;
        $imp_irs = 0.09 * $salario;

    } elseif ($salario >= 1106 && $salario < 1600) {

        $deducts = $deducts + (0.11 * $salario) + (0.11 * $salario);
        $segsoc = 0.11 * $salario;
        $imp_irs = 0.11 * $salario;

    } elseif ($salario >= 1600 && $salario < 1961) {

        $deducts = $deducts + (0.11 * $salario) + (0.16 * $salario);
        $segsoc = 0.11 * $salario;
        $imp_irs = 0.16 * $salario;

    } elseif ($salario >= 1961 && $salario < 2529) {

        $deducts = $deducts + (0.11 * $salario) + (0.19 * $salario);
        $segsoc = 0.11 * $salario;
        $imp_irs = 0.19 * $salario;

    } elseif ($salario >= 2529 && $salario < 3694) {

        $deducts = $deducts + (0.11 * $salario) + (0.23 * $salario);
        $segsoc = 0.11 * $salario;
        $imp_irs = 0.23 * $salario;

    } elseif ($salario >= 3694 && $salario < 5469) {

        $deducts = $deducts + (0.11 * $salario) + (0.28 * $salario);
        $segsoc = 0.11 * $salario;
        $imp_irs = 0.28 * $salario;

    } elseif ($salario >= 5469 && $salario < 6420) {

        $deducts = $deducts + (0.11 * $salario) + (0.32 * $salario);
        $segsoc = 0.11 * $salario;
        $imp_irs = 0.32 * $salario;

    } elseif ($salario >= 6420 && $salario < 20064) {

        $deducts = $deducts + (0.11 * $salario) + (0.33 * $salario);
        $segsoc = 0.11 * $salario;
        $imp_irs = 0.33 * $salario;

    } else {
        $deducts = $deducts + (0.11 * $salario) + (0.41 * $salario);
        $segsoc = 0.11 * $salario;
        $imp_irs = 0.41 * $salario;

    }

};

function calcHorasFaltas($quantfaltas, &$multa, $salario, &$deducts) {

    $val_hora = 0;
    $multa = 0;

    if ($quantfaltas > 0) {

        $multa = $quantfaltas * ($salario / (8 * 22));

    }

    $deducts = $deducts + $multa;

};

function calcSal ($salbruto, $deducts, $bonuss, &$saliquido) {

    $saliquido = ($saliquido + $salbruto + $bonuss) - $deducts; 

};

$hostname = "localhost";
$database = "db_devsync";
$username = "root";
$password = "";

$conn = new mysqli($hostname, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $salario_base = $_POST['salariobase'];
    $selected_id = $_POST['id'];
    $turno = $_POST['turno'];
    $salario_bruto = $_POST['salario_bruto'];
    $salario_liquido = $_POST['salario_liquido'];
    $plano_saude = $_POST['plano_saude'];
    $contribuicao_sindical = $_POST['contribuicao_sindical'];
    $ticket_transporte = $_POST['ticket_transporte'];
    $quant_horaextra = $_POST['hora_extra2'];
    $hora_extra = $_POST['hora_extra'];
    $quant_horasfaltas = $_POST['hora_falta2'];
    $hora_falta = $_POST['hora_falta'];
    $deducoes = $_POST['deducoes'];
    $seguranca_social = $_POST['seguranca_social'];
    $irs = $_POST['irs'];
    $bonus_salarial = $_POST['bonus_salarial'];
    $subsidio = $_POST['subsidio'];

    $bonus_salarial = turnoTrabalho($turno, $salario_base, $bonus_salarial);

    $hora_extra = 0;
    $salario_bruto = 0;

    horasExtras($quant_horaextra, $salario_base, $hora_extra, $salario_bruto, $turno);
    calcSubsidio($salario_bruto, $subsidio, $salario_liquido);
    services($plano_saude, $contribuicao_sindical, $ticket_transporte, $salario_base, $bonus_salarial, $deducoes);
    calcImpostos($salario_base, $deducoes, $seguranca_social, $irs);
    calcHorasFaltas($quant_horasfaltas, $hora_falta, $salario_base, $deducoes);
    calcSal ($salario_bruto, $deducoes, $bonus_salarial, $salario_liquido);

    $stmt = $conn->prepare("UPDATE tab_pagamento
                            SET turno = ?, salario_bruto = ?, salario_liquido = ?, plano_saude = ?, contr_sindical = ?, transporte = ?, quant_horaextra = ?, valor_horaextra = ?, quant_horasfaltas = ?, valor_horasfaltas = ?, deducoes = ?, seg_social = ?, irs = ?, bonus_salarial = ?, subsidio = ?, atualizacao = NOW()
                            WHERE id_funcionario = ?");
    $stmt->bind_param('siisssiiiiiiiiii', $turno, $salario_bruto, $salario_liquido, $plano_saude, $contribuicao_sindical, $ticket_transporte, $quant_horaextra, $hora_extra, $quant_horasfaltas, $hora_falta, $deducoes, $seguranca_social, $irs, $bonus_salarial, $subsidio, $selected_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {

    ?>

          <div id="message_div">
            <h1>Pagamento Efetuado Com Sucesso</h1>
            <button onclick="redirect1()" id="buttonmessage">Ok</button>
          </div>  
          <script>
            function redirect1() {

                window.location.href = "folha_de_pagamento.php";

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

                window.location.href = "folha_de_pagamento.php";

            }
        </script>
    <?php

    }

    $conn->close();

}

?>
</body>
</html>
