<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   <form method="get">
      <input type="button" value="Home" onclick="window.location.href = '../regex'">
      <input type="button" value="Limpar" onclick="window.location.href = '../regex/image.php'">
      <input type="text" name="name" class="Nome do usuário" placeholder="Digite o nome do usuário">
      <input type="submit" value="enviar">
   </form>
   
</body>
<style>
   img{
      width: 200px;
      height: 200px;
      border-radius: 50%;
   }
</style>
</html>
<?php
require 'conexao.php';
if(!empty($_GET['name'])){
   $stmt = $conn->prepare("SELECT imagem FROM tb_usuarios WHERE nome = ?");
   $stmt->bind_param("s", $_GET['name']);
   $stmt->execute();

   $resultado = $stmt->get_result();
   $resultado = $resultado->fetch_assoc();
   $imagem = $resultado['imagem'];
   echo "<img src='$imagem'>";
   
}
?>