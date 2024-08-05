<?php

function runTest($tipo, $value, $resultadoEsperado) {
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

runTest('romanoParaDecimal', 'I', '<b style="color: #556B2F">1</b>');
runTest('romanoParaDecimal', 'IV', '<b style="color: #556B2F">4</b>');
runTest('romanoParaDecimal', 'IX', '<b style="color: #556B2F">9</b>');
runTest('romanoParaDecimal', 'XL', '<b style="color: #556B2F">40</b>');
runTest('romanoParaDecimal', 'XC', '<b style="color: #556B2F">90</b>');
runTest('romanoParaDecimal', 'CD', '<b style="color: #556B2F">400</b>');
runTest('romanoParaDecimal', 'CM', '<b style="color: #556B2F">900</b>');
runTest('romanoParaDecimal', 'MCMXCIV', '<b style="color: #556B2F">1994</b>');
runTest('romanoParaDecimal', 'MMMMMMMMMM', '<b style="color: #556B2F">10000</b>');
runTest('romanoParaDecimal', 'INVALID', 'Número romano inválido: INVALID');

runTest('decimalParaRomano', '1', '<b style="color: #556B2F">I</b>');
runTest('decimalParaRomano', '4', '<b style="color: #556B2F">IV</b>');
runTest('decimalParaRomano', '9', '<b style="color: #556B2F">IX</b>');
runTest('decimalParaRomano', '40', '<b style="color: #556B2F">XL</b>');
runTest('decimalParaRomano', '90', '<b style="color: #556B2F">XC</b>');
runTest('decimalParaRomano', '400', '<b style="color: #556B2F">CD</b>');
runTest('decimalParaRomano', '900', '<b style="color: #556B2F">CM</b>');
runTest('decimalParaRomano', '1994', '<b style="color: #556B2F">MCMXCIV</b>');
runTest('decimalParaRomano', '10000', '<b style="color: #556B2F">MMMMMMMMMM</b>');
runTest('decimalParaRomano', '0', 'Número fora do intervalo permitido (1-10000): 0');
runTest('decimalParaRomano', '10001', 'Número fora do intervalo permitido (1-10000): 10001');
runTest('decimalParaRomano', '-1', 'Número fora do intervalo permitido (1-10000): -1');
?>
