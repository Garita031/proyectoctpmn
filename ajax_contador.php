<?php
header('Content-Type: application/json');

// IMPORTANTE: Cambia esta ruta según tu estructura de archivos
// Opción 1: Si está en el mismo servidor, usa ruta local
$archivoLocal = __DIR__ . '/revision_forms.php';

// Opción 2: Si necesitas la URL completa
// $url = 'http://tudominio.com/revision_forms.php';

function contarDivsLocal($archivo) {
    if (!file_exists($archivo)) {
        return ['error' => 'Archivo no encontrado', 'cantidad' => 0];
    }
    
    $html = file_get_contents($archivo);
    
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    
    // Contar SOLO los divs con clase "row"
    $xpath = new DOMXPath($dom);
    $divsRow = $xpath->query("//div[contains(@class, 'row')]");
    $cantidad = $divsRow->length;
    
    return ['cantidad' => $cantidad, 'error' => null];
}

// Si usas URL en lugar de archivo local:
function contarDivsURL($url) {
    $html = @file_get_contents($url);
    
    if ($html === false) {
        return ['error' => 'No se pudo acceder a la URL', 'cantidad' => 0];
    }
    
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $divsRow = $xpath->query("//div[contains(@class, 'row')]");
    
    return ['cantidad' => $$divsRow->length, 'error' => null];
}

// Usar el método apropiado
$resultado = contarDivsLocal($archivoLocal);
// O si usas URL: $resultado = contarDivsURL($url);

echo json_encode($resultado);
?>
