<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <%      
        boolean msg = false;
        // Verifica se o formulário foi submetido
        if (request.getMethod().equals("POST")) {
            try {
                // Guarda os dados do formulário
                String email = request.getParameter("email");
                String mensagem = request.getParameter("message");
                // Verifica se algum campo está vazio
                if (email.equals("") || mensagem.equals("")) {
                    msg = false;
                } else {
                    // Estabelece a conexão com o banco de dados
                    Class.forName("com.mysql.jdbc.Driver");
                    Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/db_devsync", "root", "");
                    // Prepara a declaração SQL
                    String sql = "Insert into tab_contato (email, mensagem, atualizacao, resposta)"
                    + "values(?, ?, NOW(), 'PENDENTE')";
                    PreparedStatement stmt = conn.prepareStatement(sql);
                    // Define os parâmetros da declaração SQL
                    stmt.setString(1, email);
                    stmt.setString(2, mensagem);
                    // Executa a inserção
                    int rowsAffected = stmt.executeUpdate();
                    stmt.close();
                    conn.close();
                    if (rowsAffected > 0) {
                        msg = true;
                    }
                }
            //Tratamento da Exceção
            } catch(Exception e) {
                e.printStackTrace();
                msg = false;
            }
        }
    %>
    <script>
        // Exibe uma mensagem de sucesso ou erro e redireciona
        <% if (msg) {%>
            alert("Sua Mensagem foi Enviada com Sucesso");
            window.location.href = "form3.html";
        <% } else {%>
            alert("Preencha os campos corretamente.");
            window.location.href = "form3.html";
        <% } %>
    </script>
</body>
</html>
