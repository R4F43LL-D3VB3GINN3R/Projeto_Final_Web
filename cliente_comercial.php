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
            //Conecta à base de dados
            include 'conexao.php';
            //Executa a Query.
            $sql = "SELECT * FROM tab_pedidos_aceitos WHERE aplicacao = 'Comercial'";
            //Guarda o resultado da consulta.
            $result = $conn->query($sql);
            //Se o número de linhas em result for maior do que zero...
            if ($result->num_rows > 0) {
                //Cria um array para receber da variável.
                $clientes = array(); 
                //Enquanto houver dados encontrados...
                while ($row = $result->fetch_assoc()) {
                    //Guarda no array os clientes.
                    $clientes[$row['cliente']] = $row['cliente']; 
                }
                //Cria um dropdown.  
                echo '<select name="messages" id="messages">';
                 //Itera sobre o vetor usando o cliente como chave, associando à respectiva mensagem.
                foreach ($clientes as $cliente => $mensagem) {
                     //Preenche a dropdown...
                    echo '<option value="' . $cliente . '">' . $cliente . '</option>';
                }
                echo '</select>';
            }
            //Encerra a conexão.
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
        //Função para redirecionar para outra página.
        function redirect() {
            //Recebe o cliente selecionado.
            var selectedCliente = document.getElementById('messages').value;
            //Passa cliente selecionado do vetor para por url.
            window.location.href = 'area_comercial.php?cliente=' + selectedCliente;
        }
    </script>
</body>
</html>
