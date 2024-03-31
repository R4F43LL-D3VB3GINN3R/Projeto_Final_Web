<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/exibicao_geral.css">
    <title>DevSync-Admin</title>
    <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
</head>
<body>

<?php

$hostname = "localhost";
$database = "db_devsync";
$username = "root";
$password = "";

$filter = "id"; // Valor padrão do filtro

if (isset($_GET['filter'])) {
    // Recebendo o valor do filtro selecionado
    $filter = $_GET['filter'];
}

$conn = new mysqli($hostname, $username, $password, $database);

$sql = "SELECT * FROM tab_funcionario ORDER BY $filter ASC";
$result = $conn->query($sql);

?>

<section class="layout">
  <div class="body">
    <table>
        <tr>
            <th>ID</th>
            <th>NIF</th>
            <th>Nome</th>
            <th>Apelido</th>
            <th>Nome Completo</th>
            <th>Data de Nascimento</th>
            <th>Sexo</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Endereço</th>
            <th>Estado Civil</th>
            <th>Dependentes</th>
            <th>Departamento</th>
            <th>Cargo</th>
            <th>Tipo de Contrato</th>
            <th>Salário</th>
            <th>Data de Contratação</th>
            <th>Estado</th>
            <th>Última Atualização</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nif"] . "</td>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["apelido"] . "</td>";
                echo "<td>" . $row["nome_completo"] . "</td>";
                echo "<td>" . $row["data_nascimento"] . "</td>";
                echo "<td>" . $row["sexo"] . "</td>";
                echo "<td>" . $row["telefone"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["endereco"] . "</td>";
                echo "<td>" . $row["estado_civil"] . "</td>";
                echo "<td>" . $row["dependentes"] . "</td>";
                echo "<td>" . $row["departamento"] . "</td>";
                echo "<td>" . $row["cargo"] . "</td>";
                echo "<td>" . $row["tipo_contrato"] . "</td>";
                echo "<td>" . $row["salario"] . "</td>";
                echo "<td>" . $row["data_contratacao"] . "</td>";
                echo "<td>" . $row["estado"] . "</td>";
                echo "<td>" . $row["atualizacao"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='19'>Nenhum funcionário encontrado</td></tr>";
        }
        ?>
    </table>
  </div>
    <form method="GET">
        <select name="filter" id="filter" onchange="this.form.submit()">
                <option value="nome" <?php if ($filter == "nome") echo "selected"; ?>>Nome</option>
                <option value="sexo" <?php if ($filter == "sexo") echo "selected"; ?>>Sexo</option>
                <option value="data_nascimento" <?php if ($filter == "data_nascimento") echo "selected"; ?>>Data de Nascimento</option>
                <option value="dependentes" <?php if ($filter == "dependentes") echo "selected"; ?>>Dependentes</option>
                <option value="tipo_contrato" <?php if ($filter == "tipo_contrato") echo "selected"; ?>>Tipo de Contrato</option>
                <option value="salario" <?php if ($filter == "salario") echo "selected"; ?>>Salário</option>
                <option value="estado" <?php if ($filter == "estado") echo "selected"; ?>>Estado</option>
        </select>
  </form>
</section>
</body>
</html>
