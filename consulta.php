<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   if (!empty($nomeSanitizado) && !empty($CPFSanitizado) && !empty($telefoneSanitizado) && !empty($emailSanitizado)) {

      $caminho_temporario = $_FILES['imagem']['tmp_name'];
      $nome_atual = $_FILES['imagem']['name'];
      $pasta_desejada = "uploads/";
      $pasta_final =  $pasta_desejada . $nome_atual;

      // Cria a pasta uploads
      if (!is_dir($pasta_desejada)) {
         mkdir($pasta_desejada, 0755, true);
      }

      // -- INÍCIO DA VALIDAÇÃO --
      // 1. Abre o leitor de informações do PHP
      $finfo = finfo_open(FILEINFO_MIME_TYPE);

      // 2. Lê o arquivo temporário ANTES de mover
      $tipo_real = finfo_file($finfo, $caminho_temporario);

      // 3. Cria a lista de MIME Types permitidos
      $mimes_permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

      // 4. Faz a verificação
      if (in_array($tipo_real, $mimes_permitidos)) {

         // Se for imagem mesmo, AGORA SIM movemos o arquivo para a pasta final
         if (move_uploaded_file($caminho_temporario, $pasta_final)) {

            $stmt = $conn->prepare("INSERT INTO tb_usuarios (nome, email, cpf, telefone, imagem) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $nomeSanitizado, $emailSanitizado, $CPFSanitizado, $telefoneSanitizado, $pasta_final);

            if ($stmt->execute()) {
               echo "Registro inserido com sucesso!";
            } else {
               echo "Erro: " . $stmt->error;
            }
            $stmt->close();

            // Busca a imagem para mostrar na tela
            $stmt_busca = $conn->prepare("SELECT imagem FROM tb_usuarios WHERE cpf = ?");
            $stmt_busca->bind_param("s", $CPFSanitizado);
            $stmt_busca->execute();

            $resultado = $stmt_busca->get_result();
            $resultado = $resultado->fetch_assoc();
            $imagem =  $resultado['imagem'];

            if ($imagem != "uploads/") {
               echo "<br><br><img src= '$imagem'/>";
            }
            $stmt_busca->close();
         
         } else {
            echo "Erro ao mover o arquivo para a pasta uploads.";
         }
      } else {
         // Se não passar na validação, cai aqui e nada é salvo ou movido
         echo "Envie uma imagem com formato válido: jpg, jpeg, png, gif ou webp.";
      }
   } else {
      echo "<strong>Registro negado</strong>. Corrija os dados inseridos.";
   }
   if (isset($conn)) {
      $conn->close();
   }
}
