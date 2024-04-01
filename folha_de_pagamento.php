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
  <div class="name2"></div>
  <div class="name3"></div>
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
            } else {
                echo "<script>alert('Funcionário não encontrado.');</script>";
            }
            $conn->close();
        }
    }
?>

</body>
</html>
