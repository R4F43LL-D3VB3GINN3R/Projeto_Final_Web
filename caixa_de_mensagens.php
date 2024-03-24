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

            <h2>Mensagens Pendentes</h2>

            <?php

            $hostname = "localhost";
            $username = "root";
            $pass = "";
            $database = "db_devsync";

            $conn = new mysqli($hostname, $username, $pass, $database);

            $sql = "SELECT * FROM tab_contato WHERE RESPOSTA = 'PENDENTE'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                $contatos_emails_mensagens = array(); 
                

                while ($row = $result->fetch_assoc()) {
                    $contatos_emails_mensagens[$row['EMAIL']] = $row['MENSAGEM'];
                }
                
                    echo '<select name="messages" id="messages">';
                    foreach ($contatos_emails_mensagens as $email => $mensagem) {
                        echo '<option value="' . $email . '">' . $email . '</option>';
                }
                
                echo '</select>';

            }

            $conn->close();

            ?>

            <br><br>
            <textarea name="areamessage" id="areamessage" cols="30" rows="10"></textarea>
            <button onclick="redirect()" id="Respondido">Respondido</button>

        </div>
        <div class="menu2"><a href="rh.html">Recursos Humanos</a></div>
        <div class="menu3"><a href="desenvolvimento.html">Desenvolvimento</a></div>
        <div class="menu4"><a href="pedidos.php">Pedidos</a></div>
        <div class="menu5"><a href="caixa_de_mensagens.php">Caixa de Mensagens</a></div>
        <div class="menu6"><a href="sair.html">Sair</a></div>
    </section>
    <script>
        document.getElementById('messages').addEventListener('change', function() {
            var selectedEmail = this.value;
            var messages = <?php echo json_encode($contatos_emails_mensagens); ?>;
            document.getElementById('areamessage').value = messages[selectedEmail];
        });
    </script>
    <script>
        function redirect() {

            var selectedEmail = document.getElementById('messages').value;
            window.location.href = 'respondido.php?email=' + selectedEmail;

        }
    </script>
</body>
</html>
