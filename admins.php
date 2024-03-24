<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevSync-Admin</title>
    <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="styles/admins.css">
    <title>Document</title>
</head>
<body>
    <section class="layout">
        <div class="menu1"><a href="admins.html">Admins</a></div>
        <div class="body">

        <?php

            $hostname = "localhost";
            $bancodedados = "db_devsync";
            $usuario = "root";
            $senha = "";

            $conn = new mysqli($hostname, $usuario, $senha, $bancodedados);

            $display = $conn->prepare("SELECT * FROM tab_admin");
            $display->execute();
            $result = $display->get_result();
            
            ?>

            <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>NOME</th>
                        <th>LOGIN</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    while ($row = $result->fetch_assoc()) {

                        echo "<tr>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['login'] . "</td>";
                        echo "</tr>";
                    }

                    ?>

                    <?php

                    $display->close();
                    $conn->close();

                    ?>

                </tbody>
            </table>
            </div>
            <div class ="buttons-container">
                <button onclick="redirect1()">Adicionar</button>
                <button onclick="redirect2()">Remover</button>
            </div>
        </div>
        <div class="menu1"><a href="admins.php">Admins</a></div>
        <div class="menu2"><a href="rh.html">Recursos Humanos</a></div>
        <div class="menu3"><a href="desenvolvimento.html">Desenvolvimento</a></div>
        <div class="menu4"><a href="pedidos.php">Pedidos</a></div>
        <div class="menu5"><a href="caixa_de_mensagens.php">Caixa de Mensagens</a></div>
        <div class="menu6"><a href="sair.html">Sair</a></div>
      </section>
      <script>
        function redirect1() {
            window.location.href = "admins_insert.html"; 
        }
        function redirect2() {
            window.location.href = "admins_delete.html"; 
        }
    </script>
</body>
</html>
