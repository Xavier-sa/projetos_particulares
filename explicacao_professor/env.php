<?php
// Caminho para o arquivo .env
$caminhoArquivo = '../.env';

// Obtém o conteúdo do arquivo .env
$conteudoArquivo = file_get_contents($caminhoArquivo);

// Separa as linhas do arquivo
$linhas = explode("\n", $conteudoArquivo);

// Array para armazenar as variáveis do .env
$variaveis = [];

// Usa o array_map para processar cada linha do arquivo .env
array_map(function($linha) use (&$variaveis) {
    // Ignora linhas vazias ou comentários
    if (empty($linha) || $linha[0] === '#') {
        return;
    }

    // Separa a chave e o valor com base no '='
    list($key, $val) = explode('=', $linha, 2); // Limitando em 2 para evitar problemas com '=' no valor

    // Remove espaços em branco das chaves e valores
    $key = trim($key);
    $val = trim($val);

    // Adiciona a chave e o valor ao array de variáveis
    $variaveis[$key] = $val;
}, $linhas);

// Exibe as variáveis do arquivo .env
echo "<pre>";
print_r($variaveis);
echo "</pre>";
?>
