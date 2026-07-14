<?php 

if(!empty($_POST['name']) && !empty($_POST['cpf']) && !empty($_POST['telefone']) && !empty($_POST['email']) && !empty($_FILES['imagem'])){

   $stmt = $conn->prepare("INSERT INTO tb_usuarios (nome, email, cpf, telefone, imagem) VALUES (?, ?, ?, ?, ?)");

   $cpf = $_POST['cpf'];

   $caminho_temporario = $_FILES['imagem']['tmp_name'];
   $nome_atual = $_FILES['imagem']['name'];
   $pasta_desejada = "uploads/";
   $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

   $pasta_final =  $pasta_desejada . $nome_atual;


   // if (!is_dir($pasta_desejada)) {
   //    mkdir($pasta_desejada, 0755, true);
   // }
   move_uploaded_file("$caminho_temporario", "$pasta_final");
  
   $stmt->bind_param("sssss", $_POST['name'], $_POST['email'], $_POST['cpf'], $_POST['telefone'], $pasta_final);
   
   if ($stmt->execute()) {
    echo "Registro inserido com sucesso!";
   } else {
      echo "Erro: " . $stmt->error;
   }
   $stmt->close();

   $stmt_busca = $conn->prepare("SELECT imagem FROM tb_usuarios WHERE cpf = ?");
   $stmt_busca->bind_param("s", $cpf);
   $stmt_busca->execute();
   
   $resultado = $stmt_busca->get_result();
   
   $resultado = $resultado->fetch_assoc();
   $imagem =  $resultado['imagem'];
   echo "<br>";
   echo "<br>";
   echo "<img src= '$imagem'/>";
   $stmt_busca->close();
}





?>