<?php

/**
 * Archivo con problemas de formato y espaciado
 */

// Espaciado incorrecto en arrays.
$config = array(
    'host'     => 'localhost',
    'port'     => 3306,
    'database' => 'test',
);

// Espaciado incorrecto en operadores
$result = $a + $b * $c;

// Espaciado incorrecto en estructuras de control
if ($result > 0) {
    echo 'Positive';
} else {
    echo 'Negative';
}

// Líneas demasiado largas (más de 120 caracteres)
$very_long_variable_name_that_exceeds_the_recommended_line_length_and_should_be_broken_into_multiple_lines = 'This is a very long string that also exceeds the recommended line length';

// Espaciado incorrecto en funciones
function calculate($a, $b, $c)
{
    return $a + $b + $c;
}

// Mezcla de tabs y espacios (simulado con espacios)
$indented_with_spaces = true;
$indented_with_tabs   = true;

// Falta de espacios en concatenación
$message = 'Hello' . $name . '!';

// Espaciado incorrecto en llamadas de función
$result = calculate(1, 2, 3);
