<?php
require_once __DIR__ . "/../models/bus.php";
require_once __DIR__ . "/../models/busgrande.php";
require_once __DIR__ . "/../models/busmediano.php";
require_once __DIR__ . "/../models/buspeq.php";

require_once __DIR__ . "/../view/visualizarbus.php";
require_once __DIR__ . "/../view/consultabus.php";

class controladorbus
{
    private $vista;

    /** @param visualizarbus $vista */
    public function __construct(visualizarbus $vista)
    {
        $this->vista = $vista;
    }


    public function desarrollar()
    {
        if (isset($_POST["enviar"])) {

            $campos = ["placa", "tam", "suben1", "suben2", "suben3", "suben4", "bajan2", "bajan3", "bajan4"];
            foreach ($campos as $campo) {
                if (!isset($_POST[$campo])) {
                    echo "Faltan datos del recorrido.";
                    return;
                }
            }

            $placa = trim($_POST["placa"]);
            $tam = $_POST["tam"];

            if ($placa === "") {
                echo "La placa es obligatoria.";
                return;
            }

            switch ($tam) {
                case "pequeño":
                    $bus = new buspequeño($placa);
                    break;
                case "mediano":
                    $bus = new busmediano($placa);
                    break;
                case "grande":
                    $bus = new busgrande($placa);
                    break;
                default:
                    return;
            }

            $suben = [$_POST["suben1"], $_POST["suben2"], $_POST["suben3"], $_POST["suben4"]];
            $bajan = [$_POST["bajan2"], $_POST["bajan3"], $_POST["bajan4"]];

            foreach (array_merge($suben, $bajan) as $cantidad) {
                if (filter_var($cantidad, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]) === false) {
                    echo "La cantidad de pasajeros debe ser un número entero mayor o igual a cero.";
                    return;
                }
            }

            for ($i = 0; $i < 4; $i++) {
                if ($suben[$i] <= $bus->getcapacidad() - $bus->getpasajerosactuales()) {
                    $bus->subirpasajeros((int) $suben[$i]);
                } else {
                    echo "En la parada " . ($i + 1) . ": " . $bus->errorcapacidad() . ".";
                    return;
                }

                if ($i < 3) {
                    if ($bajan[$i] <= $bus->getpasajerosactuales()) {
                        $bus->bajarpasajeros((int) $bajan[$i]);
                    } else {
                        echo "En la parada " . ($i + 2) . ": " . $bus->errorpasajeros0() . ".";
                        return;
                    }
                }
            }
            $this->vista->mostrartitulo("RESULTADO FINAL");
            $this->vista->mostrarbus($bus);
        }
    }
}
