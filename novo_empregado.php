<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/novo_empregado.css">
    <title>Devsync</title>
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
    <form action="empregado_cadastrado" method="post">
        <input type="text" name="nif" maxlength="9">
        <input type="text" name="nome">
        <input type="text" name="apelido">
        <input type="text" name="nome_completo">
        <input type="text" name="data_nascimento" value= "aaaa/mm/dd">
        <select name="sexo" id="sexo">
            <option value="masculino">M</option>
            <option value="feminino">F</option>
            <option value="outro">O</option>
        </select>
        <input type="text" name="telefone" maxlength="9">
        <input type="email" name="email">
        <input type="text" name="endereco">
        <select name="estado_civil" id="estado_civil">
            <option value="solteiro">Solteiro</option>
            <option value="casado">Casado</option>
            <option value="união_estável">União Estável</option>
            <option value="divorciado">Divorciado</option>
            <option value="viúvo">Viúvo</option>
        </select>
        <input type="text" name="dependentes">
        <select name="departamento" id="departamento">
            <option value="full-stack">Full-Stack</option>
            <option value="jogos">Jogos</option>
            <option value="cyber-security">Cyber-Security</option>
        </select>
        <input type="text" name="cargo">
        <select name="contrato" id="contrato">
            <option value="recibo_verde">Recibo Verde</option>
            <option value="prestação_de_serviços">Jogos</option>  
        </select>
        <input type="text" name="salario">
        <input type="text" name="data_contratacao", value= "aaaa/mm/dd">
        <select name="estado" id="estado">
            <option value="ativo">Ativo</option>
            <option value="ferias">Férias</option>  
            <option value="inativo">Inativo</option>  
        </select>
        <input id="inserir" type="submit" value="Cadastrar">
    </form>
  </div>
</section>
</body>
</html>
