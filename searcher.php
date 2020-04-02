<?php
//Archivo php para llamada AJAX. 
require ('C_place.php');
$ciudad = $_GET['ciudad'];
$precio =  htmlspecialchars($_GET['precio']);
$tipo = $_GET['tipo'];
$pos = strpos($precio, ';');

$min = substr($precio, 0, $pos);
$max = substr($precio, $pos+1);
$file = fopen("data-1.json", "r") or die("No se puede abrir el archivo");
$json = fread($file, filesize('data-1.json'));
$data = json_decode($json, true);
$datos = array(); 
foreach ($data as $place) {
    array_push($datos, $place);
    
}
$result = array();
if(!empty($ciudad) && !empty($tipo)){
    foreach($datos as $dato){
        if($dato['Ciudad']==$ciudad && $dato['Tipo']==$tipo){
            array_push($result, $dato);
            
        }
    }

}

$rjson = json_encode($result);
echo $rjson;

fclose($file);

?>
