<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario con animación de labels</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }
    .form-group {
        position: relative;
        margin-bottom: 20px;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.3s;
    }
    .form-control:focus {
        outline: none;
        border-color: dodgerblue;
    }
    .form-label {
        position: absolute;
        left: 10px;
        top: 20px;
        transition: top 0.3s, font-size 0.3s;
        font-size: 16px;
        color: #999;
        pointer-events: none;
    }
    .form-control:focus + .form-label,
    .form-control:not(:placeholder-shown) + .form-label {
        top: 6px;
        font-size: 12px;
        color: dodgerblue;
    }
</style>
</head>
<body>

<form action="#" method="post">
    <div class="form-group">
        <input type="text" id="name" name="name" class="form-control" required>
        <label for="name" class="form-label">Nombre</label>
    </div>
    <div class="form-group">
        <input type="email" id="email" name="email" class="form-control" required>
        <label for="email" class="form-label">Correo electrónico</label>
    </div>
    <div class="form-group">
        <textarea id="comment" name="comment" class="form-control" rows="4" required></textarea>
        <label for="comment" class="form-label">Comentario</label>
    </div>
    <button type="submit">Enviar</button>
</form>

</body>
</html>

