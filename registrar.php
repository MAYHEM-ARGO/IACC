<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "agencia");

// Verificar la conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Comprobar si se ha enviado una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_type = $_POST['form_type'];

    if ($form_type === 'vuelo') {
        $id_vuelo = $_POST['id_vuelo'];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $fecha = $_POST['fecha'];
        $plazas_disponibles = $_POST['plazas_disponibles'];
        $precio = $_POST['precio'];

        $consulta = "INSERT INTO vuelo (id_vuelo, origen, destino, fecha, plazas_disponibles, precio) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "issssi", $id_vuelo, $origen, $destino, $fecha, $plazas_disponibles, $precio);

    } elseif ($form_type === 'hotel') {
        $id_hotel = $_POST['id_hotel'];
        $nombre = $_POST['nombre'];
        $ubicacion = $_POST['ubicacion'];
        $habitaciones_disponibles = $_POST['habitaciones_disponibles'];
        $tarifa_noche = $_POST['tarifa_noche'];

        $consulta = "INSERT INTO hotel (id_hotel, nombre, ubicacion, habitaciones_disponibles, tarifa_noche) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "isssi", $id_hotel, $nombre, $ubicacion, $habitaciones_disponibles, $tarifa_noche);

    } elseif ($form_type === 'reserva') {
        $id_reserva = $_POST['id_reserva'];
        $id_cliente = $_POST['id_cliente'];
        $fecha = $_POST['fecha'];
        $id_vuelo = $_POST['id_vuelo'];
        $id_hotel = $_POST['id_hotel'];

        $consulta = "INSERT INTO reserva (id_reserva, id_cliente, fecha, id_vuelo, id_hotel) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "iissi", $id_reserva, $id_cliente, $fecha, $id_vuelo, $id_hotel);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "Datos agregados correctamente";
    } else {
        echo "Error al ingresar los datos: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
