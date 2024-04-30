<?php
include("conexion.php");
session_start();
if(!isset($_SESSION['registro'])){
    header('Location: login.php');
    exit();
}
$mensaje = "";
// Obtener rquipos para el select
$sql_equipos = "SELECT id_equipos, nombre_equipo FROM equipos ORDER BY nombre_equipo ASC";
$resultadosequipos = mysqli_query($con, $sql_equipos);

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql_edit = "SELECT * FROM `videos` WHERE `id` = $id";
    $resultado_edit = mysqli_query($con, $sql_edit);
    if(mysqli_num_rows($resultado_edit) == 1){
        $row = mysqli_fetch_array($resultado_edit);
        $titulo_video = $row['titulo'];
        $equipo_rival = $row['equipo_rival'];
        $url_video = $row['url_video'];
        $equipo = $row['equipo'];

    }
}

if(isset($_POST['guardar_cambios'])){
    $id = $_GET['id'];
    $titulo_video = $_POST['titulo_video'];
    $equipo_rival = $_POST['equipo_rival'];
    $url_video = $_POST['url_video'];
    $equipo = $_POST['equipo'];

    if(empty($titulo_video) || empty($equipo_rival) || empty($url_video)|| empty($equipo)){
        $mensaje = "Todos los campos son obligatorios.";
    } else { // Quita el elseif, ya que no necesitas verificar $mensaje aquí
        $sql_edit = "UPDATE `videos` SET titulo = '$titulo_video', equipo_rival = '$equipo_rival', url_video = '$url_video', equipo = '$equipo' WHERE id = '$id'";
        $guardar_edit = mysqli_query($con, $sql_edit);
        if($guardar_edit){
            header("Location: index.php");
            exit();
        }else{
            $mensaje = "ERROR!".mysqli_error($con);
        }
    }
}
?>


<?php include("cabecera.php") ?>
<?php include("lateral.php")?>
<h2>Editar video</h2>
<form action="edit_video.php?id=<?php echo $_GET['id']?>" method="POST">
<input type="text" name="titulo_video" placeholder="Titulo de video" value="<?php echo $titulo_video?>">
<input type="text" name="equipo_rival" placeholder="Equipo Rival" value="<?php echo $equipo_rival?>">
<input type="url" name="url_video" placeholder="URL video" value="<?php echo $url_video?>">

<select name="equipo">
            <option value="">Equipos</option>
            <?php
            while ($row = mysqli_fetch_assoc($resultadosequipos)) {
                $select = ($equipo == $row['id_equipos']) ? 'selected' : '';
                echo "<option value='" . $row['id_equipos'] . "' $select>" . $row['nombre_equipo'] . "</option>";
            }
            ?>
</select>

<input type="submit" name="guardar_cambios" value="Guardar Cambios">
<?php echo $mensaje?>
</form>