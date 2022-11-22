<?php
$filename = 'loge.txt';
$conteudo = date("d/m/Y")."-".$_GET['loge']."\n";

// Primeiro vamos ter certeza de que o arquivo existe e pode ser alterado
if (is_writable($filename)) {

    // Em nosso exemplo, nós vamos abrir o arquivo $filename
    // em modo de adição. O ponteiro do arquivo estará no final
    // do arquivo, e é pra lá que $conteudo irá quando o
    // escrevermos com fwrite().
    if (!$handle = fopen($filename, 'a')) {
        echo "Não foi possível abrir o arquivo ($filename)";
        exit;
    }

    // Escreve $conteudo no nosso arquivo aberto.
    if (fwrite($handle, $conteudo) === FALSE) {
        echo "Não foi possível escrever no arquivo ($filename)";
        exit;
    }

    echo "Sucesso: Escrito ($conteudo) no arquivo ($filename)";

    fclose($handle);

} else {
    echo "O arquivo $filename não pode ser alterado";
}
?>