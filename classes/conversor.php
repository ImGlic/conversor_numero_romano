<?php
header('Content-Type: application/json');

class ConversorNumeros
{
    public function romanoParaDecimal($value)
    {
        $numero = strtoupper(trim($value));
        $numerosRomanos = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        ];

        $decimal = 0;
        $posicaoNumero = 0;
        $tamanhoNumero = strlen($numero);

        if (!preg_match('/^[MDCLXVI]+$/', $numero)) {
            return json_encode(['error' => "Número romano inválido: " . $numero]);
        }

        while ($posicaoNumero < $tamanhoNumero) {
            if ($posicaoNumero + 1 < $tamanhoNumero && isset($numerosRomanos[$numero[$posicaoNumero] . $numero[$posicaoNumero + 1]])) {
                $decimal += $numerosRomanos[$numero[$posicaoNumero] . $numero[$posicaoNumero + 1]];
                $posicaoNumero += 2;
            } else if (isset($numerosRomanos[$numero[$posicaoNumero]])) {
                $decimal += $numerosRomanos[$numero[$posicaoNumero]];
                $posicaoNumero++;
            } else {
                return json_encode(['error' => "Número romano inválido: " . $numero]);
            }
        }

        return json_encode(['result' => '<b style="color: #556B2F">' . $decimal . '</b>']);
    }

    public function decimalParaRomano($value)
    {
        $numero = intval($value);
        if ($numero < 1 || $numero > 10000) {
            return json_encode(['error' => "Número fora do intervalo permitido (1-10000): " . $numero]);
        }

        $numerosRomanos = [
            1000 => 'M',
            900 => 'CM',
            500 => 'D',
            400 => 'CD',
            100 => 'C',
            90 => 'XC',
            50 => 'L',
            40 => 'XL',
            10 => 'X',
            9 => 'IX',
            5 => 'V',
            4 => 'IV',
            1 => 'I'
        ];

        $romano = '';
        foreach ($numerosRomanos as $row => $numeral) {
            while ($numero >= $row) {
                $romano .= $numeral;
                $numero -= $row;
            }
        }

        return json_encode(['result' => '<b style="color: #556B2F">' . $romano . '</b>']);
    }
}

$converter = new ConversorNumeros();
$type = $_POST['type'] ?? '';
$value = $_POST['value'] ?? '';

if ($type == 'romanoParaDecimal') {
    echo $converter->romanoParaDecimal($value);
} elseif ($type == 'decimalParaRomano') {
    echo $converter->decimalParaRomano((int)$value);
} else {
    echo json_encode(['error' => 'Tipo de conversão inválido.']);
}
?>
