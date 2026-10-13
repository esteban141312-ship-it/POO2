<?php
require_once __DIR__ . "/models/pelicula.php";
require_once __DIR__ . "/models/catalogo.php";
require_once __DIR__ .  "/view/vistapeli.php";
require_once __DIR__ . "/controller/controlcatalogo.php";



$catalogo = new Catalogo();
$peliculasGuardadas = json_decode($_POST['peliculasGuardadas'] ?? '[]', true);
if (is_array($peliculasGuardadas)) {
    foreach ($peliculasGuardadas as $pelicula) {
        $catalogo->agregarPelicula(new Pelicula($pelicula['titulo'], $pelicula['genero'], $pelicula['duracion'], $pelicula['clasificacion'], $pelicula['calificacion']));
    }
}
$vista = new PeliculaVista();
$controller = new CatalogoController($catalogo, $vista);

$peliculasGuardadas = [];
foreach ($catalogo->getPeliculas() as $pelicula) {
    $peliculasGuardadas[] = ['titulo' => $pelicula->getTitulo(), 'genero' => $pelicula->getGenero(), 'duracion' => $pelicula->getDuracionMinutos(), 'clasificacion' => $pelicula->getClasificacion(), 'calificacion' => $pelicula->getCalificacionUsuarios()];
}
$peliculasJson = htmlspecialchars(json_encode($peliculasGuardadas), ENT_QUOTES, 'UTF-8');

// Mostrar formulario con 3 películas
$vista->formularioPeliculas(1, $peliculasJson);

// Mostrar resultados
$controller->mostrarResultados();
