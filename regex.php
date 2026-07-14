<?php 
$regexName = "/[^a-zA-Z\p{L}\s]/u";
$regexCPF = "/^([0-9]{3}\.){2}([0-9]{3})(\-[0-9]{2})$/";
$regexCPFJustNumbers = "/^[0-9]{11}$/";
$regexEmail = "/([a-z0-9]{2,})@([a-z0-9]{2,})(\.[a-z]{2,})(\.[a-z]{2,})?/";
$regexTelefone = "/^\(\d{2}\).?(9\d{4}-\d{4})$/";

if (isset($_GET['email']) && $_GET['email'] != '') {
    $text = $_GET['email'];

    print("<hr>");
    if (preg_match($regexEmail, $text)) {
        // $text = trim($text, '');
        print ("Email: " . $text);
    } else {
        print("Email errado, refaça");
    }
}

if (isset($_GET['name']) && $_GET['name'] != '') {
    $text = $_GET['name'];


    print ("<hr>");
    if(preg_match($regexName, $text)){
        $text = preg_replace($regexName, '',$text);
        print("Nome inválido, retire caracteres especiais");
        }else{
        print ("Nome: " . $text);
        
    }
}


if (isset($_GET['cpf']) && $_GET['cpf'] != '') {
    $text = $_GET['cpf'];

    print ("<hr>");
    if (preg_match($regexCPF, $text)) {
        echo "CPF: " . $text;
    } else if (preg_match($regexCPFJustNumbers, $text)) {
        // Se vier só números então formatar como cpf normal.
        $cpfFormatado = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{2})/", '$1.$2.$3-$4', $text);
        echo "CPF: " . $cpfFormatado;
    } else {
        print(isset($_GET['cpf']));
        print("Erro, coloque o CPF corretamente");
    }
}

if(isset($_GET['telefone']) && $_GET['telefone'] != ''){
    $text = $_GET['telefone'];
    
    print ("<hr>");
    if(preg_match($regexTelefone, $text)){
        echo "Número: " . $text;
    }else if(preg_match("/^\d{11}$/", $text)){
       $telefoneFormatado = preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1) $2-$3", $text);
        echo "Nº formatado: " . $telefoneFormatado;
    }
    else{
        echo "Número errado! Siga o padrão (XX) 9XXXX-XXXX";
    }
    print ("<hr>");
}


?>