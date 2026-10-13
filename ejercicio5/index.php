<?php
require_once __DIR__ . "/models/persona.php";
require_once __DIR__ . "/models/estudiante.php";
require_once __DIR__ . "/models/docente.php";
require_once __DIR__ . "/models/administrativo.php";
require_once __DIR__ . "/models/curso.php";
require_once __DIR__ . "/view/academiaVista.php";
require_once __DIR__ . "/controller/controlAcademia.php";


$personasGuardadas = json_decode($_POST['personasGuardadas'] ?? '[]', true);
if (is_array($personasGuardadas)) {
    foreach ($personasGuardadas as $persona) {
        $_POST['nombre'][] = $persona['nombre'];
        $_POST['documento'][] = $persona['documento'];
        $_POST['correo'][] = $persona['correo'];
        $_POST['tipo'][] = $persona['tipo'];
    }
}

$vista = new AcademiaVista();
$controller = new academiaControl($vista);

$personasGuardadas = [];
foreach ($controller->getPersonas() as $persona) {
    $personasGuardadas[] = [
        'nombre' => $persona->getNombre(),
        'documento' => $persona->getDocumento(),
        'correo' => $persona->getCorreo(),
        'tipo' => strtolower(get_class($persona))
    ];
}
$personasJson = htmlspecialchars(json_encode($personasGuardadas), ENT_QUOTES, 'UTF-8');

// Mostrar formulario para agregar una persona a la vez
$vista->formularioPersonas(1, $personasJson);

// Mostrar resultados
$controller->mostrarResultados();
