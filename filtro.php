
<?php
//TAREA 3 Y 4
class FiltroViaje {
    public $nombreHotel;
    public $ciudad;
    public $pais;
    public $fechaViaje;
    public $duracionViaje;

    public function __construct($nombreHotel, $ciudad, $pais, $fechaViaje, $duracionViaje) {
        $this->nombreHotel = $nombreHotel;
        $this->ciudad = $ciudad;
        $this->pais = $pais;
        $this->fechaViaje = $fechaViaje;
        $this->duracionViaje = $duracionViaje;
    }

    public function buscar($ciudad = null, $fecha = null) {
        if ($ciudad && $fecha) {
            return $this->ciudad == $ciudad && $this->fechaViaje == $fecha;
        } elseif ($ciudad) {
            return $this->ciudad == $ciudad;
        } elseif ($fecha) {
            return $this->fechaViaje == $fecha;
        } else {
            return true;
        }
    }
}

//Ejemplos de algunos datos porque no sé cómo podría hacer que el cliente ingrese los datos que busca.
$filtros = [
    new FiltroViaje('Hotel ABC', 'Barcelona', 'España', '2024-08-15', '7 días'),
    new FiltroViaje('Hotel XYZ', 'Nueva York', 'EEUU', '2024-09-10', '5 días'),
    new FiltroViaje('Hotel DEF', 'Tokyo', 'Japón', '2024-10-05', '10 días')
];

$ciudadBuscada = isset($_GET['ciudad']) ? $_GET['ciudad'] : null;
$fechaBuscada = isset($_GET['fecha']) ? $_GET['fecha'] : null;

$resultados = array_filter($filtros, function($filtro) use ($ciudadBuscada, $fechaBuscada) {
    return $filtro->buscar($ciudadBuscada, $fechaBuscada);
});

echo json_encode($resultados);

    public function registrar() {
        
            echo "El viaje a {$this->ciudad}, {$this->pais}, hospedado en {$this->nombreHotel}, ha sido registrado con éxito para la fecha {$this->fechaViaje} por {$this->duracionViaje} días.";
        }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombreHotel = $_POST['nombreHotel'];
        $ciudad = $_POST['ciudad'];
        $pais = $_POST['pais'];
        $fechaViaje = $_POST['fechaViaje'];
        $duracionViaje = $_POST['duracionViaje'];

        $viaje = new FiltroViaje($nombreHotel, $ciudad, $pais, $fechaViaje, $duracionViaje);
        $viaje->registrar();
    }
?>

