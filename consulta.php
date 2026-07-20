<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($nomeSanitizado) && !empty($CPFSanitizado) && !empty($telefoneSanitizado) && !empty($emailSanitizado)) {

        $pasta_final = null;
        $pode_cadastrar = true;

        // 1. Processa a imagem SOMENTE se uma foi enviada sem erros
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {

            $caminho_temporario = $_FILES['imagem']['tmp_name'];
            $nome_atual = $_FILES['imagem']['name'];
            $pasta_desejada = "uploads/";

            $extensao = pathinfo($nome_atual, PATHINFO_EXTENSION);
            $novo_nome = uniqid("img_", true) . "." . $extensao;
            $pasta_final = $pasta_desejada . $novo_nome;

            if (!is_dir($pasta_desejada)) {
                mkdir($pasta_desejada, 0755, true);
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $tipo_real = finfo_file($finfo, $caminho_temporario);

            $mimes_permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

            if (in_array($tipo_real, $mimes_permitidos)) {
                if (!move_uploaded_file($caminho_temporario, $pasta_final)) {
                    echo "Erro ao mover o arquivo para a pasta uploads.";
                    $pode_cadastrar = false;
                }
            } else {
                echo "Envie uma imagem com formato válido: jpg, jpeg, png, gif ou webp.";
                $pode_cadastrar = false;
            }

        
        } elseif (isset($_FILES['imagem']) && $_FILES['imagem']['error'] !== UPLOAD_ERR_NO_FILE) {
            echo "Erro no envio do arquivo. Código: " . $_FILES['imagem']['error'];
            $pode_cadastrar = false;
        }

       
        if ($pode_cadastrar) {
            try {
                $stmt = $conn->prepare("INSERT INTO tb_usuarios (nome, email, cpf, telefone, imagem) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $nomeSanitizado, $emailSanitizado, $CPFSanitizado, $telefoneSanitizado, $pasta_final);

                $stmt->execute();

                echo "Registro inserido com sucesso!";
                
                if ($pasta_final !== null) {
                    echo "<br><br><img src='$pasta_final' width='200'/>";
                }

                $stmt->close();

            } catch (mysqli_sql_exception $e) {
                // Captura o erro 1062 (Duplicate entry) sem derrubar a aplicação
                if ($e->getCode() === 1062) {
                    echo "Algum dos dados únicos já está cadastrado no banco de dados ";
                } else {
                    echo "Erro ao salvar no banco: " . $e->getMessage();
                }
            }
        }

    } else {
        echo "<strong>Registro negado</strong>. Corrija os dados inseridos.";
    }

    if (isset($conn)) {
        $conn->close();
    }
}