<?php 

if(!empty($_GET['name']) && !empty($_GET['cpf']) && !empty($_GET['telefone']) && !empty($_GET['email'])){

   $stmt = $conn->prepare("INSERT INTO tb_usuarios (nome, email, cpf, telefone) VALUES (?, ?, ?, ?)");
   $stmt->bind_param("ssss", $_GET['name'], $_GET['email'], $_GET['cpf'], $_GET['telefone']);
   
   if ($stmt->execute()) {
    echo "Registro inserido com sucesso!";
   } else {
      echo "Erro: " . $stmt->error;
   }

   $stmt->close();
}

?>