<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   <form method="post" enctype="multipart/form-data">
      <label>Escolha uma imagem</label>
      <input type="file" name="imagem" placeholder="image">
      <br>
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
if ($_SERVER['REQUEST_METHOD'] == "POST") {

   var_dump($_FILES['imagem']);

   $caminho_temporario = $_FILES['imagem']['tmp_name'];
   $nome_atual = $_FILES['imagem']['name'];
   $pasta_desejada = "uploads/";
   $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

   $pasta_final =  $pasta_desejada . $nome_atual;


   // if (!is_dir($pasta_desejada)) {
   //    mkdir($pasta_desejada, 0755, true);
   // }
   move_uploaded_file("$caminho_temporario", "$pasta_final");
   echo $extensao;
   echo "<img src='$pasta_final'>";
}
?>