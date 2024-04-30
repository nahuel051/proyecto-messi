<?php
include('conexion.php');
session_start();
if(!isset($_SESSION['registro'])){ 
    header('Location: login.php');
    exit();
}
$mensaje = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql_edit = "SELECT * FROM `estadisticas` WHERE `id` = $id";
    $resultado_edit = mysqli_query($con, $sql_edit);
    if(mysqli_num_rows($resultado_edit) == 1){
        $row = mysqli_fetch_array($resultado_edit);
            $partidos = $row['partidos'];
            $goles = $row['goles'];
            $asistencias = $row['asistencias'];
    }
}

if(isset($_POST['guardar_cambios'])){
    $id = $_GET['id'];
    $partidos = $_POST['partidos'];
    $goles = $_POST['goles'];
    $asistencias = $_POST['asistencias'];

    if(empty($partidos) || empty($goles)|| empty($asistencias)){
        $mensaje = "Todos los campos son obligatorios.";
    } else {

        // Actualizar los datos del equipo en la base de datos
        $sql_edit = "UPDATE `estadisticas` SET partidos = '$partidos',
        goles = '$goles',
        asistencias = '$asistencias',
        fecha = NOW()
        WHERE id = '$id'
        ";
        $guardar = mysqli_query($con, $sql_edit);

        if($guardar){
            header("Location: estadisticas.php");
            exit();
        } else {
            $mensaje = "Error al guardar en la base de datos.";
        }
    }
}
?>

<?php include("cabecera.php")?>
<?php include("lateral.php")?>

<h2>Editar Equipo</h2>

<form action="edit_estadisticas.php?id=<?php echo $_GET['id']?>" method="POST">
<input type="number" name="partidos" placeholder="Cantidad de Partidos" value="<?php echo $partidos?>">
<input type="number" name="goles" placeholder="Cantidad de Goles" value="<?php echo $goles?>">
<input type="number" name="asistencias" placeholder="Cantidad de Asistencias" value="<?php echo $asistencias?>">
<input type="submit" value="Guardar" name="guardar_cambios">
<?php echo $mensaje ?> 
</form>
