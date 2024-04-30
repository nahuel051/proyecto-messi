<?php
include('conexion.php');
session_start();
if(!isset($_SESSION['registro'])){ 
    header('Location: login.php');
    exit();
}
$mensaje = "";
$sql_equipos = "SELECT id_equipos, nombre_equipo FROM equipos ORDER BY nombre_equipo ASC";
$resultado_equipos = mysqli_query($con, $sql_equipos);


if(isset($_GET['id_palmares'])){
    $id = $_GET['id_palmares'];
    $sql_edit = "SELECT * FROM `palmares` WHERE `id_palmares` = $id";
    $resultado_edit = mysqli_query($con, $sql_edit);
    if(mysqli_num_rows($resultado_edit) == 1){
        $row = mysqli_fetch_array($resultado_edit);
        $titulo = $row['titulo'];
        $cantidad = $row['cantidad'];
        $ruta_img = $row['img_titulo']; // Obtener la ruta de la imagen del palmarés
        $selector_equipo = $row['id_equipos'];
    }
    
    
}

if(isset($_POST['guardar_cambios'])){
    $id = $_GET['id_palmares'];
    $titulo = $_POST['titulo'];
    $cantidad = $_POST['cantidad'];
    $img_titulo = $_FILES['img_titulo'];
    $selector_equipo = $_POST['select_equipo'];

    if(empty($titulo)|| empty($cantidad)|| empty($img_titulo)|| empty($selector_equipo)){
        $mensaje = "Todos los campos son obligatorios.";
    } else {
        if(!empty($img_titulo['name'])){
            // Si se cargó una nueva imagen, procesarla
            $nombre_img = $img_titulo['name'];
            $temp_img = $img_titulo['tmp_name'];
            $extension = strtolower(pathinfo($nombre_img, PATHINFO_EXTENSION));

            if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png') {
                move_uploaded_file($temp_img, 'imagenes/' . $nombre_img);
                $ruta_img = 'imagenes/' . $nombre_img;
            } else {
                $mensaje = "ERROR! Solo se permiten archivos JPG o PNG.";
            }
        }

        // Actualizar los datos del equipo en la base de datos
        $sql_edit = "UPDATE `palmares` SET titulo = '$titulo',
        cantidad = '$cantidad',
        img_titulo = '$ruta_img',
        id_equipos = '$selector_equipo'
        WHERE id_palmares = '$id'
        ";
        $guardar = mysqli_query($con, $sql_edit);

        if($guardar){
            // Redireccionar o mostrar un mensaje de éxito
            header("Location: palmares.php");
            exit();
        } else {
            $mensaje = "Error al guardar en la base de datos.";
        }
    }
}
?>

<?php include("cabecera.php")?>
<?php include("lateral.php")?>

<h2>Editar Palmares</h2>
<form action="edit_palmares.php?id_palmares=<?php echo $_GET['id_palmares']?>" method="post" enctype="multipart/form-data">
    <input type="text" name="titulo" placeholder="Titulo" value="<?php echo $titulo?>">
    <input type="number" name="cantidad" placeholder="Cantidad" value="<?php echo $cantidad?>">
    <input type="file" name="img_titulo">
    <img width="150" src="<?php echo $ruta_img; ?>" alt="Imagen Titulo">
    <select name="select_equipo">
            <option value=""></option>
        <?php
            while ($rowequipo = mysqli_fetch_assoc($resultado_equipos)) {
                $select = ($selector_equipo == $rowequipo['id_equipos']) ? 'selected' : '';
                echo "<option value='" . $rowequipo['id_equipos'] . "' $select>" . $rowequipo['nombre_equipo'] . "</option>";
            }
        ?>
        </select>
        <input type="submit" value="Guardar Cambios" name="guardar_cambios">

    <?php echo $mensaje ?> 
</form>
