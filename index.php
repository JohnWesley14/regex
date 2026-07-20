<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário + Regex</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" class="nome" autocomplete="off" placeholder="Nome" required>
        <input type="text" name="cpf" class="cpf" autocomplete="off" placeholder="CPF" maxlength="14" required>
        <input type="text" name="email" class="email" autocomplete="off" placeholder="Email" required>
        <input type="text" name="telefone" class="telefone" autocomplete="off" placeholder="Telefone" maxlength="15" required>
        <label for="imagem">Inserir imagem</label>
        <input type="file" name="imagem" id="imagem" placeholder="image" accept="image/*">

        <input type="submit" value="Enviar">
        
        
    </form>
    <div>
        <input type="button" value="Ver Imagens" onclick="window.location.href = '../regex/image.php'">
        <input type="button" value="Home" onclick="window.location.href = '../regex'">
    </body>
    </div>
    <section>

        <?php
        require 'conexao.php';
        require 'regex.php';
        require 'consulta.php';
    
        ?>
    </section>
    <script src="script.js"></script>

</html>