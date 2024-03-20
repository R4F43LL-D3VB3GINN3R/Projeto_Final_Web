<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>

<%
try {
    Class.forName("com.mysql.jdbc.Driver");
    Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/db_devsync", "root", "");
    out.println("Bem-Vindo à DevSync");
} catch (Exception e) {
    out.println("Servidor Indisponível: " + e.getMessage());
}
%>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,600,700" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="CSS/form4.css">
        <title>.:DevSync - Política de Privacidade:.</title>
    </head>
</head>
<body>
    <section class="layout">
        <div class="header">
            <nav>
                <ul>
                    <li><a href="index.jsp">Home</a></li>
                    <li><a href="form1.jsp">Trabalhe Conosco</a></li>
                    <li><a href="form2.jsp">Encomende uma Aplicação</a></li>
                    <li><a href="form3.jsp">Contatos</a></li>
                </ul>
            </nav>
        </div>
    <div class="leftSide"></div>
    <div class="body2">

        <img src="Imagens/logo.jpg" style="border: 1px solid rgb(187, 249, 1); border-radius: 10px;">

        <h1>Política de Privacidade</h1>

        <h3><b>1. Coleta de Informações:</b></h3>

        <p><b>1.1. Informações Pessoais:</b></p>
        <p>Nós da DEVSYNC coletamos informações pessoais, incluindo nome, endereço de e-mail e informações de contato. Esses dados são obtidos apenas quando você os fornece voluntariamente ao usar nossos serviços ou interagir conosco.</p>

        <p><b>1.2. Informações de Uso:</b></p>
        <p>Podemos coletar informações sobre como você utiliza nosso site, incluindo páginas visitadas, tempo de permanência e ações realizadas. Esses dados são usados para melhorar a experiência do usuário e otimizar nossos serviços.</p>

        <h3><b>2. Uso de Informações:</b></h3>

        <p><b>2.1. Fornecimento de Serviços:</b></p>
        <p>As informações coletadas são utilizadas para fornecer, manter e melhorar nossos serviços, garantindo a funcionalidade adequada do site DEVSYNC.</p>

        <p><b>2.2. Comunicações:</b></p>
        <p>Podemos utilizar suas informações de contato para enviar notificações relevantes sobre atualizações de serviços, novidades ou informações importantes relacionadas à DEVSYNC.</p>

        <h3><b>3. Compartilhamento de Informações:</b></h3>

        <p><b>3.1. Parceiros e Fornecedores:</b></p>
        <p>Em algumas circunstâncias, podemos compartilhar suas informações com parceiros e fornecedores estratégicos para garantir a prestação eficiente de nossos serviços.</p>

        <p><b>3.2. Requisitos Legais:</b></p>
        <p>Reservamo-nos o direito de divulgar suas informações pessoais caso seja necessário cumprir obrigações legais ou responder a solicitações legais.</p>

        <p><b>4. Segurança:</b></p>
        <p>Implementamos medidas de segurança adequadas para proteger suas informações contra acesso não autorizado, alteração, divulgação ou destruição não autorizada.</p>

        <p><b>5. Seus Direitos:</b></p>
        <p>Você tem o direito de acessar, corrigir ou excluir suas informações pessoais. Entre em contato conosco para exercer esses direitos.</p>

        <p><b>6. Alterações na Política de Privacidade:</b></p>
        <p>Reservamo-nos o direito de atualizar nossa política de privacidade. Recomendamos que você reveja periodicamente as alterações.</p>

        <p><b>7. Contato:</b></p>
        <p>Para questões relacionadas à privacidade ou informações adicionais, entre em contato conosco em [inserir e-mail de contato].</p>
        <h3><b>8. Cookies e Tecnologias Semelhantes:</b></h3>

        <p><b>8.1. Cookies:</b></p>
        <p>Utilizamos cookies para melhorar a experiência do usuário, personalizar conteúdo e anúncios, e analisar o tráfego do site. Ao utilizar o site DEVSYNC, você concorda com o uso de cookies de acordo com nossa Política de Cookies.</p>

        <h3><b>9. Links para Outros Sites:</b></h3>

        <p><b>9.1. Sites de Terceiros:</b></p>
        <p>Nosso site pode conter links para sites de terceiros. Não nos responsabilizamos pela privacidade ou conteúdo desses sites e recomendamos que você revise as políticas de privacidade deles.</p>

        <h3><b>10. Crianças:</b></h3>

        <p><b>10.1. Idade Mínima:</b></p>
        <p>O site DEVSYNC não é destinado a crianças menores de 13 anos. Não coletamos intencionalmente informações de crianças sem o consentimento dos pais. Se tivermos conhecimento de informações coletadas de uma criança, tomaremos as medidas necessárias para excluí-las.</p>

        <h3><b>11. Transferência Internacional de Dados:</b></h3>

        <p><b>11.1. Armazenamento Internacional:</b></p>
        <p>Ao utilizar nossos serviços, você concorda com a transferência de suas informações para países onde a DEVSYNC opera, que podem ter padrões de proteção de dados diferentes. Comprometemo-nos a proteger suas informações, independentemente do local de processamento.</p>

        <h3><b>12. Consentimento:</b></h3>

        <p><b>12.1. Consentimento para Processamento:</b></p>
        <p>Ao utilizar nossos serviços, você consente com a coleta, uso e divulgação de suas informações conforme descrito nesta Política de Privacidade.</p>

        <h3><b>13. Atualizações de Notificação:</b></h3>

        <p><b>13.1. Notificação de Alterações:</b></p>
        <p>Em caso de alterações significativas nesta política, notificaremos os usuários por meio de avisos no site ou por outros meios de comunicação.</p>
    </div>
    <div class="rightSide">4</div>
    <div class="footer">
        <footer class="mainfooter">
          <p>&copy; <a href="#">DevSync Team</a></p> 
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-vimeo-v"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </footer>
      </div>
  </section>
  </body>
</html>
