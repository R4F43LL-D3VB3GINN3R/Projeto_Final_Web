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
            //Conexão com Base de Dados.
            include 'conexao.php';
            //Executa a Query.
            $sql = "SELECT * FROM tab_funcionario WHERE estado = 'Ativo'";
            //Guarda o resultado da consulta.
            $result = $conn->query($sql);
            //Se o número de linhas em result for maior do que zero...
            if ($result->num_rows > 0) {
                //Cria um array para receber da variável.
                $funcionario = array(); 
                //Enquanto houver dados encontrados...
                while ($row = $result->fetch_assoc()) {
                    //Guarda no array de nomes completos todos os dados relacionados a ele.
                    $funcionario[$row['nome_completo']] = $row;
                }
                //Cria um dropdown.        
                echo '<select name="messages" id="messages">';
                //Itera sobre o vetor usando o nome completo como chave.
                foreach ($funcionario as $nome_completo => $row) {
                    //Preenche a dropdown...
                    echo '<option value="' . htmlspecialchars(json_encode($row)) . '">' . $nome_completo . '</option>';
                }
                echo '</select>';
            }
            //Encerra a conexão.
            $conn->close();
            ?>

            <div id="clientDetails" class="clientDetails"> 
                <!-- Tabela inicialmente vazia na div vazia-->
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
        //Função para redirecionar para outra página.
        function redirect() {
            //Redireciona o URL
            window.location.href = 'novo_empregado.php';
        }
        //Função para redirecionar para outra página.
        function redirect2 () {
            //Recebe os dados do funcionário
            var selectedEmployeeId = document.getElementById('messages').value;
            //Se houver dados selecionados...
            if (selectedEmployeeId) {
                //Redireciona a página e envia os dados.
                window.location.href = 'editar_empregado.php?id=' + selectedEmployeeId;
            }
        }
        //Função para redirecionar para outra página.
        function redirect3 () {
            //Recebe os dados do funcionário
            var selectedEmployeeId = document.getElementById('messages').value;
            //Se houver dados selecionados...
            if (selectedEmployeeId) {
            //Redireciona a página e envia os dados.
                window.location.href = 'empregado_removido.php?id=' + selectedEmployeeId;
            }
        }
        //Ouve o evento de mudança 'change' do dropdown...
        document.getElementById('messages').addEventListener('change', function() {
            //Recebe o cliente selecionado no dropdown.
            var selectedEmployee = JSON.parse(this.value);
            //Define a variável para receber a tabela como vazia.
            var tableContent = '';
            //Se houver alguma linha para ser mostrada na tabela...
            if (Object.keys(selectedEmployee).length > 0) {
                // Define estilo para o cabeçalho da tabela
                tableContent += '<tr style="background-color: black; color: lime; border: 1px solid lime; border-radius: 20px;">';
                tableContent += '</tr>';
                // Preenche o restante da tabela com os detalhes do funcionário selecionado
                //Itera sobre o vetor concatenando strings e inserindo os elementos na tabela.
                for (var key in selectedEmployee) {
                    //Variável string -- Campo usado como chave -- Conteúdo da linha relacinado ao campo.
                    tableContent += '<tr><td>' + key + '</td><td>' + selectedEmployee[key] + '</td></tr>';
                }
            //Do contrário...
            } else {
                // Se nenhum funcionário for selecionado, a tabela ficará vazia
                tableContent = '<tr><td colspan="2">Selecione um funcionário</td></tr>';
            }
            //Insere a tabela pelo id da tabela na div.
            document.getElementById('employeeDetailsTable').innerHTML = tableContent;
        });
    </script>
</body>
</html>
