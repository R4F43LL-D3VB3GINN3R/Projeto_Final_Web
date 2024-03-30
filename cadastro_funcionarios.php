<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevSync-Admin</title>
    <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="styles/caixa_de_mensagens.css">
    <style>
        #employeeDetailsTable, th {
            background-color: lime;
            color: black;
            border: 10px solid;
            border-radius: 20px;
        }

        #employeeDetailsTable, tr {
            background-color: black;
            border: none;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <section class="layout">
        <div class="menu1"><a href="admins.php">Admins</a></div>
        <div class="body">
            <h2>Selecione o Funcionário</h2>

            <?php
            $hostname = "localhost";
            $username = "root";
            $pass = "";
            $database = "db_devsync";

            $conn = new mysqli($hostname, $username, $pass, $database);

            $sql = "SELECT * FROM tab_funcionario";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $funcionario = array(); 
                while ($row = $result->fetch_assoc()) {
                    $funcionario[$row['nome_completo']] = $row;
                }
                
                echo '<select name="messages" id="messages">';
                foreach ($funcionario as $nome_completo => $row) {
                    echo '<option value="' . htmlspecialchars(json_encode($row)) . '">' . $nome_completo . '</option>';
                }
                echo '</select>';
            }
            $conn->close();
            ?>

            <div id="clientDetails" class="clientDetails"> 
                <!-- Tabela inicialmente vazia -->
                <table id="employeeDetailsTable" style="background-color: black; color: lime; border: 0px; border-radius: 20px;"></table>
            </div>
            <div id="buttons" class="buttons"> 
                   <button onclick="redirect()">Novo</button>
                   <button onclick="redirect2()">Editar</button>
                  <button onclick="redirect3()">Remover</button>
            </div>
        </div>
        <div class="menu2"><a href="rh.html">Recursos Humanos</a></div>
        <div class="menu3"><a href="desenvolvimento.html">Desenvolvimento</a></div>
        <div class="menu4"><a href="pedidos.php">Pedidos</a></div>
        <div class="menu5"><a href="caixa_de_mensagens.php">Caixa de Mensagens</a></div>
        <div class="menu6"><a href="sair.html">Sair</a></div>
    </section>

    <script>

        function redirect() {

            window.location.href = 'novo_empregado.php';

        }

        function redirect2 () {

            var selectedEmployeeId = document.getElementById('messages').value;
            
            if (selectedEmployeeId) {

                window.location.href = 'editar_empregado.php?id=' + selectedEmployeeId;

            }

        }

        function redirect3 () {

            var selectedEmployeeId = document.getElementById('messages').value;

            if (selectedEmployeeId) {

            window.location.href = 'empregado_removido.php?id=' + selectedEmployeeId;

            }

        }

        document.getElementById('messages').addEventListener('change', function() {
            var selectedEmployee = JSON.parse(this.value);
            var tableContent = '';
            if (Object.keys(selectedEmployee).length > 0) {
                // Definindo estilo para o cabeçalho da tabela
                tableContent += '<tr style="background-color: black; color: lime; border: 1px solid lime; border-radius: 20px;">';
                tableContent += '</tr>';
                // Preenchendo o restante da tabela com os detalhes do funcionário selecionado
                for (var key in selectedEmployee) {
                    tableContent += '<tr><td>' + key + '</td><td>' + selectedEmployee[key] + '</td></tr>';
                }
            } else {
                // Se nenhum funcionário for selecionado, a tabela ficará vazia
                tableContent = '<tr><td colspan="2">Selecione um funcionário</td></tr>';
            }
            document.getElementById('employeeDetailsTable').innerHTML = tableContent;
        });
    </script>
</body>
</html>
