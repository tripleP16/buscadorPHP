<?php
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
$places = array();
foreach ($data as $place) {
    $precio = $place['Precio'];
    $precio = substr($precio, strpos($precio,'$')+1);
    $aux = strpos($precio,',');
    $precio = substr($precio,0,$aux).substr($precio,$aux+1);
    if($precio>=$min && $precio<=$max){
        array_push($datos, $place);
    }
    
}

$result = array();
if(!empty($ciudad) && !empty($tipo)){
    foreach($datos as $dato){
        if($dato['Ciudad']==$ciudad && $dato['Tipo']==$tipo){
            array_push($result, $dato);
            
        }
    }

}elseif(!empty($ciudad)){
    foreach($datos as $dato){
        if($dato['Ciudad']==$ciudad){
            array_push($result, $dato);
            
        }
    }
}elseif(!empty($tipo)){
    foreach($datos as $dato){
        if($dato['Tipo']==$tipo){
            array_push($result, $dato);
            
        }
    }
}else{
    $result = $datos;
}

$rjson = json_encode($result);
echo $rjson;

fclose($file);

?>
