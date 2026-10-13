<?php

require_once __DIR__ . "/view/consultabus.php";
require_once __DIR__ . "/view/consultaparadas.php";
require_once __DIR__ . "/view/visualizarbus.php";
require_once __DIR__ . "/controller/controladorbus.php";





if (!isset($_POST["placa"], $_POST["tam"])) {

    $consulta = new consultabus();
    $consulta->consultar();
} elseif (!isset($_POST["enviar"])) {

    $consulta = new consultaparadas();
    $consulta->mostrar($_POST["placa"], $_POST["tam"]);

} else {

    $vista = new visualizarbus();

    $controlador = new controladorbus($vista);
    $controlador->desarrollar();
}
