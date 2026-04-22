<?php

function contarDivs($url) {
    // Obtener el contenido de la página
    $html = @file_get_contents($url);
    
    if ($html === false) {
        return 0;
    }
    
    // Crear un objeto DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    
    // Contar todos los divs
    $divs = $dom->getElementsByTagName('div');
    $cantidad = $divs->length;
    
    return $cantidad;
}

// URL de la página a analizar
$urlPagina = 'revision_forms.php';
$cantidadDivs = contarDivs($urlPagina);

// Guardar en un archivo o variable de sesión
file_put_contents('cantidad_divs.txt', $cantidadDivs);

?>