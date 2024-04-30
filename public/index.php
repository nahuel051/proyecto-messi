<?php include("cabecera.php");
require_once('../admin/conexion.php'); 
$sql = "SELECT * FROM estadisticas";
$resultado = mysqli_query($con, $sql);
if(mysqli_num_rows($resultado) > 0){
 while($row = mysqli_fetch_assoc($resultado)){
     $partidos = $row["partidos"];
     $goles = $row["goles"];
     $asistencias = $row["asistencias"];
     $fecha = $row["fecha"];
 }}?>
    <div class="contenido-index">
        <h1>Lionel <span class="apellido">Messi</span></h1>
        <p>
        Bienvenidos a la leyenda viviente del fútbol! <span class="apellido">Lionel Andrés Messi,</span> un nombre que trasciende las canchas y 
        que se ha convertido en sinónimo de grandeza futbolística. Desde sus humildes comienzos en Rosario, Argentina, 
        hasta su consagración como uno de los jugadores más icónicos de todos los tiempos, Messi ha cautivado al mundo con su gracia, 
        destreza y habilidad incomparables. 
        </p>
        <a href="goles_totales.php" class="btn-goles">
                        Ver goles
                        <div class="icon">
                            <svg
                                height="24"
                                width="24"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                                    fill="currentColor"
                                ></path>
                            </svg>
                        </div>
        </a>
        <div class="contactos-link">
        <a href="https://github.com/nahuel051" target="_blank"><i class="fa-brands fa-github"></i> GitHub</a>
        <a href="https://www.linkedin.com/in/nahuel-ramirez-ab8a93203/" target="_blank"><i class="fa-brands fa-linkedin"></i>Linkedin</a>
        </div>
    </div> <!-- FIN DE contenido-index -->
    </div> <!-- FIN DE left-index -->
    <div class="right-index">
    <img src="imagenes/messi2.png" alt="messi">
    </div>
</div><!-- FIN DE index -->
<?php include("estadisticas.php")?>
<div class="numeros-estadisticos">
        <div class="contenedor-numeros" data-tooltip="Fecha de acutalización: <?php echo $fecha?>">
       <?php require_once('../admin/conexion.php'); 
       $sql = "SELECT * FROM estadisticas";
       $resultado = mysqli_query($con, $sql);
       if(mysqli_num_rows($resultado) > 0){
        while($row = mysqli_fetch_assoc($resultado)){
            $partidos = $row["partidos"];
            $goles = $row["goles"];
            $asistencias = $row["asistencias"];
            $fecha = $row["fecha"];
        }
        ?>
        <div class="partidos"><p>Partidos</p><div id="partidos"><?php echo $partidos?></div></div>
        <div class="goles"><p>Goles</p><div id="goles"><?php echo $goles?></div></div>
        <div class="asistencias"><p>Asistencias</p><div id="asistencias"><?php echo $asistencias?></div></div>
       <?php } ?>
        </div> <!-- FIN DE contenedor-numeros -->
</div> <!-- FIN DE numeros-estadisticos -->
<?php include("palmares.php") ?>
<script>
        $(document).ready(function() {
            var contadorPartidos = <?php echo $partidos?>;
            var contadorGoles = <?php echo $goles?>;
            var contadorAsistencias = <?php echo $asistencias?>;

            var tiempo = 4000; // Tiempo en milisegundos para la animación

            $({ Counter: 0 }).animate({ Counter: contadorPartidos }, {
                duration: tiempo,
                easing: 'swing',
                step: function () {
                    $('#partidos').text(Math.ceil(this.Counter));
                }
            });
            $({ Counter: 0 }).animate({ Counter: contadorGoles }, {
                duration: tiempo,
                easing: 'swing',
                step: function () {
                    $('#goles').text(Math.ceil(this.Counter));
                }
            });
            $({ Counter: 0 }).animate({ Counter: contadorAsistencias }, {
                duration: tiempo,
                easing: 'swing',
                step: function () {
                    $('#asistencias').text(Math.ceil(this.Counter));
                }
            });
            $('.contenedor-numeros').hover(function() {
            var tooltipText = $(this).attr('data-tooltip');
                $(this).append('<div class="tooltiptext">' + tooltipText + '</div>');
            }, function() {
                $('.tooltiptext').remove();
            });
        
         // Configurar el slider
         var slideIndex = 0;
        showSlides();

        // Función para avanzar los slides
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Función para mostrar los slides
        function showSlides() {
            var i;
            var slides = $(".slider-palmares").children('.slide'); // Obtener los slides
            if (slideIndex >= slides.length) { slideIndex = 0 } // Reiniciar si se alcanza el último slide
            if (slideIndex < 0) { slideIndex = slides.length - 1 } // Volver al último slide si estamos en el primero
            for (i = 0; i < slides.length; i++) {
                $(slides[i]).hide(); // Ocultar todos los slides
            }
            $(slides[slideIndex]).show(); // Mostrar el slide actual
        }

        // Manejadores de eventos para los botones de control
        $(".prev-slide").click(function() {
            plusSlides(-1);
        });
        $(".next-slide").click(function() {
            plusSlides(1);
        });
        });

    </script>
</body>
</html>