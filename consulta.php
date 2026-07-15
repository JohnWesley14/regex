<?php 

if($_SERVER['REQUEST_METHOD'] == "POST"){
   if(!empty($nomeSanitizado) && !empty($CPFSanitizado) && !empty($telefoneSanitizado) && !empty($emailSanitizado)){
      
      $stmt = $conn->prepare("INSERT INTO tb_usuarios (nome, email, cpf, telefone, imagem) VALUES (?, ?, ?, ?, ?)");
   
   
      $caminho_temporario = $_FILES['imagem']['tmp_name'];
      $nome_atual = $_FILES['imagem']['name'];
      $pasta_desejada = "uploads/";
      $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
   
      $pasta_final =  $pasta_desejada . $nome_atual;
   
      //Cria a pasta uploads  
      if (!is_dir($pasta_desejada)) {
         mkdir($pasta_desejada, 0755, true);
      }

      move_uploaded_file("$caminho_temporario", "$pasta_final");
     
      $stmt->bind_param("sssss", $nomeSanitizado, $emailSanitizado, $CPFSanitizado, $telefoneSanitizado, $pasta_final);
      
      if ($stmt->execute()) {
       echo "Registro inserido com sucesso!";
      } else {
         echo "Erro: " . $stmt->error;
      }
      $stmt->close();
   
      $stmt_busca = $conn->prepare("SELECT imagem FROM tb_usuarios WHERE cpf = ?");
      $stmt_busca->bind_param("s", $CPFSanitizado);
      $stmt_busca->execute();
      
      $resultado = $stmt_busca->get_result();
      
      $resultado = $resultado->fetch_assoc();
      $imagem =  $resultado['imagem'];
      if($imagem != "uploads/"){

         echo "<br>";
         echo "<br>";
         echo "<img src= '$imagem'/>";
      }
      $stmt_busca->close();
   }else{
      
      echo "<strong>Registro negado</strong>. Corrija os dados inseridos.";
   }
}





?>