
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messi WEB</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
        $('form').submit(function(e){
            e.preventDefault(); // Evitar el comportamiento predeterminado del formulario

            var formData = $(this).serialize(); // Serializar datos del formulario
            var url = $(this).attr('action'); // Obtener la URL del formulario

            $.ajax({
                type: 'GET',
                url: url,
                data: formData,
                success: function(response){
                    $('.contenedor-videos').html($(response).find('.contenedor-videos').html()); // Actualizar contenido de la sección de videos
                }
            });
        });
    });
    </script>
</head>
<body>
<div class="index">
    <div class="left-index">
    <div class="header">
        <img src="imagenes/messi-logo.png" alt="Logo">
        <div class="navegador">
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="index.php#estadisticas">Estadisticas</a></li>
                        <li><a href="index.php#palmares">Palmares</a></li>
                    </ul>
        </div>
    </div>
