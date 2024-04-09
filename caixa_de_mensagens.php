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
                    //Conexão com base de dados.
                    include 'conexao.php';
                    //Executa a Query.
                    $sql = "SELECT * FROM tab_contato WHERE RESPOSTA = 'PENDENTE'";
                    //A variável $result é do tipo mysqli_result, que é uma classe que representa o conjunto de resultados de uma consulta SQL.
                    $result = $conn->query($sql);
                    //Se o número de linhas em result for maior do que zero...
                    if ($result->num_rows > 0) {
                        //Cria um array para receber os emails e mensagens da consulta.
                        $contatos_emails_mensagens = array(); 
                        //Enquanto houver dados encontrados...
                        while ($row = $result->fetch_assoc()) {
                            //Guarda no array os emails e mensagens encontrados.
                            //Os emails e mensagens estão relacionados na mesma linha.
                            $contatos_emails_mensagens[$row['EMAIL']] = $row['MENSAGEM'];
                        }
                        //Cria um dropdown.                  
                        echo '<select name="messages" id="messages">';
                        //Itera sobre o vetor usando o email como chave, associando à respectiva mensagem.
                        foreach ($contatos_emails_mensagens as $email => $mensagem) {
                            //Preenche a dropdown...
                            echo '<option value="' . $email . '">' . $email . '</option>';
                        }                 
                        echo '</select>';
                    }
                    //Encerra a conexão.
                    $conn->close();
                ?>
                <br><br>
                <textarea name="areamessage" id="areamessage" cols="30" rows="10"></textarea>
                <button onclick="redirect()" id="Respondido">Respondido</button>
            </div>
        </div>
        <div class="menu2"><a href="rh.html">Recursos Humanos</a></div>
        <div class="menu3"><a href="desenvolvimento.html">Desenvolvimento</a></div>
        <div class="menu4"><a href="pedidos.php">Pedidos</a></div>
        <div class="menu5"><a href="caixa_de_mensagens.php">Caixa de Mensagens</a></div>
        <div class="menu6"><a href="sair.html">Sair</a></div>
    </section>
    <script>
            //Ouve o evento de mudança 'change' do dropdown...
            document.getElementById('messages').addEventListener('change', function() {
            //Recebe o email selecionado no dropdown
            var selectedEmail = this.value;
            //Recebe a mensagem referente ao email do array
            var messages = <?php echo json_encode($contatos_emails_mensagens); ?>;
            //A mensagem é então exibida na Textarea.
            document.getElementById('areamessage').value = messages[selectedEmail];
        });
    </script>
    <script>
        //Função para redirecionar para outra página.
        function redirect() {
            var selectedEmail = document.getElementById('messages').value;
            window.location.href = 'respondido.php?email=' + selectedEmail;
        }
    </script>
</body>
</html>
