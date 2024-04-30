<?php
include("conexion.php");

if(isset($_GET['id']) && isset($_GET['tipo'])){
    $id = $_GET['id'];
    $tipo = $_GET['tipo'];
    
    if($tipo === 'videos'){
        $sql_delete = "DELETE FROM `videos` WHERE `id` = $id";
    } elseif ($tipo === 'equipos') {
        // Eliminar videos relacionados con el equipo
        $sql_delete_videos = "DELETE FROM `videos` WHERE `equipo` = $id";
        $result_delete_videos = mysqli_query($con, $sql_delete_videos);
        // Eliminar videos relacionados con el equipo
         $sql_delete_palmares = "DELETE FROM `palmares` WHERE `id_equipos` = $id";
        $result_delete_palmares = mysqli_query($con, $sql_delete_palmares);
        // Luego eliminar el equipo
        $sql_delete_equipo = "DELETE FROM `equipos` WHERE `id_equipos` = $id";
        $result_delete_equipo = mysqli_query($con, $sql_delete_equipo);
        
        // Verificar si ambas consultas se ejecutaron correctamente
        if(!$result_delete_videos || !$result_delete_equipo|| !$result_delete_palmares){
            echo "ERROR!";
        } else {
            if($tipo === 'equipos') {
                header("Location: equipos.php");
            }
            exit();
        }
    }else if($tipo === "palmares"){
        $sql_delete = "DELETE FROM `palmares` WHERE `id_palmares` = $id";
    } else {
        echo "Tipo no válido";
        exit(); // Termina la ejecución del script si el tipo no es válido
    }

    $resultadodelete = mysqli_query($con, $sql_delete);
    
    if(!$resultadodelete){
        echo "ERROR!";
    }else{
        if($tipo === 'videos'){
            header("Location: index.php");
        } elseif ($tipo === 'equipos') {
            header("Location: equipos.php");
        }elseif ($tipo === 'palmares') {
            header("Location: palmares.php");
        }
        exit();
    }
}
?>
