<?php

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombreHotel = htmlspecialchars($_POST['nombreHotel']);
    $ciudad = htmlspecialchars($_POST['ciudad']);
    $pais = htmlspecialchars($_POST['pais']);
    $fechaViaje = $_POST['fechaViaje']; 
    $duracionViaje = (int)$_POST['duracionViaje']; 

    
    $_SESSION['viaje'] = [
        'nombreHotel' => $nombreHotel,
        'ciudad' => $ciudad,
        'pais' => $pais,
        'fechaViaje' => $fechaViaje,
        'duracionViaje' => $duracionViaje
    ];

    
    header('Location: viaje.php');
    exit();
} else {
   
    echo "Hubo un error al procesar el formulario.";
}

