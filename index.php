<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .btn-check + .btn:hover {
            color: var(--bs-btn-hover-color);
            background-color: var(--bs-btn-hover-bg);
            border-color: var(--bs-btn-hover-border-color);
        }
    </style>
    <title>Elecciones 2023</title>
</head>
<body>
    <header class="container-md mt-2 px-4 d-flex justify-content-end" style="max-width: 600px;">
        <a class="link-offset-2 link-offset-4-hover link-underline link-underline-opacity-0" href="resultados.php">Iniciar sesión</a>
    </header>
    <section class="container-md mt-4 px-4 shadow rounded pb-5" style="max-width: 600px;">
        <?php if( isset( $_SESSION['errors']['menor_de_edad'] ) ): ?>
            <p class="py-1 px-3 text-danger bg-danger-subtle border-3 border-start border-danger rounded-1"><?=$_SESSION['errors']['menor_de_edad']?></p>
            <?php elseif( isset( $_SESSION['mensaje_exito'] ) ): ?>
            <p class="py-1 px-3 text-success bg-success-subtle border-success border-start border-3 rounded-1"><?php echo $_SESSION['mensaje_exito'] ?></p>
        <?php endif; ?>
        <h1>Elecciones 2023</h1>
        <form action="control.php" method="post">
            <article>
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php if( isset( $_SESSION['datos']['name'] ) ) echo $_SESSION['datos']['name'] ?>">
                    <?php if( isset( $_SESSION['errors']['name'] ) ){
                        echo "<p class='form-text text-danger'>{$_SESSION['errors']['name']}</p>";
                        } 
                    ?>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Apellidos</label>
                    <input type="text" name="lastname" class="form-control" id="lastname" value="<?php if( isset( $_SESSION['datos']['lastname'] ) ) echo $_SESSION['datos']['lastname'] ?>">
                    <?php if( isset( $_SESSION['errors']['lastname'] ) ){
                        echo "<p class='form-text text-danger'>{$_SESSION['errors']['lastname']}</p>";
                        } 
                    ?>
                </div>
                <div class="d-flex gap-4">
                    <div class="w-50">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control" id="dni" value="<?php if( isset( $_SESSION['datos']['dni'] ) ) echo $_SESSION['datos']['dni'] ?>">
                        <?php if( isset( $_SESSION['errors']['dni'] ) ){
                            echo "<p class='form-text text-danger'>{$_SESSION['errors']['dni']}</p>";
                        } 
                        ?>
                    </div>
                    <div class="w-50">
                        <label for="birthday" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="birthday" class="form-control" id="birthday" value="<?php if( isset( $_SESSION['datos']['birthday'] ) ) echo $_SESSION['datos']['birthday'] ?>">
                        <?php if( isset( $_SESSION['errors']['birthday'] ) ){
                            echo "<p class='form-text text-danger'>{$_SESSION['errors']['birthday']}</p>";
                            } 
                        ?>
                    </div>
                </div>
            </article>
            <article class="my-5 border rounded py-4">
                <h2 class="text-center mb-4">Seleccione un candidato</h2>
                <div class="d-flex justify-content-around">
                    <input type="radio" class="btn-check" name="candidato" id="candidato1" value="candidato1">
                    <label class="btn btn-outline-success" for="candidato1">Candidato 1</label>
                    <input type="radio" class="btn-check" name="candidato" id="candidato2" value="candidato2">
                    <label class="btn btn-outline-success" for="candidato2">Candidato 2</label>
                    <input type="radio" class="btn-check" name="candidato" id="candidato3" value="candidato3">
                    <label class="btn btn-outline-success" for="candidato3">Candidato 3</label>
                </div>
                <?php if( isset( $_SESSION['errors']['candidato'] ) ){
                        echo "<p class='form-text text-danger text-center'>{$_SESSION['errors']['candidato']}</p>";
                        } 
                ?>
            </article>
            <?php 
                unset( $_SESSION['errors'] );
                unset( $_SESSION['mensaje_exito'] );
            ?>
            <div class="d-grid col-6 mx-auto">
                <button type="submit" class="btn btn-info btn-lg">Enviar voto</button>
            </div>
        </form>
    </section>
</body>
</html>