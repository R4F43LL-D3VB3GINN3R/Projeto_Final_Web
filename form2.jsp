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
            
            if (request.getMethod().equals("POST")) {
            
                try {
                
                    String cliente = request.getParameter("client");
                    String email = request.getParameter("email");
                    String telefone = request.getParameter("phone");
                    String aplicacao = request.getParameter("aplicacao");
                    String mensagem = request.getParameter("message");
                    
                    if (cliente.equals("") || email.equals("") || telefone.equals("") || aplicacao.equals("") || mensagem.equals("")) {
                    
                        msg = false;
                    
                    } else {
                    
                        Class.forName("com.mysql.jdbc.Driver");
                        Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/db_devsync", "root", "");
                        
                        String sql = "Insert into tab_pedido (cliente, email, phone, aplicacao, mensagem, atualizacao) "
                        + "values (?, ?, ?, ?, ?, NOW())";
                        PreparedStatement stmt = conn.prepareStatement(sql);
                        
                        stmt.setString(1, cliente);
                        stmt.setString(2, email);
                        stmt.setString(3, telefone);
                        stmt.setString(4, aplicacao);
                        stmt.setString(5, mensagem);
                        
                        int rowsAffected = stmt.executeUpdate();
                        
                        stmt.close();
                        conn.close();
                        
                        if (rowsAffected > 0) {
                        
                            msg = true;
                        
                        } 

                    }
             
                } catch(Exception e) {
                
                    e.printStackTrace();
                    msg = false;
                
                }
                
            }
            
        %>
        
        <script>
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

