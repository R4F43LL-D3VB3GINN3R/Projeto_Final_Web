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
                String cliente = request.getParameter("client");
                String email = request.getParameter("email");
                String telefone = request.getParameter("phone");
                String aplicacao = request.getParameter("aplicacao");
                String mensagem = request.getParameter("message");
                // Verifica se algum campo está vazio
                if (cliente.equals("") || email.equals("") || telefone.equals("") || aplicacao.equals("") || mensagem.equals("")) {
                    msg = false;
                } else {
                    // Estabelece a conexão com o banco de dados
                    Class.forName("com.mysql.jdbc.Driver");
                    Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/db_devsync", "root", "");
                    // Prepara a declaração SQL
                    String sql = "Insert into tab_pedido (cliente, email, phone, aplicacao, mensagem, atualizacao) "
                    + "values (?, ?, ?, ?, ?, NOW())";
                    // Define os parâmetros da declaração SQL
                    PreparedStatement stmt = conn.prepareStatement(sql);
                    stmt.setString(1, cliente);
                    stmt.setString(2, email);
                    stmt.setString(3, telefone);
                    stmt.setString(4, aplicacao);
                    stmt.setString(5, mensagem);
                    // Executa a inserção
                    int rowsAffected = stmt.executeUpdate();
                    // Verifica se a inserção foi bem-sucedida
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
        <% if(msg) { %>
            alert("Pedido Registado com Sucesso.");
            window.location.href = "form2.html";
        <% } else { %>
            alert("Preencha os Campos Corretamente.");
            window.location.href = "form2.html";
        <% } %>
    </script>
</body>
</html>

