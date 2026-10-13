<?php
require_once __DIR__ . "/models/banco.php";
require_once __DIR__ . "/models/cliente.php";
require_once __DIR__ . "/models/empresa.php";
require_once __DIR__ . "/models/persona.php";
require_once __DIR__ . "/view/formbanco.php";
require_once __DIR__ . "/controller/controladorbanco.php";

// Crear banco, vista y controlador
$banco = new banco("Banco J");   // minúscula porque tu clase está definida así
$clientesGuardados = json_decode($_POST['clientesGuardados'] ?? '[]', true);
if (is_array($clientesGuardados)) {
    foreach ($clientesGuardados as $cliente) {
        if (($cliente['tipo'] ?? '') === 'persona') {
            $banco->addCliente(new persona($cliente['identificacion'], $cliente['nombre'], $cliente['edad']));
        } elseif (($cliente['tipo'] ?? '') === 'empresa') {
            $banco->addCliente(new empresa($cliente['identificacion'], $cliente['nombre'], $cliente['representante']));
        }
    }
}
$vista = new BancoVista();
$controller = new BancoController($banco, $vista);

$clientesGuardados = [];
foreach ($banco->getClientes() as $cliente) {
    if ($cliente instanceof persona) {
        $clientesGuardados[] = ['tipo' => 'persona', 'identificacion' => $cliente->getIdentificacion(), 'nombre' => $cliente->getNombre(), 'edad' => $cliente->getEdad()];
    } else {
        $clientesGuardados[] = ['tipo' => 'empresa', 'identificacion' => $cliente->getIdentificacion(), 'nombre' => $cliente->getNombre(), 'representante' => $cliente->getRepresentante()];
    }
}
$clientesJson = htmlspecialchars(json_encode($clientesGuardados), ENT_QUOTES, 'UTF-8');

// Mostrar formularios
$vista->formularioPersona($clientesJson);
$vista->formularioEmpresa($clientesJson);

// Mostrar resultados
$controller->mostrarClientes();
$controller->mostrarPersonas();
$controller->mostrarEmpresas();
$controller->mostrarMenoresEdad();
$controller->mostrarMasJoven();
$controller->mostrarMasViejo();
