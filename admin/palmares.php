<?php
include("conexion.php");
session_start();
if(!isset($_SESSION['registro'])){ // Debe ser 'registro', no 'usuario'
    header('Location: login.php');
    exit();
}
$mensaje = "";
$sql_equipos = "SELECT id_equipos, nombre_equipo FROM equipos ORDER BY nombre_equipo ASC";
$resultado_equipos = mysqli_query($con, $sql_equipos);

if(isset($_POST['subir'])){
    $titulo = $_POST['titulo'];
    $cantidad = $_POST['cantidad'];
    $img_titulo = $_FILES['img_titulo'];
    $selector_equipo = $_POST['select_equipo'];

    if(empty($titulo)|| empty($cantidad)|| empty($img_titulo)|| empty($selector_equipo)){
        $mensaje = "Todos los campos son obligatorios.";
    }else{
        // Procesar la imagen
        $nombre_img = $img_titulo['name'];
        $temp_img = $img_titulo['tmp_name'];
        $extension = strtolower(pathinfo($nombre_img, PATHINFO_EXTENSION));

        // Verificar si es una imagen permitida
        if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png') {
            // Mover el archivo solo si es una imagen permitida
            move_uploaded_file($temp_img, 'imagenes/' . $nombre_img);

            // Guardar la ruta de la imagen en la base de datos
            $ruta_img = 'imagenes/' . $nombre_img;

            $sql_palmares = "INSERT INTO palmares (titulo, cantidad, img_titulo, id_equipos) VALUES ('$titulo', '$cantidad','$ruta_img','$selector_equipo')";
            $guardar = mysqli_query($con, $sql_palmares);

            if($guardar){
                // Redireccionar o mostrar un mensaje de éxito
                header("Location: palmares.php");
                exit();
            } else {
                $mensaje = "Error al guardar en la base de datos.";
            }
        } else {
            $mensaje = "ERROR! Solo se permiten archivos JPG o PNG.";
        }
        }
}
?>

<?php
include("cabecera.php");
include("lateral.php");
?>
<div class="container mt-5">

<form action="palmares.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Título">
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" id="cantidad" placeholder="Cantidad">
        </div>
        <div class="mb-3">
            <label for="img_titulo" class="form-label">Imagen del Título</label>
            <input type="file" name="img_titulo" class="form-control" id="img_titulo">
        </div>
        <div class="mb-3">
            <label for="select_equipo" class="form-label">Seleccionar Equipo</label>
            <select name="select_equipo" class="form-select" id="select_equipo">
                <option value=""></option>
                <?php
                    while ($rowequipo = mysqli_fetch_assoc($resultado_equipos)) {
                        $select = (isset($_POST['select_equipo']) && $_POST['select_equipo'] == $rowequipo['id_equipos']) ? 'selected' : '';
                        echo "<option value='" . $rowequipo['id_equipos'] . "' $select>" . $rowequipo['nombre_equipo'] . "</option>";
                    }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="subir">Subir</button>
        <?php echo $mensaje?>
    </form>
<table class="table table-striped mt-3">
    <thead>
        <th>#</th>
        <th>Titulo</th>
        <th>Cantidad</th>
        <th>Equipo</th>
        <th>Imagen</th>
    </thead>
    <tbody>
        <?php
       $sqltabla = "SELECT p.*, e.nombre_equipo  FROM palmares p 
       JOIN equipos e ON p.id_equipos = e.id_equipos";

        $resultadotabla = mysqli_query($con, $sqltabla);
        while($row = mysqli_fetch_array($resultadotabla)){         ?>
        <tr>
            <td><?php echo $row['id_palmares']?></td>
            <td><?php echo $row['titulo']?></td>
            <td><?php echo $row['cantidad']?></td>
            <td><?php echo $row['nombre_equipo']?></td>
            <td>
            <img width="150" src="<?php echo $row['img_titulo']; ?>" alt="Titulos">
            </td>
            <td>
            <a href="delete.php?id=<?php echo $row['id_palmares']?>&tipo=palmares"class="btn btn-danger">Eliminar</a>
            <a href="edit_palmares.php?id_palmares=<?php echo $row['id_palmares']?>"class="btn btn-primary">Editar</a>
    
        </td>
        </tr>
       <?php } ?>        

    </tbody>
</table>
</div>
</body>
</html>