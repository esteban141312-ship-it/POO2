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

            $placa = $_POST["placa"];
            $tam = $_POST["tam"];

            switch ($tam) {

                case "pequeno":
                    $bus = new buspequeño($placa);
                    break;

                case "mediano":
                    $bus = new busmediano($placa);
                    break;

                case "grande":
                    $bus = new busgrande($placa);
                    break;
            }


            if ($_POST["suben1"] & $_POST["suben2"] & $_POST["suben3"] & $_POST["suben4"] <= $bus->getcapacidad()) {
                $bus->subirpasajeros($pasajeros = $_POST["suben1"]);
                $bus->subirpasajeros($pasajeros = $_POST["suben2"]);
                $bus->subirpasajeros($pasajeros = $_POST["suben3"]);
                $bus->subirpasajeros($pasajeros = $_POST["suben4"]);
            } else {
                echo "{$bus->errorcapacidad()}";
            }


            if ($_POST["bajan2"] & $_POST["bajan3"] & $_POST["bajan4"] <= $bus->getpasajerosactuales()) {
                $bus->bajarpasajeros($pasajeros = $_POST["bajan2"]);


                $bus->bajarpasajeros($pasajeros = $_POST["bajan3"]);


                $bus->bajarpasajeros($pasajeros = $_POST["bajan4"]);
            } else {
                echo "{$bus->errorpasajeros0()}";
            }






            $this->vista->mostrartitulo("RESULTADO FINAL");
            $this->vista->mostrarbus($bus);
        }
    }
}
