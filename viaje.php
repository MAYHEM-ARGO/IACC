<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viaje_1.css">
    <title>Agencia de Viajes</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="search-container">
        <input type="text" id="destination" placeholder="Destino">
        <input type="date" id="travel-date">
        <button onclick="search()">Buscar</button>
    </div>

    <?php if (!isset($_SESSION['username'])): ?>
    <div>
        <h1> Bienvenido!!
        </h1>
    </div>
    <div id="login-container">
        <h2>Iniciar sesión</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
    <?php else: ?>
    <div>
        <h1> <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <a href="logout.php">Cerrar sesión</a>
    </div>
    <?php endif; ?>

    <div id="results-container">
        <h2>Lista de Productos</h2>
        <?php include 'productos.php'; ?>
    </div>

    <div id="carrito-container">
        <?php include 'productos.php'; ?>
        <?php include 'carrito.php'; ?>
    </div>

    <div>
        <h1>Registrar Intención de Viaje</h1>
        <form action="registrar_viaje.php" method="post">
            <div class="form-group">
                <label for="nombreHotel">Nombre del Hotel:</label>
                <input type="text" id="nombreHotel" name="nombreHotel" required>
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" name="ciudad" required>
            </div>
            <div class="form-group">
                <label for="pais">País:</label>
                <input type="text" id="pais" name="pais" required>
            </div>
            <div class="form-group">
                <label for="fechaViaje">Fecha de Viaje:</label>
                <input type="date" id="fechaViaje" name="fechaViaje" required>
            </div>
            <div class="form-group">
                <label for="duracionViaje">Duración del Viaje (días):</label>
                <input type="number" id="duracionViaje" name="duracionViaje" required>
            </div>
            <button type="submit">Registrar Viaje</button>
        </form>
    </div>
    <script>
//Respuesta 1
        document.addEventListener('DOMContentLoaded', function() {
            fetch('notificacion.php')
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        title: 'Mensaje de Bienvenida',
                        text: data.mensaje,
                        icon: 'info',
                        confirmButtonText: 'Aceptar'
                    });
                })
                .catch(error => console.error('Error:', error));
        });
