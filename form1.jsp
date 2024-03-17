<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>


<%
    boolean msg = false;
    // Verifica se o formulário foi submetido
    if (request.getMethod().equals("POST")) {
        try {
            String firstName = request.getParameter("name");
            String lastName = request.getParameter("surname");
            String email = request.getParameter("email");
            String phone = request.getParameter("phone");
            String nationality = request.getParameter("nationality");
            String city = request.getParameter("city");
            String message = request.getParameter("message");
            
            if (firstName.equals("") || lastName.equals("") || email.equals("") || phone.equals("") || nationality.equals("") || city.equals("") || message.equals("")) {
                // Se algum campo estiver vazio, exibe uma mensagem de erro
                msg = false;
            } else {
                // Registrar o driver JDBC e estabelecer a conexão com o banco de dados
                Class.forName("com.mysql.jdbc.Driver");
                Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/db_devsync", "root", "");

                // Preparar a declaração SQL usando um PreparedStatement para evitar injeção de SQL
                String sql = "INSERT INTO tab_cadastro (primeiro_nome, ultimo_nome, email, telefone, nacionalidade, cidade, mensagem) VALUES (?, ?, ?, ?, ?, ?, ?)";
                PreparedStatement stmt = conn.prepareStatement(sql);

                stmt.setString(1, firstName);
                stmt.setString(2, lastName);
                stmt.setString(3, email);
                stmt.setString(4, phone);
                stmt.setString(5, nationality);
                stmt.setString(6, city);
                stmt.setString(7, message);

                // Executar a inserção
                int rowsAffected = stmt.executeUpdate();

                stmt.close();
                conn.close();

                if (rowsAffected > 0) {
                    msg = true;
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
            msg = false;
        }
    }
    
%>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,600,700" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="CSS/form1.css">
    <title>.:DevSync - Candidatura espontânea</title>
</head>
<body>
    <% if (msg) { %>
        <h1>Dados inseridos com sucesso!</h1>
    <% } else { %>
        <h1>Ocorreu um erro ao inserir os dados.</h1>
    <% } %>
</body>
</html>
