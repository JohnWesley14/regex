<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário + Regex</title>
</head>
<body>
    <form action="" method="get">
    <input type="button" value="Home" onclick="window.location.href = '../regex'">
    <input type="text" name="name" class="nome" autocomplete="off" placeholder="Nome" required>
    <input type="text" name="cpf" class="cpf" autocomplete="off" placeholder="cpf: XXX.XXX.XXX-XX" maxlength="14" required>
    <input type="text" name="email" class="email" autocomplete="off" placeholder="email" required>
    <input type="text" name="telefone" class="telefone" autocomplete="off" placeholder="telefone: (XX) XXXX-XXXX" maxlength="15" required>
    <a href="registros.php"><input type="button" value="Ver registros"></a>
    <input type="submit" value="enviar">
</form>
<script src="script.js"></script>
</body>
</html>

<?php
require 'conexao.php';
require 'regex.php';
require 'consulta.php';

?>