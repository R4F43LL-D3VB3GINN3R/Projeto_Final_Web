<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/novo_empregado.css">
    <title>DevSync-Admin</title>
    <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
</head>
<body>

<?php

if (isset($_GET['id'])) {
    // Decodifica a string JSON para um array associativo
    $funcionario = json_decode($_GET['id'], true);
    
    // Verifica se 'id' está presente no array e se possui um valor válido
    if (isset($funcionario['id'])) {
        // Acessa o valor do 'id'
        $id = $funcionario['id'];

    }

}

$hostname = "localhost";
$username = "root";
$pass = "";
$database = "db_devsync";

$conn = new mysqli($hostname, $username, $pass, $database);

$sql = "SELECT * FROM tab_funcionario WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
    while ($row = $result->fetch_assoc()) {

        $nif = $row['nif']; 
        $nome = $row['nome'];
        $apelido = $row['apelido'];
        $nome_completo = $row['nome_completo'];
        $data_nascimento = $row['data_nascimento'];
        $sexo = $row['sexo'];
        $telefone = $row['telefone'];
        $email = $row['email'];
        $endereco = $row['endereco'];
        $estado_civil = $row['estado_civil'];
        $dependentes = $row['dependentes'];
        $departamento = $row['departamento'];
        $cargo = $row['cargo'];
        $contrato = $row['tipo_contrato'];
        $salario = $row['salario'];
        $data_contratacao = $row['data_contratacao'];
        $estado = $row['estado'];
        
    }

}

?>

<section class="layout">
  <div class="name1">
    <h2>Nif</h2>
    <h2>Nome</h2>
    <h2>Apelido</h2>
    <h2>Nome Completo</h2>
    <h2>Data de Nascimento</h2>
    <h2>Sexo</h2>
    <h2>Telefone</h2>
    <h2>Email</h2>
    <h2>Endereço</h2>
    <h2>Estado Civil</h2>
    <h2>Dependentes</h2>
    <h2>Departamento</h2>
    <h2>Cargo</h2>
    <h2>Tipo de Contrato</h2>
    <h2>Salário</h2>
    <h2>Data de Contratação</h2>
    <h2>Estado</h2>
  </div>
  <div class="name2">
    <form action="empregado_editado.php" method="post">
        <input type="text" name="nif" maxlength="9" value="<?php echo $nif; ?>">
        <input type="text" name="nome" value="<?php echo $nome; ?>">
        <input type="text" name="apelido" value="<?php echo $apelido; ?>">
        <input type="text" name="nome_completo" value="<?php echo $nome_completo; ?>">
        <input type="text" name="data_nascimento" value="<?php echo $data_nascimento; ?>">
        <select name="sexo" id="sexo" value="<?php echo $sexo; ?>">
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
            <option value="O">Outro</option>
        </select>
        <input type="text" name="telefone" maxlength="9" value="<?php echo $telefone; ?>">
        <input type="email" name="email" value="<?php echo $email; ?>">
        <input type="text" name="endereco" value="<?php echo $endereco; ?>">
        <select name="estado_civil" id="estado_civil" value="<?php echo $estado_civil; ?>">
            <option value="Solteiro">Solteiro</option>
            <option value="Casado">Casado</option>
            <option value="União Estável">União Estável</option>
            <option value="Divorciado">Divorciado</option>
            <option value="Viúvo">Viúvo</option>
        </select>
        <input type="text" name="dependentes" value="<?php echo $dependentes; ?>">
        <select name="departamento" id="departamento" value="<?php echo $departamento; ?>">
            <option value="Full-stack">Full-Stack</option>
            <option value="Jogos">Jogos</option>
            <option value="Cyber-security">Cyber-Security</option>
        </select>
        <input type="text" name="cargo" value="<?php echo $cargo; ?>">
        <select name="contrato" id="contrato" value="<?php echo $contrato; ?>">
            <option value="Recibo verde">Recibo Verde</option>
            <option value="Prestação de serviços">Prestação de Serviços</option>  
        </select>
        <input type="text" name="salario" value="<?php echo $salario; ?>">
        <input type="text" name="data_contratacao", value="<?php echo $data_contratacao; ?>">
        <select name="estado" id="estado" value="<?php echo $estado; ?>">
            <option value="Ativo">Ativo</option>
            <option value="Ferias">Férias</option>  
            <option value="Inativo">Inativo</option>  
        </select>
        <input id="inserir" type="submit" value="Redefinir">
    </form>
  </div>
</section>
</body>
</html>
