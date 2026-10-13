<?php
require_once __DIR__ . "/controller/controladorcita.php";
require_once __DIR__ . "/view/consultausuario.php";
require_once __DIR__ . "/view/visualizarcita.php";




if (!isset($_POST["numero"], $_POST["tipo"], $_POST["tarifa"])) {

    $formulario = new consultausuario();
    $formulario->mostrar();

} else {

    $vista = new visualizarcita();
    $controlador = new controladorcita($vista);
    $controlador->demostrar();

}
