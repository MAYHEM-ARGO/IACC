<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conectar a la base de datos
    $servername = "localhost";
    $db_username = "root";
    $db_password = "Jhonatan1993";
    $dbname = "agencia_viaje";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Preparar y ejecutar la consulta
    $sql = "SELECT * FROM usuarios WHERE NOMBRE_USUARIO = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener el resultado
        $user = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $user['CONTRASENA'])) {
            $_SESSION['username'] = $username;
            header("Location: productos.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
    $conn->close();
}
