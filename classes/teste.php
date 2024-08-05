<?php

function testeConversao($tipo, $value, $resultadoEsperado) {
    $url = 'teste.php';
    $data = array('tipo' => $tipo, 'value' => $value);

    $script = curl_init($url);
    curl_setopt($script, CURLOPT_POST, 1);
    curl_setopt($script, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($script, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($script);
    curl_close($script);

    $result = json_decode($response, true);
    
    if ($result['result'] === $resultadoEsperado || $result['error'] === $resultadoEsperado) {
        echo "Teste Aprovado $tipo($value) => $resultadoEsperado\n";
    } else {
        echo "o Teste Falhou: $tipo($value) => resultado esperado: $resultadoEsperado, resultado: " . ($result['result'] ?? $result['error']) . "\n";
    }
}

testeConversao('romanoParaDecimal', 'I', '<b style="color: #556B2F">1</b>');
testeConversao('romanoParaDecimal', 'IV', '<b style="color: #556B2F">4</b>');
testeConversao('romanoParaDecimal', 'IX', '<b style="color: #556B2F">9</b>');
testeConversao('romanoParaDecimal', 'XL', '<b style="color: #556B2F">40</b>');
testeConversao('romanoParaDecimal', 'XC', '<b style="color: #556B2F">90</b>');
testeConversao('romanoParaDecimal', 'CD', '<b style="color: #556B2F">400</b>');
testeConversao('romanoParaDecimal', 'CM', '<b style="color: #556B2F">900</b>');
testeConversao('romanoParaDecimal', 'MCMXCIV', '<b style="color: #556B2F">1994</b>');
testeConversao('romanoParaDecimal', 'MMMMMMMMMM', '<b style="color: #556B2F">10000</b>');
testeConversao('romanoParaDecimal', 'INVALID', 'Número romano inválido: INVALID');

testeConversao('decimalParaRomano', '1', '<b style="color: #556B2F">I</b>');
testeConversao('decimalParaRomano', '4', '<b style="color: #556B2F">IV</b>');
testeConversao('decimalParaRomano', '9', '<b style="color: #556B2F">IX</b>');
testeConversao('decimalParaRomano', '40', '<b style="color: #556B2F">XL</b>');
testeConversao('decimalParaRomano', '90', '<b style="color: #556B2F">XC</b>');
testeConversao('decimalParaRomano', '400', '<b style="color: #556B2F">CD</b>');
testeConversao('decimalParaRomano', '900', '<b style="color: #556B2F">CM</b>');
testeConversao('decimalParaRomano', '1994', '<b style="color: #556B2F">MCMXCIV</b>');
testeConversao('decimalParaRomano', '10000', '<b style="color: #556B2F">MMMMMMMMMM</b>');
testeConversao('decimalParaRomano', '0', 'Número fora do intervalo permitido (1-10000): 0');
testeConversao('decimalParaRomano', '10001', 'Número fora do intervalo permitido (1-10000): 10001');
testeConversao('decimalParaRomano', '-1', 'Número fora do intervalo permitido (1-10000): -1');
?>
