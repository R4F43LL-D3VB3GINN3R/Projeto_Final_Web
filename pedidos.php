<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevSync-Admin</title>
    <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="styles/caixa_de_mensagens.css">
</head>
<body>
    <section class="layout">
        <div class="menu1"><a href="admins.php">Admins</a></div>
        <div class="body">
            <h2>Pedidos</h2>

            <?php
            //Conexão com a base de dados.
            include 'conexao.php';
            //Executa a Query.
            $sql = "SELECT * FROM tab_pedido";
            //Guarda o resultado da consulta.
            $result = $conn->query($sql);
            //Se o número de linhas em result for maior do que zero...
            if ($result->num_rows > 0) {
                //Cria um array para receber da variável.
                $pedidos = array(); 
                //Enquanto houver dados encontrados...
                while ($row = $result->fetch_assoc()) {
                    //Guarda no array clientes e todos os dados relacionados a ele.
                    $pedidos[$row['CLIENTE']] = $row;
                }
                //Cria um dropdown.           
                echo '<select name="messages" id="messages">';
                //Itera sobre o vetor usando o cliente como chave, associando à respectiva mensagem.
                foreach ($pedidos as $cliente => $mensagem) {
                    //Preenche a dropdown...
                    echo '<option value="' . $cliente . '">' . $cliente . '</option>';
                }
                echo '</select>';
            }
            //Encerra a conexão.
            $conn->close();
            ?>

            <br><br>
            <textarea name="areamessage" id="areamessage" cols="30" rows="10"></textarea>

            <?php //Div vazia. ?>
            <div id="clientDetails"> 
            </div>

        </div>
        <div class="menu2"><a href="rh.html">Recursos Humanos</a></div>
        <div class="menu3"><a href="desenvolvimento.html">Desenvolvimento</a></div>
        <div class="menu4"><a href="pedidos.php">Pedidos</a></div>
        <div class="menu5"><a href="caixa_de_mensagens.php">Caixa de Mensagens</a></div>
        <div class="menu6"><a href="sair.html">Sair</a></div>
    </section>
    <script>
        // Definindo a variável clienteDetails globalmente.
        var clienteDetails; 
        //Ouve o evento de mudança 'change' do dropdown...
        document.getElementById('messages').addEventListener('change', function() {
        //Recebe o cliente selecionado no dropdown.
        var selectedCliente = this.value;
        //Recebe a mensagem referente ao cliente do array.
        var pedidos = <?php echo json_encode($pedidos); ?>;
        //Recebe os pedidos relacionados ao cliente.
        clienteDetails = pedidos[selectedCliente]; 
        //A mensagem é então exibida na Textarea.
        document.getElementById('areamessage').value = pedidos[selectedCliente].MENSAGEM;
        //Variável criada para receber Strings concatenadas juntamente com elementos de vetores.
        var clientDetailsHTML = '<h3 style="color: rgb(0, 252, 0); border: 4px solid lime; font-style: italic; margin-top: 20px; text-align: center;">Detalhes do Cliente</h3>';
        clientDetailsHTML += '<table style="color: rgb(0, 252, 0); border: 4px solid lime; width: 100%; margin-top: 20px; text-align: center;">';
        clientDetailsHTML += '<tr><td>Cliente:</td><td>' + clienteDetails.CLIENTE + '</td></tr>';
        clientDetailsHTML += '<tr><td>Email:</td><td>' + clienteDetails.EMAIL + '</td></tr>';
        clientDetailsHTML += '<tr><td>Telefone:</td><td>' + clienteDetails.PHONE + '</td></tr>';
        clientDetailsHTML += '<tr><td>Aplicação:</td><td>' + clienteDetails.APLICACAO + '</td></tr>';
        clientDetailsHTML += '</table>';
        clientDetailsHTML += '<button onclick="redirect()" id="aceitar">Aceitar</button>';
        clientDetailsHTML += '<button onclick="redirect2()" id="recusar">Recusar</button>';
        //Joga dentro da div todo o conteúdo da variável.
        document.getElementById('clientDetails').innerHTML = clientDetailsHTML;
        });
    </script>
    <script>
        //Função para redirecionar para outra página.
        function redirect() {
            //Recebe o cliente selecionado.
            var selectedCliente = document.getElementById('messages').value;
            //Passa os elementos do vetor para por url.
            window.location.href = 'pedidos_aceitos.php?cliente=' + clienteDetails.CLIENTE + '&email=' + clienteDetails.EMAIL + '&phone=' + clienteDetails.PHONE + '&aplicacao=' + clienteDetails.APLICACAO + '&atualizacao=' + clienteDetails.ATUALIZACAO;     
        }
    </script>
    <script>
        //Função para redirecionar para outra página.
        function redirect2() {
            //Recebe o cliente selecionado.
            var selectedCliente = document.getElementById('messages').value;
            //Passa cliente selecionado do vetor para por url.
            window.location.href = 'pedidos_recusados.php?cliente=' + selectedCliente;
        }
    </script>
</body>
</html>
