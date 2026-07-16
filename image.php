<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Visualizar Imagens</title>
</head>

<body>
   <form method="get">
      <input type="button" value="Home" onclick="window.location.href = '../regex'">
      <input type="button" value="Limpar" onclick="window.location.href = '../regex/image.php'">
      <input type="text" name="cpf" maxlength="14" class="cpf" placeholder=" Digite o cpf do usuário">
      <input type="submit" value="enviar">
   </form>

</body>
<style>
</style>
<script src="script.js"></script>
</html>
<?php
require 'conexao.php';
//Mesma sanitização da home
$regexCPF = "/^([0-9]{3}\.){2}([0-9]{3})(\-[0-9]{2})$/";
$regexCPFJustNumbers = "/^[0-9]{11}$/";
if (!empty($_GET['cpf'])) {

   $text = $_GET['cpf'];
   $CPFSanitizado = null;
   print("<hr>");
   if (preg_match($regexCPF, $text)) {
      $CPFSanitizado = $text;
   } else if (preg_match($regexCPFJustNumbers, $text)) {
      // Se vier só números então formatar como cpf normal.
      $cpfFormatado = preg_replace($regexCPF, '$1.$2.$3-$4', $text);
      $CPFSanitizado = $cpfFormatado;
   } else {
      print("Erro, coloque o CPF corretamente");
   }
   
   //Busca somente se o cpf estiver certo, com mensagem de erro caso o user n tenha colocado foto
   if (!empty($CPFSanitizado)) {
      $stmt = $conn->prepare("SELECT imagem FROM tb_usuarios WHERE cpf = ?");
      $stmt->bind_param("s", $CPFSanitizado);
      $stmt->execute();

      $resultado = $stmt->get_result();
      $resultado = $resultado->fetch_assoc();
      if (!empty($resultado['imagem']) && ($resultado['imagem'] != "uploads/")) {
         $imagem = $resultado['imagem'];
         echo "<img src='$imagem'>";
      } else {
         echo "Não foi possível mostrar a imagem. CPF inexistente ou sem foto";
      }
   }
}
?>