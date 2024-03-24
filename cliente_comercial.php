<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevSync-Admin</title>
    <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="styles/caixa_de_mensagens.css">
    <title>Document</title>
</head>
<body>
    <section class="layout">
        <div class="menu1"><a href="admins.php">Admins</a></div>
        <div class="body">

            <h2>Seleção de Clientes</h2>

            <?php

            $hostname = "localhost";
            $username = "root";
            $pass = "";
            $database = "db_devsync";

            $conn = new mysqli($hostname, $username, $pass, $database);

            $sql = "SELECT * FROM tab_pedidos_aceitos WHERE aplicacao = 'Comercial'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                $clientes = array(); 
                

                while ($row = $result->fetch_assoc()) {
                    $clientes[$row['cliente']] = $row['cliente']; 
                }
                
                    echo '<select name="messages" id="messages">';
                    foreach ($clientes as $cliente => $mensagem) {
                        echo '<option value="' . $cliente . '">' . $cliente . '</option>';
                }
                
                echo '</select>';

            }

            $conn->close();

            ?>

            <br><br>
        
            <button onclick="redirect()" id="Respondido">Ir</button>

        </div>
        <div class="menu2"><a href="rh.html">Recursos Humanos</a></div>
        <div class="menu3"><a href="desenvolvimento.html">Desenvolvimento</a></div>
        <div class="menu4"><a href="pedidos.php">Pedidos</a></div>
        <div class="menu5"><a href="caixa_de_mensagens.php">Caixa de Mensagens</a></div>
        <div class="menu6"><a href="sair.html">Sair</a></div>
    </section>
    <script>
        function redirect() {

            var selectedCliente = document.getElementById('messages').value;
            window.location.href = 'area_comercial.php?cliente=' + selectedCliente;

        }
    </script>
</body>
</html>
