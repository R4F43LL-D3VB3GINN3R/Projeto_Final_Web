<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevSync-Admin</title>
    <link rel="icon" href="Imagens/logo_icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="styles/insert_message.css">
</head>
<body>

<?php

$server = "localhost";
$database = "db_devsync";
$user = "root";
$pass = "";

$conn = new mysqli($server, $user, $pass, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

    $login_ = $_POST["login"];

    $stmt = $conn->prepare("DELETE FROM tab_admin WHERE login = ?");
    $stmt->bind_param('s', $login_);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {

        ?>

        <div id="message_div">
          <h1>Administrador Removido com Sucesso.</h1>
          <button onclick="redirect1()" id="buttonmessage">Ok</button>
        </div>  
        <script>
          function redirect1() {

              window.location.href = "admins.php";

          }
        </script>

  <?php

  } else {

  ?>
      <div id="message_div">
          <h1>Não foi possível remover o Administrador</h1>
          <button onclick="redirect2()" id="buttonmessage">Ok</button>        
      </div>
      <script>
          function redirect2() {

              window.location.href = "admins.php";

          }
      </script>
      </body>

  <?php

  }

  $conn->close();

}

?>
</html>
