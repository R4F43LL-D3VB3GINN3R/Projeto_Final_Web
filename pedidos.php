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

            $hostname = "localhost";
            $username = "root";
            $pass = "";
            $database = "db_devsync";

            $conn = new mysqli($hostname, $username, $pass, $database);

            $sql = "SELECT * FROM tab_pedido";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                $pedidos = array(); 

                while ($row = $result->fetch_assoc()) {
                    $pedidos[$row['CLIENTE']] = $row;
                }
                
                echo '<select name="messages" id="messages">';
                foreach ($pedidos as $cliente => $mensagem) {
                    echo '<option value="' . $cliente . '">' . $cliente . '</option>';
                }
                echo '</select>';

            }

            $conn->close();

            ?>

            <br><br>
            <textarea name="areamessage" id="areamessage" cols="30" rows="10"></textarea>

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

        var clienteDetails; // Definindo a variável clienteDetails globalmente

        document.getElementById('messages').addEventListener('change', function() {
            var selectedCliente = this.value;
            var pedidos = <?php echo json_encode($pedidos); ?>;
            clienteDetails = pedidos[selectedCliente]; 

            document.getElementById('areamessage').value = pedidos[selectedCliente].MENSAGEM;
            
            var clientDetailsHTML = '<h3 style="color: rgb(0, 252, 0); border: 4px solid lime; font-style: italic; margin-top: 20px; text-align: center;">Detalhes do Cliente</h3>';
            clientDetailsHTML += '<table style="color: rgb(0, 252, 0); border: 4px solid lime; width: 100%; margin-top: 20px; text-align: center;">';
            clientDetailsHTML += '<tr><td>Cliente:</td><td>' + clienteDetails.CLIENTE + '</td></tr>';
            clientDetailsHTML += '<tr><td>Email:</td><td>' + clienteDetails.EMAIL + '</td></tr>';
            clientDetailsHTML += '<tr><td>Telefone:</td><td>' + clienteDetails.PHONE + '</td></tr>';
            clientDetailsHTML += '<tr><td>Aplicação:</td><td>' + clienteDetails.APLICACAO + '</td></tr>';
            clientDetailsHTML += '</table>';
            clientDetailsHTML += '<button onclick="redirect()" id="aceitar">Aceitar</button>';
            clientDetailsHTML += '<button onclick="redirect2()" id="recusar">Recusar</button>';
            
            document.getElementById('clientDetails').innerHTML = clientDetailsHTML;
        });
    </script>
    <script>

        function redirect() {

            var selectedCliente = document.getElementById('messages').value;
            window.location.href = 'pedidos_aceitos.php?cliente=' + clienteDetails.CLIENTE + '&email=' + clienteDetails.EMAIL + '&phone=' + clienteDetails.PHONE + '&aplicacao=' + clienteDetails.APLICACAO + '&atualizacao=' + clienteDetails.ATUALIZACAO;

        
        }
    </script>
    <script>
        function redirect2() {

            var selectedCliente = document.getElementById('messages').value;
            window.location.href = 'pedidos_recusados.php?cliente=' + selectedCliente;
        }
    </script>
</body>
</html>
