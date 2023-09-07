<?php
    if( $_SERVER['REQUEST_METHOD'] !== 'POST' ){
        header('Location: ../resultados.php');
        die();
    }
    session_start();

    // Control de errores
    if( empty( $_POST['user'] ) ){
        $_SESSION['errors']['user'] = 'Debe completar este campo';
    } else $_SESSION['login']['user'] = htmlspecialchars( $_POST['user'] );

    if( empty( $_POST['password'] ) ){
        $_SESSION['errors']['password'] = 'Debe completar este campo';
    }

    if( isset( $_SESSION['errors'] ) ){
        header( 'Location: ../resultados.php' );
        die();
    }
    // Fin control de errores

    $user = filter_input( INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS );
    $pass = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS );
    
    if( file_exists( 'usuarios.dat' ) ){
        $file = fopen( 'usuarios.dat', 'r' );

        while( !feof( $file ) ){
            $linea = fgets( $file );
            if( empty( $linea ) ) continue;
            list( $usuario_registrado, $pass_usuario_registrado ) = explode( ',', trim( $linea ) );

            if( $usuario_registrado === $user ){
                if( $pass_usuario_registrado === $pass  ){
                    fclose( $file );
                    unset( $file, $usuario_registrado, $pass_usuario_registrado, $pass );
                    $_SESSION['userid'] = session_id();
                    $_SESSION['user'] = $user;
                    header( 'Location: ../resultados.php' );
                    die();
                } else {
                    fclose( $file );
                    $_SESSION['user'] = $user;
                    $_SESSION['errors']['password'] = 'Contraseña incorrecta';
                    header( 'Location: ../resultados.php' );
                    die();
                }
            }
        }

        fclose( $file );
    } else die('ERROR. No existe el archivo usuarios.dat');

    $_SESSION['errors']['user'] = 'Usuario inválido';
    unset( $file, $usuario_registrado, $pass_usuario_registrado, $pass );
    header( 'Location: ../resultados.php' );
    die();