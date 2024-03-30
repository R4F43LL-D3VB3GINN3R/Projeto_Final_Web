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
    <form action="empregado_cadastrado.php" method="post">
        <input type="text" name="nif" maxlength="9">
        <input type="text" name="nome">
        <input type="text" name="apelido">
        <input type="text" name="nome_completo">
        <input type="text" name="data_nascimento" value= "aaaa/mm/dd">
        <select name="sexo" id="sexo">
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
            <option value="O">Outro</option>
        </select>
        <input type="text" name="telefone" maxlength="9">
        <input type="email" name="email">
        <input type="text" name="endereco">
        <select name="estado_civil" id="estado_civil">
            <option value="Solteiro">Solteiro</option>
            <option value="Casado">Casado</option>
            <option value="União Estável">União Estável</option>
            <option value="Divorciado">Divorciado</option>
            <option value="Viúvo">Viúvo</option>
        </select>
        <input type="text" name="dependentes">
        <select name="departamento" id="departamento">
            <option value="Full-stack">Full-Stack</option>
            <option value="Jogos">Jogos</option>
            <option value="Cyber-security">Cyber-Security</option>
        </select>
        <input type="text" name="cargo">
        <select name="contrato" id="contrato">
            <option value="Recibo_verde">Recibo Verde</option>
            <option value="Prestação_de_serviços">Prestação de Serviços</option>  
        </select>
        <input type="text" name="salario">
        <input type="text" name="data_contratacao", value= "aaaa/mm/dd">
        <select name="estado" id="estado">
            <option value="Ativo">Ativo</option>
            <option value="Ferias">Férias</option>  
            <option value="Inativo">Inativo</option>  
        </select>
        <input id="inserir" type="submit" value="Cadastrar">
    </form>
  </div>
</section>
</body>
</html>
