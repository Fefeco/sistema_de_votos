<?php

    if( $_SERVER['REQUEST_METHOD'] !== "POST"){
        header('Location: index.php');
        die();
    }

    session_start();
    include_once 'includes/calcular_edad.php';

    // Control de errores
    if( empty( $_POST['birthday'] ) ){
        $_SESSION['errors']['birthday'] = 'Debe seleccionar la fecha de nacimiento';
    } elseif( calcular_edad( $_POST['birthday'] ) < 18  ){
        $_SESSION['errors']['menor_de_edad'] = 'Debes ser mayor de 18 años para poder votar';
        header( 'Location: index.php' );
        die();
    } else $_SESSION['datos']['birthday'] = $_POST['birthday'];
    
    if( empty( $_POST['name'] ) ){
        $_SESSION['errors']['name'] = 'Debe completar este campo';
    } else {
        $_SESSION['datos']['name'] = htmlspecialchars( $_POST['name'] );
    } 

    if( empty( $_POST['lastname'] ) ){
        $_SESSION['errors']['lastname'] = 'Debe completar este campo';
    } else {
        $_SESSION['datos']['lastname'] = htmlspecialchars( $_POST['lastname'] );
    } 

    if( empty( $_POST['dni'] ) ){
        $_SESSION['errors']['dni'] = 'Debe completar este campo';
    } else {
        if( preg_match( '/^[0-9]{8}[a-zA-z]?/', $_POST['dni'] ) === 0 ){
            $_SESSION['errors']['dni'] = "Formato incorrecto. Debe contener 8 digitos y una letra";
        } else {
            $_SESSION['datos']['dni'] = $_POST['dni'];
        } 
    }

    if( empty( $_POST['candidato']) ){
        $_SESSION['errors']['candidato'] = 'Debe seleccionar un candidato';
    } else {
        $_SESSION['datos']['candidato'] = $_POST['candidato'];
    } 
    
    if( isset( $_SESSION['errors'] ) ){
        header('Location: index.php');
        exit();
    }
    // Fin control de errores
    $datos = array();
    foreach( $_SESSION['datos'] as $key => $value ){
        array_push( $datos, $key.'='.$value );
    }
    $linea = implode( ',', $datos );
    unset( $_SESSION['datos'] );
    unset( $datos );

    if( file_exists( 'elecciones2023.dat' ) ){
        @$file = fopen( 'elecciones2023.dat', 'a' );
        if( $file ){
            fwrite( $file, $linea."\n" );
        } else die('ERROR permiso de escritura');
        
    } else {
        @$file = fopen( 'elecciones2023.dat', 'w' );
        if( $file ){
            fwrite( $file, $linea."\n" );
        } else die('ERROR permiso de escritura');
    }
    fclose( $file );
    unset( $linea );
    $_SESSION['mensaje_exito'] = 'Su voto ha sido registrado con éxito';
    header('Location: index.php');
    die();