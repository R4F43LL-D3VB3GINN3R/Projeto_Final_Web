<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevSync-Admin</title>
    <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="styles/area_comercial.css">
    <title>Document</title>
</head>
<body>  

    <?php

        $cliente = $_GET['cliente'];

        $hostname = "localhost";
        $username = "root";
        $pass = "";
        $database = "db_devsync";

        $conn = new mysqli($hostname, $username, $pass, $database);

        $sql = "SELECT * FROM tab_pedidos_aceitos WHERE cliente = '$cliente'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          
            while ($row = $result->fetch_assoc()) {

                $cliente2 = $row['cliente']; 
                $email = $row['email']; 
                $phone = $row['phone']; 
                $aplicacao = $row['aplicacao']; 
                $atualizacao = $row['atualizacao'];
                $id = $row['id'];
                $orcamento = $row['orcamento'];
                $estado = $row['estado'];
                $observacoes = $row['observacoes'];
                
            }

        }

    ?>

    <section class="layout">
        <div class="name0">
            <form action="cliente_atualizado.php" method="post">
                <h1>Area do Cliente</h1>
                <label for="cliente" id="lbl_cliente">Nome:</label>
                <input type="text" id="cliente" name="cliente" value="<?php echo $cliente2; ?>">
                <label for="email" id="lbl_email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                <label for="phone" id=lbl_phone>Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">
                <label for="aplicacao" id="lbl_id">Aplicação:</label>
                <input type="text" id="aplicacao" name="aplicacao" value="<?php echo $aplicacao; ?>">
                <label for="id" id="lbl_id">Número:</label>
                <input type="text" id="id" name="id" ReadOnly="true" value="<?php echo $id; ?>">
                <label for="atualizacao" id="lbl_atualizacao">Modificado em:</label>
                <input type="text" id="atualizacao" name="atualizacao" value ="<?php echo $atualizacao; ?>">
                <label for="estado" id="lbl_estado">Estado:</label>
                <select id="estado" name="estado">
                    <option value="Analise" <?php if ($estado == 'Analise') echo 'selected'; ?>>Análise</option>
                    <option value="Desenvolvimento" <?php if ($estado == 'Desenvolvimento') echo 'selected'; ?>>Desenvolvimento</option>
                    <option value="Devolvido Em Análise" <?php if ($estado == 'Devolvido Em Análise') echo 'selected'; ?>>Devolvido Em Análise</option>
                    <option value="Devolvido em Desenvolvimento" <?php if ($estado == 'Devolvido em Desenvolvimento') echo 'selected'; ?>>Devolvido Em Desenvolvimento</option>
                    <option value="Finalizado" <?php if ($estado == 'Finalizado') echo 'selected'; ?>>Finalizado</option>
                </select>
                <label for="obs" id="lbl_obs">Observações:</label>
                <textarea name="obs" id="obs" cols="30" rows="10" maxlength="500"><?php echo $observacoes; ?></textarea>
                <label for="orcamento" id="lbl_orcamento">Orçamento Atual:</label>
                <input type="text" id="orcamento" name="orcamento" value="<?php echo $orcamento; ?>">
                <input type="button" value="Voltar" id="botao_voltar" class="submit-button" onclick="window.location.href = 'desenvolvimento.html'">
                <input type="submit" value="Atualizar" id="botar_atualizar" class="submit-button">
            </form>
        </div> 
    </section> 
</body>
</html>
