<?php
$vuelos = [
    [
        'origen' => 'Chile',
        'destino' => 'Argentina',
        'fechaVuelo' => '2024-09-07',
        'duracion' => 10,
        'precio' => 400
    ],
    [
        'origen' => 'Chile',
        'destino' => 'Tokyo',
        'fechaVuelo' => '2024-10-23',
        'duracion' => 7,
        'precio' => 1700
    ],
    [
        'origen' => 'Chile',
        'destino' => 'Paris',
        'fechaVuelo' => '2024-10-23',
        'duracion' => 10,
        'precio' => 1200
    ],
];

$destino = isset($_GET['destino']) ? $_GET['destino'] : '';
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';

$resultados = array_filter($vuelos, function($vuelo) use ($destino, $fecha) {
    return (strtolower($vuelo['destino']) === strtolower($destino) && $vuelo['fechaVuelo'] === $fecha);
});

header('Content-Type: application/json');
echo json_encode(array_values($resultados));
?>
