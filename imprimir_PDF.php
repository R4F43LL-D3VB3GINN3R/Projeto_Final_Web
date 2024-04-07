<?php 

require 'dompdf/autoload.inc.php';

$selected_id = $_GET['selected_id'];

$hostname = "localhost";
$username = "root";
$pass = "";
$database = "db_devsync";

$conn = new mysqli($hostname, $username, $pass, $database);
$conn2 = new mysqli($hostname, $username, $pass, $database);

$sql = "SELECT * FROM tab_pagamento WHERE id_funcionario = ?";
$sql2 = "SELECT * FROM tab_funcionario WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $selected_id);
$stmt->execute();
$result = $stmt->get_result();

$stmt2 = $conn2->prepare($sql2);
$stmt2->bind_param("i", $selected_id);
$stmt2->execute();
$result2 = $stmt2->get_result();

$mes_atual = strftime("%B");
$data_atual = date("d/m/Y");
$numero_aleatorio = rand(100000, 999999);

$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
$dados .= "<title>Document</title>";
$css_content = file_get_contents("styles/pdf.css");
$dados .= "<style>" . $css_content . "</style>";
$dados .= "</head>";
$dados .= "<body>";

$dados .= "<h1>Recibo Vencimento</h1>";

$dados .= '<section class="layout">';

$dados .= "<hr>";

$dados .= '<div class="name1">';

$dados .= "<table>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dados .= "<tr><td><strong>Período:...............................................</strong></td><td>" . $mes_atual . "</td></tr>";
        $dados .= "<tr><td><strong>Data Fecho:.........................................</strong></td><td>" . $data_atual . "</td></tr>";
        $salario_liquido = $row['salario_liquido'];
        $multas_faltas = $row['valor_horasfaltas'];
        $turno = $row['turno'];
        $segsoc = $row['seg_social'];
        $irs = $row['irs'];
        $subsidio = $row['subsidio'];
    }
}

if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $dados .= "<tr><td><strong>Vencimento:........................................</strong></td><td>" . $row2['salario'] . "</td></tr>";
        $valor_hora = $row2['salario'] / (8 * 22);
        $dados .= "<tr><td><strong>Venc. Hora:.........................................</strong></td><td>" . number_format($valor_hora, 2) . "</td></tr>";
        $nomecompleto = $row2['nome_completo'];
        $cargo = $row2['cargo'];
        $nif = $row2['nif'];
        $departamento = $row2['departamento'];
        $salario = $row2['salario'];
    }
}

$adicional_noturno = 0.05 * $salario;   

$dados .= "<tr><td><strong>Dias Trabalhados:..............................</strong></td><td>22</td></tr>";
$dados .= "</table>";
$dados .= '</div>';

$dados .= "<hr>";

$dados .= '<div class="name2">';
$dados .= "<table>";

$dados .= "<tr><td><strong>Nome:..................................................</strong></td><td>" . $nomecompleto . "</td></tr>";
$dados .= "<tr><td><strong>Cargo:.................................................</strong></td><td>" . $cargo . "</td></tr>";
$dados .= "<tr><td><strong>NIF:.....................................................</strong></td><td>" . $nif . "</td></tr>";
$dados .= "<tr><td><strong>Departamento:...................................</strong></td><td>" . $departamento . "</td></tr>";
$dados .= "<tr><td><strong>Nº Seguro:...........................................</strong></td><td>" . $numero_aleatorio . "</td></tr>";

$dados .= "</table>";
$dados .= '</div>';

$dados .= "<hr>";

$dados .= '<div class="name3">';
$dados .= "<table>";

$dados .= "<tr><td><strong>Ordenado Líquido:............................</strong></td><td>" . $salario_liquido . "</td></tr>";
$dados .= "<tr><td><strong>Valor das Horas Faltas Líquido:......</strong></td><td>" . $multas_faltas . "</td></tr>";

if ($turno == "Noite") {
    $dados .= "<tr><td><strong>Adicional Noturno:............................</strong></td><td>" . $adicional_noturno . "</td></tr>";
} else {
    $adicional_noturno = 0;
    $dados .= "<tr><td><strong>Adicional Noturno:............................</strong></td><td>" . $adicional_noturno . "</td></tr>";
}

$dados .= "<tr><td><strong>Segurança Social:...............................</strong></td><td>" . $segsoc . "</td></tr>";
$dados .= "<tr><td><strong>IRS:.....................................................</strong></td><td>" . $irs . "</td></tr>";
$dados .= "<tr><td><strong>Subsídio Natal/Férias:.......................</strong></td><td>" . $subsidio . "</td></tr>";
$dados .= "<tr><td><strong>Forma de Pagamento:.......................</strong></td><td> Transferência </td></tr>";
$dados .= "<tr><td><strong>Moeda:................................................</strong></td><td> [EUR] </td></tr>";
$dados .= "<tr><td><strong>Total:...................................................</strong></td><td>" . $salario_liquido . "</td></tr>";

$dados .= "</table>";
$dados .= '</div>';

$dados .= '<div class="name5">';

$dados .= "<h4><strong>Declaro que recebi a quantia constante neste recibo: </strong></h4>";


$dados .= '</div>';

$dados .= '<div class="name6"></div>';
$dados .= '<div class="name7"></div>';
$dados .= '<div class="name8"></div>';
$dados .= '<div></div>';
$dados .= '</section>';

use Dompdf\Dompdf;

$dompdf = new Dompdf(['enable_remote' => true]);

$dompdf->loadHtml($dados);

$dompdf->set_option('defaultFont', 'sans');

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream();

$stmt->close();
$conn->close();
$stmt2->close();
$conn2->close();

$dados .= "</body>";
$dados .= "</html>";

?>
