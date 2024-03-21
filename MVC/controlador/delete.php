<?php
include_once '../modelo/conexion.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    //mensaje
}

$sql = "DELETE FROM StarVisory WHERE id = $id";

if($conexion->query($sql) === TRUE){
    echo "Registro eliminado correctamente";
} else {
    echo "Error al eliminar registro: ". $conexion->error;
}

$conexion->close();

?>