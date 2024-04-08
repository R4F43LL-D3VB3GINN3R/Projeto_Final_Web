<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>
<!DOCTYPE html>
<html lang="pt-br">
<head>
</head>
<body>
    <% 
        boolean msg = false;
        // Verifica se o formulário foi submetido
        if (request.getMethod().equals("POST")) {        
            try {           
                // Guarda os dados do formulário
                String firstName = request.getParameter("name");
                String lastName = request.getParameter("surname");
                String email = request.getParameter("email");
                String phone = request.getParameter("phone");
                String nationality = request.getParameter("nationality");
                String city = request.getParameter("city");
                String message = request.getParameter("message");               
                // Verifica se algum campo está vazio
                if (firstName.isEmpty() || lastName.isEmpty() || email.isEmpty() || phone.isEmpty() || nationality.isEmpty() || city.isEmpty() || message.isEmpty()) {
                    msg = false;
                } else {
                    // Estabelece a conexão com o banco de dados
                    Class.forName("com.mysql.jdbc.Driver");
                    Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/db_devsync", "root", "");
                    // Prepara a declaração SQL
                    String sql = "INSERT INTO tab_candidatura (primeiro_nome, ultimo_nome, email, telefone, nacionalidade, cidade, mensagem, atualizacao) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
                    PreparedStatement stmt = conn.prepareStatement(sql);
                    // Define os parâmetros da declaração SQL
                    stmt.setString(1, firstName);
                    stmt.setString(2, lastName);
                    stmt.setString(3, email);
                    stmt.setString(4, phone);
                    stmt.setString(5, nationality);
                    stmt.setString(6, city);
                    stmt.setString(7, message);
                    // Executa a inserção
                    int rowsAffected = stmt.executeUpdate();
                    // Fecha a conexão e o statement
                    stmt.close();
                    conn.close();               
                    // Verifica se a inserção foi bem-sucedida
                    if (rowsAffected > 0) {
                        msg = true;
                    }
                }
            //Tratamento da Exceção
            } catch (Exception e) {
                e.printStackTrace();
                msg = false;
            }
        }
    %> 
    <script>
        // Exibe uma mensagem de sucesso ou erro e redireciona
        <% if (msg) { %>
            alert("Dados inseridos com sucesso!");
            window.history.back();
        <% } else { %>
            alert("Preencha todos os campos devidamente!");
        <% } %>
        // Redireciona para a página anterior
        window.history.back();
    </script>
</body>
</html>
