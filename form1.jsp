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
                //Guarda os dados do formulário.
                String firstName = request.getParameter("name");
                String lastName = request.getParameter("surname");
                String email = request.getParameter("email");
                String phone = request.getParameter("phone");
                String nationality = request.getParameter("nationality");
                String city = request.getParameter("city");
                String message = request.getParameter("message");
                
                // Se algum campo estiver vazio, exibe uma mensagem de erro
                if (firstName.equals("") || lastName.equals("") || email.equals("") || phone.equals("") || nationality.equals("") || city.equals("") || message.equals("")) {
                    msg = false;
                } else {
                
                    // Registrar o driver JDBC e estabelecer a conexão com o banco de dados
                    Class.forName("com.mysql.jdbc.Driver");
                    Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/db_devsync", "root", "");

                    // Preparar a declaração SQL usando um PreparedStatement para evitar injeção de SQL
                    String sql = "INSERT INTO tab_candidatura (primeiro_nome, ultimo_nome, email, telefone, nacionalidade, cidade, mensagem, atualizacao) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
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

                    //Encerra o leitor e a conexão.
                    stmt.close();
                    conn.close();
                    
                    //Se mais de uma linha da tabela for afetada...
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
    <script>
        // Se a mensagem for verdadeira, exibe um alerta e redireciona para form1.html quando o usuário clicar em "OK"
        <% if (msg) { %>
            alert("Dados inseridos com sucesso!");
            window.location.href = "form1.html";
        <% } else {%>
            alert("Preencha os Campos Devidamente!");
            window.location.href = "form1.html";
        <% } %>
    </script>
</body>
</html>
