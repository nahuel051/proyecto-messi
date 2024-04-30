<?php
include('conexion.php');
session_start();
if(!isset($_SESSION['registro'])){ // Aquí debería ser 'registro', no 'usuario'
    header('Location: login.php');
    exit(); // Agrega esto para asegurarte de que se detenga la ejecución del script después de redirigir
}
$mensaje = "";

// Obtener rquipos para el select
$sql_equipos = "SELECT id_equipos, nombre_equipo FROM equipos ORDER BY nombre_equipo ASC";
$resultadosequipos = mysqli_query($con, $sql_equipos);

if(isset($_POST['subir'])){
    $titulo_video = $_POST['titulo_video'];
    $equipo_rival = $_POST['equipo_rival'];
    $url_video = $_POST['url_video'];
    $equipo = $_POST['equipos'];

    if(empty($titulo_video) || empty($equipo_rival) || empty($url_video) || empty($equipo)){
        $mensaje = "Todos los campos son obligatiorios.";
    }else if(empty($mensaje)){
        $sqlvideo = "INSERT INTO videos (id, titulo, equipo_rival, url_video, equipo) VALUES (null, '$titulo_video', '$equipo_rival', '$url_video', '$equipo')";
        $guardar = mysqli_query($con, $sqlvideo);
    }

}
?>
<?php include("cabecera.php")?>
<?php include("lateral.php")?>
<div class="container mt-5">
<form action="index.php" method="post">
    <div class="mb-3">
        <input type="text" name="titulo_video" class="form-control" placeholder="Titulo de video">
    </div>
    <div class="mb-3">
        <input type="text" name="equipo_rival" class="form-control" placeholder="Equipo Rival">
    </div>
    <div class="mb-3">
        <input type="url" name="url_video" class="form-control" placeholder="URL video">
    </div>
    <div class="mb-3">
        <select name="equipos" class="form-select">
            <option value="">Equipos</option>
            <?php
             while ($row = mysqli_fetch_assoc($resultadosequipos)) {
                $select = (isset($_POST['equipos']) && $_POST['equipos'] == $row['id_equipos']) ? 'selected' : '';
                echo "<option value='" . $row['id_equipos'] . "' $select>" . $row['nombre_equipo'] . "</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" name="subir" class="btn btn-primary">Subir</button>
    <?php echo $mensaje ?> 
</form>

    <table class="table table-striped mt-3">
        <thead>
            <th>#</th>
            <th>Titulo</th>
            <th>Equipo Rival</th>
            <th>URL video</th>
            <th>Equipo</th>
            <th>Acciones</th>
        </thead>
        <tbody>
    <?php
// Función para obtener la URL embebida de un video de YouTube
function getEmbeddedUrl($url) {
    // Divide la URL del video de YouTube en un array usando 'v=' como separador
    $video_id = explode('v=', $url);
    // El ID del video se encuentra en el segundo elemento del array resultante
    $video_id = $video_id[1]; // Obtiene el ID del video de la URL de YouTube
    // Concatena el ID del video con la URL base de YouTube para crear la URL embebida
    $embed_url = "https://www.youtube.com/embed/" . $video_id; // URL embebida
    // Devuelve la URL embebida del video
    return $embed_url;
}

    $sqltabla = "SELECT * FROM `videos`";
    $resultadovideo = mysqli_query($con, $sqltabla);
    while ($row = mysqli_fetch_array($resultadovideo)){ ?>
    <tr>
        <td><?php echo $row['id']?></td>
        <td><?php echo $row['titulo']?></td>
        <td><?php echo $row['equipo_rival']?></td>
        <!-- inframe es para mostrar el video en la pagina es un marco en linea 
        utilizado para insertart contenido de otro recurso a una pagina -->
        <!-- frameborder especifica si el borde del infram debe mostrae
        allowfullscreen permite al inframe que se expanda en modo de pantalla completa
        cuando el usuario hace clic en la pnatalla completa -->
        <td><iframe width="320" height="180" src="<?php echo getEmbeddedUrl($row['url_video'])?>" frameborder="0" allowfullscreen></iframe></td>
        <td><?php echo $row['equipo']?></td>
        <td>
            <a href="delete.php?id=<?php echo $row['id']?>&tipo=videos" class="btn btn-danger">Eliminar</a>
            <a href="edit_video.php?id=<?php echo $row['id']?>" class="btn btn-primary">Editar</a>
        </td>

    </tr>
    <?php } ?>
    </tbody>
    </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-XtXN/G7t9ER9kN5QQxu3a5sXcVX6hx9A6z46vN7rncDSH+nw3sT5WSzof2r8dqW5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-QK+1vhxKQSd9PuwJEdp3OLh2FfvukT87XcMH4FFNU8joMcyFnnxI+qbqq1Q5gE5K" crossorigin="anonymous"></script>
</body>
</html>