//Respuesta 2
        function search() {
            const destination = document.getElementById('destination').value;
            const travelDate = document.getElementById('travel-date').value;
            fetch(`filtros_viajes.php?ciudad=${destination}&fecha=${travelDate}`)
                .then(response => response.json())
                .then(data => {
                    const resultsContainer = document.getElementById('results-container');
                    resultsContainer.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'result-item';
                            div.innerHTML = `
                                <h3>Nombre del Hotel: ${item.nombreHotel}</h3>
                                <p>Ciudad: ${item.ciudad}</p>
                                <p>País: ${item.pais}</p>
                                <p>Fecha de Viaje: ${item.fechaViaje}</p>
                                <p>Duración: ${item.duracionViaje}</p>
                            `;
                            resultsContainer.appendChild(div);
                        });
                    } else {
                        resultsContainer.innerHTML = '<p>No se encontraron resultados.</p>';
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <script src="viaje_3.js"></script>
    <script>
        
        function validarVuelo(form) {
            const idVuelo = form.id_vuelo.value.trim();
            const origen = form.origen.value.trim();
            const destino = form.destino.value.trim();
            const fecha = form.fecha.value.trim();
            const plazasDisponibles = form.plazas_disponibles.value.trim();
            const precio = form.precio.value.trim();
            
            if (!idVuelo || !origen || !destino || !fecha || !plazasDisponibles || !precio) {
                alert("Todos los campos son obligatorios.");
                return false;
            }

           
            if (!/^\d{4}-\d{2}-\d{2}$/.test(fecha)) {
                alert("Fecha inválida.");
                return false;
            }

         
            if (isNaN(plazasDisponibles) || isNaN(precio)) {
                alert("Plazas disponibles y precio deben ser números.");
                return false;
            }

            return true;
        }

        
        function validarHotel(form) {
            const idHotel = form.id_hotel.value.trim();
            const nombre = form.nombre.value.trim();
            const ubicacion = form.ubicacion.value.trim();
            const habitacionesDisponibles = form.habitaciones_disponibles.value.trim();
            const tarifaNoche = form.tarifa_noche.value.trim();

            if (!idHotel || !nombre || !ubicacion || !habitacionesDisponibles || !tarifaNoche) {
                alert("Todos los campos son obligatorios.");
                return false;
            }

           
            if (isNaN(habitacionesDisponibles) || isNaN(tarifaNoche)) {
                alert("Habitaciones disponibles y tarifa noche deben ser números.");
                return false;
            }

            return true;
        }

        
        function validarReserva(form) {
            const idReserva = form.id_reserva.value.trim();
            const idCliente = form.id_cliente.value.trim();
            const fecha = form.fecha.value.trim();
            const idVuelo = form.id_vuelo.value.trim();
            const idHotel = form.id_hotel.value.trim();

            if (!idReserva || !idCliente || !fecha || !idVuelo || !idHotel) {
                alert("Todos los campos son obligatorios.");
                return false;
            }

            
            if (!/^\d{4}-\d{2}-\d{2}$/.test(fecha)) {
                alert("Fecha inválida.");
                return false;
            }

            return true;
        }
    </script>

    <div id="Formulario Vuelo">
        <form action="registrar_vuelo.php" method="post">
            <h1>Vuelo</h1>
            
            <input type="hidden" name="form_type" value="vuelo">
            <label for="id_vuelo">Id_vuelo</label>
            <input type="text" id="id_vuelo" placeholder="Escribe el ID del vuelo" name="id_vuelo" required>
            <br>
            <label for="origen">Origen</label>
            <input type="text" id="origen" placeholder="Ingrese el origen del vuelo" name="origen" required>
            <br>
            <label for="destino">Destino</label>
            <input type="text" id="destino" placeholder="Ingrese el destino del vuelo" name="destino" required>
            <br>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" required>
            <br>
            <label for="plazas_disponibles">Plaza_Disponible</label>
            <input type="text" id="plazas_disponibles" placeholder="Indique la plaza disponible" name="plazas_disponibles" required>
            <br>
            <label for="precio">Precio</label>
            <input type="text" id="precio" placeholder="Indique el precio del vuelo" name="precio" required>
            <br>
            <input type="submit" value="Registrar">
        </form>

<div id="Formulario Hotel">
    <form action="registrar_hotel.php" method="post">
            <h1>Hotel</h1>
            
            <input type="hidden" name="form_type" value="hotel">
            <label for="id_hotel">Id_Hotel</label>
            <input type="text" id="id_hotel" placeholder="Escribe el ID del hotel" name="id_hotel" required>
            <br>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" placeholder="Ingrese el nombre del hotel" name="nombre" required>
            <br>
            <label for="ubicacion">Ubicacion</label>
            <input type="text" id="ubicacion" placeholder="Ingrese la ubicación del hotel" name="ubicacion" required>
            <br>
            <label for="habitaciones_disponibles">Habitaciones_Disponibles</label>
            <input type="text" id="habitaciones_disponibles" placeholder="Habitaciones disponibles" name="habitaciones_disponibles" required>
            <br>
            <label for="tarifa_noche">Tarifa Noche</label>
            <input type="text" id="tarifa_noche" placeholder="Indique la tarifa noche" name="tarifa_noche" required>
            <br>
            <input type="submit" value="Registrar">
    </form>
</div>

<div id="Formulario Reserva">
        <form action="reserva.php" method="post">
            <h1>Reserva</h1>
            
            <input type="hidden" name="form_type" value="reserva">
            <label for="id_reserva">Id_Reserva</label>
            <input type="text" id="id_reserva" placeholder="Escribe el ID de Reserva" name="id_reserva" required>
            <br>
            <label for="id_cliente">Id_Cliente</label>
            <input type="text" id="id_cliente" placeholder="Ingrese el Id del cliente" name="id_cliente" required>
            <br>
            <label for="fecha">Fecha Reserva</label>
            <input type="date" id="fecha" name="fecha" required>
            <br>
            <label for="id_vuelo">Id_Vuelo</label>
            <input type="text" id="id_vuelo" placeholder="Ingrese el ID del vuelo" name="id_vuelo" required>
            <br>
            <label for="id_hotel">Id_Hotel</label>
            <input type="text" id="id_hotel" placeholder="Ingrese el ID del hotel" name="id_hotel" required>
            <br>
            <input type="submit" value="Registrar">
        </form>
    </div>

    <?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "agencia");

// Verificar conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Consulta para mostrar el contenido de la tabla RESERVA
$consulta = "SELECT * FROM reserva";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
    echo "<h1>Contenido de la tabla RESERVA</h1>";
    echo "<table border='1'><tr><th>Id_Reserva</th><th>Id_Cliente</th><th>Fecha</th><th>Id_Vuelo</th><th>Id_Hotel</th></tr>";
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
                <td>{$fila['id_reserva']}</td>
                <td>{$fila['id_cliente']}</td>
                <td>{$fila['fecha']}</td>
                <td>{$fila['id_vuelo']}</td>
                <td>{$fila['id_hotel']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>


<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "agencia");

// Verificar conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Consulta para obtener el número de reservas por hotel y mostrar los hoteles con más de dos reservas
$consulta = "
    SELECT h.id_hotel, h.nombre, COUNT(r.id_reserva) AS num_reservas
    FROM hotel h
    LEFT JOIN reserva r ON h.id_hotel = r.id_hotel
    GROUP BY h.id_hotel
    HAVING COUNT(r.id_reserva) > 2
";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
    echo "<h1>Hoteles con más de dos reservas</h1>";
    echo "<table border='1'><tr><th>Id_Hotel</th><th>Nombre</th><th>Número de Reservas</th></tr>";
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
                <td>{$fila['id_hotel']}</td>
                <td>{$fila['nombre']}</td>
                <td>{$fila['num_reservas']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>



    </form>

</body>
</html>


