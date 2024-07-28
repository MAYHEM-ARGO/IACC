<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$id_reserva = isset($_POST['id_reserva']) ? trim($_POST['id_reserva']) : '';
$id_cliente = isset($_POST['id_cliente']) ? trim($_POST['id_cliente']) : '';
$fecha = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';
$id_vuelo = isset($_POST['id_vuelo']) ? trim($_POST['id_vuelo']) : '';
$id_hotel = isset($_POST['id_hotel']) ? trim($_POST['id_hotel']) : '';


if (empty($id_reserva) || empty($id_cliente) || empty($fecha) || empty($id_vuelo) || empty($id_hotel)) {
    die("Todos los campos son obligatorios.");
}


if (!DateTime::createFromFormat('Y-m-d', $fecha)) {
    die("Fecha inválida.");
}


$conexion = mysqli_connect("localhost", "root", "", "agencia");


if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}


$consulta = "INSERT INTO reserva (id_reserva, id_cliente, fecha, id_vuelo, id_hotel) VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexion, $consulta);


if ($stmt) {
    
    mysqli_stmt_bind_param($stmt, "sssss", $id_reserva, $id_cliente, $fecha, $id_vuelo, $id_hotel);
    

    $resultado = mysqli_stmt_execute($stmt);
 
    if ($resultado) {
        echo "Datos agregados correctamente";
    } else {
        echo "Error al ingresar los datos: " . mysqli_stmt_error($stmt);
    }
    

    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la consulta: " . mysqli_error($conexion);
}


mysqli_close($conexion);
?>
