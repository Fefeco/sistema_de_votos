<?php
    session_start();
    include_once 'includes/calculo_porcentaje.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Resultados-Elecciones 2023</title>
</head>
<body>
    <section class="container-md mt-5 px-4 shadow rounded pb-5" style="max-width: 600px;">
        <h1 class="mb-5">Resultados - Elecciones 2023</h1>

        <?php if( !isset( $_SESSION['userid'] ) ): ?>
            <form action="includes/login.php" method="post">
                <article>
                    <h2>Iniciar sesión</h2>

                    <div class="mb-3">
                        <label for="user" class="form-label">Usuario</label>
                        <input type="text" name="user" class="form-control" id="user" value="<?php if( isset( $_SESSION['login']['user'] ) ) echo $_SESSION['login']['user'] ?>">
                        <?php if( isset( $_SESSION['errors']['user'] ) ){
                            echo "<p class='form-text text-danger'>{$_SESSION['errors']['user']}</p>";
                            } 
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="password" value="<?php if( isset( $_SESSION['login']['password'] ) ) echo $_SESSION['login']['password'] ?>">
                        <?php if( isset( $_SESSION['errors']['password'] ) ){
                            echo "<p class='form-text text-danger'>{$_SESSION['errors']['password']}</p>";
                            } 
                        ?>
                    </div>

                </article>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-secondary">Iniciar sesión</button>
                </div>
            </form>
        <?php else: ?>
            <?php include_once 'includes/lectura_resultados.php' ?>
            <?php $porcentajes = calculo_porcentaje( $total_votos ); ?>
            <article>
                <table class="table table-striped table-hover">
                    <caption class="mt-3">Total de votantes: <?= array_sum( $total_votos ) ?></caption>
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Candidato</th>
                            <th scope="col">Votos</th>
                            <th scope="col">Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach( $total_votos as $candidato => $votos ): ?>
                            <tr>
                            <td scope="row"><?= $candidato ?></td>
                            <td><?= $votos ?></td>
                            <td><?= $porcentajes[$candidato].'%' ?></td>
                            </tr>        
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </article>
            <div class="d-flex justify-content-end">
                <a href="includes/logout.php"><button type="btn" class="btn btn-secondary">Cerrar sesión</button></a>
            </div>
        <?php endif; ?>
    </section>
</body>
</html>