<?php
include('conexion.php');
session_start();
if(!isset($_SESSION['registro'])){ // Debe ser 'registro', no 'usuario'
    header('Location: login.php');
    exit();
}

$mensaje = "";

if(isset($_POST['subir_equipo'])){
    $nombre_equipo = $_POST['nombre_equipo'];
    $descripcion = $_POST['descripcion_equipo'];
    $img_equipo = $_FILES['img_equipo'];

    if(empty($nombre_equipo) || empty($descripcion) || empty($img_equipo['name'])){
        $mensaje = "Todos los campos son obligatorios.";
    } else {
        // Procesar la imagen
        $nombre_img = $img_equipo['name'];
        $temp_img = $img_equipo['tmp_name'];
        $extension = strtolower(pathinfo($nombre_img, PATHINFO_EXTENSION));

        // Verificar si es una imagen permitida
        if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png') {
            // Mover el archivo solo si es una imagen permitida
            move_uploaded_file($temp_img, 'imagenes/' . $nombre_img);

            // Guardar la ruta de la imagen en la base de datos
            $ruta_img = 'imagenes/' . $nombre_img;

            // Insertar datos del equipo en la base de datos
            $sqlequipos = "INSERT INTO equipos VALUES(null, '$nombre_equipo', '$descripcion', '$ruta_img')";
            $guardar = mysqli_query($con, $sqlequipos);

            if($guardar){
                // Redireccionar o mostrar un mensaje de éxito
                header("Location: equipos.php");
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

<?php include("cabecera.php")?>
<?php include("lateral.php")?>
<div class="container mt-5">
<form action="equipos.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nombre_equipo" class="form-label">Nombre de equipo</label>
        <input type="text" name="nombre_equipo" class="form-control" id="nombre_equipo" placeholder="Nombre de equipo">
    </div>
    <div class="mb-3">
        <label for="descripcion_equipo" class="form-label">Descripción</label>
        <input type="text" name="descripcion_equipo" class="form-control" id="descripcion_equipo" placeholder="Descripción">
    </div>
    <div class="mb-3">
        <label for="img_equipo" class="form-label">Imagen de equipo</label>
        <input type="file" name="img_equipo" class="form-control" id="img_equipo">
    </div>
    <button type="submit" class="btn btn-primary" name="subir_equipo">Subir</button>
    <?php echo $mensaje ?> 
</form>

<table class="table table-striped mt-3">
    <thead>
        <th>#</th>
        <th>Nombre de equipo</th>
        <th>Descripción</th>
        <th>Imagen</th>
        <th>Acción</th>
    </thead>
    <tbody>
        <?php 
        $sqltabla = "SELECT * FROM `equipos`";
        $resultadoequipos = mysqli_query($con, $sqltabla);
        while($row = mysqli_fetch_array($resultadoequipos)){ ?>
        <tr>
            <td> <?php echo $row['id_equipos']?></td> 
            <td> <?php echo $row['nombre_equipo']?></td>  
            <td><?php echo $row['descripcion']?></td>
            <td>
         <img width="320" height="180" src="<?php echo $row['img_equipos']; ?>" alt="Imagen del equipo">
        </td>
        <td>
        <a href="delete.php?id=<?php echo $row['id_equipos']?>&tipo=equipos" class="btn btn-danger">Eliminar</a>
        <a href="edit_equipo.php?id_equipos=<?php echo $row['id_equipos']?>" class="btn btn-primary">Editar</a>

        </td>
            
        </tr>
        <?php 
        }
        ?>
    </tbody>
</table>
</div>
</body>
</html>