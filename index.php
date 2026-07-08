
<form action="" method="get">
    <input type="button" value="Home" onclick="window.location.href = '../regex'">
    <input type="text" name="name" autocomplete="off" placeholder="Nome">
    <input type="text" name="cpf" autocomplete="off" placeholder="cpf" max="11">
    <input type="text" name="email" autocomplete="off" placeholder="email">
    <input type="text" name="telefone" autocomplete="off" placeholder="telefone">
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
$regexCPF = "/";
$regexReplaceCPF = "/[\.\-]/";
if (isset($_GET['name'])) {
    $text = $_GET['name'];
    
   
    print ("<hr>");
    print ("<br>");
    $text = preg_replace($regexName, '',$text);
    print("Texto novo: ");
    print($text);
}
if(isset($_GET['cpf'])){
    $text = $_GET['cpf'];
    if(preg_match($regexCPF, $text)){
        echo "foi";
    }else{die ("erro");}
    $text = preg_replace($regexReplaceCPF,'',$text);
    print ("CPF NOVO: ");
    print ($text);
}
// <script>alert("Esqueceu de me bloquear na Cazé TV")</script>

// ^ se estiver no começo e fora dos colchetes diz que o padrão só é válido se começar exatamente no primeiro caractere do texto
// Se o ^ estiver dentro do colchete ele se torna negação

?>