<?php
include('conexion.php');
session_start();
if(!isset($_SESSION['registro'])){ 
    header('Location: login.php');
    exit();
}
$mensaje = "";

if(isset($_GET['id_equipos'])){
    $id = $_GET['id_equipos'];
    $sql_edit = "SELECT * FROM `equipos` WHERE `id_equipos` = $id";
    $resultado_edit = mysqli_query($con, $sql_edit);
    if(mysqli_num_rows($resultado_edit) == 1){
        $row = mysqli_fetch_array($resultado_edit);
        $nombre_equipo = $row['nombre_equipo'];
        $descripcion = $row['descripcion'];
        $ruta_img = $row['img_equipos']; // Obtener la ruta de la imagen actual del equipo
    }
}

if(isset($_POST['guardar_cambios'])){
    $id = $_GET['id_equipos'];
    $nombre_equipo = $_POST['nombre_equipo'];
    $descripcion = $_POST['descripcion_equipo'];
    $img_equipo = $_FILES['img_equipo'];

    if(empty($nombre_equipo) || empty($descripcion)){
        $mensaje = "El nombre y la descripción del equipo son obligatorios.";
    } else {
        if(!empty($img_equipo['name'])){
            // Si se cargó una nueva imagen, procesarla
            $nombre_img = $img_equipo['name'];
            $temp_img = $img_equipo['tmp_name'];
            $extension = strtolower(pathinfo($nombre_img, PATHINFO_EXTENSION));

            if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png') {
                move_uploaded_file($temp_img, 'imagenes/' . $nombre_img);
                $ruta_img = 'imagenes/' . $nombre_img;
            } else {
                $mensaje = "ERROR! Solo se permiten archivos JPG o PNG.";
            }
        }

        // Actualizar los datos del equipo en la base de datos
        $sql_edit = "UPDATE `equipos` SET nombre_equipo = '$nombre_equipo',
        descripcion = '$descripcion',
        img_equipos = '$ruta_img'
        WHERE id_equipos = '$id'
        ";
        $guardar = mysqli_query($con, $sql_edit);

        if($guardar){
            // Redireccionar o mostrar un mensaje de éxito
            header("Location: equipos.php");
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
<form action="edit_equipo.php?id_equipos=<?php echo $_GET['id_equipos']?>" method="post" enctype="multipart/form-data">
    <input type="text" name="nombre_equipo" placeholder="Nombre de equipo" value="<?php echo $nombre_equipo?>">
    <input type="text" name="descripcion_equipo" placeholder="Descripción" value="<?php echo $descripcion?>">
    <input type="file" name="img_equipo"> <!-- Eliminar el value del input de imagen -->
    <img width="320" height="180" src="<?php echo $ruta_img; ?>" alt="Imagen del equipo"> <!-- Mostrar la imagen actual -->
    <input type="submit" value="Guardar Cambios" name="guardar_cambios">
    <?php echo $mensaje ?> 
</form>
