<?php 
$regexName = "/[^a-zA-Z\p{L}\s]/u";
$regexCPF = "/^([0-9]{3}\.){2}([0-9]{3})(\-[0-9]{2})$/";
$regexCPFJustNumbers = "/^[0-9]{11}$/";
$regexEmail = "/^([a-z0-9]{2,})@([a-z0-9]{2,})(\.[a-z]{2,})(\.[a-z]{2,})?$/i";
$regexTelefone = "/^\(\d{2}\).?(9\d{4}-\d{4})$/";

if (isset($_POST['email']) && $_POST['email'] != '') {
    $text = $_POST['email'];

    if (preg_match($regexEmail, $text)) {
        // $text = trim($text, '');
        $emailSanitizado = trim($text, "");
        print ("<p>Email: " . htmlspecialchars($text) . "</p>");
    } else {
        print("<p>Email errado, refaça</p>");
    }
}

if (isset($_POST['name']) && $_POST['name'] != '') {
    $text = $_POST['name'];


    if(preg_match($regexName, $text)){
        $text = preg_replace($regexName, '',$text);
        print("<p>Nome inválido, retire caracteres especiais</p>");
        }else{
        $nomeSanitizado = $text;
        print ("<p>Nome: " . htmlspecialchars($text) . "</p>");
        
    }
}


if (isset($_POST['cpf']) && $_POST['cpf'] != '') {
    $text = $_POST['cpf'];

    if (preg_match($regexCPF, $text)) {
        echo "CPF: " . $text;
        $CPFSanitizado = $text;
    } else if (preg_match($regexCPFJustNumbers, $text)) {
        // Se vier só números então formatar como cpf normal.
        $cpfFormatado = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{2})/", '$1.$2.$3-$4', $text);
        $CPFSanitizado = $cpfFormatado;
        echo "<p>CPF: " . htmlspecialchars($cpfFormatado) . "</p>";
    } else {
        print(isset($_POST['cpf']));
        print("<p>Erro, coloque o CPF corretamente</p>");
    }
}

if(isset($_POST['telefone']) && $_POST['telefone'] != ''){
    $text = $_POST['telefone'];
    
    if(preg_match($regexTelefone, $text)){
        echo "<p>Número: " . $text . "</p>";
        $telefoneSanitizado = $text;
    }else if(preg_match("/^\d{11}$/", $text)){
       $telefoneFormatado = preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1) $2-$3", $text);
       $telefoneSanitizado = $telefoneFormatado;
        echo "<p>Nº formatado: " . htmlspecialchars($telefoneFormatado) . "</p>";
    }
    else{
        echo "<p>Número errado! Siga o padrão (XX) 9XXXX-XXXX</p>";
    }
}


?>