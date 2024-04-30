<?php include("cabecera.php")?>
<div class="content-gol">
        <div class="filtros">
            <form method="get" action="goles_inter.php">
                <select name="ordenar" onchange="this.form.submit()">
                    <option value="">Ordenar por</option>
                    <option value="alfabetico" <?php echo (isset($_GET['ordenar']) && $_GET['ordenar'] == 'alfabetico') ? 'selected' : ''; ?>>Equipo Rival</option>
                    <option value="recientes" <?php echo (isset($_GET['ordenar']) && $_GET['ordenar'] == 'recientes') ? 'selected' : ''; ?>>Recientes</option>
                </select>
                <input type="text" name="text_buscar" value="<?php echo isset($_GET['text_buscar']) ? $_GET['text_buscar'] : ''; ?>">
                <button type="submit" name="buscar"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="contenedor-videos">
                <?php
                require_once('../admin/conexion.php');
                
                function getEmbeddedUrl($url) {
                    $video_id = explode('v=', $url);
                    $video_id = $video_id[1]; 
                    $embed_url = "https://www.youtube.com/embed/" . $video_id; 
                    return $embed_url;
                }

                $orden = isset($_GET['ordenar']) ? $_GET['ordenar'] : '';
                $buscar = isset($_GET['text_buscar']) ? $_GET['text_buscar'] : '';

                $equipos = "Inter Miami";
                $sqlvideos = "SELECT v.*, e.nombre_equipo 
                FROM videos v
                JOIN equipos e ON v.equipo = e.id_equipos 
                WHERE e.nombre_equipo = '$equipos' AND (equipo_rival LIKE '%$buscar%' OR titulo LIKE '%$buscar%')";

                if ($orden === 'alfabetico') {
                    $sqlvideos .= " ORDER BY v.equipo_rival";
                }
                if ($orden === 'recientes') {
                    $sqlvideos .= " ORDER BY v.id DESC ";
                }

                $resultadovideos = mysqli_query($con, $sqlvideos);

                if(mysqli_num_rows($resultadovideos) > 0){
                    while($videos = mysqli_fetch_assoc($resultadovideos)){
                        ?>  
                        <div class="videos">
                            <h3><?php echo $videos['titulo']?></h3>
                            <p><?php echo $videos['equipo_rival']?></p>
                            <p><?php echo $videos['nombre_equipo']?></p>
                            <iframe src="<?php echo getEmbeddedUrl($videos['url_video'])?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <?php
                    }
                } else {
                    echo "No se encontraron videos.";
                }
                ?>
    </div> <!-- FIN DE contenedor-videos -->
    </div> <!-- FIN DE content-goles -->

</body>
</html>
