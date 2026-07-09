<form action="" method="get">
    <input type="button" value="Home" onclick="window.location.href = '../regex'">
    <input type="text" name="name" autocomplete="off" placeholder="Nome">
    <input type="number" name="cpf" autocomplete="off" placeholder="cpf: XXX.XXX.XXX-XX" maxlength="11" >
    <input type="text" name="email" autocomplete="off" placeholder="email">
    <input type="text" name="telefone" autocomplete="off" placeholder="telefone: (XX) XXXX-XXXX">
    <input type="submit" value="enviar">
</form>
<?php
// [^ ... ] = Significa "Tudo que NÃO seja o que está aqui dentro"
// \p{L}    = Qualquer letra (com ou sem acento)
// \d       = Qualquer número
// \s       = Espaços em branco
// /u       = Pra aparecer os acentos
// 
$regexName = "/[^a-zA-Z0-9\p{L}\s]/u";
$regexCPF = "/^([0-9]{3}\.){2}([0-9]{3})(\-[0-9]{2})$/";
$regexCPFJustNumbers = "/^[0-9]{11}$/";
$regexEmail = "/([a-z0-9]{2,})@([a-z0-9]{2,})(\.[a-z]{2,})(\.[a-z]{2,})?/";
$regexTelefone = "/\(\d{2}\).?(9\d{4}-\d{4})/";

if (isset($_GET['email']) && $_GET['email'] != '') {
    $text = $_GET['email'];

    print("<hr>");
    print("<br>");
    if (preg_match($regexEmail, $text)) {
        print ("Email: " . $text);
    } else {
        print("Email errado, refaça");
    }
}

if (isset($_GET['name']) && $_GET['name'] != '') {
    $text = $_GET['name'];


    print ("<hr>");
    print ("<br>");
    if(preg_match($regexName, $text)){
        $text = preg_replace($regexName, '',$text);
        print("Nome inválido, retire caracteres especiais");
        }else{
        print ("Nome: " . $text);
    }
}


if (isset($_GET['cpf']) && $_GET['cpf'] != '') {
    $text = $_GET['cpf'];
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
    if(preg_match($regexTelefone, $text)){
    
    }else if(preg_match("/\d{11}/", $text)){
       $telefoneFormatado = preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1) $2-$3", $text);
        echo "Nº formatado: " . $telefoneFormatado;
    }
    else{
        echo "errou foi mlk";
    }
}

// <script>alert("Esqueceu de me bloquear na Cazé TV")</script>

// ^ se estiver no começo e fora dos colchetes diz que o padrão só é válido se começar exatamente no primeiro caractere do texto
// Se o ^ estiver dentro do colchete ele se torna negação

?>